@extends('layouts.app')

@section('title', 'Agendar Encontro com Rafael - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('encontros') }}" class="text-xs font-bold text-[#590219] hover:underline flex items-center gap-1">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>Agenda</span>
        </a>
    </header>
@endsection

@section('content')
<form action="{{ route('encontros.store') }}" method="POST" class="px-5 py-3 flex flex-col gap-6 max-w-md mx-auto pb-12">
    @csrf

    <!-- Hidden Fields for Vibe, Location and DateTime -->
    <input type="hidden" name="title" id="input-title" value="Vinhos & Tapas com Rafael">
    <input type="hidden" name="location" id="input-location" value="Vino! Vila Madalena - R. Fradique Coutinho, 47">
    <input type="hidden" name="date_time" id="input-datetime" value="2026-10-13 20:00:00">

    <!-- Avatar & Title Section -->
    <div class="flex flex-col items-center text-center gap-2 pt-2">
        <div class="relative w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-md">
            <img src="{{ asset('images/avatars/rafael.jpg') }}" alt="Rafael" class="w-full h-full object-cover">
            <div class="absolute bottom-1 right-1 w-6 h-6 rounded-full bg-white text-[#221417] flex items-center justify-center shadow-md">
                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
            </div>
        </div>

        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight mt-1">
            Agendar Encontro
        </h1>
        <p class="text-xs text-[#796a6e] font-medium -mt-1">
            com Rafael
        </p>
    </div>

    <!-- Section 1: A Vibe -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">A Vibe</h2>
            <button type="button" class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] hover:underline">VER MAIS</button>
        </div>

        <!-- Horizontal Vibe Cards Carousel -->
        <div class="flex gap-3 overflow-x-auto pb-1 scrollbar-none">
            
            <!-- Vibe 1: Vinho & Tapas (Selected with Checkmark) -->
            <div onclick="selectVibe('Vinhos & Tapas com Rafael')" class="relative min-w-[140px] w-36 h-44 rounded-2xl overflow-hidden shadow-sm border-2 border-[#590219] shrink-0 cursor-pointer">
                <img src="{{ asset('images/moments/cafe.jpg') }}" alt="Vinhos & Tapas" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                <!-- Selected Checkmark Icon -->
                <div class="absolute top-2.5 right-2.5 w-5 h-5 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-xs">
                    <i data-lucide="check" class="w-3 h-3 stroke-[3]"></i>
                </div>

                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                    <span class="text-[9px] font-extrabold uppercase tracking-wider opacity-90">RELAXADO</span>
                    <h3 class="font-bold text-xs leading-tight">Vinhos & Tapas</h3>
                </div>
            </div>

            <!-- Vibe 2: Galeria de Arte -->
            <div onclick="selectVibe('Galeria de Arte com Rafael')" class="relative min-w-[140px] w-36 h-44 rounded-2xl overflow-hidden shadow-sm border border-[#ede7e5] shrink-0 cursor-pointer">
                <img src="{{ asset('images/moments/museum.jpg') }}" alt="Galeria de Arte" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                    <span class="text-[9px] font-extrabold uppercase tracking-wider opacity-90">CULTURAL</span>
                    <h3 class="font-bold text-xs leading-tight">Galeria de Arte</h3>
                </div>
            </div>

            <!-- Vibe 3: Picnic -->
            <div onclick="selectVibe('Parque & Sol com Rafael')" class="relative min-w-[140px] w-36 h-44 rounded-2xl overflow-hidden shadow-sm border border-[#ede7e5] shrink-0 cursor-pointer">
                <img src="{{ asset('images/moments/picnic.jpg') }}" alt="Passeio" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                    <span class="text-[9px] font-extrabold uppercase tracking-wider opacity-90">AR LIVRE</span>
                    <h3 class="font-bold text-xs leading-tight">Parque & Sol</h3>
                </div>
            </div>

        </div>
    </div>

    <!-- Section 2: Quando? -->
    <div class="flex flex-col gap-3">
        <h2 class="text-base font-extrabold text-[#221417]">Quando?</h2>

        <div class="bg-[#eee9e6] rounded-3xl p-5 flex flex-col gap-4 border border-[#ede7e5]">
            <!-- Calendar Month Header -->
            <div class="flex justify-between items-center px-2">
                <button type="button" class="text-[#796a6e] hover:text-[#590219]">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#221417]">OUTUBRO 2026</span>
                <button type="button" class="text-[#796a6e] hover:text-[#590219]">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Calendar Days Row -->
            <div class="grid grid-cols-5 gap-2 text-center">
                <div class="flex flex-col items-center gap-1.5 cursor-pointer">
                    <span class="text-[10px] font-semibold text-[#796a6e]">Qui</span>
                    <span class="text-xs font-bold text-[#221417]">12</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 cursor-pointer">
                    <span class="text-[10px] font-bold text-[#590219]">Sex</span>
                    <span class="w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center text-xs font-extrabold shadow-md">13</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 cursor-pointer">
                    <span class="text-[10px] font-semibold text-[#796a6e]">Sáb</span>
                    <span class="text-xs font-bold text-[#221417]">14</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 cursor-pointer">
                    <span class="text-[10px] font-semibold text-[#796a6e]">Dom</span>
                    <span class="text-xs font-bold text-[#221417]">15</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 cursor-pointer">
                    <span class="text-[10px] font-semibold text-[#796a6e]">Seg</span>
                    <span class="text-xs font-bold text-[#221417]">16</span>
                </div>
            </div>

            <div class="h-px bg-[#ede7e5]"></div>

            <!-- Time Options -->
            <div class="flex justify-between items-center gap-2 pt-1">
                <button type="button" class="flex-1 py-2.5 rounded-xl bg-transparent text-[#221417] text-xs font-bold hover:bg-white/50 transition-colors text-center">
                    19:00
                </button>
                <button type="button" class="flex-1 py-2.5 rounded-xl bg-[#590219] text-white text-xs font-bold shadow-md text-center">
                    20:00
                </button>
                <button type="button" class="flex-1 py-2.5 rounded-xl bg-transparent text-[#221417] text-xs font-bold hover:bg-white/50 transition-colors text-center">
                    21:00
                </button>
            </div>
        </div>
    </div>

    <!-- Section 3: Onde? -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center">
            <h2 class="text-base font-extrabold text-[#221417]">Onde?</h2>
            <button type="button" class="text-[#796a6e] hover:text-[#590219]">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Venue Card with Map Background -->
        <div class="relative w-full rounded-2xl overflow-hidden border border-[#ede7e5] bg-sky-100 p-3 shadow-xs">
            <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:12px_12px] opacity-70"></div>
            
            <div class="relative z-10 bg-white/95 backdrop-blur-md rounded-xl p-3 flex justify-between items-center border border-[#ede7e5]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#f8d7da] flex items-center justify-center text-[#590219]">
                        <i data-lucide="wine" class="w-5 h-5"></i>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-xs text-[#221417]">Vino! Vila Madalena</h3>
                        <p class="text-[10px] text-[#796a6e] font-medium">R. Fradique Coutinho, 47 - Pin...</p>
                    </div>
                </div>

                <button type="button" class="text-[#796a6e] hover:text-[#590219]">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Section 4: Compartilhar Encontro Toggle Card -->
    <div class="bg-[#eee9e6] rounded-2xl p-4 flex justify-between items-center border border-[#ede7e5]">
        <div class="flex flex-col gap-0.5 max-w-[240px]">
            <h3 class="font-bold text-xs text-[#221417]">Compartilhar Encontro</h3>
            <p class="text-[10px] text-[#796a6e] leading-snug">
                Seus contatos de confiança receberão os detalhes de local e horário automaticamente.
            </p>
        </div>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" checked class="sr-only peer">
            <div class="w-11 h-6 bg-[#d6c7c4] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#590219]"></div>
        </label>
    </div>

    <!-- Confirm Invite Button -->
    <button type="submit" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 text-center mt-2 cursor-pointer">
        <span>Confirmar e Agendar</span>
        <i data-lucide="send" class="w-4 h-4"></i>
    </button>

</form>

<script>
function selectVibe(vibeTitle) {
    document.getElementById('input-title').value = vibeTitle;
}
</script>
@endsection
