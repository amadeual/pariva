@extends('layouts.app')

@section('title', 'Agendar Encontro - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('encontros') }}" class="text-xs font-bold text-[#590219] hover:underline flex items-center gap-1">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>Minha Agenda</span>
        </a>
    </header>
@endsection

@section('content')
<form action="{{ route('encontros.store') }}" method="POST" class="px-5 py-3 flex flex-col gap-6 max-w-md mx-auto pb-16">
    @csrf

    <!-- Hidden Field for Selected Target User -->
    <input type="hidden" name="target_user_id" id="input-target-user-id" value="{{ $targetUser->id ?? '' }}">

    <!-- Page Header & Match Profile Banner -->
    <div class="flex flex-col items-center text-center gap-2 pt-2">
        <div class="relative w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-md">
            <img id="selected-user-avatar" src="{{ isset($targetUser) ? $targetUser->avatar_url : asset('images/avatars/placeholder.jpg') }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" alt="{{ $targetUser->name ?? 'Match' }}" class="w-full h-full object-cover">
            <div class="absolute bottom-0 right-0 w-6 h-6 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-md">
                <i data-lucide="heart" class="w-3.5 h-3.5 fill-white"></i>
            </div>
        </div>

        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight mt-1">
            Agendar Encontro
        </h1>
        <p id="selected-user-label" class="text-xs text-[#796a6e] font-medium -mt-1">
            Convite para <strong class="text-[#590219] font-bold">{{ isset($targetUser) ? $targetUser->name : 'Seu Match' }}</strong>
        </p>
    </div>

    <!-- Section 1: Escolher a Pessoa (Match) -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">1. Selecionar Match</h2>
            <span class="text-[10px] text-[#796a6e] font-medium">Pessoas com Match</span>
        </div>

        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-none px-1">
            @forelse($matches as $match)
                <div onclick="selectMatch('{{ $match->id }}', '{{ e($match->name) }}', '{{ e($match->avatar_url) }}')" id="match-card-{{ $match->id }}" class="match-card flex flex-col items-center gap-1.5 p-2 rounded-2xl border-2 transition-all cursor-pointer shrink-0 w-24 {{ (isset($targetUser) && $targetUser->id == $match->id) ? 'border-[#590219] bg-[#fdf2f4] shadow-sm' : 'border-[#ede7e5] bg-white hover:border-[#590219]/40' }}">
                    <div class="relative w-14 h-14 rounded-full overflow-hidden border border-[#ede7e5]">
                        <img src="{{ $match->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" class="w-full h-full object-cover" alt="{{ $match->name }}">
                        <div id="check-icon-{{ $match->id }}" class="match-check-icon absolute inset-0 bg-[#590219]/30 flex items-center justify-center {{ (isset($targetUser) && $targetUser->id == $match->id) ? '' : 'hidden' }}">
                            <i data-lucide="check" class="w-5 h-5 text-white stroke-[3]"></i>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#221417] truncate w-full text-center">{{ explode(' ', $match->name)[0] }}</span>
                </div>
            @empty
                <div class="w-full bg-white rounded-2xl p-4 border border-[#ede7e5] text-center text-xs text-[#796a6e]">
                    Nenhum match encontrado. Explore mais perfis para dar match!
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 2: Qual a Vibe? -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">2. A Vibe do Date</h2>
        </div>

        <div class="flex flex-col gap-2.5">
            <div class="relative">
                <i data-lucide="sparkles" class="w-4 h-4 text-[#590219] absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="title" id="input-title" required value="Vinhos & Tapas" placeholder="Ex: Café no Fim de Tarde, Jantar Romântico..." class="w-full h-12 pl-10 pr-4 rounded-2xl border border-[#ede7e5] bg-white text-xs font-bold text-[#221417] focus:outline-none focus:border-[#590219] shadow-xs">
            </div>

            <!-- Vibe Cards Suggestions -->
            <div class="flex gap-2.5 overflow-x-auto pb-1 scrollbar-none">
                <div onclick="selectVibe('Vinhos & Tapas')" class="px-3.5 py-2 rounded-xl bg-white border border-[#ede7e5] hover:border-[#590219] hover:bg-[#fdf2f4] text-xs font-bold text-[#221417] shrink-0 cursor-pointer flex items-center gap-1.5 transition-colors shadow-2xs">
                    <i data-lucide="wine" class="w-3.5 h-3.5 text-[#590219]"></i>
                    <span>Vinhos & Tapas</span>
                </div>
                <div onclick="selectVibe('Café & Conversa')" class="px-3.5 py-2 rounded-xl bg-white border border-[#ede7e5] hover:border-[#590219] hover:bg-[#fdf2f4] text-xs font-bold text-[#221417] shrink-0 cursor-pointer flex items-center gap-1.5 transition-colors shadow-2xs">
                    <i data-lucide="coffee" class="w-3.5 h-3.5 text-[#590219]"></i>
                    <span>Café & Conversa</span>
                </div>
                <div onclick="selectVibe('Galeria de Arte')" class="px-3.5 py-2 rounded-xl bg-white border border-[#ede7e5] hover:border-[#590219] hover:bg-[#fdf2f4] text-xs font-bold text-[#221417] shrink-0 cursor-pointer flex items-center gap-1.5 transition-colors shadow-2xs">
                    <i data-lucide="palette" class="w-3.5 h-3.5 text-[#590219]"></i>
                    <span>Galeria de Arte</span>
                </div>
                <div onclick="selectVibe('Parque & Sol')" class="px-3.5 py-2 rounded-xl bg-white border border-[#ede7e5] hover:border-[#590219] hover:bg-[#fdf2f4] text-xs font-bold text-[#221417] shrink-0 cursor-pointer flex items-center gap-1.5 transition-colors shadow-2xs">
                    <i data-lucide="trees" class="w-3.5 h-3.5 text-[#590219]"></i>
                    <span>Parque & Sol</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Quando? (Data e Horário) -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">3. Data e Horário</h2>
        </div>

        <div class="flex flex-col gap-2.5">
            <div class="relative">
                <i data-lucide="calendar" class="w-4 h-4 text-[#590219] absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="datetime-local" name="date_time" id="input-datetime" required value="{{ now()->addDays(1)->setTime(20, 0)->format('Y-m-d\TH:i') }}" class="w-full h-12 pl-10 pr-4 rounded-2xl border border-[#ede7e5] bg-white text-xs font-bold text-[#221417] focus:outline-none focus:border-[#590219] shadow-xs">
            </div>
        </div>
    </div>

    <!-- Section 4: Onde? (Local) -->
    <div class="flex flex-col gap-3">
        <div class="flex justify-between items-center px-1">
            <h2 class="text-base font-extrabold text-[#221417]">4. Local do Encontro</h2>
        </div>

        <div class="flex flex-col gap-2.5">
            <div class="relative">
                <i data-lucide="map-pin" class="w-4 h-4 text-[#590219] absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="location" id="input-location" required value="Vino! Vila Madalena - R. Fradique Coutinho, 47" placeholder="Ex: Café Girondino, Parque Ibirapuera..." class="w-full h-12 pl-10 pr-4 rounded-2xl border border-[#ede7e5] bg-white text-xs font-bold text-[#221417] focus:outline-none focus:border-[#590219] shadow-xs">
            </div>

            <!-- Venue Suggestions -->
            <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-none">
                <button type="button" onclick="setLocation('Vino! Vila Madalena - R. Fradique Coutinho, 47')" class="px-3 py-1.5 rounded-xl bg-white border border-[#ede7e5] text-[10px] font-bold text-[#796a6e] hover:text-[#590219] hover:border-[#590219] shrink-0 shadow-2xs">
                    Vino! Vila Madalena
                </button>
                <button type="button" onclick="setLocation('Café Girondino - Centro Histórico')" class="px-3 py-1.5 rounded-xl bg-white border border-[#ede7e5] text-[10px] font-bold text-[#796a6e] hover:text-[#590219] hover:border-[#590219] shrink-0 shadow-2xs">
                    Café Girondino
                </button>
                <button type="button" onclick="setLocation('Parque Ibirapuera - Portão 3')" class="px-3 py-1.5 rounded-xl bg-white border border-[#ede7e5] text-[10px] font-bold text-[#796a6e] hover:text-[#590219] hover:border-[#590219] shrink-0 shadow-2xs">
                    Parque Ibirapuera
                </button>
                <button type="button" onclick="setLocation('Terraço Itália - Av. Ipiranga, 344')" class="px-3 py-1.5 rounded-xl bg-white border border-[#ede7e5] text-[10px] font-bold text-[#796a6e] hover:text-[#590219] hover:border-[#590219] shrink-0 shadow-2xs">
                    Terraço Itália
                </button>
            </div>
        </div>
    </div>

    <!-- Safety Notice Toggle -->
    <div class="bg-gradient-to-r from-[#fdf2f4] to-white rounded-2xl p-4 flex justify-between items-center border border-[#590219]/20 shadow-xs">
        <div class="flex flex-col gap-0.5 max-w-[240px]">
            <h3 class="font-bold text-xs text-[#221417] flex items-center gap-1.5">
                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i>
                <span>Compartilhar Encontro Seguro</span>
            </h3>
            <p class="text-[10px] text-[#796a6e] leading-snug">
                Notifica automaticamente seus contatos de emergência quando o date for aceito.
            </p>
        </div>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" checked class="sr-only peer">
            <div class="w-11 h-6 bg-[#d6c7c4] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#590219]"></div>
        </label>
    </div>

    <!-- Confirm Invite Button -->
    <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#ff007f] text-white font-extrabold text-sm rounded-2xl shadow-xl hover:opacity-95 transition-all flex items-center justify-center gap-2 cursor-pointer border border-white/20">
        <span>Enviar Convite e Agendar</span>
        <i data-lucide="send" class="w-4 h-4"></i>
    </button>
</form>

<script>
function selectMatch(userId, name, avatarUrl) {
    document.getElementById('input-target-user-id').value = userId;
    document.getElementById('selected-user-avatar').src = avatarUrl;
    document.getElementById('selected-user-label').innerHTML = 'Convite para <strong class="text-[#590219] font-bold">' + name + '</strong>';

    document.querySelectorAll('.match-card').forEach(el => {
        el.classList.remove('border-[#590219]', 'bg-[#fdf2f4]', 'shadow-sm');
        el.classList.add('border-[#ede7e5]', 'bg-white');
    });
    document.querySelectorAll('.match-check-icon').forEach(el => el.classList.add('hidden'));

    const selectedCard = document.getElementById('match-card-' + userId);
    const selectedIcon = document.getElementById('check-icon-' + userId);
    if (selectedCard) {
        selectedCard.classList.remove('border-[#ede7e5]', 'bg-white');
        selectedCard.classList.add('border-[#590219]', 'bg-[#fdf2f4]', 'shadow-sm');
    }
    if (selectedIcon) {
        selectedIcon.classList.remove('hidden');
    }
}

function selectVibe(vibeTitle) {
    document.getElementById('input-title').value = vibeTitle;
}

function setLocation(loc) {
    document.getElementById('input-location').value = loc;
}
</script>
@endsection
