@extends('layouts.app')

@section('title', 'Minha Agenda de Encontros - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('encontros.agendar') }}" class="text-xs font-bold text-white bg-[#590219] px-3.5 py-1.5 rounded-xl shadow-xs hover:bg-[#3f0111] transition-colors flex items-center gap-1.5">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            <span>Agendar Date</span>
        </a>
    </header>
@endsection

@section('content')
<div class="px-5 py-3 flex flex-col gap-6 max-w-md mx-auto pb-16">

    <!-- Title Header -->
    <div class="flex flex-col text-center gap-1 pt-1">
        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">
            Minha Agenda & Ideias
        </h1>
        <p class="text-xs text-[#796a6e] font-medium leading-relaxed px-4">
            Gerencie seus encontros agendados e responda aos convites recebidos dos seus matches.
        </p>
    </div>

    @php
        $user = Auth::user();
        $receivedPending = $dates->filter(fn($d) => $d->target_user_id == $user->id && $d->status === 'pendente');
        $myDates = $dates->reject(fn($d) => $d->target_user_id == $user->id && $d->status === 'pendente');
    @endphp

    <!-- Section: Convites Recebidos (Pendentes de Resposta) -->
    @if($receivedPending->count() > 0)
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#590219] flex items-center gap-2">
                <i data-lucide="mail-open" class="w-4 h-4 text-[#ff007f]"></i>
                <span>Convites Recebidos</span>
            </h2>
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-white bg-gradient-to-r from-[#ff007f] to-rose-600 px-2.5 py-0.5 rounded-full shadow-xs animate-pulse">
                {{ $receivedPending->count() }} PENDENTE{{ $receivedPending->count() > 1 ? 'S' : '' }}
            </span>
        </div>

        <div class="flex flex-col gap-3">
            @foreach($receivedPending as $date)
                @php
                    $otherUser = $date->user_id == $user->id ? $date->targetUser : $date->user;
                @endphp
                <div class="bg-gradient-to-br from-white via-[#fdf2f4] to-[#fae6e9] rounded-3xl p-4 border-2 border-[#590219]/30 shadow-md flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-[#590219] shrink-0 shadow-sm">
                                <img src="{{ $otherUser->avatar_url ?? asset('images/avatars/placeholder.jpg') }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" class="w-full h-full object-cover" alt="{{ $otherUser->name ?? 'User' }}">
                            </div>
                            <div class="flex flex-col">
                                <h3 class="font-extrabold text-sm text-[#221417] leading-snug">{{ $date->title }}</h3>
                                <p class="text-xs text-[#590219] font-bold">
                                    Convite de {{ $otherUser->name ?? 'Match' }}
                                </p>
                            </div>
                        </div>
                        <span class="bg-amber-100 text-amber-800 text-[9px] font-black uppercase px-2.5 py-1 rounded-full border border-amber-300">
                            Aguardando você
                        </span>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-3 flex flex-col gap-1 border border-[#ede7e5]">
                        <div class="flex items-center gap-2 text-xs font-semibold text-[#221417]">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-[#590219]"></i>
                            <span>{{ \Carbon\Carbon::parse($date->date_time)->format('d/m/Y \à\s H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-medium text-[#796a6e]">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#590219]"></i>
                            <span class="truncate">{{ $date->location }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <a href="{{ route('encontros.convite', $date->id) }}" class="py-2.5 rounded-xl bg-white border border-[#590219] text-[#590219] text-xs font-extrabold flex items-center justify-center gap-1 hover:bg-[#fbf9f8] transition-colors">
                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                            <span>Ver Detalhes</span>
                        </a>

                        <form action="{{ route('encontros.responder', $date->id) }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="status" value="confirmado">
                            <button type="submit" class="w-full py-2.5 rounded-xl bg-[#590219] text-white text-xs font-extrabold flex items-center justify-center gap-1 shadow-md hover:bg-[#3f0111] transition-colors cursor-pointer">
                                <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                                <span>Aceitar Date</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Agenda de Dates Confirmados / Enviados -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">Meus Encontros</h2>
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] bg-[#f8d7da] px-2.5 py-0.5 rounded-full">
                {{ count($dates) }} TOTAL
            </span>
        </div>

        <div class="flex flex-col gap-2.5">
            @forelse($dates as $date)
                @php
                    $isSender = $date->user_id == $user->id;
                    $otherUser = $isSender ? $date->targetUser : $date->user;
                @endphp
                <div class="bg-white rounded-2xl p-4 border border-[#ede7e5] shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative w-12 h-12 rounded-full overflow-hidden border border-[#590219]/20 shrink-0 bg-[#fdf2f4]">
                            <img src="{{ $otherUser->avatar_url ?? asset('images/avatars/placeholder.jpg') }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" class="w-full h-full object-cover" alt="{{ $otherUser->name ?? 'Match' }}">
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-extrabold text-xs text-[#221417] max-w-[170px] truncate">{{ $date->title }}</h3>
                            <p class="text-[11px] text-[#796a6e] font-medium flex items-center gap-1 mt-0.5">
                                <i data-lucide="calendar" class="w-3 h-3 text-[#590219]"></i>
                                {{ \Carbon\Carbon::parse($date->date_time)->format('d/m/Y H:i') }}
                            </p>
                            <span class="text-[10px] text-[#590219] font-bold mt-0.5 flex items-center gap-1 max-w-[170px] truncate">
                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                {{ $date->location }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-1.5">
                        @if($date->status === 'confirmado')
                            <span class="bg-emerald-50 text-emerald-700 text-[9px] font-extrabold uppercase px-2.5 py-1 rounded-lg border border-emerald-200 flex items-center gap-1">
                                <i data-lucide="check-circle" class="w-3 h-3"></i>
                                Confirmado
                            </span>
                        @elseif($date->status === 'pendente')
                            <a href="{{ route('encontros.convite', $date->id) }}" class="bg-amber-50 text-amber-700 text-[9px] font-extrabold uppercase px-2.5 py-1 rounded-lg border border-amber-200 hover:bg-amber-100 flex items-center gap-1">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                {{ $isSender ? 'Aguardando' : 'Pendente' }}
                            </a>
                        @elseif($date->status === 'recusado')
                            <span class="bg-rose-50 text-rose-700 text-[9px] font-extrabold uppercase px-2.5 py-1 rounded-lg border border-rose-200">
                                Recusado
                            </span>
                        @else
                            <span class="bg-gray-50 text-gray-700 text-[9px] font-extrabold uppercase px-2.5 py-1 rounded-lg border border-gray-200">
                                {{ ucfirst($date->status) }}
                            </span>
                        @endif

                        <span class="text-[9px] text-[#796a6e] font-medium">
                            com {{ $otherUser ? explode(' ', $otherUser->name)[0] : 'Match' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-6 border border-[#ede7e5] shadow-xs text-center flex flex-col items-center gap-2">
                    <div class="w-12 h-12 rounded-2xl bg-[#fdf2f4] text-[#590219] flex items-center justify-center">
                        <i data-lucide="calendar-heart" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-xs text-[#221417]">Nenhum encontro agendado ainda</h3>
                    <p class="text-[11px] text-[#796a6e] max-w-xs">
                        Agende um encontro incrível com quem você deu match no Pariva!
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Date Ideas Section Header -->
    <div class="flex justify-between items-center px-1 pt-2">
        <h2 class="text-base font-extrabold text-[#221417]">Sugestões de Locais</h2>
        <a href="{{ route('encontros.agendar') }}" class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] hover:underline">Ver Todos</a>
    </div>

    <!-- Date Ideas Grid -->
    <div class="flex flex-col gap-4">

        <!-- Card 1: Café & Conversa -->
        <a href="{{ route('encontros.agendar') }}" class="relative w-full h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
            <img src="{{ asset('images/moments/cafe.jpg') }}" alt="Café & Conversa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
            
            <div class="absolute bottom-4 left-4 right-4 text-white flex flex-col gap-0.5">
                <div class="flex items-center gap-2 font-bold text-base">
                    <i data-lucide="coffee" class="w-4 h-4 text-white"></i>
                    <span>Café & Conversa</span>
                </div>
                <p class="text-xs text-white/90 font-light">Perfeito para o primeiro encontro</p>
            </div>
        </a>

        <!-- Row 2: 2 Column Cards -->
        <div class="grid grid-cols-2 gap-3">
            <!-- Card 2: Jantar Romântico -->
            <a href="{{ route('encontros.agendar') }}" class="relative h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
                <img src="{{ asset('images/moments/museum.jpg') }}" alt="Jantar Romântico" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col gap-0.5">
                    <i data-lucide="utensils" class="w-4 h-4 text-white mb-0.5"></i>
                    <h3 class="font-bold text-xs leading-tight">Jantar Romântico</h3>
                    <p class="text-[10px] text-white/80 font-light">Clássico inesquecível</p>
                </div>
            </a>

            <!-- Card 3: Passeio ao Ar Livre -->
            <a href="{{ route('encontros.agendar') }}" class="relative h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
                <img src="{{ asset('images/moments/picnic.jpg') }}" alt="Passeio ao Ar Livre" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col gap-0.5">
                    <i data-lucide="trees" class="w-4 h-4 text-white mb-0.5"></i>
                    <h3 class="font-bold text-xs leading-tight">Passeio ao Ar Livre</h3>
                    <p class="text-[10px] text-white/80 font-light">Conexão com a natureza</p>
                </div>
            </a>
        </div>

    </div>

    <!-- Bottom Button: Novo Agendamento -->
    <a href="{{ route('encontros.agendar') }}" class="w-full py-4 bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#ff007f] text-white font-extrabold text-sm rounded-2xl shadow-xl hover:opacity-95 transition-all flex items-center justify-center gap-2 mt-2">
        <i data-lucide="calendar-plus" class="w-4 h-4"></i>
        <span>Agendar Novo Encontro</span>
    </a>

</div>
@endsection
