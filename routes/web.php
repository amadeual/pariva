<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public Landing & Legal Routes
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/termos', function () {
    return view('legal.termos');
})->name('legal.termos')->name('termos');

Route::get('/privacidade', function () {
    return view('legal.privacidade');
})->name('legal.privacidade')->name('privacidade');

Route::get('/seguranca', function () {
    return view('legal.seguranca');
})->name('legal.seguranca')->name('seguranca');


// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::get('/reset-password', function () {
        return view('auth.reset-password');
    })->name('password.reset');

    // Google SSO Routes
    Route::get('/auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// Authenticated Application Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/descobrir', [AppController::class, 'discover'])->name('discover');
    Route::post('/like/{user}', [AppController::class, 'likeUser'])->name('like.user');

    Route::get('/curtidas', [AppController::class, 'likes'])->name('likes');

    Route::get('/moments', function () {
        return view('moments');
    })->name('moments');

    Route::get('/encontros', [AppController::class, 'encontros'])->name('encontros');

    Route::get('/encontros/agendar/{userId}', [AppController::class, 'agendarEncontro'])->name('encontros.agendar');
    Route::post('/encontros/agendar', [AppController::class, 'storeEncontro'])->name('encontros.store');

    Route::get('/encontros/convite/{dateId}', [AppController::class, 'conviteEncontro'])->name('encontros.convite');
    Route::post('/encontros/responder/{dateId}', [AppController::class, 'responderEncontro'])->name('encontros.responder');

    Route::get('/games/quem-e-mais-provavel', [AppController::class, 'gamesTrivia'])->name('games.trivia');
    Route::get('/games/resultado', [AppController::class, 'gamesResult'])->name('games.result');

    Route::get('/match-celebration', [AppController::class, 'matchCelebration'])->name('match.celebration');

    Route::get('/onboarding/interesses', [AppController::class, 'onboardingInteresses'])->name('onboarding.interesses');
    Route::post('/onboarding/interesses', [AppController::class, 'saveOnboardingInteresses'])->name('onboarding.interesses.save');

    Route::get('/filtros', [AppController::class, 'filtros'])->name('filtros');
    Route::post('/filtros', [AppController::class, 'updateFilters'])->name('filtros.update');

    Route::get('/premium', [AppController::class, 'premium'])->name('premium');
    Route::get('/chat', [AppController::class, 'chat'])->name('chat');

    Route::get('/perfil/editar', [AppController::class, 'editProfile'])->name('profile.edit');
    Route::post('/perfil/editar', [AppController::class, 'updateProfile'])->name('profile.update');

    Route::get('/matches', function () {
        return redirect()->route('chat');
    })->name('matches');

    Route::post('/user/report', [AppController::class, 'reportUser'])->name('user.report');
    Route::post('/user/block', [AppController::class, 'blockUser'])->name('user.block');
    Route::post('/user/send-gift', [AppController::class, 'sendGift'])->name('user.gift');

    Route::post('/user/boost', [AppController::class, 'buyBoost'])->name('user.boost');
    Route::post('/user/featured', [AppController::class, 'buyFeatured'])->name('user.featured');
    Route::post('/user/see-likes', [AppController::class, 'buySeeLikes'])->name('user.see-likes');
});

// Email Preview Routes for Development
Route::prefix('email-preview')->group(function () {
    Route::get('/welcome', function () {
        $user = new App\Models\User(['name' => 'Amanda Silva', 'email' => 'amanda@pariva.com.br']);
        $user->id = 1;
        return new App\Mail\WelcomeMail($user);
    });

    Route::get('/reset-password', function () {
        $user = new App\Models\User(['name' => 'Amanda Silva', 'email' => 'amanda@pariva.com.br']);
        $user->id = 1;
        return new App\Mail\ResetPasswordMail($user, url('/reset-password?token=sample123'));
    });

    Route::get('/account-banned', function () {
        $user = new App\Models\User(['name' => 'Amanda Silva', 'email' => 'amanda@pariva.com.br']);
        $user->id = 1;
        return new App\Mail\AccountBannedMail($user, 'Comportamento inadequado e violação das diretrizes da comunidade.');
    });

    Route::get('/verify-email', function () {
        $user = new App\Models\User(['name' => 'Amanda Silva', 'email' => 'amanda@pariva.com.br']);
        $user->id = 1;
        return new App\Mail\VerifyEmailMail($user, url('/verify-email?code=849201'), '849201');
    });
});


