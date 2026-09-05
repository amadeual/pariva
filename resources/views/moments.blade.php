@extends('layouts.app')

@section('title', 'Moments - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8]">
        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">Moments</h1>
        <button class="w-9 h-9 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417]">
            <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
        </button>
    </header>
@endsection

@section('content')
<div class="px-4 py-2 flex flex-col gap-6 max-w-md mx-auto pb-10">

    <!-- Stories Bar (Avatars with borders) -->
    <div class="flex items-center gap-4 overflow-x-auto pb-2 scrollbar-none px-1">
        
        <!-- Story 1 (Camila) -->
        <div class="flex flex-col items-center gap-1.5 shrink-0 cursor-pointer">
            <div class="w-16 h-16 rounded-full p-0.5 border-2 border-[#a67c85]">
                <img src="{{ asset('images/avatars/sofia.jpg') }}" alt="Camila" class="w-full h-full object-cover rounded-full">
            </div>
            <span class="text-[11px] font-medium text-[#221417]">Camila, 26</span>
        </div>

        <!-- Story 2 (Lucas) -->
        <div class="flex flex-col items-center gap-1.5 shrink-0 cursor-pointer">
            <div class="w-16 h-16 rounded-full p-0.5 border-2 border-[#a67c85]">
                <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Lucas" class="w-full h-full object-cover rounded-full">
            </div>
            <span class="text-[11px] font-medium text-[#221417]">Lucas, 30</span>
        </div>

        <!-- Story 3 (Marina) -->
        <div class="flex flex-col items-center gap-1.5 shrink-0 cursor-pointer">
            <div class="w-16 h-16 rounded-full p-0.5 border-2 border-[#ede7e5]">
                <img src="{{ asset('images/avatars/isabella.jpg') }}" alt="Marina" class="w-full h-full object-cover rounded-full">
            </div>
            <span class="text-[11px] font-medium text-[#221417]">Marina, 28</span>
        </div>

        <!-- Story 4 (João) -->
        <div class="flex flex-col items-center gap-1.5 shrink-0 cursor-pointer">
            <div class="w-16 h-16 rounded-full p-0.5 border-2 border-[#ede7e5]">
                <img src="{{ asset('images/moments/cafe.jpg') }}" alt="João" class="w-full h-full object-cover rounded-full">
            </div>
            <span class="text-[11px] font-medium text-[#221417]">João, 32</span>
        </div>

    </div>

    <!-- Feed Post 1: Beatriz -->
    <div class="flex flex-col gap-3">
        <!-- Post Header -->
        <div class="flex justify-between items-center px-1">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden border border-[#ede7e5]">
                    <img src="{{ asset('images/avatars/sofia.jpg') }}" alt="Beatriz" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <h3 class="font-bold text-sm text-[#221417]">Beatriz, 27</h3>
                    <div class="flex items-center gap-2 text-[11px] text-[#796a6e]">
                        <span>Há 2h</span>
                        <span>•</span>
                        <span class="bg-[#fdf2f4] text-[#590219] font-bold px-2 py-0.5 rounded-full border border-[#f5d6dc]">
                            92% compatível
                        </span>
                    </div>
                </div>
            </div>
            <button class="text-[#796a6e]">
                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Post Image -->
        <div class="w-full h-[400px] rounded-3xl overflow-hidden shadow-sm border border-[#ede7e5]">
            <img src="{{ asset('images/moments/picnic.jpg') }}" alt="Picnic em SP" class="w-full h-full object-cover">
        </div>

        <!-- Action Icons -->
        <div class="flex items-center gap-4 px-1 py-1">
            <button class="text-[#221417] hover:text-[#590219]">
                <i data-lucide="heart" class="w-6 h-6"></i>
            </button>
            <button class="text-[#221417] hover:text-[#590219]">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </button>
            <button class="text-[#221417] hover:text-[#590219]">
                <i data-lucide="send" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Caption -->
        <p class="text-xs text-[#221417] leading-relaxed px-1 font-medium">
            Domingo perfeito explorando os parques da cidade. Quem me acompanha na próxima? 🍷 🌳
        </p>
    </div>

    <!-- Feed Post 2: Rafael -->
    <div class="flex flex-col gap-3 pt-2">
        <!-- Post Header -->
        <div class="flex justify-between items-center px-1">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden border border-[#ede7e5]">
                    <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Rafael" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <h3 class="font-bold text-sm text-[#221417]">Rafael, 31</h3>
                    <div class="flex items-center gap-2 text-[11px] text-[#796a6e]">
                        <span>Ontem</span>
                        <span>•</span>
                        <span class="bg-[#fdf2f4] text-[#590219] font-bold px-2 py-0.5 rounded-full border border-[#f5d6dc]">
                            88% compatível
                        </span>
                    </div>
                </div>
            </div>
            <button class="text-[#796a6e]">
                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Post Image -->
        <div class="w-full h-[400px] rounded-3xl overflow-hidden shadow-sm border border-[#ede7e5]">
            <img src="{{ asset('images/moments/museum.jpg') }}" alt="Exposição MASP" class="w-full h-full object-cover">
        </div>

        <!-- Action Icons -->
        <div class="flex items-center gap-4 px-1 py-1">
            <button class="text-[#221417] hover:text-[#590219]">
                <i data-lucide="heart" class="w-6 h-6"></i>
            </button>
            <button class="text-[#221417] hover:text-[#590219]">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Caption -->
        <p class="text-xs text-[#221417] leading-relaxed px-1 font-medium">
            Nova exposição no MASP. Sempre encontrando inspiração no caos. 🎨
        </p>
    </div>

</div>
@endsection
