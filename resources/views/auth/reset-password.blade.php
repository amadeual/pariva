@extends('layouts.app')

@section('title', 'Nova Senha - Pariva')

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
<div class="px-6 py-6 flex flex-col justify-between items-center min-h-[calc(100vh-140px)] max-w-md mx-auto">

    <div class="flex flex-col gap-6 w-full pt-2">

        <!-- Back Arrow Button -->
        <div class="w-full flex justify-start">
            <a href="{{ route('password.request') }}" class="w-10 h-10 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417] hover:bg-[#e2dad6] transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
        </div>

        <!-- Title & Subtitle -->
        <div class="flex flex-col gap-2 text-left">
            <h1 class="text-3xl font-extrabold text-[#590219] tracking-tight">
                Nova Senha
            </h1>
            <p class="text-xs text-[#796a6e] leading-relaxed font-medium">
                Crie uma senha forte e memorável para proteger sua conta no Pariva.
            </p>
        </div>

        <!-- Form Fields -->
        <form class="w-full flex flex-col gap-4 mt-1">
            
            <!-- Input 1: NOVA SENHA -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] font-extrabold uppercase tracking-widest text-[#796a6e]">NOVA SENHA</label>
                <div class="relative">
                    <input type="password" placeholder="Sua nova senha secreta" class="w-full bg-[#eee9e6] rounded-2xl py-4 pr-10 pl-4 text-xs text-[#221417] placeholder-[#796a6e] border border-transparent focus:border-[#590219] focus:outline-none font-medium">
                    <i data-lucide="eye-off" class="w-4 h-4 text-[#796a6e] absolute right-3.5 top-4 cursor-pointer"></i>
                </div>
            </div>

            <!-- Input 2: CONFIRMAR NOVA SENHA -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] font-extrabold uppercase tracking-widest text-[#796a6e]">CONFIRMAR NOVA SENHA</label>
                <div class="relative">
                    <input type="password" placeholder="Repita a senha para confirmar" class="w-full bg-[#eee9e6] rounded-2xl py-4 pr-10 pl-4 text-xs text-[#221417] placeholder-[#796a6e] border border-transparent focus:border-[#590219] focus:outline-none font-medium">
                    <i data-lucide="eye-off" class="w-4 h-4 text-[#796a6e] absolute right-3.5 top-4 cursor-pointer"></i>
                </div>
            </div>

            <!-- REQUISITOS DA SENHA Card -->
            <div class="w-full bg-[#eee9e6] rounded-2xl p-4 flex flex-col gap-2.5 border border-[#ede7e5] mt-1">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#796a6e]">REQUISITOS DA SENHA</span>
                
                <div class="flex flex-col gap-2 text-xs text-[#796a6e] font-medium">
                    <div class="flex items-center gap-2.5">
                        <div class="w-4 h-4 rounded-full border-2 border-[#d6c7c4]"></div>
                        <span>Pelo menos 8 caracteres</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-4 h-4 rounded-full border-2 border-[#d6c7c4]"></div>
                        <span>Pelo menos 1 número</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-4 h-4 rounded-full border-2 border-[#d6c7c4]"></div>
                        <span>Pelo menos 1 caractere especial (!@#$%)</span>
                    </div>
                </div>
            </div>

            <!-- Redefinir Senha Dusty Rose Button -->
            <a href="{{ route('login') }}" class="w-full py-4 bg-[#a67c85] text-white font-bold text-xs uppercase tracking-wider rounded-2xl shadow-md hover:bg-[#590219] transition-all flex items-center justify-center gap-2 text-center mt-3">
                <span>REDEFINIR SENHA</span>
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
            </a>

        </form>

    </div>

</div>
@endsection
