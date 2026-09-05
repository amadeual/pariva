@extends('layouts.app')

@section('title', 'Pariva Extras & Destaques')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#7c0d28] to-[#590219] flex items-center justify-center p-1.5 text-white shadow-xs">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
            </div>
            <span class="text-lg font-extrabold text-[#590219] tracking-tight">Loja & Destaques</span>
        </div>
        <a href="{{ route('discover') }}" class="text-xs font-bold text-[#796a6e] hover:text-[#590219]">
            Voltar
        </a>
    </header>
@endsection

@section('content')
<div class="flex flex-col gap-6 pb-12">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mx-5 mt-4 bg-[#10b981]/10 text-[#065f46] p-3.5 rounded-xl border border-[#10b981]/20 flex items-center gap-2.5 text-xs font-bold shadow-xs">
        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#10b981] shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Hero Section -->
    <div class="relative w-full bg-gradient-to-b from-[#3f0111] via-[#590219] to-[#7c0d28] text-white pt-8 pb-10 px-6 rounded-b-3xl shadow-md text-center overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <h1 class="text-2xl font-extrabold tracking-tight mb-2 relative z-10">Destaque seu Perfil 🔥</h1>
        <p class="text-xs text-white/80 max-w-xs mx-auto leading-relaxed relative z-10">
            Aumente suas curtidas em até 10x com Boosts, Destaque Semanal/Mensal e veja quem curtiu você.
        </p>

        <!-- Active Status Pills -->
        <div class="flex flex-wrap justify-center gap-2 mt-4 relative z-10">
            @if(Auth::user()->isBoosted())
            <span class="bg-[#f5b800] text-black text-[10px] font-black px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                ⚡ BOOST ATIVO (até {{ Auth::user()->boosted_until->format('H:i') }})
            </span>
            @endif

            @if(Auth::user()->isFeatured())
            <span class="bg-white text-[#590219] text-[10px] font-black px-3 py-1 rounded-full flex items-center gap-1 shadow-sm uppercase">
                ⭐ DESTAQUE {{ Auth::user()->featured_plan ?? 'ATIVO' }} (até {{ Auth::user()->featured_until->format('d/m') }})
            </span>
            @endif

            @if(Auth::user()->canSeeWhoLiked())
            <span class="bg-[#10b981] text-white text-[10px] font-black px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                👀 QUEM CURTIU LIBERADO
            </span>
            @endif
        </div>
    </div>

    <!-- Section 1: Perfil em Destaque (Semanal / Mensal) -->
    <div class="px-5 flex flex-col gap-3 -mt-4 relative z-20">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#f5b800]/20 text-[#d9a000] flex items-center justify-center font-bold">
                ⭐
            </div>
            <h2 class="text-base font-extrabold text-[#221417]">Perfil em Destaque</h2>
        </div>
        <p class="text-xs text-[#796a6e]">
            Fique em evidência contínua com o selo Destaque no topo do Descobrir por 7 dias ou 30 dias.
        </p>

        <div class="grid grid-cols-2 gap-3 mt-1">
            <!-- Destaque Semanal -->
            <form action="{{ route('user.featured') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="semanal">
                <div class="bg-white rounded-2xl p-4 border border-[#ede7e5] shadow-sm flex flex-col justify-between h-full hover:border-[#590219] transition-all">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] font-extrabold uppercase text-[#796a6e]">Semanal</span>
                            <span class="text-xs">📅</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-[#221417]">R$ 19,90</h3>
                        <p class="text-[10px] text-[#796a6e] mt-1">7 Dias de visibilidade máxima com selo ⭐</p>
                    </div>
                    <button type="submit" class="w-full mt-3 py-2 bg-[#fdf2f4] hover:bg-[#fae6e9] text-[#590219] font-bold text-xs rounded-xl transition-all">
                        Ativar 7 Dias
                    </button>
                </div>
            </form>

            <!-- Destaque Mensal -->
            <form action="{{ route('user.featured') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="mensal">
                <div class="bg-gradient-to-br from-[#590219] to-[#7c0d28] text-white rounded-2xl p-4 shadow-md flex flex-col justify-between h-full relative overflow-hidden">
                    <span class="absolute top-0 right-0 bg-[#f5b800] text-black font-black text-[8px] px-2 py-0.5 rounded-bl">50% OFF</span>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] font-extrabold uppercase text-white/80">Mensal</span>
                            <span class="text-xs">👑</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-white">R$ 39,90</h3>
                        <p class="text-[10px] text-white/80 mt-1">30 Dias contínuos de destaque na região</p>
                    </div>
                    <button type="submit" class="w-full mt-3 py-2 bg-[#f5b800] hover:bg-[#e0a700] text-black font-black text-xs rounded-xl shadow-xs transition-all">
                        Ativar 30 Dias 🔥
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section 2: Boost de Perfil Instantâneo -->
    <div class="px-5 flex flex-col gap-3 mt-2">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#590219]/10 text-[#590219] flex items-center justify-center font-bold">
                ⚡
            </div>
            <h2 class="text-base font-extrabold text-[#221417]">Boost Instantâneo</h2>
        </div>
        <p class="text-xs text-[#796a6e]">
            Coloque seu perfil como o 1º a ser exibido para todos os usuários ativos da sua cidade agora.
        </p>

        <div class="grid grid-cols-3 gap-2.5 mt-1">
            <!-- Boost 30 min -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="30">
                <button type="submit" class="w-full bg-white rounded-2xl p-3 border border-[#ede7e5] shadow-xs hover:border-[#590219] flex flex-col items-center text-center transition-all">
                    <span class="text-[10px] font-bold text-[#796a6e]">30 MIN</span>
                    <span class="text-sm font-extrabold text-[#590219] my-0.5">R$ 9,90</span>
                    <span class="text-[9px] text-[#796a6e]">Ideal pra hoje</span>
                </button>
            </form>

            <!-- Boost 1 Hora -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="60">
                <button type="submit" class="w-full bg-white rounded-2xl p-3 border-2 border-[#590219] shadow-xs hover:bg-[#fdf2f4] flex flex-col items-center text-center transition-all relative">
                    <span class="text-[10px] font-bold text-[#590219]">1 HORA</span>
                    <span class="text-sm font-extrabold text-[#590219] my-0.5">R$ 14,90</span>
                    <span class="text-[9px] text-[#590219] font-bold">Recomendado</span>
                </button>
            </form>

            <!-- Super Boost 3 Horas -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="180">
                <button type="submit" class="w-full bg-[#590219] text-white rounded-2xl p-3 shadow-sm flex flex-col items-center text-center transition-all">
                    <span class="text-[10px] font-bold text-white/80">3 HORAS</span>
                    <span class="text-sm font-extrabold text-white my-0.5">R$ 24,90</span>
                    <span class="text-[9px] text-[#f5b800] font-bold">Super Boost</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Section: Chat Direto Sem Match (R$ 15,00) -->
    <div class="px-5 flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-[#590219]/10 text-[#590219] flex items-center justify-center font-bold">
                    💬
                </div>
                <h2 class="text-base font-extrabold text-[#221417]">Chat Direto sem Match</h2>
            </div>
            <span class="text-[10px] font-extrabold text-[#590219] bg-[#590219]/10 px-2.5 py-0.5 rounded-full">
                Créditos: {{ Auth::user()->direct_chat_credits }}
            </span>
        </div>
        <p class="text-xs text-[#796a6e]">
            Envie mensagens para qualquer pessoa da plataforma mesmo sem ter dado match!
        </p>

        <form action="{{ route('user.buy-chat-credits') }}" method="POST">
            @csrf
            <div class="bg-gradient-to-r from-amber-500 via-[#880d2d] to-[#590219] text-white rounded-2xl p-4 shadow-md flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shrink-0">
                        ⚡
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-extrabold">Pacote 3 Chats Diretos</span>
                        <span class="text-[11px] text-white/80">Inicie até 3 conversas exclusivas</span>
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-amber-400 text-[#590219] font-black text-xs rounded-xl shadow-sm hover:bg-amber-300 transition-colors shrink-0 cursor-pointer">
                    R$ 15,00
                </button>
            </div>
        </form>
    </div>

    <!-- Section 3: Ver Quem Te Curtiu -->
    <div class="px-5 flex flex-col gap-3 mt-2">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#10b981]/10 text-[#059669] flex items-center justify-center font-bold">
                👀
            </div>
            <h2 class="text-base font-extrabold text-[#221417]">Revelar 'Quem Te Curtiu'</h2>
        </div>

        <div class="bg-white rounded-2xl p-4 border border-[#ede7e5] shadow-sm flex flex-col gap-3">
            <p class="text-xs text-[#796a6e]">
                Veja instantaneamente todas as fotos e nomes de quem deu Like no seu perfil antes mesmo de você curtir de volta.
            </p>

            <div class="grid grid-cols-2 gap-2.5">
                <form action="{{ route('user.see-likes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="semanal">
                    <button type="submit" class="w-full py-2.5 px-3 bg-[#fdf2f4] text-[#590219] font-bold text-xs rounded-xl hover:bg-[#fae6e9] flex flex-col items-center">
                        <span>Semanal (7 Dias)</span>
                        <span class="font-extrabold text-sm text-[#590219]">R$ 14,90</span>
                    </button>
                </form>

                <form action="{{ route('user.see-likes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="mensal">
                    <button type="submit" class="w-full py-2.5 px-3 bg-[#590219] text-white font-bold text-xs rounded-xl hover:bg-[#3f0111] flex flex-col items-center shadow-sm">
                        <span>Mensal (30 Dias)</span>
                        <span class="font-extrabold text-sm text-[#f5b800]">R$ 29,90</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Links -->
    <div class="flex justify-center gap-4 text-[11px] text-[#796a6e] mt-4">
        <a href="{{ route('termos') }}" class="hover:underline">Termos de Uso</a>
        <span>•</span>
        <a href="{{ route('privacidade') }}" class="hover:underline">Política de Privacidade</a>
        <span>•</span>
        <a href="{{ route('seguranca') }}" class="hover:underline">Segurança</a>
    </div>

</div>
@endsection
