@extends('layouts.app')

@section('title', 'Pariva Games - Descobrir')

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
<div class="px-5 py-4 flex flex-col gap-5 max-w-md mx-auto pb-10">

    <!-- Title Section -->
    <div class="flex flex-col text-center gap-1.5">
        <h1 class="text-2xl font-extrabold text-[#590219] tracking-tight">
            Pariva Games
        </h1>
        <p class="text-xs text-[#796a6e] font-normal leading-relaxed max-w-xs mx-auto">
            Descubram o quanto vocês combinam através de jogos interativos.
        </p>
    </div>

    <!-- Featured Game: Quem é mais provável? (Dark Card with Background Image) -->
    <a href="{{ route('games.trivia') }}" class="relative w-full h-44 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] bg-gray-900 block">
        <img src="{{ asset('images/moments/cafe.jpg') }}" alt="Quem é mais provável?" class="w-full h-full object-cover opacity-50 group-hover:scale-105 transition-transform duration-300">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/30"></div>

        <div class="absolute inset-0 p-5 flex flex-col justify-between text-white">
            <div class="flex items-center gap-1.5 text-[11px] font-bold tracking-wider uppercase text-white/90">
                <i data-lucide="help-circle" class="w-4 h-4"></i>
                <span>NOVO</span>
            </div>

            <div class="flex flex-col gap-1">
                <h2 class="text-xl font-extrabold tracking-tight">Quem é mais provável?</h2>
                <p class="text-xs text-white/80 font-light leading-snug">
                    Um jogo rápido para descobrir as percepções um do outro.
                </p>
            </div>
        </div>
    </a>

    <!-- Grid: 2 Column Games -->
    <div class="grid grid-cols-2 gap-3">

        <!-- Game 2: Você prefere? -->
        <a href="{{ route('games.trivia') }}" class="bg-[#eee9e6] rounded-3xl p-5 flex flex-col justify-between h-48 border border-[#ede7e5] relative shadow-xs hover:bg-[#e4deda] transition-colors cursor-pointer block">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219]">
                    <i data-lucide="git-fork" class="w-5 h-5"></i>
                </div>
                <i data-lucide="arrow-down-left" class="w-5 h-5 text-[#b0a5a8]"></i>
            </div>

            <div class="flex flex-col gap-1">
                <h3 class="font-extrabold text-base text-[#221417] leading-tight">Você prefere?</h3>
                <p class="text-[11px] text-[#796a6e] leading-tight font-medium">
                    Dilemas instigantes para quebrar o gelo.
                </p>
            </div>
        </a>

        <!-- Game 3: Conheça-me -->
        <a href="{{ route('games.trivia') }}" class="bg-[#eee9e6] rounded-3xl p-5 flex flex-col justify-between h-48 border border-[#ede7e5] relative shadow-xs hover:bg-[#e4deda] transition-colors cursor-pointer block">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219]">
                    <i data-lucide="hand-metal" class="w-5 h-5"></i>
                </div>
                <i data-lucide="heart" class="w-6 h-6 text-[#d6c7c4] stroke-[1.5px]"></i>
            </div>

            <div class="flex flex-col gap-1">
                <h3 class="font-extrabold text-base text-[#221417] leading-tight">Conheça-me</h3>
                <p class="text-[11px] text-[#796a6e] leading-tight font-medium">
                    Perguntas profundas para gerar conexões.
                </p>
            </div>
        </a>

    </div>

    <!-- Game 4: 2 Verdades, 1 Mentira (Horizontal Banner Card) -->
    <a href="{{ route('games.trivia') }}" class="bg-[#eee9e6] rounded-3xl p-4 px-5 flex items-center justify-between border border-[#ede7e5] shadow-xs hover:bg-[#e4deda] transition-colors cursor-pointer block">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219] shrink-0">
                <i data-lucide="dice-5" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col">
                <h3 class="font-extrabold text-sm text-[#221417]">2 Verdades, 1 Mentira</h3>
                <p class="text-[11px] text-[#796a6e] font-medium">Teste a intuição do seu par.</p>
            </div>
        </div>
        <i data-lucide="chevron-right" class="w-5 h-5 text-[#796a6e]"></i>
    </a>

    <!-- Compatibility Challenge Card (Burgundy Large Card) -->
    <div class="bg-gradient-to-b from-[#70293a] to-[#4e1322] text-white rounded-3xl p-6 flex flex-col items-center text-center gap-3 shadow-lg border border-[#3f0111] mt-1">
        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
            <i data-lucide="star" class="w-6 h-6 text-white"></i>
        </div>

        <h3 class="font-extrabold text-xl tracking-tight">Compatibility Challenge</h3>

        <p class="text-xs text-white/80 leading-relaxed max-w-xs font-light">
            O teste definitivo para ver se seus valores se alinham.
        </p>

        <a href="{{ route('games.trivia') }}" class="w-full py-3.5 bg-white text-[#590219] font-extrabold text-xs uppercase tracking-wider rounded-full shadow-md hover:bg-[#fdf2f4] transition-all text-center block mt-1">
            INICIAR DESAFIO
        </a>
    </div>

</div>
@endsection
