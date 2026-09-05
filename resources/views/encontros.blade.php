@extends('layouts.app')

@section('title', 'Idéias para Encontros - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="text-xs font-bold text-white bg-[#590219] px-3.5 py-1.5 rounded-xl shadow-xs hover:bg-[#3f0111] transition-colors flex items-center gap-1.5">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            <span>Agendar Date</span>
        </a>
    </header>
@endsection

@section('content')
<div class="px-5 py-3 flex flex-col gap-6 max-w-md mx-auto pb-12">

    <!-- Title Header -->
    <div class="flex flex-col text-center gap-1 pt-1">
        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">
            Minha Agenda & Ideias
        </h1>
        <p class="text-xs text-[#796a6e] font-medium leading-relaxed px-4">
            Gerencie seus encontros agendados e descubra novas ideias a dois.
        </p>
    </div>

    <!-- Agenda de Dates Confirmados / Agendados -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">Encontros Agendados</h2>
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] bg-[#f8d7da] px-2.5 py-0.5 rounded-full">2 PRÓXIMOS</span>
        </div>

        <div class="flex flex-col gap-2.5">
            <!-- Scheduled Date 1 -->
            <div class="bg-white rounded-2xl p-4 border border-[#ede7e5] shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full overflow-hidden border border-[#590219]/20 shrink-0">
                        <img src="{{ asset('images/avatars/rafael.jpg') }}" alt="Rafael" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-extrabold text-xs text-[#221417]">Vinhos & Tapas com Rafael</h3>
                        <p class="text-[11px] text-[#796a6e] font-medium flex items-center gap-1 mt-0.5">
                            <i data-lucide="calendar" class="w-3 h-3 text-[#590219]"></i> Sex, 13 de Out • 20:00
                        </p>
                        <span class="text-[10px] text-[#590219] font-bold mt-0.5 flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> Vino! Vila Madalena
                        </span>
                    </div>
                </div>
                <span class="bg-emerald-50 text-emerald-700 text-[9px] font-extrabold uppercase px-2 py-1 rounded-lg border border-emerald-200">
                    Confirmado
                </span>
            </div>

            <!-- Scheduled Date 2 -->
            <div class="bg-white rounded-2xl p-4 border border-[#ede7e5] shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full overflow-hidden border border-[#590219]/20 shrink-0">
                        <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Mariana" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-extrabold text-xs text-[#221417]">Café & Conversa com Mariana</h3>
                        <p class="text-[11px] text-[#796a6e] font-medium flex items-center gap-1 mt-0.5">
                            <i data-lucide="calendar" class="w-3 h-3 text-[#590219]"></i> Sáb, 21 de Out • 16:00
                        </p>
                        <span class="text-[10px] text-[#590219] font-bold mt-0.5 flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> Sofá Café - Pinheiros
                        </span>
                    </div>
                </div>
                <span class="bg-amber-50 text-amber-700 text-[9px] font-extrabold uppercase px-2 py-1 rounded-lg border border-amber-200">
                    Pendente
                </span>
            </div>
        </div>
    </div>

    <!-- Date Ideas Section Header -->
    <div class="flex justify-between items-center px-1 pt-2">
        <h2 class="text-base font-extrabold text-[#221417]">Sugestões de Locais</h2>
        <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] hover:underline">Ver Todos</a>
    </div>

    <!-- Date Ideas Grid -->
    <div class="flex flex-col gap-4">

        <!-- Card 1: Café & Conversa -->
        <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="relative w-full h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
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
            <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="relative h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
                <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Jantar Romântico" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col gap-0.5">
                    <i data-lucide="utensils" class="w-4 h-4 text-white mb-0.5"></i>
                    <h3 class="font-bold text-xs leading-tight">Jantar Romântico</h3>
                    <p class="text-[10px] text-white/80 font-light">Clássico inesquecível</p>
                </div>
            </a>

            <!-- Card 3: Passeio ao Ar Livre -->
            <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="relative h-40 rounded-3xl overflow-hidden shadow-md group cursor-pointer border border-[#ede7e5] block">
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
    <a href="{{ route('encontros.agendar', ['userId' => 1]) }}" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 mt-2">
        <i data-lucide="calendar-plus" class="w-4 h-4"></i>
        <span>Agendar Novo Encontro</span>
    </a>

</div>
@endsection
