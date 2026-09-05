@extends('layouts.app')

@section('title', 'Perfil 5 de 7 - Interesses - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8]">
        <a href="{{ route('discover') }}" class="text-[#796a6e]">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <span class="text-[10px] font-extrabold text-[#796a6e] uppercase tracking-widest">PERFIL 5 DE 7</span>
        <div class="w-5"></div>
    </header>
@endsection

@section('content')
<div class="px-6 py-6 flex flex-col justify-between min-h-[calc(100vh-140px)] max-w-md mx-auto">

    <div class="flex flex-col items-center text-center gap-8 pt-4">
        
        <!-- Header Text -->
        <div class="flex flex-col gap-3">
            <h1 class="text-2xl sm:text-3xl font-medium text-[#221417] leading-tight tracking-tight">
                O que você gosta de fazer?
            </h1>
            <p class="text-xs sm:text-sm text-[#796a6e] leading-relaxed max-w-xs mx-auto">
                Selecione seus interesses para encontrarmos pessoas compatíveis.
            </p>
        </div>

        <!-- Interest Pills Cloud (Exact Stitch Layout & Pill Styling) -->
        <div class="flex flex-wrap justify-center gap-2.5 max-w-xs">
            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Viagens
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Música
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Cinema
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Gastronomia
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Academia
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Praia
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Livros
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Tecnologia
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Arte
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Esportes
            </button>

            <button onclick="this.classList.toggle('bg-[#590219]'); this.classList.toggle('text-white'); this.classList.toggle('bg-[#eee9e6]'); this.classList.toggle('text-[#221417]')" class="px-5 py-3 rounded-full bg-[#eee9e6] text-[#221417] text-sm font-medium transition-colors border border-transparent shadow-xs hover:bg-[#e2dad6]">
                Pets
            </button>
        </div>

    </div>

    <!-- Bottom Button: Continuar (Exact Stitch Dusty Rose Tone) -->
    <a href="{{ route('discover') }}" class="w-full py-4 bg-[#a67c85] text-white font-bold text-sm rounded-2xl shadow-md hover:bg-[#590219] transition-all flex items-center justify-center gap-2 text-center mt-8">
        <span>Continuar</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
    </a>

</div>
@endsection
