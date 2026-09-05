@extends('layouts.app')

@section('title', 'Filtros de Busca - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#f0e6e4] flex items-center justify-center p-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="#590219" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Descobrir</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/20 shadow-sm">
            <img src="{{ asset('images/avatars/isabella.jpg') }}" alt="Perfil" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<form method="POST" action="{{ route('filtros.update') }}" class="px-5 py-4 flex flex-col gap-6 max-w-md mx-auto pb-10">
    @csrf

    <!-- Section 1: Localização -->
    <div class="flex flex-col gap-3">
        <h2 class="text-xl font-bold text-[#221417]">Localização</h2>
        
        <!-- Location Card with map snippet placeholder -->
        <div class="bg-[#eee9e6] rounded-2xl p-3.5 flex flex-col gap-3 border border-[#ede7e5]">
            <div class="flex justify-between items-center px-1">
                <div class="flex items-center gap-2 text-xs font-bold text-[#221417]">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#590219]"></i>
                    <span>{{ Auth::user()->location ?? 'São Paulo, SP' }}</span>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-[#590219] hover:underline">Alterar</a>
            </div>

            <!-- Stylized Map Container -->
            <div class="w-full h-28 rounded-xl overflow-hidden relative border border-[#ede7e5] bg-sky-100 flex items-center justify-center">
                <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:12px_12px] opacity-70"></div>
                <div class="relative z-10 flex flex-col items-center gap-1">
                    <div class="w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-lg animate-bounce">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                    </div>
                    <span class="bg-white/90 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[10px] font-bold text-[#221417] shadow-sm">{{ Auth::user()->location ?? 'São Paulo' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Distância Máxima -->
    <div class="bg-[#eee9e6] rounded-2xl p-4 flex flex-col gap-4 border border-[#ede7e5]">
        <div class="flex justify-between items-center">
            <span class="text-xs font-bold text-[#221417]">Distância Máxima</span>
            <span id="distance-label" class="text-xs text-[#590219] font-bold">Até {{ Auth::user()->max_distance ?? 50 }} km</span>
        </div>

        <!-- Interactive Range Input -->
        <div class="relative w-full flex items-center py-2">
            <input type="range" name="max_distance" min="1" max="200" value="{{ old('max_distance', Auth::user()->max_distance ?? 50) }}" 
                   id="max-distance-slider"
                   oninput="document.getElementById('distance-label').innerText = 'Até ' + this.value + ' km'"
                   class="w-full h-2 bg-[#d6c7c4] rounded-lg appearance-none cursor-pointer accent-[#590219]">
        </div>
    </div>

    <!-- Section 3: Mostrar para mim (Gênero) -->
    <div class="flex flex-col gap-3">
        <h2 class="text-xl font-bold text-[#221417]">Mostrar para mim</h2>
        
        @php
            $interested = old('interested_in', Auth::user()->interested_in ?? 'todos');
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 bg-[#eee9e6] p-1.5 rounded-2xl border border-[#ede7e5]">
            <label class="cursor-pointer">
                <input type="radio" name="interested_in" value="homens" {{ $interested === 'homens' ? 'checked' : '' }} class="sr-only peer">
                <div class="py-3 text-center text-xs font-bold rounded-xl text-[#221417] peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                    Homens
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="interested_in" value="mulheres" {{ $interested === 'mulheres' ? 'checked' : '' }} class="sr-only peer">
                <div class="py-3 text-center text-xs font-bold rounded-xl text-[#221417] peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                    Mulheres
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="interested_in" value="nao_binarios" {{ $interested === 'nao_binarios' ? 'checked' : '' }} class="sr-only peer">
                <div class="py-3 text-center text-xs font-bold rounded-xl text-[#221417] peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                    Não Binários
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="interested_in" value="todos" {{ $interested === 'todos' ? 'checked' : '' }} class="sr-only peer">
                <div class="py-3 text-center text-xs font-bold rounded-xl text-[#221417] peer-checked:bg-[#590219] peer-checked:text-white transition-all shadow-xs">
                    Todos
                </div>
            </label>
        </div>
    </div>

    <!-- Section 4: Faixa Etária -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-[#221417]">Faixa Etária</h2>
            <span id="age-range-label" class="text-xs text-[#590219] font-bold">18 - 85 anos</span>
        </div>

        <div class="bg-[#eee9e6] rounded-2xl p-4 flex flex-col gap-4 border border-[#ede7e5]">
            <!-- Dual Range Inputs Container -->
            <div class="relative w-full h-8 flex items-center">
                <!-- Track background -->
                <div class="absolute w-full h-2 bg-[#d6c7c4] rounded-lg"></div>
                <!-- Highlighted Track -->
                <div id="age-track" class="absolute h-2 bg-[#590219] rounded-lg"></div>

                <!-- Range Inputs -->
                <input type="range" name="min_age" min="18" max="85" value="{{ old('min_age', Auth::user()->min_age ?? 18) }}" id="min-age-input"
                       class="absolute w-full appearance-none bg-transparent pointer-events-none cursor-pointer accent-[#590219] [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-[#590219] [&::-webkit-slider-thumb]:shadow-md">

                <input type="range" name="max_age" min="18" max="85" value="{{ old('max_age', Auth::user()->max_age ?? 85) }}" id="max-age-input"
                       class="absolute w-full appearance-none bg-transparent pointer-events-none cursor-pointer accent-[#590219] [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-[#590219] [&::-webkit-slider-thumb]:shadow-md">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const minInput = document.getElementById('min-age-input');
            const maxInput = document.getElementById('max-age-input');
            const label = document.getElementById('age-range-label');
            const track = document.getElementById('age-track');

            function updateAgeSlider() {
                let min = parseInt(minInput.value);
                let max = parseInt(maxInput.value);

                if (min > max) {
                    let tmp = min;
                    min = max;
                    max = tmp;
                }

                label.innerText = min + ' - ' + (max === 85 ? '85+' : max) + ' anos';

                const percentMin = ((min - 18) / (85 - 18)) * 100;
                const percentMax = ((max - 18) / (85 - 18)) * 100;

                track.style.left = percentMin + '%';
                track.style.width = (percentMax - percentMin) + '%';
            }

            minInput.addEventListener('input', updateAgeSlider);
            maxInput.addEventListener('input', updateAgeSlider);

            updateAgeSlider();
        });
    </script>

    <!-- Section 5: Filtros Avançados (With Pariva Premium Paywall Box Overlay) -->
    <div class="flex flex-col gap-3 relative">
        <div class="flex items-center gap-1.5">
            <h2 class="text-xl font-bold text-[#221417]">Filtros Avançados</h2>
            <i data-lucide="award" class="w-4 h-4 text-[#590219]"></i>
        </div>

        <!-- Pariva Premium Overlay Box -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-5 border border-[#ede7e5] shadow-lg text-center flex flex-col items-center gap-2.5">
            <h3 class="font-extrabold text-base text-[#590219]">Pariva Premium</h3>
            <p class="text-xs text-[#796a6e] leading-snug max-w-xs font-medium">
                Desbloqueie filtros avançados de altura, escolaridade e signos.
            </p>
            <a href="{{ route('premium') }}" class="w-full py-3 bg-[#590219] text-white font-extrabold text-xs rounded-xl shadow-md hover:bg-[#3f0111] transition-all text-center mt-1">
                Assinar Premium
            </a>
        </div>
    </div>

    <!-- Apply Filters Button -->
    <button type="submit" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all text-center mt-2">
        Aplicar Filtros
    </button>

</form>
@endsection
