@extends('layouts.app')

@section('title', 'Esqueceu sua senha? - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </a>
        <a href="{{ url('/') }}" class="text-xs font-bold text-[#796a6e] hover:text-[#590219]">
            Início
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

        @if(session('status'))
            <div class="w-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold p-3.5 rounded-2xl text-center shadow-xs">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="w-full bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold p-3.5 rounded-2xl text-center shadow-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Reset Password Form -->
        <form method="POST" action="{{ route('password.email') }}" class="w-full flex flex-col gap-4 mt-2">
            @csrf
            <div class="relative">
                <input type="email" name="email" required placeholder="Digite seu e-mail cadastrado" class="w-full bg-white rounded-2xl py-4 pr-10 pl-12 text-xs text-[#221417] placeholder-[#a09497] border border-[#ede7e5] focus:border-[#590219] focus:outline-none font-medium shadow-xs">
                <i data-lucide="mail" class="w-4 h-4 text-[#a09497] absolute left-4 top-4"></i>
            </div>

            <!-- Submit Button (Vinho Dark Button) -->
            <button type="submit" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 text-center mt-2 cursor-pointer">
                <span>Enviar Link de Redefinição</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

    </div>

    <!-- Bottom Link: Voltar para o Login -->
    <a href="{{ route('login') }}" class="flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-[#796a6e] hover:text-[#590219] transition-colors py-4">
        <i data-lucide="chevron-left" class="w-4 h-4"></i>
        <span>VOLTAR PARA O LOGIN</span>
    </a>

</div>
@endsection
