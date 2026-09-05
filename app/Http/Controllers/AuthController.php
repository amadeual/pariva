<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Por favor, informe seu e-mail para entrar.',
            'email.email' => 'Por favor, digite um e-mail válido.',
            'password.required' => 'Por favor, insira sua senha de acesso.',
        ]);

        try {
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('discover'));
            }

            // Standard secure credential check message (avoids account enumeration)
            return back()->withErrors([
                'email' => 'E-mail ou senha incorretos. Por favor, verifique suas credenciais e tente novamente.',
            ])->onlyInput('email');

        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Login error: ' . $e->getMessage());

            return back()->withErrors([
                'email' => 'Ocorreu uma indisponibilidade temporária. Por favor, tente novamente em instantes.',
            ])->onlyInput('email');
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Por favor, informe seu endereço de e-mail.',
            'email.email' => 'Por favor, insira um e-mail válido.',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = \Illuminate\Support\Str::random(60);
            \Illuminate\Support\Facades\DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                ['token' => \Illuminate\Support\Facades\Hash::make($token), 'created_at' => now()]
            );

            $resetUrl = url('/reset-password?token=' . $token . '&email=' . urlencode($user->email));

            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($user, $resetUrl));
            } catch (\Throwable $mailErr) {
                \Illuminate\Support\Facades\Log::error('Reset password mail error: ' . $mailErr->getMessage());
            }
        }

        return back()->with('status', 'Se o e-mail informado estiver cadastrado em nossa plataforma, enviamos um link para redefinição de sua senha.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $customMessages = [
            'name.required' => 'Por favor, informe seu nome completo.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado em nosso sistema.',
            'password.required' => 'Por favor, crie uma senha.',
            'password.min' => 'A senha deve conter no mínimo 6 caracteres.',
            'password.confirmed' => 'As senhas digitadas não coincidem.',
            'gender.required' => 'Por favor, selecione o seu gênero.',
            'age.required' => 'Por favor, informe a sua idade.',
            'age.min' => 'É necessário ter no mínimo 18 anos para se cadastrar no Pariva.',
            'age.max' => 'Por favor, informe uma idade válida.',
        ];

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'gender' => ['required', 'string', 'in:homem,mulher,nao_binario'],
                'age' => ['required', 'integer', 'min:18', 'max:120'],
            ], $customMessages);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'age' => $request->age,
            ]);

            Auth::login($user);

            // Send Welcome Email asynchronously or safely
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
            } catch (\Throwable $mailErr) {
                \Illuminate\Support\Facades\Log::error('Welcome mail error: ' . $mailErr->getMessage());
            }

            return redirect()->route('onboarding.interesses');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Registration error: ' . $e->getMessage());

            return back()->withErrors([
                'email' => 'Não foi possível concluir o cadastro no momento. Por favor, tente novamente em instantes.',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
