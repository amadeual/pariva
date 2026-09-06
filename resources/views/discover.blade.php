@extends('layouts.app')

@section('title', 'Pariva - Descobrir')

@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#f7f2f0]/95 backdrop-blur-md border-b border-[#e8dedb] sticky top-0 z-40 shadow-[0_2px_15px_rgba(0,0,0,0.02)]">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}?v={{ time() }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/30 shadow-xs flex items-center justify-center bg-[#eee9e6] font-bold text-xs text-[#590219] hover:scale-105 transition-transform" title="{{ Auth::user()->name }}">
            <img src="{{ asset('images/avatars/' . (strtolower(explode(' ', Auth::user()->name)[0])) . '.jpg') }}" 
                 onerror="this.src='{{ asset('images/avatars/isabella.jpg') }}'" 
                 alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-4 py-3 flex flex-col gap-3 max-w-md mx-auto">

    <!-- Location & Filter Bar -->
    <div class="flex justify-between items-center px-1">
        <div class="flex flex-col">
            <div class="flex items-center gap-1 text-[#221417] text-xs font-semibold">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#590219]"></i>
                <span>São Paulo, SP</span>
            </div>
            <span class="text-[10px] uppercase tracking-widest text-[#796a6e] font-bold mt-0.5">EXPLORANDO</span>
        </div>
        <a href="{{ route('filtros') }}" class="w-9 h-9 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417] hover:bg-[#e2dad6] transition-all shadow-sm">
            <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- Active User Boost Banner (if user has active boost) -->
    @if(Auth::user()->isBoosted())
    <div class="w-full bg-[#f5b800] text-black rounded-2xl p-3 flex items-center justify-between shadow-md border border-yellow-500 font-extrabold text-xs">
        <div class="flex items-center gap-2">
            <span class="text-base animate-pulse">⚡</span>
            <span>BOOST ATIVO: Seu perfil está em 1º lugar no Descobrir!</span>
        </div>
        <span class="bg-black text-white text-[10px] px-2 py-0.5 rounded-full">
            até {{ Auth::user()->boosted_until->format('H:i') }}
        </span>
    </div>
    @endif

    <!-- Banner CTA 1: Verificação Profissional por R$ 9,90/ano -->
    <div class="w-full bg-gradient-to-r from-[#590219] to-[#880d2d] rounded-2xl p-3 text-white flex items-center justify-between shadow-md border border-white/10">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center shrink-0">
                <i data-lucide="badge-check" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-1">
                    <span class="text-xs font-extrabold">Verifique seu Perfil</span>
                    <span class="bg-amber-400 text-black text-[9px] font-black px-1.5 py-0.2 rounded-full uppercase">OFICIAL</span>
                </div>
                <span class="text-[10px] text-white/80">Ganhe até 4x mais visitas com um pagamento único de R$ 14,99</span>
            </div>
        </div>
        <button type="button" onclick="openVerificationModal()" class="px-3 py-1.5 bg-amber-400 text-[#590219] text-xs font-extrabold rounded-xl shadow-xs hover:bg-amber-300 transition-colors shrink-0">
            Verificar
        </button>
    </div>

    <!-- Banner CTA 2: Boost & Destaques de Perfil ⚡ -->
    <div class="w-full bg-amber-50 border border-amber-200 rounded-2xl p-2.5 flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-2">
            <span class="text-xl">⚡</span>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-amber-950">Aumente suas curtidas em 10x!</span>
                <span class="text-[10px] text-amber-800 font-medium">Ative o Boost ou coloque seu Perfil em Destaque!</span>
            </div>
        </div>
        <a href="{{ route('premium') }}" class="px-3 py-1.5 bg-[#590219] text-white text-xs font-bold rounded-xl hover:bg-[#3f0111] transition-colors shrink-0">
            Turbinar ⚡
        </a>
    </div>

    <!-- Swipe Deck Stack Container -->
    <div id="swipe-deck" class="relative w-full h-[520px]">
        @forelse($users as $index => $user)
        <!-- Swipe Card -->
        <div class="swipe-card absolute inset-0 w-full h-full rounded-3xl overflow-hidden shadow-xl border border-[#ede7e5] bg-gray-900 select-none touch-none transition-transform duration-300 ease-out cursor-grab active:cursor-grabbing"
             style="z-index: {{ count($users) - $index }};"
             data-user-id="{{ $user->id }}">
            
            <!-- LIKE Badge -->
            <div class="like-badge opacity-0 pointer-events-none absolute top-10 left-8 z-30 border-4 border-emerald-500 text-emerald-500 px-4 py-1.5 rounded-2xl text-2xl font-black uppercase tracking-widest -rotate-12 transition-opacity duration-150">
                LIKE
            </div>

            <!-- NOPE Badge -->
            <div class="nope-badge opacity-0 pointer-events-none absolute top-10 right-8 z-30 border-4 border-rose-600 text-rose-600 px-4 py-1.5 rounded-2xl text-2xl font-black uppercase tracking-widest rotate-12 transition-opacity duration-150">
                PASSAR
            </div>

            <!-- Photo Navigation Tap Areas (Tinder-style left/right tap) -->
            <div class="absolute inset-0 z-15 flex pointer-events-auto">
                <div class="w-1/2 h-full cursor-pointer" onclick="prevPhoto(this, event)"></div>
                <div class="w-1/2 h-full cursor-pointer" onclick="nextPhoto(this, event)"></div>
            </div>

            <!-- Profile Image -->
            <img src="{{ $user->avatar ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', $user->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', $user->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                 onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                 alt="{{ $user->name }}" class="card-img w-full h-full object-cover pointer-events-none transition-all duration-300">

            <!-- Top Progress Bars (Photos indicator) -->
            <div class="absolute top-3 left-4 right-4 flex gap-1.5 z-20 pointer-events-none">
                <div class="photo-bar h-1 flex-1 bg-white rounded-full opacity-100 transition-opacity"></div>
                <div class="photo-bar h-1 flex-1 bg-white/40 rounded-full opacity-40 transition-opacity"></div>
                <div class="photo-bar h-1 flex-1 bg-white/40 rounded-full opacity-40 transition-opacity"></div>
            </div>

            <!-- Match Badge & Safety Options -->
            <div class="absolute top-7 left-4 right-4 flex justify-between items-center z-30 pointer-events-none">
                <div class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full flex items-center gap-1.5 shadow-md">
                    <span class="w-2 h-2 rounded-full bg-[#10b981]"></span>
                    <span class="text-[11px] font-bold text-[#221417]">91% MATCH</span>
                </div>

                <!-- Report/Block Dropdown Button -->
                <button type="button" onclick="openSafetyModal({{ $user->id }}, '{{ $user->name }}')" class="w-8 h-8 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/60 transition-colors pointer-events-auto">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent z-10 pointer-events-none"></div>

            <!-- Profile Information Overlay -->
            <div class="absolute bottom-4 left-4 right-4 text-white z-20 flex flex-col gap-2 pointer-events-none">
                <!-- Name and Age (Clickable to open Full Profile Modal) -->
                <div class="flex items-center gap-2 pointer-events-auto cursor-pointer group" onclick="openProfileModal({{ json_encode($user) }})">
                    <h2 class="text-3xl font-extrabold tracking-tight group-hover:underline flex items-center gap-1.5">
                        <span>{{ $user->name }}</span>
                        <i data-lucide="info" class="w-5 h-5 text-white/80 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </h2>
                    <span class="text-2xl font-light opacity-90">{{ $user->age ?? 28 }}</span>
                    
                    @if($user->is_verified ?? true)
                        <div class="flex items-center gap-1 bg-[#590219]/90 text-white px-2 py-0.5 rounded-full border border-white/20 text-[10px] font-bold shadow-sm" title="Perfil Verificado Pariva">
                            <i data-lucide="badge-check" class="w-3.5 h-3.5 text-amber-300 fill-amber-300/20"></i>
                            <span>{{ $user->verification_badge ?? 'Verificado' }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-1.5 text-xs opacity-90">
                    <i data-lucide="navigation" class="w-3.5 h-3.5 fill-current"></i>
                    <span>{{ $user->profession ?? 'Designer & Fotógrafa' }}</span>
                    <span>•</span>
                    <span>{{ $user->location ?? 'São Paulo, SP' }}</span>
                </div>

                <p class="text-sm font-medium leading-snug line-clamp-2 text-white/95 my-1">
                    "{{ $user->bio ?? 'Adoro viajar, descobrir restaurantes novos e passar o domingo no parque...' }}"
                </p>

                <!-- Tags -->
                <div class="flex flex-wrap gap-1.5 mt-1">
                    <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white border border-white/20">
                        Viagens
                    </span>
                    <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white border border-white/20">
                        Música
                    </span>
                    <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold text-white border border-white/20">
                        Gastronomia
                    </span>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State Container -->
        <div class="w-full h-full flex flex-col items-center justify-center text-center py-20 text-[#796a6e] bg-white rounded-3xl border border-[#ede7e5]">
            <div class="w-16 h-16 rounded-full bg-[#f0e6e4] flex items-center justify-center text-[#590219] mb-3">
                <i data-lucide="sparkles" class="w-8 h-8"></i>
            </div>
            <h3 class="text-lg font-extrabold text-[#221417]">Sem mais perfis</h3>
            <p class="text-xs text-[#796a6e] mt-1 max-w-xs">Você visualizou todas as pessoas da sua região por enquanto!</p>
        </div>
        @endforelse

        <!-- Empty Deck Hidden Fallback -->
        <div id="deck-empty-msg" class="hidden w-full h-full flex-col items-center justify-center text-center py-20 text-[#796a6e] bg-white rounded-3xl border border-[#ede7e5]">
            <div class="w-16 h-16 rounded-full bg-[#f0e6e4] flex items-center justify-center text-[#590219] mb-3">
                <i data-lucide="sparkles" class="w-8 h-8"></i>
            </div>
            <h3 class="text-lg font-extrabold text-[#221417]">Tudo visto por aqui!</h3>
            <p class="text-xs text-[#796a6e] mt-1 max-w-xs">Volte mais tarde para descobrir novos matches.</p>
        </div>
    </div>

    <!-- Hidden Form for CSRF Like Submission -->
    <form id="like-form" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="superlike" id="superlike-input" value="0">
    </form>

    <!-- Action Buttons Row (Tinder Floating Controls) -->
    <div class="flex items-center justify-center gap-3 py-3 px-2">
        <!-- Rewind / Reset Deck -->
        <button id="btn-rewind" class="w-12 h-12 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#221417] shadow-sm hover:scale-105 active:scale-95 transition-transform">
            <i data-lucide="undo-2" class="w-5 h-5"></i>
        </button>

        <!-- Dislike (X - Swipe Left) -->
        <button id="btn-dislike" class="w-14 h-14 rounded-full bg-white border border-[#ede7e5] flex items-center justify-center text-[#221417] shadow-md hover:scale-105 active:scale-95 transition-transform">
            <i data-lucide="x" class="w-7 h-7 stroke-[2.5px]"></i>
        </button>

        <!-- Like (Heart Burgundy - Swipe Right) -->
        <button id="btn-like" class="w-16 h-16 rounded-full bg-[#590219] flex items-center justify-center text-white shadow-xl shadow-[#590219]/30 hover:scale-105 active:scale-95 transition-transform">
            <i data-lucide="heart" class="w-8 h-8 fill-current"></i>
        </button>

        <!-- Send Gift Button 🎁 -->
        <button id="btn-rose" type="button" onclick="openRoseModal()" class="w-14 h-14 rounded-full bg-rose-50 border-2 border-rose-200 flex items-center justify-center text-rose-600 shadow-md hover:scale-105 active:scale-95 transition-transform" title="Enviar um Mimo / Presentinho">
            <span class="text-xl">🎁</span>
        </button>

        <!-- Super Like (Star Yellow) -->
        <button id="btn-superlike" class="w-14 h-14 rounded-full bg-white border border-[#ede7e5] flex items-center justify-center text-[#f5b800] shadow-md hover:scale-105 active:scale-95 transition-transform" title="Super Like">
            <i data-lucide="star" class="w-7 h-7 fill-current"></i>
        </button>

        <!-- Chat / Message Instant (Inicia conversa usando Crédito Direto ou Match) -->
        <button id="btn-instant-chat" type="button" onclick="startDirectChat()" class="w-12 h-12 rounded-full bg-[#eee9e6] flex items-center justify-center text-[#590219] shadow-sm hover:scale-105 active:scale-95 transition-transform" title="Iniciar Conversa">
            <i data-lucide="message-square" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Multi-Gift Modal -->
    <div id="rose-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <form method="POST" action="{{ route('user.gift') }}" class="bg-white w-full max-w-sm rounded-3xl p-5 flex flex-col gap-4 shadow-2xl border border-[#ede7e5]">
            @csrf
            <input type="hidden" name="receiver_id" id="rose-receiver-id">
            
            <div class="flex justify-between items-center border-b border-[#ede7e5] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🎁</span>
                    <h3 class="font-extrabold text-base text-[#590219]">Mimos & Presentinhos</h3>
                    <span class="text-[9px] font-extrabold text-[#ff007f] bg-[#ff007f]/10 border border-[#ff007f]/20 px-2 py-0.5 rounded-full uppercase">Especial</span>
                </div>
                <button type="button" onclick="closeRoseModal()" class="text-[#796a6e] hover:text-[#221417]">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p class="text-xs text-[#796a6e]">Escolha um mimo especial para enviar para <span id="rose-user-name" class="font-bold text-[#221417]"></span>:</p>

            <!-- Gift Selection Grid with Prices (Without White Backgrounds) -->
            <div class="grid grid-cols-3 gap-2.5">
                <label class="cursor-pointer">
                    <input type="radio" name="gift_type" value="rosa" checked class="sr-only peer">
                    <div class="p-3 rounded-2xl bg-gradient-to-b from-[#fffafd] to-[#f9f5f3] border-2 border-[#ede7e5] hover:border-[#ff007f]/30 peer-checked:border-[#ff007f] peer-checked:bg-[#ff007f]/10 peer-checked:shadow-md peer-checked:shadow-[#ff007f]/15 flex flex-col items-center gap-1 transition-all text-center">
                        <span class="text-2xl">🌹</span>
                        <span class="text-[11px] font-extrabold text-[#221417]">Rosa</span>
                        <span class="text-[11px] font-black text-[#ff007f]">R$ 2,50</span>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="gift_type" value="sorvete" class="sr-only peer">
                    <div class="p-3 rounded-2xl bg-gradient-to-b from-[#fffafd] to-[#f9f5f3] border-2 border-[#ede7e5] hover:border-[#ff007f]/30 peer-checked:border-[#ff007f] peer-checked:bg-[#ff007f]/10 peer-checked:shadow-md peer-checked:shadow-[#ff007f]/15 flex flex-col items-center gap-1 transition-all text-center">
                        <span class="text-2xl">🍦</span>
                        <span class="text-[11px] font-extrabold text-[#221417]">Sorvete</span>
                        <span class="text-[11px] font-black text-[#ff007f]">R$ 3,00</span>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="gift_type" value="paquera" class="sr-only peer">
                    <div class="p-3 rounded-2xl bg-gradient-to-b from-[#fffafd] to-[#f9f5f3] border-2 border-[#ede7e5] hover:border-[#ff007f]/30 peer-checked:border-[#ff007f] peer-checked:bg-[#ff007f]/10 peer-checked:shadow-md peer-checked:shadow-[#ff007f]/15 flex flex-col items-center gap-1 transition-all text-center">
                        <span class="text-2xl">💌</span>
                        <span class="text-[11px] font-extrabold text-[#221417]">Paquera</span>
                        <span class="text-[11px] font-black text-[#ff007f]">R$ 3,80</span>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="gift_type" value="perfume" class="sr-only peer">
                    <div class="p-3 rounded-2xl bg-gradient-to-b from-[#fffafd] to-[#f9f5f3] border-2 border-[#ede7e5] hover:border-[#ff007f]/30 peer-checked:border-[#ff007f] peer-checked:bg-[#ff007f]/10 peer-checked:shadow-md peer-checked:shadow-[#ff007f]/15 flex flex-col items-center gap-1 transition-all text-center">
                        <span class="text-2xl">🧪</span>
                        <span class="text-[11px] font-extrabold text-[#221417]">Perfume</span>
                        <span class="text-[11px] font-black text-[#ff007f]">R$ 5,00</span>
                    </div>
                </label>

                <label class="cursor-pointer col-span-2">
                    <input type="radio" name="gift_type" value="diamante" class="sr-only peer">
                    <div class="p-3 rounded-2xl bg-gradient-to-r from-[#fffafd] via-[#fff0f6] to-[#f9f5f3] border-2 border-[#ede7e5] hover:border-[#ff007f]/30 peer-checked:border-[#ff007f] peer-checked:bg-[#ff007f]/10 peer-checked:shadow-md peer-checked:shadow-[#ff007f]/15 flex items-center justify-between px-4 transition-all text-center">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">💎</span>
                            <span class="text-[11px] font-extrabold text-[#221417]">Anel de Diamante</span>
                        </div>
                        <span class="text-[11px] font-black text-[#ff007f]">R$ 9,90</span>
                    </div>
                </label>
            </div>

            <textarea name="message" rows="2" placeholder="Escreva um recadinho fofo (opcional)..." class="w-full bg-[#fdfaf8] rounded-xl p-3 text-xs text-[#221417] border border-[#ede7e5] focus:border-[#ff007f] focus:ring-1 focus:ring-[#ff007f]/20 focus:outline-none resize-none"></textarea>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#ff007f] via-[#c4065c] to-[#590219] text-white font-bold text-xs rounded-2xl shadow-lg shadow-[#ff007f]/25 hover:shadow-xl hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span>Confirmar & Enviar Mimo</span>
                <span>✨</span>
            </button>
        </form>
    </div>

    <!-- Safety / Report & Block Modal -->
    <div id="safety-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-3xl p-5 flex flex-col gap-4 shadow-2xl border border-[#ede7e5]">
            <div class="flex justify-between items-center border-b border-[#ede7e5] pb-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-alert" class="w-5 h-5 text-[#590219]"></i>
                    <h3 class="font-extrabold text-base text-[#221417]">Medidas de Segurança</h3>
                </div>
                <button type="button" onclick="closeSafetyModal()" class="text-[#796a6e] hover:text-[#221417]">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p class="text-xs text-[#796a6e]">O que você deseja fazer em relação a <span id="modal-user-name" class="font-bold text-[#221417]"></span>?</p>

            <!-- Action Options -->
            <div class="flex flex-col gap-2.5">
                <!-- Denunciar perfil button -->
                <button type="button" onclick="showReportForm()" class="w-full p-3.5 rounded-2xl bg-red-50 text-red-700 font-bold text-xs flex items-center justify-between border border-red-100 hover:bg-red-100 transition-colors">
                    <div class="flex items-center gap-2">
                        <i data-lucide="flag" class="w-4 h-4"></i>
                        <span>Denunciar Perfil</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>

                <!-- Bloquear perfil form -->
                <form id="block-user-form" method="POST" action="{{ route('user.block') }}">
                    @csrf
                    <input type="hidden" name="blocked_user_id" id="block-user-id">
                    <button type="submit" class="w-full p-3.5 rounded-2xl bg-[#eee9e6] text-[#221417] font-bold text-xs flex items-center justify-between border border-[#ede7e5] hover:bg-[#e2dad6] transition-colors">
                        <div class="flex items-center gap-2">
                            <i data-lucide="slash" class="w-4 h-4 text-red-600"></i>
                            <span>Bloquear Perfil</span>
                        </div>
                        <span class="text-[10px] text-[#796a6e] font-normal">Não verá mais seu perfil</span>
                    </button>
                </form>
            </div>

            <!-- Report Details Hidden Form -->
            <form id="report-details-form" method="POST" action="{{ route('user.report') }}" class="hidden flex-col gap-3 pt-2 border-t border-[#ede7e5]">
                @csrf
                <input type="hidden" name="reported_user_id" id="report-user-id">
                
                <label class="text-[11px] font-bold text-[#796a6e]">Motivo da Denúncia</label>
                <select name="reason" required class="w-full bg-[#eee9e6] rounded-xl p-3 text-xs font-semibold text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none">
                    <option value="Comportamento Inapropriado">Comportamento Inapropriado</option>
                    <option value="Perfil Falso / Fake">Perfil Falso / Fake</option>
                    <option value="Assédio ou Ofensa">Assédio ou Ofensa</option>
                    <option value="Golpe ou Spam">Golpe ou Spam</option>
                    <option value="Outros">Outros</option>
                </select>

                <textarea name="details" rows="3" placeholder="Descreva brevemente (opcional)..." class="w-full bg-[#eee9e6] rounded-xl p-3 text-xs text-[#221417] border border-transparent focus:border-[#590219] focus:outline-none resize-none"></textarea>

                <button type="submit" class="w-full py-3 bg-red-600 text-white font-bold text-xs rounded-xl shadow-md hover:bg-red-700 transition-colors">
                    Enviar Denúncia
                </button>
            </form>
        </div>
    </div>

    <!-- Full User Profile Modal (Tinder-style details screen) -->
    <div id="profile-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden items-center justify-center p-3">
        <div class="bg-white w-full max-w-md h-[90vh] rounded-3xl overflow-hidden flex flex-col shadow-2xl relative border border-[#ede7e5] animate-in zoom-in-95 duration-200">
            <!-- Modal Header / Image Gallery -->
            <div class="relative h-2/5 w-full bg-slate-900">
                <img id="profile-modal-img" src="" class="w-full h-full object-cover">
                <button type="button" onclick="closeProfileModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/50 text-white flex items-center justify-center backdrop-blur-md hover:bg-black/70 transition-colors z-20">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-3 left-4 right-4 text-white z-10 flex items-center gap-2">
                    <h2 id="profile-modal-name" class="text-2xl font-extrabold"></h2>
                    <span id="profile-modal-age" class="text-xl font-light opacity-90"></span>
                    <span id="profile-modal-badge" class="bg-[#590219] text-white px-2 py-0.5 rounded-full text-[10px] font-bold border border-white/20"></span>
                </div>
            </div>

            <!-- Scrollable Profile Details Body -->
            <div class="flex-1 overflow-y-auto p-5 flex flex-col gap-5 text-[#221417]">
                <!-- Profession & Location -->
                <div class="flex flex-col gap-1 border-b border-[#ede7e5] pb-4">
                    <div class="flex items-center gap-2 text-xs font-semibold text-[#796a6e]">
                        <i data-lucide="briefcase" class="w-4 h-4 text-[#590219]"></i>
                        <span id="profile-modal-profession"></span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-[#796a6e]">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#590219]"></i>
                        <span id="profile-modal-location"></span>
                    </div>
                </div>

                <!-- Biography -->
                <div class="flex flex-col gap-1.5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#796a6e]">Sobre mim</h4>
                    <p id="profile-modal-bio" class="text-xs leading-relaxed text-[#221417] bg-[#fbf9f8] p-3.5 rounded-2xl border border-[#ede7e5] font-medium"></p>
                </div>

                <!-- Interesses / Tags -->
                <div class="flex flex-col gap-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#796a6e]">Interesses</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full bg-[#fdf2f4] text-[#590219] text-xs font-bold border border-[#fae6e9]">Viagens</span>
                        <span class="px-3 py-1 rounded-full bg-[#fdf2f4] text-[#590219] text-xs font-bold border border-[#fae6e9]">Fotografia</span>
                        <span class="px-3 py-1 rounded-full bg-[#fdf2f4] text-[#590219] text-xs font-bold border border-[#fae6e9]">Gastronomia</span>
                        <span class="px-3 py-1 rounded-full bg-[#fdf2f4] text-[#590219] text-xs font-bold border border-[#fae6e9]">Música ao Vivo</span>
                    </div>
                </div>

                <!-- Additional Photos Gallery Grid -->
                <div class="flex flex-col gap-2 pt-2 border-t border-[#ede7e5]">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#796a6e]">Galeria de Fotos</h4>
                    <div class="grid grid-cols-2 gap-2">
                        <img id="profile-modal-gallery-1" src="" class="w-full h-36 object-cover rounded-2xl border border-[#ede7e5]">
                        <img id="profile-modal-gallery-2" src="" class="w-full h-36 object-cover rounded-2xl border border-[#ede7e5]">
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="p-4 bg-white border-t border-[#ede7e5] flex justify-center items-center gap-3">
                <button type="button" onclick="closeProfileModal(); document.getElementById('btn-dislike').click();" class="w-12 h-12 rounded-full bg-white border border-[#ede7e5] flex items-center justify-center text-[#221417] shadow-md hover:scale-105 transition-transform" title="Passar">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <a id="profile-modal-chat-btn" href="#" class="w-12 h-12 rounded-full bg-[#fdf2f4] border border-[#590219]/20 flex items-center justify-center text-[#590219] shadow-md hover:scale-105 transition-transform" title="Enviar Mensagem Direta">
                    <i data-lucide="message-circle" class="w-6 h-6"></i>
                </a>
                <button type="button" onclick="closeProfileModal(); document.getElementById('btn-like').click();" class="w-14 h-14 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-xl hover:scale-105 transition-transform" title="Curtir">
                    <i data-lucide="heart" class="w-7 h-7 fill-current"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Verification Modal (R$ 9,90/ano Monetization CTA) -->
    <div id="verification-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-3xl p-6 flex flex-col gap-4 shadow-2xl relative border border-[#ede7e5]">
            <button type="button" onclick="closeVerificationModal()" class="absolute top-4 right-4 text-[#796a6e] hover:text-[#221417]">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="flex flex-col items-center text-center gap-2 pt-2">
                <div class="w-16 h-16 rounded-3xl bg-[#590219] text-amber-300 flex items-center justify-center shadow-lg shadow-[#590219]/30">
                    <i data-lucide="badge-check" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-extrabold text-[#221417]">Selo de Perfil Oficial</h3>
                <p class="text-xs text-[#796a6e]">Aumente a confiança, ganhe destaque no topo das buscas e receba até **4x mais curtidas** no Pariva!</p>
            </div>

            <!-- Pricing Banner -->
            <div class="bg-gradient-to-r from-amber-500/10 to-amber-600/20 rounded-2xl p-4 border border-amber-300/40 flex items-center justify-between">
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-[#590219] uppercase tracking-wider">Pagamento Único</span>
                    <span class="text-2xl font-black text-[#221417]">R$ 14,99</span>
                </div>
                <span class="bg-[#590219] text-amber-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-amber-300/30">
                    TAXA ÚNICA
                </span>
            </div>

            <!-- Features List -->
            <ul class="flex flex-col gap-2 text-xs font-semibold text-[#221417]">
                <li class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>Selo Azul/Dourado em destaque no seu nome</span>
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>Maior prioridade no Swipe Deck dos outros usuários</span>
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>Acesso total ao selo de confiança verificado</span>
                </li>
            </ul>

            <button type="button" onclick="alert('Pagamento via PIX/Cartão simulado com sucesso! Seu selo de verificação vitalício está ativo.'); closeVerificationModal();" class="w-full py-4 bg-[#590219] text-white font-black text-xs rounded-2xl shadow-xl hover:bg-[#3f0111] transition-all flex items-center justify-center gap-2">
                <span>Garantir Meu Selo Por R$ 14,99</span>
                <i data-lucide="arrow-right" class="w-4 h-4 text-amber-300"></i>
            </button>
        </div>
    </div>


</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const cards = Array.from(document.querySelectorAll('.swipe-card'));
    const emptyDeckMsg = document.getElementById('deck-empty-msg');
    const likeForm = document.getElementById('like-form');
    const superlikeInput = document.getElementById('superlike-input');

    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let activeCard = null;

    function getTopCard() {
        return cards.find(c => !c.classList.contains('dismissed')) || null;
    }

    function initCardEvents(card) {
        if (!card) return;

        const onPointerDown = (e) => {
            // Only allow interaction with the topmost visible card (Tinder behavior)
            if (card !== getTopCard()) return;

            isDragging = true;
            activeCard = card;
            card.classList.remove('transition-transform', 'duration-300');
            
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            
            startX = clientX;
            startY = clientY;
        };

        const onPointerMove = (e) => {
            if (!isDragging || activeCard !== card) return;

            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;

            currentX = clientX - startX;
            currentY = clientY - startY;

            const rotate = currentX * 0.08;
            card.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) rotate(${rotate}deg)`;

            // Toggle Badges
            const likeBadge = card.querySelector('.like-badge');
            const nopeBadge = card.querySelector('.nope-badge');

            if (currentX > 30) {
                likeBadge.style.opacity = Math.min(currentX / 100, 1);
                nopeBadge.style.opacity = 0;
            } else if (currentX < -30) {
                nopeBadge.style.opacity = Math.min(Math.abs(currentX) / 100, 1);
                likeBadge.style.opacity = 0;
            } else {
                likeBadge.style.opacity = 0;
                nopeBadge.style.opacity = 0;
            }
        };

        const onPointerUp = () => {
            if (!isDragging || activeCard !== card) return;
            isDragging = false;
            card.classList.add('transition-transform', 'duration-300');

            const threshold = 100;

            if (currentX > threshold) {
                swipeRight(card);
            } else if (currentX < -threshold) {
                swipeLeft(card);
            } else {
                // Reset to center
                card.style.transform = `translate3d(0, 0, 0) rotate(0deg)`;
                const likeBadge = card.querySelector('.like-badge');
                const nopeBadge = card.querySelector('.nope-badge');
                if (likeBadge) likeBadge.style.opacity = 0;
                if (nopeBadge) nopeBadge.style.opacity = 0;
            }

            currentX = 0;
            currentY = 0;
        };

        card.addEventListener('mousedown', onPointerDown);
        window.addEventListener('mousemove', onPointerMove);
        window.addEventListener('mouseup', onPointerUp);

        card.addEventListener('touchstart', onPointerDown, { passive: true });
        window.addEventListener('touchmove', onPointerMove, { passive: true });
        window.addEventListener('touchend', onPointerUp);
    }

    cards.forEach(card => initCardEvents(card));

    function swipeRight(card, isSuper = false) {
        if (!card) return;
        const likeBadge = card.querySelector('.like-badge');
        if (likeBadge) likeBadge.style.opacity = '1';
        card.classList.add('dismissed', 'transition-transform', 'duration-300');
        card.style.transform = `translate3d(${window.innerWidth + 200}px, ${currentY || 0}px, 0) rotate(30deg)`;
        
        const userId = card.dataset.userId;
        setTimeout(() => {
            card.style.display = 'none';
            checkDeckEmpty();
            submitLike(userId, isSuper);
        }, 300);
    }

    function swipeLeft(card) {
        if (!card) return;
        const nopeBadge = card.querySelector('.nope-badge');
        if (nopeBadge) nopeBadge.style.opacity = '1';
        card.classList.add('dismissed', 'transition-transform', 'duration-300');
        card.style.transform = `translate3d(-${window.innerWidth + 200}px, ${currentY || 0}px, 0) rotate(-30deg)`;
        
        setTimeout(() => {
            card.style.display = 'none';
            checkDeckEmpty();
        }, 300);
    }

    function submitLike(userId, isSuper = false) {
        likeForm.action = `/like/${userId}`;
        superlikeInput.value = isSuper ? '1' : '0';
        likeForm.submit();
    }

    function checkDeckEmpty() {
        const remaining = cards.filter(c => !c.classList.contains('dismissed'));
        if (remaining.length === 0 && emptyDeckMsg) {
            emptyDeckMsg.classList.remove('hidden');
            emptyDeckMsg.classList.add('flex');
        }
    }

    // Floating Buttons Wire-up
    document.getElementById('btn-like').addEventListener('click', () => {
        const topCard = getTopCard();
        if (topCard) swipeRight(topCard, false);
    });

    document.getElementById('btn-dislike').addEventListener('click', () => {
        const topCard = getTopCard();
        if (topCard) swipeLeft(topCard);
    });

    document.getElementById('btn-superlike').addEventListener('click', () => {
        const topCard = getTopCard();
        if (topCard) swipeRight(topCard, true);
    });

    document.getElementById('btn-rewind').addEventListener('click', () => {
        cards.forEach(card => {
            card.classList.remove('dismissed');
            card.style.display = 'block';
            card.style.transform = 'translate3d(0, 0, 0) rotate(0deg)';
            const likeBadge = card.querySelector('.like-badge');
            const nopeBadge = card.querySelector('.nope-badge');
            if (likeBadge) likeBadge.style.opacity = 0;
            if (nopeBadge) nopeBadge.style.opacity = 0;
        });
        if (emptyDeckMsg) {
            emptyDeckMsg.classList.add('hidden');
            emptyDeckMsg.classList.remove('flex');
        }
    });
});

function openSafetyModal(userId, userName) {
    document.getElementById('modal-user-name').innerText = userName;
    document.getElementById('block-user-id').value = userId;
    document.getElementById('report-user-id').value = userId;
    
    const modal = document.getElementById('safety-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeSafetyModal() {
    const modal = document.getElementById('safety-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('report-details-form').classList.add('hidden');
    document.getElementById('report-details-form').classList.remove('flex');
}

function showReportForm() {
    const form = document.getElementById('report-details-form');
    form.classList.remove('hidden');
    form.classList.add('flex');
}

function openRoseModal() {
    const cards = Array.from(document.querySelectorAll('.swipe-card'));
    const topCard = cards.find(c => !c.classList.contains('dismissed'));
    if (!topCard) return;
    const userId = topCard.dataset.userId;
    const userName = topCard.querySelector('h2 span')?.innerText.trim() || 'Usuário';

    document.getElementById('rose-user-name').innerText = userName;
    document.getElementById('rose-receiver-id').value = userId;

    const modal = document.getElementById('rose-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeRoseModal() {
    const modal = document.getElementById('rose-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Photo switching logic (Tinder style photo tap navigation)
const userPhotosMap = {
    'Mariana': ['/images/avatars/mariana.jpg', '/images/moments/picnic.jpg', '/images/moments/museum.jpg'],
    'Isabella': ['/images/avatars/isabella.jpg', '/images/moments/cafe.jpg', '/images/moments/art_gallery.jpg'],
    'Camila': ['/images/avatars/camila.jpg', '/images/moments/picnic.jpg', '/images/moments/cafe.jpg'],
    'Lucas': ['/images/avatars/lucas.jpg', '/images/moments/museum.jpg', '/images/moments/cafe.jpg']
};

function nextPhoto(el, event) {
    event.stopPropagation();
    const card = el.closest('.swipe-card');
    const userName = card.querySelector('h2 span').innerText.trim();
    const photos = userPhotosMap[userName] || ['/images/avatars/mariana.jpg', '/images/moments/picnic.jpg', '/images/moments/cafe.jpg'];
    
    let currentIndex = parseInt(card.dataset.photoIndex || '0');
    currentIndex = (currentIndex + 1) % photos.length;
    card.dataset.photoIndex = currentIndex;

    const img = card.querySelector('.card-img');
    img.src = photos[currentIndex];

    // Update photo progress indicators
    const bars = card.querySelectorAll('.photo-bar');
    bars.forEach((bar, idx) => {
        if (idx === currentIndex) {
            bar.classList.add('opacity-100');
            bar.classList.remove('opacity-40');
        } else {
            bar.classList.remove('opacity-100');
            bar.classList.add('opacity-40');
        }
    });
}

function prevPhoto(el, event) {
    event.stopPropagation();
    const card = el.closest('.swipe-card');
    const userName = card.querySelector('h2 span').innerText.trim();
    const photos = userPhotosMap[userName] || ['/images/avatars/mariana.jpg', '/images/moments/picnic.jpg', '/images/moments/cafe.jpg'];
    
    let currentIndex = parseInt(card.dataset.photoIndex || '0');
    currentIndex = (currentIndex - 1 + photos.length) % photos.length;
    card.dataset.photoIndex = currentIndex;

    const img = card.querySelector('.card-img');
    img.src = photos[currentIndex];

    // Update photo progress indicators
    const bars = card.querySelectorAll('.photo-bar');
    bars.forEach((bar, idx) => {
        if (idx === currentIndex) {
            bar.classList.add('opacity-100');
            bar.classList.remove('opacity-40');
        } else {
            bar.classList.remove('opacity-100');
            bar.classList.add('opacity-40');
        }
    });
}

function startDirectChat() {
    const topCard = getTopCard();
    if (!topCard) {
        window.location.href = '/chat';
        return;
    }
    const userId = topCard.dataset.userId;
    window.location.href = `/chat?user_id=${userId}`;
}

function openProfileModal(user) {
    const firstName = user.name.split(' ')[0];
    const mainImg = `/images/avatars/${firstName.toLowerCase()}.jpg`;
    
    document.getElementById('profile-modal-img').src = mainImg;
    document.getElementById('profile-modal-name').innerText = user.name;
    document.getElementById('profile-modal-age').innerText = user.age || 28;
    document.getElementById('profile-modal-badge').innerText = user.verification_badge || 'Verificado';
    document.getElementById('profile-modal-profession').innerText = user.profession || 'Designer & Fotógrafa';
    document.getElementById('profile-modal-location').innerText = user.location || 'São Paulo, SP';
    document.getElementById('profile-modal-bio').innerText = user.bio || 'Adoro viajar, descobrir restaurantes novos e passar o domingo no parque ouvindo boa música...';

    document.getElementById('profile-modal-gallery-1').src = '/images/moments/picnic.jpg';
    document.getElementById('profile-modal-gallery-2').src = '/images/moments/cafe.jpg';

    const chatBtn = document.getElementById('profile-modal-chat-btn');
    if (chatBtn) {
        chatBtn.href = `/chat?user_id=${user.id}`;
    }

    const modal = document.getElementById('profile-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProfileModal() {
    const modal = document.getElementById('profile-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function openVerificationModal() {
    const modal = document.getElementById('verification-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeVerificationModal() {
    const modal = document.getElementById('verification-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush
@endsection
