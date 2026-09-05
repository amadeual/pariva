@extends('layouts.app')

@section('title', 'Chat & Mensagens')

@section('header')
    <header class="w-full px-4 py-3 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5] sticky top-0 z-40">
        <div class="flex items-center gap-3">
            <a href="{{ route('discover') }}" class="text-[#221417] p-1">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div class="flex flex-col">
                <h2 class="font-bold text-sm text-[#221417]">Chat & Mensagens</h2>
                <span class="text-[11px] text-[#796a6e] font-medium">Suas conexões</span>
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

        <!-- Empty Chat State for New Users -->
        <div class="bg-white border border-[#ede7e5] rounded-3xl p-6 text-center flex flex-col items-center gap-3 my-4 shadow-xs">
            <div class="w-14 h-14 rounded-2xl bg-[#fdf2f4] text-[#590219] flex items-center justify-center">
                <i data-lucide="message-square-heart" class="w-7 h-7"></i>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-bold text-sm text-[#221417]">Sua conversa começa aqui!</h3>
                <p class="text-xs text-[#796a6e] leading-relaxed max-w-xs">
                    Faça um match no Descobrir para iniciar conversas reais e agendar encontros incríveis.
                </p>
            </div>
        </div>

    </div>

    <!-- Bottom Input Area -->
    <div class="flex flex-col gap-3 sticky bottom-14 pt-2 bg-[#fbf9f8]">

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
