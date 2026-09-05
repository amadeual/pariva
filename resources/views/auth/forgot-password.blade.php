@extends('layouts.app')

@section('title', 'Esqueceu sua senha? - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#f0e6e4] flex items-center justify-center p-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="#590219" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Assinatura Premium</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/20 shadow-sm">
            <img src="{{ asset('images/avatars/isabella.jpg') }}" alt="Perfil" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-6 py-8 flex flex-col justify-between items-center min-h-[calc(100vh-140px)] max-w-md mx-auto">

    <div class="flex flex-col items-center gap-6 w-full pt-4">

        <!-- Back Arrow Button -->
        <div class="w-full flex justify-start">
            <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417] hover:bg-[#e2dad6] transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
        </div>

        <!-- Lock Sync Icon Card -->
        <div class="w-16 h-16 rounded-2xl bg-[#fdf2f4] border border-[#f5d6dc] flex items-center justify-center text-[#590219] shadow-xs my-2">
            <i data-lucide="rotate-ccw" class="w-8 h-8"></i>
        </div>

        <!-- Title & Subtitle -->
        <div class="flex flex-col items-center text-center gap-2">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#221417] tracking-tight">
                Esqueceu sua senha?
            </h1>
            <p class="text-xs text-[#796a6e] leading-relaxed max-w-xs font-medium">
                Não se preocupe! Insira seu e-mail, CPF ou telefone abaixo e enviaremos as instruções para você.
            </p>
        </div>

        <!-- Reset Password Form -->
        <form class="w-full flex flex-col gap-4 mt-2">
            <div class="relative">
                <input type="text" placeholder="E-mail, CPF ou Telefone" class="w-full bg-white rounded-2xl py-4 pr-10 pl-12 text-xs text-[#221417] placeholder-[#a09497] border border-[#ede7e5] focus:border-[#590219] focus:outline-none font-medium shadow-xs">
                <i data-lucide="user" class="w-4 h-4 text-[#a09497] absolute left-4 top-4"></i>
            </div>

            <!-- Submit Button (Vinho Dark Button) -->
            <a href="{{ route('login') }}" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 text-center mt-2">
                <span>Enviar Código</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </form>

    </div>

    <!-- Bottom Link: Voltar para o Login -->
    <a href="{{ route('login') }}" class="flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-[#796a6e] hover:text-[#590219] transition-colors py-4">
        <i data-lucide="chevron-left" class="w-4 h-4"></i>
        <span>VOLTAR PARA O LOGIN</span>
    </a>

</div>
@endsection
