@extends('layouts.app')

@section('title', 'Conversa com Rafael')

@section('header')
    <header class="w-full px-4 py-3 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5] sticky top-0 z-40">
        <div class="flex items-center gap-3">
            <a href="{{ route('discover') }}" class="text-[#221417] p-1">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div class="relative w-10 h-10 rounded-full overflow-hidden border border-[#ede7e5]">
                <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Rafael" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-1">
                    <h2 class="font-bold text-sm text-[#221417]">Rafael</h2>
                    <i data-lucide="badge-check" class="w-4 h-4 text-[#590219] fill-[#590219]/10"></i>
                </div>
                <span class="text-[11px] text-[#590219] font-medium">92% compatível</span>
            </div>
        </div>

        <button class="p-2 text-[#796a6e] hover:text-[#221417]">
            <i data-lucide="more-vertical" class="w-5 h-5"></i>
        </button>
    </header>
@endsection

@section('content')
<div class="flex flex-col justify-between min-h-[calc(100vh-130px)] px-4 py-4 gap-4">

    <!-- Messages Container -->
    <div class="flex flex-col gap-4">

        <!-- Game Finished Divider Badge -->
        <div class="flex items-center justify-center my-2">
            <div class="border-t border-[#ede7e5] flex-1"></div>
            <span class="bg-[#f0e8e6] text-[#796a6e] text-[10px] font-extrabold uppercase px-4 py-1.5 rounded-full tracking-wider">
                JOGO FINALIZADO
            </span>
            <div class="border-t border-[#ede7e5] flex-1"></div>
        </div>

        <!-- Game Result Highlight Box (Stitch Pink Box) -->
        <div class="bg-[#fdf2f4] border border-[#f5d6dc] rounded-2xl p-4 text-center">
            <p class="text-xs text-[#590219] font-medium leading-relaxed">
                Vocês concordaram em 4 de 5 cenários. Parece que temos uma dupla dinâmica aqui.
            </p>
        </div>

        <!-- Received Message (Rafael) -->
        <div class="flex gap-2.5 items-end max-w-[85%]">
            <div class="w-8 h-8 rounded-full overflow-hidden border border-[#ede7e5] shrink-0">
                <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Rafael" class="w-full h-full object-cover">
            </div>
            <div class="bg-[#eee9e6] rounded-2xl rounded-bl-xs p-3.5 text-xs text-[#221417] leading-relaxed relative">
                <p>Hahaha, eu realmente roubaria comida do seu prato no primeiro encontro! 🍕</p>
                <span class="text-[9px] text-[#796a6e] block text-right mt-1 font-medium">14:23</span>
            </div>
        </div>

        <!-- Sent Message (Me / Isabella) -->
        <div class="flex flex-col items-end max-w-[85%] self-end">
            <div class="bg-[#590219] text-white rounded-2xl rounded-br-xs p-3.5 text-xs leading-relaxed relative shadow-sm">
                <p>Estou avisada então! Vou ter que pedir uma porção extra. 😅</p>
                <div class="flex items-center justify-end gap-1 text-[9px] text-white/80 mt-1">
                    <span>14:25</span>
                    <i data-lucide="check-check" class="w-3 h-3 text-white"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Suggestion Card & Input Area -->
    <div class="flex flex-col gap-3 sticky bottom-14 pt-2 bg-[#fbf9f8]">
        
        <!-- Pariva AI Suggestion Card (Stitch Suggestion Box) -->
        <div class="bg-[#fdf2f4] border border-[#f5d6dc] rounded-2xl p-4 flex flex-col gap-2 relative">
            <div class="flex items-center gap-2 text-[#590219] font-bold text-xs">
                <div class="w-6 h-6 rounded-full bg-[#fce4e8] flex items-center justify-center">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#590219]"></i>
                </div>
                <span>Sugestão da Pariva</span>
            </div>

            <p class="text-xs text-[#796a6e] leading-relaxed">
                Vocês dois concordaram que o Rafael faria uma viagem sem planejar nada. Que tal agendar um encontro para conversarem sobre isso?
            </p>

            <a href="{{ route('encontros.agendar') }}" class="text-[11px] font-extrabold text-[#590219] flex items-center gap-1 uppercase tracking-wider mt-1 hover:underline text-left">
                <span>AGENDAR ENCONTRO AGORA</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- Message Composer Input (Stitch Capsule Input) -->
        <div class="bg-[#eee9e6] rounded-full p-2 px-4 flex items-center gap-2 shadow-inner">
            <button class="text-[#796a6e] hover:text-[#221417]">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
            </button>

            <input type="text" placeholder="Escreva uma mensagem..." class="bg-transparent flex-1 text-xs text-[#221417] focus:outline-none placeholder-[#796a6e]">

            <button class="text-[#796a6e] hover:text-[#221417]">
                <i data-lucide="smile" class="w-5 h-5"></i>
            </button>

            <button class="text-[#796a6e] hover:text-[#221417]">
                <i data-lucide="mic" class="w-5 h-5"></i>
            </button>

            <button class="w-8 h-8 rounded-full bg-[#8e5261] text-white flex items-center justify-center shadow-sm hover:bg-[#590219] transition-colors">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </div>

    </div>

</div>
@endsection
