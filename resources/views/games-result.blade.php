@extends('layouts.app')

@section('title', 'Resultado do Jogo - Pariva')

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
            <img src="{{ Auth::user()->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="Perfil" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
@php
    $matchName = isset($matchedUser) ? explode(' ', $matchedUser->name)[0] : 'Rafael';
    $matchAvatar = isset($matchedUser) ? $matchedUser->avatar_url : asset('images/avatars/rafael.jpg');
@endphp
<div class="px-5 py-2 flex flex-col items-center gap-6 max-w-md mx-auto pb-10">

    <!-- Top Hero Banner with Holding Hands Image -->
    <div class="relative w-full h-44 rounded-3xl overflow-hidden shadow-sm border border-[#ede7e5]">
        <img src="{{ asset('images/moments/cafe.jpg') }}" alt="Sintonia" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#fbf9f8] via-[#fbf9f8]/60 to-transparent"></div>

        <!-- Floating Heart Badge -->
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-11 h-11 rounded-full bg-white text-[#590219] flex items-center justify-center shadow-lg border border-[#ede7e5]">
            <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
        </div>
    </div>

    <!-- Main Title & Subtitle -->
    <div class="flex flex-col text-center gap-1 -mt-2">
        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">
            Vocês estão em sintonia!
        </h1>
        <p class="text-xs text-[#796a6e] font-normal">
            Vocês concordaram em 8 de 10 respostas.
        </p>
    </div>

    <!-- Affinity Gauge Circle Card -->
    <div class="bg-white rounded-3xl p-6 border border-[#ede7e5] shadow-sm flex flex-col items-center justify-center w-56 h-56 relative">
        <div class="relative w-36 h-36 flex items-center justify-center">
            <!-- SVG Progress Circle -->
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="42" stroke="#f2e8ea" stroke-width="6" fill="transparent" />
                <circle cx="50" cy="50" r="42" stroke="#590219" stroke-width="6" stroke-linecap="round" fill="transparent" stroke-dasharray="263.89" stroke-dashoffset="21.1" />
            </svg>
            <div class="absolute flex flex-col items-center text-center">
                <span class="text-3xl font-extrabold text-[#221417]">92%</span>
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#796a6e]">DE AFINIDADE</span>
            </div>
        </div>
    </div>

    <!-- Section Title: Destaques da rodada -->
    <div class="w-full flex items-center justify-center gap-3 my-1">
        <div class="h-px bg-[#ede7e5] flex-1"></div>
        <h2 class="text-base font-extrabold text-[#221417]">Destaques da rodada</h2>
        <div class="h-px bg-[#ede7e5] flex-1"></div>
    </div>

    <!-- Highlight Card 1 (Sintonia) -->
    <div class="w-full bg-[#eee9e6] rounded-2xl p-4 flex flex-col gap-2 border border-[#ede7e5] relative">
        <div class="flex items-center gap-2">
            <div class="flex -space-x-2">
                <img src="{{ Auth::user()->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="Você" class="w-6 h-6 rounded-full border border-white object-cover">
                <img src="{{ $matchAvatar }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ $matchName }}" class="w-6 h-6 rounded-full border border-white object-cover">
            </div>
            <span class="bg-[#e4deda] text-[#590219] font-bold text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                SINTONIA
            </span>
        </div>

        <p class="text-xs text-[#221417] leading-relaxed font-medium">
            Ambos acham que <strong class="text-[#590219]">{{ $matchName }}</strong> faria uma viagem de última hora sem planejar absolutamente nada.
        </p>
    </div>

    <!-- Highlight Card 2 (Curiosidade) -->
    <div class="w-full bg-[#eee9e6] rounded-2xl p-4 flex flex-col gap-2 border border-[#ede7e5] relative">
        <div class="flex items-center gap-2">
            <div class="flex -space-x-2">
                <img src="{{ Auth::user()->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="Você" class="w-6 h-6 rounded-full border border-white object-cover">
                <img src="{{ $matchAvatar }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ $matchName }}" class="w-6 h-6 rounded-full border border-white object-cover">
            </div>
            <span class="bg-[#e4deda] text-[#590219] font-bold text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                CURIOSIDADE
            </span>
        </div>

        <p class="text-xs text-[#221417] leading-relaxed font-medium">
            Vocês dois confessaram que roubariam comida do prato do outro no primeiro encontro.
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="w-full flex flex-col gap-2.5 mt-2">
        <a href="{{ route('chat') }}" class="w-full py-4 bg-[#590219] text-white font-bold text-xs rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2">
            <span>Conversar sobre os resultados</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>

        <a href="{{ route('games.trivia') }}" class="w-full py-4 bg-[#eee9e6] text-[#221417] font-bold text-xs rounded-2xl border border-[#ede7e5] hover:bg-[#e2dad6] transition-all text-center">
            Jogar outro jogo
        </a>
    </div>

</div>
@endsection
