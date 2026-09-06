@extends('layouts.app')

@section('title', 'Quem é mais provável? - Pariva Games')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/20 shadow-sm flex items-center justify-center bg-[#eee9e6] font-bold text-xs text-[#590219]" title="{{ Auth::user()->name }}">
            <img src="{{ Auth::user()->avatar_url }}" 
                 onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" 
                 alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-5 py-3 flex flex-col items-center gap-5 max-w-md mx-auto pb-10">

    <!-- Top Sub-header & Progress bar -->
    <div class="w-full flex flex-col gap-3">
        <div class="flex items-center justify-between px-1">
            <a href="{{ route('games.trivia') }}" class="w-9 h-9 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417] hover:bg-[#e2dad6] transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>

            <div class="flex flex-col items-center text-center">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219]">QUEM É MAIS PROVÁVEL?</span>
                <span class="text-xs text-[#796a6e] font-medium">Pergunta 3 de 10</span>
            </div>

            <div class="w-9"></div>
        </div>

        <!-- Progress Bar (30% filled) -->
        <div class="w-full h-1 bg-[#ede7e5] rounded-full overflow-hidden">
            <div class="w-3/10 h-full bg-[#590219] rounded-full"></div>
        </div>
    </div>

    <!-- Question Title -->
    <h1 class="text-xl sm:text-2xl font-extrabold text-[#590219] text-center leading-tight tracking-tight px-2 my-1">
        Quem provavelmente faria uma viagem de última hora?
    </h1>

    <!-- Selection Cards (User vs Match) -->
    <div class="w-full grid grid-cols-2 gap-3.5">

        <!-- Option 1: Logged-in User -->
        <div onclick="window.location.href='{{ route('games.result') }}'" class="relative w-full h-52 rounded-3xl overflow-hidden shadow-md border-2 border-transparent hover:border-[#590219] transition-all cursor-pointer group bg-[#eee9e6]">
            <img src="{{ Auth::user()->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

            <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                <h3 class="font-extrabold text-base leading-tight truncate">{{ explode(' ', Auth::user()->name)[0] }}</h3>
                <span class="text-xs opacity-90 font-light">Você</span>
            </div>
        </div>

        <!-- Option 2: Matched User -->
        @php
            $matchName = isset($matchedUser) ? explode(' ', $matchedUser->name)[0] : 'Rafael';
            $matchAvatar = isset($matchedUser) ? $matchedUser->avatar_url : asset('images/avatars/placeholder.jpg');
        @endphp
        <div onclick="window.location.href='{{ route('games.result') }}'" class="relative w-full h-52 rounded-3xl overflow-hidden shadow-md border-2 border-transparent hover:border-[#590219] transition-all cursor-pointer group bg-[#eee9e6]">
            <img src="{{ $matchAvatar }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ $matchName }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

            <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                <h3 class="font-extrabold text-base leading-tight truncate">{{ $matchName }}</h3>
                <span class="text-xs opacity-90 font-light">Match</span>
            </div>
        </div>

    </div>

    <!-- Skip Question Link -->
    <a href="{{ route('games.result') }}" class="text-xs font-extrabold uppercase tracking-widest text-[#796a6e] hover:text-[#590219] transition-colors mt-2">
        PULAR PERGUNTA
    </a>

</div>
@endsection
