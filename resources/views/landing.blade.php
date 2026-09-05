@extends('layouts.app')

@section('title', 'Pariva - Aplicativo de Relacionamento Sério e Conexões Genuínas')
@section('meta_description', 'Encontre solteiros em busca de relacionamentos sérios no Pariva. Teste de compatibilidade por IA, agendamento de dates seguros e perfis 100% verificados.')
@section('meta_keywords', 'aplicativo de relacionamento sério, site de namoro confiavel, encontros seguros, pariva namoro, aplicativo tinder alternativo, solteiros em sao paulo')


@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#fbf9f8]/80 backdrop-blur-xl border-b border-[#ede7e5]/80 sticky top-0 z-50 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-9 w-auto object-contain rounded-xl shadow-xs border border-[#590219]/10">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="text-xs font-bold text-[#590219] px-3.5 py-2 rounded-xl hover:bg-[#f7ecee] transition-all">
                Entrar
            </a>
            <a href="{{ route('register') }}" class="text-xs font-bold text-white bg-gradient-to-r from-[#590219] to-[#7c0d28] px-4 py-2 rounded-xl shadow-md hover:shadow-lg hover:brightness-110 active:scale-95 transition-all flex items-center gap-1">
                <span>Cadastrar</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </header>
@endsection

@section('content')
<div class="px-5 py-6 flex flex-col gap-10">

    <!-- Hero Section Stitch -->
    <section class="flex flex-col items-center text-center">
        <!-- Logo Emblem -->
        <div class="mb-6 flex flex-col items-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-24 w-auto object-contain rounded-2xl shadow-sm">
        </div>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#590219] leading-snug max-w-xs mb-3">
            Encontre alguém que realmente combina com você.
        </h1>

        <p class="text-xs sm:text-sm text-[#796a6e] max-w-xs leading-relaxed mb-6">
            Na Pariva, você conhece pessoas que também procuram uma conexão genuína e um relacionamento sério.
        </p>

        <div class="w-full flex flex-col gap-3 max-w-xs">
            <a href="{{ route('discover') }}" class="w-full py-3.5 px-4 bg-[#590219] text-white font-semibold text-sm rounded-xl shadow-md hover:bg-[#3f0111] transition-all text-center">
                Criar meu perfil gratuitamente
            </a>
            <a href="#como-funciona" class="w-full py-3.5 px-4 bg-white text-[#590219] font-medium text-sm rounded-xl border border-[#d6c7c4] hover:bg-[#fdf2f4] transition-all text-center">
                Como funciona
            </a>
        </div>
    </section>

    <!-- Como Funciona Section -->
    <section id="como-funciona" class="flex flex-col gap-6 pt-4">
        <h2 class="text-xl font-bold text-center text-[#221417]">Como funciona</h2>

        <div class="flex flex-col gap-5">
            <!-- Step 1 -->
            <div class="flex gap-4 items-start">
                <div class="w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center font-bold text-sm shrink-0">
                    1
                </div>
                <div>
                    <h3 class="font-bold text-sm text-[#221417] mb-1">Crie seu perfil</h3>
                    <p class="text-xs text-[#796a6e] leading-relaxed">
                        Conte-nos sobre você, seus valores e o que procura. Quanto mais genuíno, melhor.
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="flex gap-4 items-start">
                <div class="w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center font-bold text-sm shrink-0">
                    2
                </div>
                <div>
                    <h3 class="font-bold text-sm text-[#221417] mb-1">Descubra compatibilidades</h3>
                    <p class="text-xs text-[#796a6e] leading-relaxed">
                        Nosso algoritmo analisa profundamente os perfis para sugerir pessoas com alta afinidade.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex gap-4 items-start">
                <div class="w-8 h-8 rounded-full bg-[#590219] text-white flex items-center justify-center font-bold text-sm shrink-0">
                    3
                </div>
                <div>
                    <h3 class="font-bold text-sm text-[#221417] mb-1">Crie uma conexão</h3>
                    <p class="text-xs text-[#796a6e] leading-relaxed">
                        Inicie conversas significativas e deixe a faísca acontecer naturalmente.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preview Profiles Carousel / Grid Section -->
    <section class="flex flex-col gap-4">
        <div class="flex flex-col items-center text-center gap-1">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#590219] bg-[#590219]/10 px-3 py-1 rounded-full">Pessoas na sua Região</span>
            <h2 class="text-xl font-bold text-[#221417]">Conexões reais esperando por você</h2>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($profiles as $profile)
                <div class="bg-gradient-to-br from-white to-[#f7f2f0] rounded-3xl p-5 border border-[#ede7e5] shadow-md hover:shadow-lg transition-all flex flex-col gap-3 relative overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div class="relative w-16 h-16 rounded-2xl overflow-hidden shrink-0 border-2 border-white shadow-sm bg-[#eee9e6]">
                            <img src="{{ $profile->avatar ? (str_starts_with($profile->avatar, 'http') ? $profile->avatar : asset('storage/' . $profile->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', $profile->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', $profile->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                                 onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                                 alt="{{ $profile->name }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex flex-col gap-0.5 flex-1 min-w-0">
                            <div class="flex items-center gap-1.5">
                                <h4 class="font-extrabold text-base text-[#221417] truncate">{{ $profile->name }}</h4>
                                <span class="text-sm font-semibold text-[#796a6e]">, {{ $profile->age ?? '25' }}</span>
                                @if($profile->is_verified)
                                    <i data-lucide="badge-check" class="w-4 h-4 text-amber-500 fill-amber-500/20 shrink-0"></i>
                                @endif
                            </div>

                            <p class="text-xs text-[#796a6e] truncate">{{ $profile->profession ?? 'Profissional' }} • {{ $profile->location ?? 'São Paulo' }}</p>

                            <div class="mt-1 inline-flex items-center gap-1 text-[10px] font-bold text-[#590219] bg-[#590219]/10 px-2.5 py-0.5 rounded-full w-fit">
                                <i data-lucide="sparkles" class="w-3 h-3 text-[#590219]"></i>
                                <span>{{ rand(84, 98) }}% Compatível</span>
                            </div>
                        </div>
                    </div>

                    @if($profile->bio)
                        <p class="text-xs text-[#221417]/80 italic line-clamp-2 bg-white/60 p-2.5 rounded-xl border border-[#ede7e5]/50">
                            "{{ $profile->bio }}"
                        </p>
                    @endif
                </div>
            @empty
                <!-- Fallback 3 static profiles if database is empty -->
                <div class="bg-gradient-to-br from-white to-[#f7f2f0] rounded-3xl p-5 border border-[#ede7e5] shadow-md flex items-center gap-4">
                    <img src="{{ asset('images/avatars/mariana.jpg') }}" alt="Mariana" class="w-16 h-16 rounded-2xl object-cover border-2 border-white shadow-sm">
                    <div>
                        <h4 class="font-extrabold text-base text-[#221417]">Mariana, 26 <i data-lucide="badge-check" class="inline w-4 h-4 text-amber-500"></i></h4>
                        <p class="text-xs text-[#796a6e]">Arquiteta • São Paulo</p>
                        <span class="text-[10px] font-bold text-[#590219] bg-[#590219]/10 px-2 py-0.5 rounded-full mt-1 inline-block">96% Compatível</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white to-[#f7f2f0] rounded-3xl p-5 border border-[#ede7e5] shadow-md flex items-center gap-4">
                    <img src="{{ asset('images/avatars/lucas.jpg') }}" alt="Lucas" class="w-16 h-16 rounded-2xl object-cover border-2 border-white shadow-sm">
                    <div>
                        <h4 class="font-extrabold text-base text-[#221417]">Lucas, 29 <i data-lucide="badge-check" class="inline w-4 h-4 text-amber-500"></i></h4>
                        <p class="text-xs text-[#796a6e]">Engenheiro • São Paulo</p>
                        <span class="text-[10px] font-bold text-[#590219] bg-[#590219]/10 px-2 py-0.5 rounded-full mt-1 inline-block">92% Compatível</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white to-[#f7f2f0] rounded-3xl p-5 border border-[#ede7e5] shadow-md flex items-center gap-4">
                    <img src="{{ asset('images/avatars/isabella.jpg') }}" alt="Isabella" class="w-16 h-16 rounded-2xl object-cover border-2 border-white shadow-sm">
                    <div>
                        <h4 class="font-extrabold text-base text-[#221417]">Isabella, 27 <i data-lucide="badge-check" class="inline w-4 h-4 text-amber-500"></i></h4>
                        <p class="text-xs text-[#796a6e]">Médica • Campinas</p>
                        <span class="text-[10px] font-bold text-[#590219] bg-[#590219]/10 px-2 py-0.5 rounded-full mt-1 inline-block">89% Compatível</span>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Security & Privacy Cards -->
    <section class="flex flex-col gap-3">
        <div class="bg-[#f5f2f0] p-4 rounded-xl flex items-center gap-3 border border-[#ede7e5]">
            <div class="w-9 h-9 rounded-full bg-[#590219] text-white flex items-center justify-center shrink-0">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <div>
                <h5 class="font-bold text-xs text-[#221417]">Perfis verificados</h5>
                <p class="text-[11px] text-[#796a6e]">Ambiente seguro com verificação rigorosa.</p>
            </div>
        </div>

        <div class="bg-[#f5f2f0] p-4 rounded-xl flex items-center gap-3 border border-[#ede7e5]">
            <div class="w-9 h-9 rounded-full bg-[#590219] text-white flex items-center justify-center shrink-0">
                <i data-lucide="lock" class="w-5 h-5"></i>
            </div>
            <div>
                <h5 class="font-bold text-xs text-[#221417]">Privacidade total</h5>
                <p class="text-[11px] text-[#796a6e]">Seus dados estão protegidos conosco.</p>
            </div>
        </div>
    </section>

    <!-- Features Grid: IA Matching, Dates Seguros & Eventos -->
    <section class="flex flex-col gap-4">
        <h2 class="text-xl font-bold text-center text-[#221417] mb-1">Por que a Pariva é diferente?</h2>

        <!-- Feature 1: Matching com IA -->
        <div class="bg-gradient-to-br from-[#fbf9f8] to-[#f4ebe8] p-5 rounded-2xl border border-[#ede7e5] shadow-xs flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-[#590219] text-white flex items-center justify-center shrink-0 shadow-md">
                <i data-lucide="sparkles" class="w-6 h-6"></i>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-extrabold text-sm text-[#221417]">Matching com Inteligência Artificial</h3>
                <p class="text-xs text-[#796a6e] leading-relaxed">
                    Nossa IA analisa compatibilidade emocional, valores e estilo de vida para sugerir pares que realmente combinam no mundo real.
                </p>
            </div>
        </div>

        <!-- Feature 2: Agendar Dates Seguros -->
        <div class="bg-gradient-to-br from-[#fbf9f8] to-[#f4ebe8] p-5 rounded-2xl border border-[#ede7e5] shadow-xs flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-[#590219] text-white flex items-center justify-center shrink-0 shadow-md">
                <i data-lucide="calendar-heart" class="w-6 h-6"></i>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-extrabold text-sm text-[#221417]">Agendar Encontros Seguros</h3>
                <p class="text-xs text-[#796a6e] leading-relaxed">
                    Escolha locais públicos verificados (cafés, parques, museus) e agende o date direto pelo app com compartilhamento de segurança.
                </p>
            </div>
        </div>

        <!-- Feature 3: Eventos da Comunidade -->
        <div class="bg-gradient-to-br from-[#fbf9f8] to-[#f4ebe8] p-5 rounded-2xl border border-[#ede7e5] shadow-xs flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-[#590219] text-white flex items-center justify-center shrink-0 shadow-md">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-extrabold text-sm text-[#221417]">Eventos das Comunidades</h3>
                <p class="text-xs text-[#796a6e] leading-relaxed">
                    Participe de encontros presenciais exclusivos (degustação de vinhos, feiras de arte, trilhas) com solteiros com interesses em comum.
                </p>
            </div>
        </div>
    </section>

    <!-- Pariva Games Banner (Stitch Burgundy Banner) -->
    <section class="bg-[#590219] text-white rounded-2xl p-6 flex flex-col items-center text-center gap-2 shadow-lg">
        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mb-1">
            <i data-lucide="gamepad-2" class="w-6 h-6 text-white"></i>
        </div>
        <h3 class="font-extrabold text-base tracking-wide">Pariva Games</h3>
        <p class="text-xs text-white/80 leading-relaxed max-w-xs">
            Quebre o gelo de forma divertida. Conheça pessoas através de dinâmicas e jogos interativos ("Quem é mais provável", Trivia) antes do primeiro date.
        </p>
    </section>

    <!-- Final Call To Action -->
    <section class="flex flex-col items-center text-center gap-4 py-4">
        <h2 class="text-xl font-extrabold text-[#590219] leading-snug max-w-xs">
            Sua próxima grande conexão pode começar aqui.
        </h2>
        <a href="{{ route('discover') }}" class="w-full max-w-xs py-3.5 px-4 bg-[#590219] text-white font-semibold text-sm rounded-xl shadow-md hover:bg-[#3f0111] transition-all text-center">
            Começar agora
        </a>
    </section>

</div>

@include('components.footer')
@endsection

