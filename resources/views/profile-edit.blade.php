@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]">
        <div class="flex items-center gap-2">
            <a href="{{ route('discover') }}" class="text-xs font-bold text-[#796a6e] hover:text-[#221417]">
                Cancelar
            </a>
        </div>
        <div class="flex items-center gap-1.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-6 w-auto object-contain rounded-md shadow-xs">
            <h1 class="text-base font-extrabold text-[#590219]">Editar Perfil</h1>
        </div>
        <button onclick="document.getElementById('profile-edit-form').submit()" class="text-xs font-bold text-[#590219]">
            Salvar
        </button>
    </header>
@endsection

@section('content')
<div class="px-5 py-5 flex flex-col gap-6 max-w-md mx-auto">

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-xs flex flex-col gap-1 shadow-sm">
            @foreach($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Main Profile Edit Form -->
    <form id="profile-edit-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf

        <!-- Hidden file input for photo upload -->
        <input type="file" id="avatar-input" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(this)">

        <!-- Photos Grid (Exact Stitch Layout: 1 main big photo, 2 stacked, 3 empty slots) -->
        <div class="flex flex-col gap-2">
            <div class="grid grid-cols-3 gap-2">
                <!-- Main Large Photo (Spans 2 cols & 2 rows) -->
                <div class="col-span-2 row-span-2 relative h-60 rounded-2xl overflow-hidden shadow-sm border border-[#ede7e5] bg-[#eee9e6]">
                    <img id="avatar-preview-img" src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', Auth::user()->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', Auth::user()->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                         onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                         alt="Foto Principal" class="w-full h-full object-cover">
                    <!-- Principal Badge -->
                    <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-md text-[10px] font-bold text-[#221417] px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm flex items-center gap-1">
                        <i data-lucide="star" class="w-3 h-3 text-[#590219] fill-current"></i> PRINCIPAL
                    </div>
                    <!-- Edit Icon Badge -->
                    <button type="button" onclick="document.getElementById('avatar-input').click()" class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-md cursor-pointer hover:bg-[#3f0111] transition-transform hover:scale-105" title="Alterar Foto de Perfil">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Photo 2 Slot -->
                <button type="button" onclick="document.getElementById('avatar-input').click()" class="relative h-[116px] rounded-2xl bg-[#eee9e6] border-2 border-dashed border-[#d6c7c4] flex flex-col items-center justify-center gap-1 text-[#796a6e] hover:bg-[#e6dfdc] transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="text-[9px] font-bold">Adicionar</span>
                </button>

                <!-- Photo 3 Slot -->
                <button type="button" onclick="document.getElementById('avatar-input').click()" class="relative h-[116px] rounded-2xl bg-[#eee9e6] border-2 border-dashed border-[#d6c7c4] flex flex-col items-center justify-center gap-1 text-[#796a6e] hover:bg-[#e6dfdc] transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="text-[9px] font-bold">Adicionar</span>
                </button>
            </div>

            <!-- 3 Empty Slots Row -->
            <div class="grid grid-cols-3 gap-2">
                <button type="button" onclick="document.getElementById('avatar-input').click()" class="h-24 rounded-2xl bg-[#eee9e6] border-2 border-dashed border-[#d6c7c4] flex flex-col items-center justify-center gap-1 text-[#796a6e] hover:bg-[#e6dfdc] transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="text-[9px] font-bold">Foto</span>
                </button>
                <button type="button" onclick="document.getElementById('avatar-input').click()" class="h-24 rounded-2xl bg-[#eee9e6] border-2 border-dashed border-[#d6c7c4] flex flex-col items-center justify-center gap-1 text-[#796a6e] hover:bg-[#e6dfdc] transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="text-[9px] font-bold">Foto</span>
                </button>
                <button type="button" onclick="document.getElementById('avatar-input').click()" class="h-24 rounded-2xl bg-[#eee9e6] border-2 border-dashed border-[#d6c7c4] flex flex-col items-center justify-center gap-1 text-[#796a6e] hover:bg-[#e6dfdc] transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="text-[9px] font-bold">Foto</span>
                </button>
            </div>

            <p class="text-[11px] text-[#796a6e] text-center mt-1">
                Adicione pelo menos 3 fotos para ter um perfil completo.
            </p>
        </div>

        <!-- Section: Status da Verificação de Identidade -->
        @php
            $latestVerif = Auth::user()->latestVerification;
        @endphp
        <div class="w-full bg-gradient-to-r from-[#590219] to-[#880d2d] rounded-2xl p-4 text-white flex flex-col gap-3 shadow-md border border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-extrabold">Verificação de Identidade</span>
                        <span class="text-[10px] text-white/80">Confirme seu documento + selfie para obter o selo oficial</span>
                    </div>
                </div>
                @if(Auth::user()->is_verified)
                    <span class="bg-emerald-400 text-emerald-950 text-[10px] font-black px-2.5 py-1 rounded-full uppercase">VERIFICADO ✅</span>
                @elseif($latestVerif && $latestVerif->status === 'pending')
                    <span class="bg-amber-400 text-amber-950 text-[10px] font-black px-2.5 py-1 rounded-full uppercase">EM ANÁLISE ⏳</span>
                @else
                    <span class="bg-white/20 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase">NÃO VERIFICADO</span>
                @endif
            </div>

            @if(!Auth::user()->is_verified && (!$latestVerif || $latestVerif->status !== 'pending'))
                <a href="{{ route('discover') }}#verificar" onclick="window.location.href='{{ route('discover') }}'; setTimeout(() => openVerificationModal(), 300);" class="w-full py-2.5 bg-amber-400 text-[#590219] font-black text-xs rounded-xl shadow-sm text-center hover:bg-amber-300 transition-colors block">
                    Solicitar Selo de Verificação (Documento + Selfie)
                </a>
            @endif
        </div>

        <!-- Section: Básico -->
        <div class="flex flex-col gap-3">
            <h2 class="text-xl font-bold text-[#590219]">Básico</h2>
            
            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Nome</label>
                <input type="text" value="{{ Auth::user()->name }}" disabled class="w-full bg-[#e2dad6] rounded-xl p-3 text-xs font-semibold text-[#796a6e] border border-transparent cursor-not-allowed">
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">E-mail</label>
                <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full bg-[#e2dad6] rounded-xl p-3 text-xs font-semibold text-[#796a6e] border border-transparent cursor-not-allowed">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-bold text-[#796a6e]">Idade</label>
                    <input type="number" name="age" value="{{ old('age', Auth::user()->age ?? 28) }}" min="18" max="120" class="w-full bg-[#eee9e6] rounded-xl p-3 text-xs font-semibold text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-bold text-[#796a6e]">Localização</label>
                    <div class="relative">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#590219] absolute left-3 top-3.5"></i>
                        <input type="text" name="location" value="{{ old('location', Auth::user()->location ?? 'São Paulo, SP') }}" placeholder="Cidade, UF" class="w-full bg-[#eee9e6] rounded-xl py-3 pr-3 pl-8 text-xs font-semibold text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Sobre mim -->
        <div class="flex flex-col gap-2">
            <h2 class="text-xl font-bold text-[#590219]">Sobre mim</h2>
            <div class="relative">
                <textarea name="bio" rows="4" maxlength="500" placeholder="Conte um pouco sobre você..." class="w-full bg-[#eee9e6] rounded-xl p-3.5 text-xs text-[#221417] font-medium border border-transparent focus:border-[#590219] focus:outline-none resize-none leading-relaxed">{{ old('bio', Auth::user()->bio ?? 'Amante de vinhos, exposições de arte e manhãs lentas. Procurando alguém para dividir boas conversas.') }}</textarea>
            </div>
        </div>

        <!-- Section: Estilo de Vida -->
        <div class="flex flex-col gap-3">
            <h2 class="text-xl font-bold text-[#590219]">Estilo de Vida</h2>

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-bold text-[#796a6e]">Profissão</label>
                <input type="text" name="profession" value="{{ old('profession', Auth::user()->profession ?? 'Designer & Fotógrafa') }}" placeholder="Sua profissão" class="w-full bg-[#eee9e6] rounded-xl p-3 text-xs font-semibold text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none">
            </div>
        </div>

        <!-- Section: Interesses -->
        @php
            $userInterests = Auth::user()->interests ?? ['Arte Contemporânea', 'Fotografia Analógica', 'Vinhos', 'Yoga'];
        @endphp
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-[#590219]">Interesses</h2>
                <span id="interest-count" class="text-xs font-bold text-[#796a6e]">{{ count($userInterests) }} de 5</span>
            </div>

            <!-- Interests Chips Container -->
            <div id="interests-wrapper" class="flex flex-wrap gap-2 pt-1">
                @foreach($userInterests as $interest)
                    <div class="interest-chip px-3.5 py-2 rounded-full bg-[#590219] text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-all">
                        <input type="hidden" name="interests[]" value="{{ $interest }}">
                        <span>{{ $interest }}</span>
                        <button type="button" onclick="removeInterest(this)" class="hover:text-amber-300 transition-colors">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Add Interest Input Field -->
            <div class="flex items-center gap-2 mt-1">
                <input type="text" id="new-interest-input" placeholder="Novo interesse (ex: Gastronomia, Viagens...)" class="flex-1 bg-[#eee9e6] rounded-xl px-3.5 py-2 text-xs font-semibold text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none" onkeypress="if(event.key === 'Enter'){ event.preventDefault(); addInterest(); }">
                <button type="button" onclick="addInterest()" class="px-4 py-2 rounded-xl bg-[#590219] text-white text-xs font-bold flex items-center gap-1 hover:bg-[#3f0111] transition-colors shrink-0 shadow-sm">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Adicionar
                </button>
            </div>
        </div>

        <!-- Submit Save Button -->
        <button type="submit" class="w-full py-4 bg-[#590219] text-white font-bold text-sm rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all text-center mt-2">
            Salvar Alterações
        </button>
    </form>

    <!-- Logout Form Button -->
    <form method="POST" action="{{ route('logout') }}" class="w-full mt-1">
        @csrf
        <button type="submit" class="w-full py-3.5 bg-[#eee9e6] text-[#796a6e] font-bold text-xs rounded-2xl border border-[#ede7e5] hover:bg-red-50 hover:text-red-600 transition-all text-center">
            Sair da Conta (Logout)
        </button>
    </form>

</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('avatar-preview-img');
                if (img) {
                    img.src = e.target.result;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateInterestCount() {
        const wrapper = document.getElementById('interests-wrapper');
        const count = wrapper.querySelectorAll('.interest-chip').length;
        document.getElementById('interest-count').innerText = count + ' de 5';
    }

    function removeInterest(button) {
        const chip = button.closest('.interest-chip');
        if (chip) {
            chip.remove();
            updateInterestCount();
        }
    }

    function addInterest() {
        const input = document.getElementById('new-interest-input');
        const val = input.value.trim();
        const wrapper = document.getElementById('interests-wrapper');
        const currentCount = wrapper.querySelectorAll('.interest-chip').length;

        if (!val) return;

        if (currentCount >= 5) {
            alert('Você pode selecionar no máximo 5 interesses.');
            return;
        }

        // Create new interest chip
        const chip = document.createElement('div');
        chip.className = 'interest-chip px-3.5 py-2 rounded-full bg-[#590219] text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-all animate-fadeIn';
        chip.innerHTML = `
            <input type="hidden" name="interests[]" value="${val.replace(/"/g, '&quot;')}">
            <span>${val}</span>
            <button type="button" onclick="removeInterest(this)" class="hover:text-amber-300 transition-colors">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
        `;

        wrapper.appendChild(chip);
        input.value = '';
        updateInterestCount();

        if (window.lucide) {
            lucide.createIcons();
        }
    }
</script>
@endsection
