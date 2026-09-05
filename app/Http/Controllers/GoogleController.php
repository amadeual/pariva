<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Look up existing user by google_id or email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Associate google_id and avatar if not already present
                $user->update([
                    'google_id' => $user->google_id ?? $googleUser->getId(),
                    'avatar'    => $user->avatar ?? $googleUser->getAvatar(),
                ]);
            } else {
                // Register a new user via Google SSO
                $user = User::create([
                    'name'        => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Usuário',
                    'email'       => $googleUser->getEmail(),
                    'google_id'   => $googleUser->getId(),
                    'avatar'      => $googleUser->getAvatar(),
                    'password'    => null,
                    'is_verified' => true, // Auto-verify Google SSO users
                ]);

                try {
                    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
                } catch (\Throwable $mailErr) {
                    Log::error('Google SSO Welcome mail error: ' . $mailErr->getMessage());
                }
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            // Redirect to interest onboarding if user details (e.g. gender or age) are incomplete
            if (empty($user->gender) || empty($user->age)) {
                return redirect()->intended(route('onboarding.interesses'));
            }

            return redirect()->intended(route('discover'));

        } catch (Throwable $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());

            return redirect()->route('login')->withErrors([
                'email' => 'Não foi possível autenticar com o Google. Por favor, tente novamente.',
            ]);
        }
    }
}
