@extends('layouts.app')

@section('title', 'Cadastre-se - Pariva')

@section('content')
<div class="px-4 py-6 sm:px-6 flex flex-col justify-between min-h-screen max-w-lg mx-auto bg-[#fbf9f8]">

    <!-- Top Navigation Bar -->
    <div class="w-full flex justify-between items-center mb-4">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#590219] bg-[#590219]/10 px-3.5 py-2 rounded-full hover:bg-[#590219]/20 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Página Inicial</span>
        </a>
        <div class="text-xs text-[#796a6e]">
            Já tem conta? <a href="{{ route('login') }}" class="text-[#ff007f] font-bold hover:underline">Entrar</a>
        </div>
    </div>

    <!-- Main Registration Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#ede7e5] shadow-xl shadow-[#590219]/5 w-full flex flex-col gap-6 my-auto">
        
        <!-- Header Logo & Welcome -->
        <div class="flex flex-col items-center text-center gap-2">
            <a href="{{ url('/') }}" class="inline-block group" title="Ir para a página inicial">
                <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-16 w-auto object-contain rounded-2xl shadow-sm border border-[#ff007f]/20 group-hover:scale-105 transition-transform">
            </a>
            <h1 class="text-xl sm:text-2xl font-extrabold text-[#221417] tracking-tight mt-1">
                Crie sua conta no <span class="bg-gradient-to-r from-[#ff007f] to-[#590219] bg-clip-text text-transparent">Pariva</span>
            </h1>
            <p class="text-xs text-[#796a6e] max-w-xs leading-relaxed">
                Junte-se à comunidade de relacionamentos genuínos e encontre sua melhor conexão.
            </p>
        </div>

        <!-- Social Register Button (Google) -->
        <div class="w-full flex flex-col gap-3">
            <a href="{{ route('auth.google') }}" class="w-full py-3 px-4 bg-[#fbf9f8] border border-[#e5dcd9] rounded-2xl flex items-center justify-center gap-3 text-xs font-bold text-[#221417] shadow-xs hover:bg-white hover:border-[#ff007f]/40 hover:shadow-md transition-all">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Cadastrar com o Google</span>
            </a>

            <!-- Divider: OU PREENCHA SEUS DADOS -->
            <div class="w-full flex items-center justify-center gap-3 my-1">
                <div class="h-px bg-[#ede7e5] flex-1"></div>
                <span class="text-[9px] font-extrabold uppercase tracking-wider text-[#a09497]">OU PREENCHA OS DADOS</span>
                <div class="h-px bg-[#ede7e5] flex-1"></div>
            </div>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" novalidate class="w-full flex flex-col gap-4" x-data="{ showPassword: false }">
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
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#221417]">Nome completo</label>
                <div class="relative">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Como gostaria de ser chamado(a)?" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('name') border-red-500 @else border-[#e5dcd9] @enderror focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                    <i data-lucide="user" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>
            </div>

            <!-- Email Input -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#221417]">E-mail</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="seu.email@exemplo.com" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('email') border-red-500 @else border-[#e5dcd9] @enderror focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                    <i data-lucide="mail" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>
            </div>

            <!-- Senha Input -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#221417]">Senha</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Crie uma senha forte" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('password') border-red-500 @else border-[#e5dcd9] @enderror focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3.5 top-4 text-[#a09497] hover:text-[#590219] transition-colors focus:outline-none">
                        <i data-lucide="eye" x-show="!showPassword" class="w-4 h-4"></i>
                        <i data-lucide="eye-off" x-show="showPassword" class="w-4 h-4" style="display: none;"></i>
                    </button>
                </div>
            </div>

            <!-- Confirmar Senha Input -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#221417]">Confirmar Senha</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" placeholder="Digite a senha novamente" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border border-[#e5dcd9] focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                    <i data-lucide="lock" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>
            </div>

            <!-- Idade / Data de Nascimento Selector -->
            <div class="flex flex-col gap-2 pt-1" x-data="{
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
                    <label class="text-xs font-bold text-[#221417]">Sua Idade</label>
                    <div class="bg-[#f5f0ee] p-1 rounded-xl flex gap-1 border border-[#e5dcd9]">
                        <button type="button" @click="mode = 'dob'" :class="mode === 'dob' ? 'bg-white text-[#590219] font-bold shadow-xs' : 'text-[#796a6e] hover:text-[#221417]'" class="text-[10px] px-2.5 py-1 rounded-lg transition-all">
                            Data de Nascimento
                        </button>
                        <button type="button" @click="mode = 'age'" :class="mode === 'age' ? 'bg-white text-[#590219] font-bold shadow-xs' : 'text-[#796a6e] hover:text-[#221417]'" class="text-[10px] px-2.5 py-1 rounded-lg transition-all">
                            Digitar Idade
                        </button>
                    </div>
                </div>

                <!-- Mode: DOB -->
                <div x-show="mode === 'dob'" class="relative">
                    <input type="date" x-model="dob" @change="calculateAgeFromDob()" max="{{ date('Y-m-d', strtotime('-18 years')) }}" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 px-4 text-xs text-[#221417] border @error('age') border-red-500 @else border-[#e5dcd9] @enderror focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                </div>

                <!-- Mode: Direct Age -->
                <div x-show="mode === 'age'" class="relative" style="display: none;">
                    <input type="number" x-model="age" @input="validateAge()" min="18" max="120" placeholder="Ex: 24" class="w-full bg-[#fbf9f8] rounded-2xl py-3.5 pr-10 pl-4 text-xs text-[#221417] placeholder-[#a09497] border @error('age') border-red-500 @else border-[#e5dcd9] @enderror focus:border-[#ff007f] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#ff007f]/10 font-medium transition-all">
                    <i data-lucide="calendar" class="w-4 h-4 text-[#a09497] absolute right-3.5 top-4"></i>
                </div>

                <input type="hidden" name="age" :value="age">

                <!-- Dynamic Age Validation Messages -->
                <template x-if="errorMsg">
                    <p class="text-[11px] text-red-600 font-medium px-1 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-red-500 shrink-0"></i>
                        <span x-text="errorMsg"></span>
                    </p>
                </template>
                <template x-if="!errorMsg && age >= 18">
                    <p class="text-[11px] text-emerald-700 font-medium px-1 flex items-center gap-1 bg-emerald-50 border border-emerald-200 py-1.5 px-3 rounded-xl">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                        <span>Idade confirmada: <strong x-text="age + ' anos'"></strong> (Maior de idade)</span>
                    </p>
                </template>
            </div>

            <!-- Gênero Selection -->
            <div class="flex flex-col gap-2 pt-1">
                <label class="text-xs font-bold text-[#221417]">Gênero</label>
                <div class="grid grid-cols-3 gap-2.5">
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="mulher" {{ old('gender', 'mulher') === 'mulher' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 px-2 text-center text-xs font-bold rounded-2xl bg-[#fbf9f8] text-[#221417] border border-[#e5dcd9] peer-checked:bg-gradient-to-r peer-checked:from-[#ff007f] peer-checked:to-[#590219] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition-all flex flex-col items-center gap-1">
                            <span>Mulher</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="homem" {{ old('gender') === 'homem' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 px-2 text-center text-xs font-bold rounded-2xl bg-[#fbf9f8] text-[#221417] border border-[#e5dcd9] peer-checked:bg-gradient-to-r peer-checked:from-[#ff007f] peer-checked:to-[#590219] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition-all flex flex-col items-center gap-1">
                            <span>Homem</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="gender" value="nao_binario" {{ old('gender') === 'nao_binario' ? 'checked' : '' }} class="sr-only peer">
                        <div class="py-3 px-2 text-center text-xs font-bold rounded-2xl bg-[#fbf9f8] text-[#221417] border border-[#e5dcd9] peer-checked:bg-gradient-to-r peer-checked:from-[#ff007f] peer-checked:to-[#590219] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition-all flex flex-col items-center gap-1">
                            <span>Não binário</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Terms & Age Confirmation -->
            <div class="flex items-start gap-2.5 pt-2 px-0.5">
                <input type="checkbox" id="terms" required class="mt-0.5 w-4 h-4 rounded border-[#d6c7c4] accent-[#ff007f] cursor-pointer">
                <label for="terms" class="text-xs text-[#796a6e] leading-relaxed cursor-pointer select-none">
                    Eu declaro ter pelo menos 18 anos e aceito os <a href="{{ route('termos') }}" class="text-[#ff007f] font-bold hover:underline" target="_blank">Termos de Uso</a> e a <a href="{{ route('privacidade') }}" class="text-[#ff007f] font-bold hover:underline" target="_blank">Política de Privacidade</a>.
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#ff007f] via-[#c4065c] to-[#590219] text-white font-bold text-sm rounded-2xl shadow-lg shadow-[#ff007f]/25 hover:shadow-xl hover:brightness-110 active:scale-[0.99] transition-all flex items-center justify-center gap-2 text-center mt-2">
                <span>Criar minha conta gratuita</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

    </div>

    <!-- Minimalist Footer -->
    <div class="flex flex-col items-center gap-2 pt-6 pb-2">
        <div class="flex items-center justify-center gap-3 text-[11px] text-[#796a6e]">
            <a href="{{ route('termos') }}" class="hover:text-[#ff007f] transition-colors">Termos</a>
            <span>•</span>
            <a href="{{ route('privacidade') }}" class="hover:text-[#ff007f] transition-colors">Privacidade</a>
            <span>•</span>
            <a href="{{ route('seguranca') }}" class="hover:text-[#ff007f] transition-colors">Segurança</a>
        </div>
        <p class="text-[10px] text-[#a09497]">&copy; {{ date('Y') }} Pariva. Todos os direitos reservados.</p>
    </div>

</div>
@endsection
