@extends('layouts.app')

@section('title', 'É um Match! - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#f0e6e4] flex items-center justify-center p-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="#590219" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Descobrir</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/20 shadow-sm">
            <img src="{{ asset('images/avatars/isabella.jpg') }}" alt="Perfil" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-6 py-6 flex flex-col justify-between items-center min-h-[calc(100vh-140px)] max-w-md mx-auto text-center">

    <div class="flex flex-col items-center gap-6 w-full pt-4">

        <!-- Title Header -->
        <div class="flex flex-col gap-1.5 items-center">
            <div class="flex items-center justify-center gap-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#590219] tracking-tight">
                    É um Match!
                </h1>
                <span class="text-3xl">❤️</span>
            </div>
            <p class="text-sm text-[#796a6e] font-normal">
                Vocês dois demonstraram interesse.
            </p>
        </div>

        <!-- Overlapping Profile Avatars with Compatibility Badge -->
        <div class="relative flex items-center justify-center my-6">
            
            <!-- Left Avatar (Logged-in User) -->
            <div class="w-36 h-36 rounded-full border-4 border-white shadow-xl overflow-hidden z-10 flex items-center justify-center bg-[#eee9e6] font-bold text-[#590219]" title="{{ $currentUser->name }}">
                <img src="{{ asset('images/avatars/' . (strtolower(explode(' ', $currentUser->name)[0])) . '.jpg') }}" 
                     onerror="this.src='{{ asset('images/avatars/isabella.jpg') }}'"
                     alt="{{ $currentUser->name }}" class="w-full h-full object-cover">
            </div>

            <!-- Right Avatar (Matched User) -->
            <div class="w-36 h-36 rounded-full border-4 border-white shadow-xl overflow-hidden -ml-10 z-20 flex items-center justify-center bg-[#eee9e6] font-bold text-[#590219]" title="{{ $matchedUser->name }}">
                <img src="{{ asset('images/avatars/' . (strtolower(explode(' ', $matchedUser->name)[0])) . '.jpg') }}" 
                     onerror="this.src='{{ asset('images/avatars/mariana.jpg') }}'"
                     alt="{{ $matchedUser->name }}" class="w-full h-full object-cover">
            </div>

            <!-- Bottom Compatibility Badge -->
            <div class="absolute -bottom-4 z-30 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full border border-[#ede7e5] shadow-lg flex items-center gap-1.5 text-xs font-bold text-[#221417]">
                <i data-lucide="heart" class="w-3.5 h-3.5 text-[#590219] fill-current"></i>
                <span>91% Compatível</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="w-full flex flex-col gap-3 mt-6">
            <!-- Enviar mensagem -->
            <a href="{{ route('chat') }}" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Enviar mensagem</span>
            </a>

            <!-- Jogar juntos -->
            <a href="{{ route('games.trivia') }}" class="w-full py-4 bg-[#fdf2f4] text-[#590219] border border-[#f5d6dc] font-bold text-sm rounded-2xl hover:bg-[#fae6e9] transition-all flex items-center justify-center gap-2">
                <i data-lucide="gamepad-2" class="w-4 h-4 text-[#590219]"></i>
                <span>Jogar juntos</span>
            </a>
        </div>

    </div>

    <!-- Bottom Link: Continuar descobrindo -->
    <a href="{{ route('discover') }}" class="text-xs font-semibold text-[#796a6e] hover:text-[#221417] transition-colors py-4">
        Continuar descobrindo
    </a>

</div>
@endsection
