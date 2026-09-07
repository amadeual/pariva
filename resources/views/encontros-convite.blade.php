@extends('layouts.app')

@section('title', 'Convite de Encontro - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('encontros') }}" class="text-xs font-bold text-[#590219] hover:underline flex items-center gap-1">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>Voltar para Agenda</span>
        </a>
    </header>
@endsection

@section('content')
<div class="px-5 py-3 flex flex-col items-center gap-5 max-w-md mx-auto pb-16">

    <!-- Top Icon Header -->
    <div class="flex flex-col items-center text-center gap-1.5 pt-2">
        <div class="w-12 h-12 rounded-2xl bg-[#fdf2f4] border border-[#590219]/20 shadow-xs flex items-center justify-center text-[#590219]">
            <i data-lucide="calendar-heart" class="w-6 h-6"></i>
        </div>

        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight mt-1">
            Convite de Encontro
        </h1>
        <p class="text-xs text-[#796a6e] font-medium max-w-xs">
            {{ $date->user_id == Auth::id() ? 'Você enviou este convite para ' . ($date->targetUser->name ?? 'Match') : ($date->user->name ?? 'Match') . ' convidou você para um date!' }}
        </p>
    </div>

    <!-- Main Invitation Card -->
    <div class="w-full bg-white rounded-3xl overflow-hidden border border-[#ede7e5] shadow-md flex flex-col">
        
        <!-- User Profile Top Section -->
        <div class="bg-gradient-to-b from-[#fdf2f4] to-white p-6 flex flex-col items-center text-center gap-2 border-b border-[#ede7e5]/60">
            <div class="relative w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-md">
                <img src="{{ $date->user->avatar_url ?? asset('images/avatars/placeholder.jpg') }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ $date->user->name ?? 'Convite' }}" class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-extrabold text-[#221417] leading-tight mt-1">{{ $date->user->name ?? 'Membro Pariva' }}</h2>
            <span class="text-xs text-[#796a6e] font-semibold -mt-1">{{ $date->user->profession ?? 'Membro Verificado' }}</span>

            <div class="mt-1">
                @if($date->status === 'confirmado')
                    <span class="bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase px-3 py-1 rounded-full border border-emerald-300 flex items-center gap-1">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                        ENCONTRO CONFIRMADO
                    </span>
                @elseif($date->status === 'pendente')
                    <span class="bg-amber-100 text-amber-800 text-[10px] font-black uppercase px-3 py-1 rounded-full border border-amber-300 flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-600"></i>
                        AGUARDANDO CONFIRMAÇÃO
                    </span>
                @elseif($date->status === 'recusado')
                    <span class="bg-rose-100 text-rose-800 text-[10px] font-black uppercase px-3 py-1 rounded-full border border-rose-300">
                        CONVITE RECUSADO
                    </span>
                @endif
            </div>
        </div>

        <!-- Invitation Details -->
        <div class="p-5 flex flex-col gap-4 bg-white">
            
            <!-- Details 1: A Vibe -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-2xl bg-[#fdf2f4] flex items-center justify-center text-[#590219] shrink-0">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#796a6e]">A VIBE DO DATE</span>
                    <h3 class="font-extrabold text-sm text-[#221417]">{{ $date->title }}</h3>
                </div>
            </div>

            <!-- Details 2: Quando -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-2xl bg-[#fdf2f4] flex items-center justify-center text-[#590219] shrink-0">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#796a6e]">QUANDO</span>
                    <h3 class="font-bold text-xs text-[#221417]">
                        {{ \Carbon\Carbon::parse($date->date_time)->translatedFormat('l, d \d\e F \d\e Y') }}
                    </h3>
                    <span class="text-xs text-[#590219] font-extrabold">
                        às {{ \Carbon\Carbon::parse($date->date_time)->format('H:i') }}
                    </span>
                </div>
            </div>

            <!-- Details 3: Onde + Venue info -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-2xl bg-[#fdf2f4] flex items-center justify-center text-[#590219] shrink-0">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                </div>
                <div class="flex flex-col w-full">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#796a6e]">ONDE</span>
                    <h3 class="font-bold text-xs text-[#221417] leading-snug">{{ $date->location }}</h3>
                </div>
            </div>

        </div>

    </div>

    <!-- Safety Notice Card -->
    <div class="w-full bg-[#eee9e6] rounded-2xl p-4 flex items-start gap-3 border border-[#ede7e5]">
        <i data-lucide="shield-check" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
        <p class="text-[11px] text-[#796a6e] leading-relaxed">
            Ao confirmar o encontro, os detalhes de local e horário ficarão salvos na sua agenda e o recurso de <strong class="text-[#221417]">Encontro Seguro</strong> notificará seus contatos de confiança.
        </p>
    </div>

    <!-- Action Form Section -->
    <div class="w-full flex flex-col gap-3 mt-1">
        @if(Auth::id() === $date->target_user_id && $date->status === 'pendente')
            <!-- Accept Button Form -->
            <form action="{{ route('encontros.responder', $date->id) }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="status" value="confirmado">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#ff007f] text-white font-extrabold text-xs tracking-wider rounded-2xl shadow-xl hover:opacity-95 transition-all flex items-center justify-center gap-2 cursor-pointer border border-white/20">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                    <span>ACEITAR CONVITE DE ENCONTRO</span>
                </button>
            </form>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('chat', ['user_id' => $date->user_id]) }}" class="py-3 bg-white text-[#590219] border border-[#ede7e5] font-extrabold text-[10px] uppercase tracking-wider rounded-xl hover:bg-[#fbf9f8] transition-colors flex items-center justify-center gap-1">
                    <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                    <span>Sugerir Alteração</span>
                </a>

                <form action="{{ route('encontros.responder', $date->id) }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="status" value="recusado">
                    <button type="submit" class="w-full py-3 bg-white text-[#796a6e] border border-[#ede7e5] font-extrabold text-[10px] uppercase tracking-wider rounded-xl hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 transition-colors cursor-pointer flex items-center justify-center gap-1">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        <span>Recusar Date</span>
                    </button>
                </form>
            </div>
        @else
            <!-- If already confirmed or user is sender -->
            <a href="{{ route('chat', ['user_id' => Auth::id() === $date->user_id ? $date->target_user_id : $date->user_id]) }}" class="w-full py-4 bg-[#590219] text-white font-extrabold text-xs tracking-wider rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>COMBINAR DETALHES NO CHAT</span>
            </a>
        @endif
    </div>

</div>
@endsection
