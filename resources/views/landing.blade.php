@extends('layouts.app')

@section('title', 'Pariva - Aplicativo de Relacionamento Sério e Conexões Genuínas')
@section('meta_description', 'Encontre solteiros em busca de relacionamentos sérios no Pariva. Teste de compatibilidade por IA, agendamento de dates seguros e perfis 100% verificados.')
@section('meta_keywords', 'aplicativo de relacionamento sério, site de namoro confiavel, encontros seguros, pariva namoro, aplicativo tinder alternativo, solteiros em sao paulo')


@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-9 w-auto object-contain rounded-lg shadow-xs">
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="text-xs font-bold text-[#590219] px-3 py-1.5 rounded-lg hover:bg-[#f5ebe8] transition-colors">
                Entrar
            </a>
            <a href="{{ route('register') }}" class="text-xs font-bold text-white bg-[#590219] px-3.5 py-1.5 rounded-lg shadow-sm hover:bg-[#3f0111] transition-colors">
                Cadastrar
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

    <!-- Preview Profile Card (Sofia) Stitch -->
    <section class="bg-gradient-to-b from-[#f5f2f0] to-[#eae5e2] rounded-2xl p-6 flex flex-col items-center text-center border border-[#ede7e5] shadow-sm">
        <div class="w-20 h-20 rounded-full overflow-hidden mb-3 border-2 border-white shadow-sm">
            <img src="{{ asset('images/avatars/sofia.jpg') }}" alt="Sofia" class="w-full h-full object-cover">
        </div>
        <div class="bg-[#590219] text-white text-[10px] font-bold px-3 py-1 rounded-full flex items-center gap-1 mb-2">
            <i data-lucide="heart" class="w-3 h-3 fill-current"></i> 89% Compatível
        </div>
        <h4 class="font-bold text-base text-[#221417]">Sofia, 28</h4>
        <p class="text-xs text-[#796a6e] italic mt-1 max-w-xs">
            "Amo fotografia, vinhos aos sábados e conversas profundas sobre livros."
        </p>
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

