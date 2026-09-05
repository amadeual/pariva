@extends('layouts.app')

@section('title', 'Erro do Servidor - 500 Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('discover') }}" class="text-xs font-bold text-[#796a6e] hover:text-[#590219]">
            Início
        </a>
    </header>
@endsection

@section('content')
<div class="flex flex-col items-center justify-center min-h-[calc(100vh-140px)] px-6 py-10 text-center gap-6 max-w-md mx-auto">

    <!-- Glowing Icon Badge -->
    <div class="relative">
        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#590219] to-[#7c0d28] text-rose-300 flex items-center justify-center shadow-xl shadow-[#590219]/30 relative z-10">
            <i data-lucide="shield-alert" class="w-12 h-12 stroke-[1.75px] animate-pulse"></i>
        </div>
        <div class="absolute inset-0 bg-[#590219]/20 rounded-3xl blur-xl scale-125"></div>
    </div>

    <!-- Error Text -->
    <div class="flex flex-col gap-2">
        <span class="text-xs font-extrabold uppercase tracking-widest text-[#590219] bg-[#590219]/10 px-3 py-1 rounded-full w-fit mx-auto">
            Erro 500
        </span>
        <h1 class="text-3xl font-black text-[#221417] tracking-tight">Instabilidade Temporária</h1>
        <p class="text-xs text-[#796a6e] leading-relaxed font-medium max-w-xs mx-auto">
            Desculpe! Ocorreu um problema inesperado no nosso sistema. Nossa equipe técnica já foi notificada.
        </p>
    </div>

    <!-- Navigation Action Cards -->
    <div class="flex flex-col gap-3 w-full mt-2">
        <button onclick="window.location.reload();" class="w-full py-3.5 bg-[#590219] text-white font-extrabold text-xs rounded-2xl shadow-md hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 cursor-pointer">
            <i data-lucide="refresh-cw" class="w-4 h-4 text-amber-300"></i>
            <span>Tentar Novamente</span>
        </button>

        <a href="{{ route('discover') }}" class="w-full py-3.5 bg-white border border-[#ede7e5] text-[#221417] font-extrabold text-xs rounded-2xl shadow-sm hover:bg-[#fbf9f8] transition-all flex items-center justify-center gap-2">
            <i data-lucide="home" class="w-4 h-4 text-[#590219]"></i>
            <span>Voltar à Página Inicial</span>
        </a>
    </div>

</div>
@endsection
