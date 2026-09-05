@extends('layouts.app')

@section('title', 'Cadastre-se - Pariva')

@section('content')
<div class="px-6 py-6 flex flex-col justify-between min-h-screen max-w-md mx-auto bg-[#fbf9f8]">

    <!-- Top Return to Home Button -->
    <div class="w-full flex justify-between items-center">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-[#590219] bg-[#590219]/10 px-3 py-1.5 rounded-full hover:bg-[#590219]/20 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Página Inicial</span>
        </a>
    </div>

    <!-- Main Container -->
    <div class="flex flex-col items-center gap-6 w-full pt-2">
        
        <!-- Brand Header Logo -->
        <a href="{{ url('/') }}" class="flex flex-col items-center gap-2 group" title="Ir para a página inicial">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-20 w-auto object-contain rounded-2xl shadow-sm group-hover:scale-105 transition-transform">
            <p class="text-xs text-[#796a6e] text-center max-w-xs leading-relaxed mt-1">
                Sua jornada rumo a conexões mais profundas começa aqui.
            </p>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" novalidate class="w-full flex flex-col gap-4 mt-2">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-xs flex flex-col gap-1.5 shadow-sm">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Nome Input -->
            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Nome completo</label>
                <div class="relative">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Seu nome" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 px-4 text-xs text-[#221417] placeholder-[#a09497] border @error('name') border-red-500 @else border-transparent @enderror focus:border-[#590219] focus:outline-none font-medium">
                </div>
            </div>

            <!-- Email Input -->
            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">E-mail</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('email') border-red-500 @else border-transparent @enderror focus:border-[#590219] focus:outline-none font-medium">
                    <i data-lucide="user" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>
            </div>

            <!-- Senha Input -->
            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Senha</label>
                <div class="relative">
                    <input type="password" name="password" placeholder="Sua senha secreta" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] border @error('password') border-red-500 @else border-transparent @enderror focus:border-[#590219] focus:outline-none font-medium">
                    <i data-lucide="eye-off" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4 cursor-pointer"></i>
                </div>
            </div>

            <!-- Confirmar Senha Input -->
            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Confirmar Senha</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" placeholder="Repita a senha" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none font-medium">
                </div>
            </div>

            <!-- Idade / Data de Nascimento Input -->
            <div class="flex flex-col gap-1.5" x-data="{
                mode: 'dob',
                age: '{{ old('age') }}',
                dob: '',
                errorMsg: '',
                calculateAgeFromDob() {
                    if (!this.dob) return;
                    const birthDate = new Date(this.dob);
                    const today = new Date();
                    let calcAge = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        calcAge--;
                    }
                    if (isNaN(calcAge) || calcAge < 0) {
                        this.errorMsg = 'Data de nascimento inválida.';
                        this.age = '';
                    } else if (calcAge < 18) {
                        this.errorMsg = 'Você deve ter no mínimo 18 anos para se cadastrar.';
                        this.age = calcAge;
                    } else {
                        this.errorMsg = '';
                        this.age = calcAge;
                    }
                },
                validateAge() {
                    const num = parseInt(this.age);
                    if (isNaN(num)) {
                        this.errorMsg = 'Por favor, informe sua idade.';
                    } else if (num < 18) {
                        this.errorMsg = 'Você deve ter no mínimo 18 anos para se cadastrar.';
                    } else {
                        this.errorMsg = '';
                    }
                }
            }">
                <div class="flex justify-between items-center">
                    <label class="text-[11px] font-bold text-[#796a6e]">Sua Idade / Data de Nascimento</label>
                    <div class="flex gap-2">
                        <button type="button" @click="mode = 'dob'" :class="mode === 'dob' ? 'text-[#590219] font-bold border-b border-[#590219]' : 'text-[#a09497]'" class="text-[10px] pb-0.5 transition-colors">
                            Data de Nascimento
                        </button>
                        <button type="button" @click="mode = 'age'" :class="mode === 'age' ? 'text-[#590219] font-bold border-b border-[#590219]' : 'text-[#a09497]'" class="text-[10px] pb-0.5 transition-colors">
                            Digitar Idade
                        </button>
                    </div>
                </div>

                <!-- Input mode: Data de Nascimento (Calendar) -->
                <div x-show="mode === 'dob'" class="relative">
                    <input type="date" x-model="dob" @change="calculateAgeFromDob()" max="{{ date('Y-m-d', strtotime('-18 years')) }}" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 px-4 text-xs text-[#221417] border @error('age') border-red-500 @else border-transparent @enderror focus:border-[#590219] focus:outline-none font-medium">
                </div>

                <!-- Input mode: Direct Age -->
                <div x-show="mode === 'age'" class="relative">
                    <input type="number" x-model="age" @input="validateAge()" min="18" max="120" placeholder="Ex: 24" class="w-full bg-[#eee9e6] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('age') border-red-500 @else border-transparent @enderror focus:border-[#590219] focus:outline-none font-medium">
                    <i data-lucide="calendar" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>

                <!-- Hidden form field sent to Laravel backend -->
                <input type="hidden" name="age" :value="age">

                <!-- Real-time Validation Error Message -->
                <template x-if="errorMsg">
                    <p class="text-[11px] text-red-600 font-medium px-1" x-text="errorMsg"></p>
                </template>
                <template x-if="!errorMsg && age >= 18">
                    <p class="text-[11px] text-emerald-700 font-medium px-1 flex items-center gap-1">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                        <span>Idade confirmada: <strong x-text="age + ' anos'"></strong></span>
                    </p>
                </template>
            </div>

            <!-- Gênero Selection -->
            <div class="flex flex-col gap-1.5 pt-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Gênero</label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="mulher" {{ old('gender', 'mulher') === 'mulher' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 text-center text-xs font-bold rounded-2xl bg-[#eee9e6] text-[#221417] border border-transparent peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                            Mulher
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="homem" {{ old('gender') === 'homem' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 text-center text-xs font-bold rounded-2xl bg-[#eee9e6] text-[#221417] border border-transparent peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                            Homem
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="nao_binario" {{ old('gender') === 'nao_binario' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 text-center text-xs font-bold rounded-2xl bg-[#eee9e6] text-[#221417] border border-transparent peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                            Não binário
                        </div>
                    </label>
                </div>
            </div>

            <!-- Age & Terms Confirmation Checkbox -->
            <div class="flex items-start gap-2 pt-1 px-0.5">
                <input type="checkbox" id="terms" required class="mt-0.5 w-4 h-4 rounded border-[#d6c7c4] accent-[#590219]">
                <label for="terms">
                    <p class="text-[10px] text-[#796a6e] text-center max-w-xs mx-auto leading-relaxed mt-2">
                        Ao se cadastrar, você concorda com nossos <a href="{{ route('termos') }}" class="underline hover:text-[#221417]">Termos</a> e <a href="{{ route('privacidade') }}" class="underline hover:text-[#221417]">Política de Privacidade</a>.
                    </p>
                </label>
            </div>

            <!-- Submit Button (Dusty Rose Button) -->
            <button type="submit" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-md hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2 text-center mt-2">
                <span>Criar Conta</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <!-- Divider: OU CADASTRE-SE COM -->
        <div class="w-full flex items-center justify-center gap-3 my-1">
            <div class="h-px bg-[#ede7e5] flex-1"></div>
            <span class="text-[9px] font-extrabold uppercase tracking-widest text-[#a09497]">OU CADASTRE-SE COM</span>
            <div class="h-px bg-[#ede7e5] flex-1"></div>
        </div>

        <!-- Social Register Buttons (Google) -->
        <div class="w-full flex flex-col gap-2.5">
            <a href="{{ route('auth.google') }}" class="w-full py-3.5 bg-white border border-[#ede7e5] rounded-2xl flex items-center justify-center gap-2 text-xs font-bold text-[#221417] shadow-xs hover:bg-[#fbf9f8] transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Cadastrar com Google</span>
            </a>
        </div>

    </div>

    <!-- Already have account link -->
    <div class="text-center text-xs text-[#796a6e] pt-6">
        Já tem uma conta? <a href="{{ route('login') }}" class="text-[#590219] font-bold hover:underline">Entre</a>
    </div>

</div>
@endsection
