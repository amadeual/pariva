@extends('layouts.app')

@section('title', 'Novo Convite de Encontro - Pariva')

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
<div class="px-5 py-3 flex flex-col items-center gap-5 max-w-md mx-auto pb-12">

    <!-- Top Mail Icon Header -->
    <div class="flex flex-col items-center text-center gap-1.5 pt-2">
        <div class="w-12 h-12 rounded-2xl bg-white border border-[#ede7e5] shadow-xs flex items-center justify-center text-[#590219]">
            <i data-lucide="mail-check" class="w-6 h-6"></i>
        </div>

        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight mt-1">
            Novo Convite
        </h1>
        <p class="text-xs text-[#796a6e] font-normal max-w-xs">
            Beatriz enviou uma sugestão de encontro.
        </p>
    </div>

    <!-- Main Invitation Card -->
    <div class="w-full bg-[#eee9e6] rounded-3xl overflow-hidden border border-[#ede7e5] shadow-sm flex flex-col">
        
        <!-- User Profile Top Section -->
        <div class="bg-[#eee9e6] p-6 flex flex-col items-center text-center gap-2 border-b border-[#ede7e5]/60">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-md">
                <img src="{{ asset('images/avatars/sofia.jpg') }}" alt="Beatriz" class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-extrabold text-[#221417] leading-tight mt-1">Beatriz, 28</h2>
            <span class="text-xs text-[#796a6e] font-medium -mt-1">Designer de Interiores</span>
        </div>

        <!-- Invitation Details -->
        <div class="p-5 flex flex-col gap-4 bg-white/50">
            
            <!-- Details 1: A Vibe -->
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219] shrink-0 mt-0.5">
                    <i data-lucide="wine" class="w-4 h-4"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#796a6e]">A VIBE</span>
                    <h3 class="font-bold text-xs text-[#221417]">Vinhos & Tapas</h3>
                    <span class="text-[11px] text-[#796a6e]">Vino! Vila Madalena</span>
                </div>
            </div>

            <!-- Details 2: Quando -->
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219] shrink-0 mt-0.5">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#796a6e]">QUANDO</span>
                    <h3 class="font-bold text-xs text-[#221417]">Sexta-feira, 13 de Outubro</h3>
                    <span class="text-[11px] text-[#796a6e]">às 20:00</span>
                </div>
            </div>

            <!-- Details 3: Onde + Map snippet -->
            <div class="flex flex-col gap-1.5 pt-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#796a6e] px-1">ONDE</span>
                
                <div class="relative w-full h-24 rounded-2xl overflow-hidden border border-[#ede7e5] bg-sky-100 p-2 shadow-xs">
                    <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:12px_12px] opacity-70"></div>
                    
                    <div class="relative z-10 bg-white/95 backdrop-blur-md rounded-xl p-2.5 flex items-center gap-2 border border-[#ede7e5] mt-8">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#590219] shrink-0"></i>
                        <span class="text-[10px] font-bold text-[#221417] truncate">R. Fradique Coutinho, 47</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Safety Notice Card -->
    <div class="w-full bg-[#eee9e6] rounded-2xl p-4 flex items-start gap-3 border border-[#ede7e5]">
        <i data-lucide="shield-check" class="w-5 h-5 text-[#796a6e] shrink-0 mt-0.5"></i>
        <p class="text-[11px] text-[#796a6e] leading-relaxed">
            O recurso <strong class="text-[#221417]">Compartilhar Encontro</strong> será ativado automaticamente ao confirmar. Suas amigas de confiança serão notificadas para sua segurança.
        </p>
    </div>

    <!-- Actions Section -->
    <div class="w-full flex flex-col gap-3 mt-1">
        <!-- Aceitar Convite -->
        <a href="{{ route('chat') }}" class="w-full py-4 bg-[#590219] text-white font-bold text-xs rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2">
            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            <span>ACEITAR CONVITE</span>
        </a>

        <!-- Sugerir alteração / Recusar buttons row -->
        <div class="grid grid-cols-2 gap-3">
            <button class="py-3 bg-white text-[#590219] border border-[#ede7e5] font-extrabold text-[10px] uppercase tracking-wider rounded-xl hover:bg-[#fbf9f8] transition-colors">
                SUGERIR ALTERAÇÃO
            </button>
            <button class="py-3 bg-white text-[#796a6e] border border-[#ede7e5] font-extrabold text-[10px] uppercase tracking-wider rounded-xl hover:bg-[#fbf9f8] transition-colors">
                RECUSAR
            </button>
        </div>
    </div>

</div>
@endsection
