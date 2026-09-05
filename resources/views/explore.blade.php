@extends('layouts.app')

@section('title', 'Pariva - Explorar')

@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#f7f2f0]/95 backdrop-blur-md border-b border-[#e8dedb] sticky top-0 z-40 shadow-[0_2px_15px_rgba(0,0,0,0.02)]">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}?v={{ time() }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Explorar</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/30 shadow-xs flex items-center justify-center bg-[#eee9e6] font-bold text-xs text-[#590219] hover:scale-105 transition-transform" title="{{ Auth::user()->name }}">
            <img src="{{ asset('images/avatars/' . (strtolower(explode(' ', Auth::user()->name)[0])) . '.jpg') }}" 
                 onerror="this.src='{{ asset('images/avatars/isabella.jpg') }}'" 
                 alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-4 py-4 flex flex-col gap-5 max-w-md mx-auto">

    <!-- Header Intro -->
    <div class="flex flex-col gap-1">
        <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] bg-[#590219]/10 px-2.5 py-0.5 rounded-full w-fit">Vibe & Intenções</span>
        <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">O que você busca hoje?</h1>
        <p class="text-xs text-[#796a6e]">Explore pessoas por momentos, interesses e intenções em tempo real.</p>
    </div>

    <!-- Active Filter Notice (if filtered) -->
    @if(request('mode'))
    <div class="flex items-center justify-between bg-[#590219] text-white px-4 py-2.5 rounded-2xl shadow-sm text-xs">
        <div class="flex items-center gap-2 font-medium">
            <i data-lucide="filter" class="w-4 h-4 text-amber-300"></i>
            <span>Filtrado por: <strong class="font-bold underline">{{ ucfirst(str_replace('_', ' ', request('mode'))) }}</strong></span>
        </div>
        <a href="{{ route('explore') }}" class="text-[11px] font-extrabold text-amber-300 hover:text-white uppercase tracking-wider">Limpar</a>
    </div>
    @endif

    <!-- Category Grid Cards -->
    <div class="grid grid-cols-2 gap-3">

        <!-- Card 1: Livre Hoje à Noite -->
        <a href="{{ route('explore', ['mode' => 'livre_hoje']) }}" class="group relative rounded-3xl overflow-hidden h-40 border border-[#ede7e5] shadow-md transition-all hover:scale-[1.02] hover:shadow-xl bg-gradient-to-br from-amber-500 via-rose-600 to-[#590219] p-4 flex flex-col justify-between text-white">
            <div class="w-9 h-9 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-amber-200 shadow-xs">
                <i data-lucide="moon-star" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col gap-0.5 z-10">
                <span class="text-[10px] font-black uppercase tracking-wider text-amber-200">Alta Vibe</span>
                <h3 class="text-base font-extrabold leading-tight">Livre Hoje à Noite 🌙</h3>
                <p class="text-[10px] text-white/80 line-clamp-1">Pessoas prontas para sair hoje</p>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
        </a>

        <!-- Card 2: Procurando um Amor -->
        <a href="{{ route('explore', ['mode' => 'relacionamento']) }}" class="group relative rounded-3xl overflow-hidden h-40 border border-[#ede7e5] shadow-md transition-all hover:scale-[1.02] hover:shadow-xl bg-gradient-to-br from-rose-500 via-[#880d2d] to-[#590219] p-4 flex flex-col justify-between text-white">
            <div class="w-9 h-9 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-pink-200 shadow-xs">
                <i data-lucide="heart" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col gap-0.5 z-10">
                <span class="text-[10px] font-black uppercase tracking-wider text-pink-200">Sério & Conexão</span>
                <h3 class="text-base font-extrabold leading-tight">Busco Relacionamento 💖</h3>
                <p class="text-[10px] text-white/80 line-clamp-1">Conexões duradouras</p>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
        </a>

        <!-- Card 3: Tomar um Café / Bar -->
        <a href="{{ route('explore', ['mode' => 'cafe_bar']) }}" class="group relative rounded-3xl overflow-hidden h-40 border border-[#ede7e5] shadow-md transition-all hover:scale-[1.02] hover:shadow-xl bg-gradient-to-br from-amber-700 via-amber-800 to-[#3f0111] p-4 flex flex-col justify-between text-white">
            <div class="w-9 h-9 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-amber-200 shadow-xs">
                <i data-lucide="coffee" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col gap-0.5 z-10">
                <span class="text-[10px] font-black uppercase tracking-wider text-amber-200">Casual</span>
                <h3 class="text-base font-extrabold leading-tight">Tomar um Café ☕</h3>
                <p class="text-[10px] text-white/80 line-clamp-1">Bate-papo leve e descontraído</p>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
        </a>

        <!-- Card 4: Novas Amizades -->
        <a href="{{ route('explore', ['mode' => 'amizade']) }}" class="group relative rounded-3xl overflow-hidden h-40 border border-[#ede7e5] shadow-md transition-all hover:scale-[1.02] hover:shadow-xl bg-gradient-to-br from-emerald-600 via-teal-700 to-[#590219] p-4 flex flex-col justify-between text-white">
            <div class="w-9 h-9 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-emerald-200 shadow-xs">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
            <div class="flex flex-col gap-0.5 z-10">
                <span class="text-[10px] font-black uppercase tracking-wider text-emerald-200">Social</span>
                <h3 class="text-base font-extrabold leading-tight">Novas Amizades 🤝</h3>
                <p class="text-[10px] text-white/80 line-clamp-1">Expandir o círculo de amigos</p>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
        </a>

    </div>

    <!-- Filtered Results Section -->
    <div class="flex flex-col gap-3 mt-2">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-extrabold text-[#221417]">Perfis em Destaque</h2>
            <span class="text-xs text-[#796a6e] font-semibold">{{ count($users) }} pessoas encontradas</span>
        </div>

        <div class="grid grid-cols-1 gap-3">
            @forelse($users as $user)
                <div class="bg-gradient-to-br from-white to-[#f7f2f0] rounded-3xl p-4 border border-[#ede7e5] shadow-md flex items-center justify-between gap-3 hover:shadow-lg transition-all">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="relative w-14 h-14 rounded-2xl overflow-hidden shrink-0 border-2 border-white shadow-sm bg-[#eee9e6]">
                            <img src="{{ $user->avatar ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', $user->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', $user->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                                 onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                                 alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col gap-0.5 min-w-0">
                            <div class="flex items-center gap-1.5 truncate">
                                <h3 class="font-extrabold text-sm text-[#221417] truncate">{{ $user->name }}</h3>
                                <span class="text-xs font-semibold text-[#796a6e]">, {{ $user->age ?? 25 }}</span>
                                @if($user->is_verified)
                                    <i data-lucide="badge-check" class="w-3.5 h-3.5 text-amber-500 fill-amber-500/20 shrink-0"></i>
                                @endif
                            </div>
                            <p class="text-[11px] text-[#796a6e] truncate">{{ $user->profession ?? 'Pariva Member' }} • {{ $user->location ?? 'São Paulo' }}</p>
                            
                            <!-- Vibe Tag -->
                            <div class="mt-1 flex items-center gap-1">
                                <span class="text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-[#590219]/10 text-[#590219]">
                                    @if(request('mode') === 'livre_hoje')
                                        🌙 Livre Hoje
                                    @elseif(request('mode') === 'relacionamento')
                                        💖 Relacionamento
                                    @elseif(request('mode') === 'cafe_bar')
                                        ☕ Tomar um Café
                                    @elseif(request('mode') === 'amizade')
                                        🤝 Novas Amizades
                                    @else
                                        ✨ Verificado & Ativo
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Like Button -->
                    <form action="{{ route('like.user', $user->id) }}" method="POST" class="shrink-0">
                        @csrf
                        <button type="submit" class="w-10 h-10 rounded-2xl bg-[#590219] text-white flex items-center justify-center shadow-md hover:bg-[#3f0111] hover:scale-105 transition-all">
                            <i data-lucide="heart" class="w-5 h-5 fill-white"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-6 text-center border border-[#ede7e5] flex flex-col items-center gap-2">
                    <div class="w-12 h-12 rounded-full bg-[#fdf2f4] text-[#590219] flex items-center justify-center">
                        <i data-lucide="compass" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-extrabold text-sm text-[#221417]">Nenhum perfil nesta vibe no momento</h3>
                    <p class="text-xs text-[#796a6e]">Tente selecionar outra categoria de exploração acima.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
