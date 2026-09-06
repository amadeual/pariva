@extends('layouts.app')

@section('title', 'Loja Pariva VIP - Boosts & Destaques')

@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5] sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <a href="{{ route('discover') }}" class="w-8 h-8 rounded-full bg-[#fdf2f4] text-[#590219] flex items-center justify-center hover:bg-[#590219] hover:text-white transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div class="flex flex-col">
                <h2 class="font-extrabold text-sm text-[#221417] leading-tight flex items-center gap-1.5">
                    <span>Loja VIP Pariva</span>
                    <i data-lucide="crown" class="w-3.5 h-3.5 text-amber-500 fill-amber-500/20"></i>
                </h2>
                <span class="text-[10px] text-[#796a6e] font-medium">Aumente suas conexões em até 10x</span>
            </div>
        </div>
        <div class="flex items-center gap-1.5 px-3 py-1 bg-amber-500/10 text-amber-700 text-[10px] font-extrabold rounded-full border border-amber-500/20">
            <i data-lucide="sparkles" class="w-3 h-3 text-amber-500"></i>
            <span>Loja Oficial</span>
        </div>
    </header>
@endsection

@section('content')
<div class="flex flex-col gap-6 pb-24 bg-[#fbf9f8]">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="mx-5 mt-4 bg-emerald-50 text-emerald-800 p-3.5 rounded-2xl border border-emerald-200 flex items-center gap-2.5 text-xs font-extrabold shadow-sm">
        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Hero Banner (Tinder Gold/Platinum Style) -->
    <div class="relative w-full bg-gradient-to-br from-[#3f0111] via-[#590219] to-[#7c0d28] text-white pt-8 pb-10 px-6 rounded-b-[2.5rem] shadow-xl text-center overflow-hidden border-b border-[#590219]">
        <!-- Subtle Pattern Overlay -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#ff007f]/20 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-amber-500/20 rounded-full blur-2xl"></div>
        
        <!-- Glowing Crown Icon -->
        <div class="relative z-10 w-16 h-16 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto mb-3 shadow-lg">
            <i data-lucide="crown" class="w-8 h-8 text-amber-400 fill-amber-400/30"></i>
        </div>

        <h1 class="text-2xl font-black tracking-tight mb-2 relative z-10 bg-gradient-to-r from-white via-amber-100 to-amber-300 bg-clip-text text-transparent">
            Destaque seu Perfil no Pariva 🔥
        </h1>
        <p class="text-xs text-white/80 max-w-xs mx-auto leading-relaxed relative z-10 font-medium">
            Multiplique suas combinações com Boosts imediatos, Destaque em Topo de Galeria e revelação de quem curtiu você.
        </p>

        <!-- Active Status Badges -->
        <div class="flex flex-wrap justify-center gap-2 mt-5 relative z-10">
            @if(Auth::user()->isBoosted())
            <span class="bg-gradient-to-r from-amber-400 to-amber-500 text-black text-[10px] font-black px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-md animate-pulse">
                <i data-lucide="zap" class="w-3.5 h-3.5 fill-black"></i>
                <span>BOOST ATIVO (até {{ Auth::user()->boosted_until->format('H:i') }})</span>
            </span>
            @endif

            @if(Auth::user()->isFeatured())
            <span class="bg-white text-[#590219] text-[10px] font-black px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-md uppercase">
                <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i>
                <span>DESTAQUE {{ Auth::user()->featured_plan ?? 'ATIVO' }} (até {{ Auth::user()->featured_until->format('d/m') }})</span>
            </span>
            @endif

            @if(Auth::user()->canSeeWhoLiked())
            <span class="bg-emerald-500 text-white text-[10px] font-black px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-md">
                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                <span>QUEM CURTIU LIBERADO</span>
            </span>
            @endif
        </div>
    </div>

    <!-- Section 1: Perfil em Destaque (Semanal / Mensal) -->
    <div class="px-5 flex flex-col gap-3 -mt-6 relative z-20">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-amber-500/15 text-amber-600 flex items-center justify-center font-extrabold border border-amber-500/20">
                <i data-lucide="star" class="w-4 h-4 fill-amber-500 text-amber-500"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-[#221417]">Perfil em Destaque</h2>
                <p class="text-[11px] text-[#796a6e] font-medium">Exibido no topo da fila de busca na sua cidade</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mt-1">
            <!-- Destaque Semanal -->
            <form action="{{ route('user.featured') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="semanal">
                <div class="bg-white rounded-3xl p-4 border border-[#ede7e5] shadow-xs flex flex-col justify-between h-full hover:border-[#590219] transition-all">
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-[10px] font-black uppercase tracking-wider text-[#796a6e]">Semanal</span>
                            <span class="text-xs bg-[#fdf2f4] text-[#590219] px-2 py-0.5 rounded-md font-bold">7 Dias</span>
                        </div>
                        <h3 class="font-black text-xl text-[#221417]">R$ 19,90</h3>
                        <p class="text-[10px] text-[#796a6e] mt-1 leading-relaxed">Selo ⭐ Destaque Ouro no feed por 1 semana</p>
                    </div>
                    <button type="submit" class="w-full mt-4 py-2.5 bg-[#fdf2f4] hover:bg-[#590219] hover:text-white text-[#590219] font-black text-xs rounded-2xl transition-all active:scale-95 shadow-2xs">
                        Ativar 7 Dias
                    </button>
                </div>
            </form>

            <!-- Destaque Mensal (Card Destaque) -->
            <form action="{{ route('user.featured') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="mensal">
                <div class="bg-gradient-to-br from-[#590219] via-[#7c0d28] to-[#990c33] text-white rounded-3xl p-4 shadow-lg flex flex-col justify-between h-full relative overflow-hidden border border-[#ff007f]/30">
                    <span class="absolute top-0 right-0 bg-gradient-to-r from-amber-400 to-amber-500 text-black font-black text-[9px] px-2.5 py-1 rounded-bl-xl shadow-xs">50% OFF</span>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-[10px] font-black uppercase tracking-wider text-amber-300">Mensal VIP</span>
                            <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-md font-bold">30 Dias</span>
                        </div>
                        <h3 class="font-black text-xl text-white">R$ 39,90</h3>
                        <p class="text-[10px] text-white/80 mt-1 leading-relaxed">30 Dias contínuos em 1º lugar com distintivo VIP</p>
                    </div>
                    <button type="submit" class="w-full mt-4 py-2.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:brightness-110 text-black font-black text-xs rounded-2xl shadow-md transition-all active:scale-95 flex items-center justify-center gap-1">
                        <span>Ativar 30 Dias</span>
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 fill-black"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section 2: Boost Instantâneo (30min, 1h, 3h) -->
    <div class="px-5 flex flex-col gap-3 mt-2">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-[#590219]/10 text-[#590219] flex items-center justify-center font-extrabold border border-[#590219]/20">
                <i data-lucide="zap" class="w-4 h-4 fill-[#590219]"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-[#221417]">Boost Instantâneo ⚡</h2>
                <p class="text-[11px] text-[#796a6e] font-medium">Torne seu perfil o #1 exibido no Descobrir imediatamente</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2.5 mt-1">
            <!-- Boost 30 min -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="30">
                <button type="submit" class="w-full bg-white rounded-3xl p-3 border border-[#ede7e5] shadow-xs hover:border-[#590219] active:scale-95 flex flex-col items-center text-center transition-all group">
                    <div class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-600 flex items-center justify-center mb-1 group-hover:scale-110 transition-all">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                    </div>
                    <span class="text-[10px] font-black text-[#796a6e]">30 MIN</span>
                    <span class="text-sm font-black text-[#590219] my-0.5">R$ 9,90</span>
                    <span class="text-[9px] text-[#796a6e]">Exprés</span>
                </button>
            </form>

            <!-- Boost 1 Hora (Recomendado) -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="60">
                <button type="submit" class="w-full bg-white rounded-3xl p-3 border-2 border-[#590219] shadow-md hover:bg-[#fdf2f4] active:scale-95 flex flex-col items-center text-center transition-all relative overflow-hidden group">
                    <span class="absolute top-0 right-0 left-0 bg-[#590219] text-white text-[8px] font-black py-0.5 uppercase tracking-wider">Mais Popular</span>
                    <div class="w-8 h-8 rounded-full bg-[#590219]/10 text-[#590219] flex items-center justify-center mt-2 mb-1 group-hover:scale-110 transition-all">
                        <i data-lucide="flame" class="w-4 h-4 fill-[#ff007f] text-[#ff007f]"></i>
                    </div>
                    <span class="text-[10px] font-black text-[#590219]">1 HORA</span>
                    <span class="text-sm font-black text-[#590219] my-0.5">R$ 14,90</span>
                    <span class="text-[9px] text-[#590219] font-black">Recomendado</span>
                </button>
            </form>

            <!-- Super Boost 3 Horas -->
            <form action="{{ route('user.boost') }}" method="POST">
                @csrf
                <input type="hidden" name="duration" value="180">
                <button type="submit" class="w-full bg-gradient-to-b from-[#590219] to-[#3f0111] text-white rounded-3xl p-3 shadow-md active:scale-95 flex flex-col items-center text-center transition-all group">
                    <div class="w-8 h-8 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center mb-1 group-hover:scale-110 transition-all">
                        <i data-lucide="crown" class="w-4 h-4 fill-amber-400"></i>
                    </div>
                    <span class="text-[10px] font-black text-white/80">3 HORAS</span>
                    <span class="text-sm font-black text-white my-0.5">R$ 24,90</span>
                    <span class="text-[9px] text-amber-400 font-black">Super Boost</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Section 3: Chat Direto Sem Match (R$ 15,00) -->
    <div class="px-5 flex flex-col gap-3 mt-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#590219] to-[#ff007f] text-white flex items-center justify-center font-extrabold shadow-xs">
                    <i data-lucide="message-square-plus" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-[#221417]">Chat Direto sem Match</h2>
                    <p class="text-[11px] text-[#796a6e] font-medium">Inicie conversas imediatas sem esperar pelo match</p>
                </div>
            </div>
            <span class="text-[10px] font-black text-[#590219] bg-[#590219]/10 px-3 py-1 rounded-full border border-[#590219]/20 shrink-0">
                {{ Auth::user()->direct_chat_credits }} Créditos
            </span>
        </div>

        <form action="{{ route('user.buy-chat-credits') }}" method="POST">
            @csrf
            <div class="bg-gradient-to-r from-amber-500 via-[#880d2d] to-[#590219] text-white rounded-3xl p-4.5 shadow-lg flex items-center justify-between gap-3 border border-amber-400/30">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-md flex items-center justify-center text-white shrink-0 border border-white/20">
                        <i data-lucide="sparkles" class="w-6 h-6 text-amber-300"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-white">Pacote 3 Chats Diretos</span>
                        <span class="text-[11px] text-white/80 font-medium leading-tight">Mande mensagem para 3 pessoas agora mesmo</span>
                    </div>
                </div>
                <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-amber-300 to-amber-400 text-[#590219] font-black text-xs rounded-2xl shadow-md hover:brightness-110 active:scale-95 transition-all shrink-0 cursor-pointer flex items-center gap-1">
                    <span>R$ 15,00</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Section 4: Ver Quem Te Curtiu (Tinder Gold Style) -->
    <div class="px-5 flex flex-col gap-3 mt-2">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-emerald-500/15 text-emerald-700 flex items-center justify-center font-extrabold border border-emerald-500/20">
                <i data-lucide="eye" class="w-4 h-4 text-emerald-600"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-[#221417]">Revelar 'Quem Te Curtiu'</h2>
                <p class="text-[11px] text-[#796a6e] font-medium">Veja quem deu Like no seu perfil antes de curtir de volta</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-4 border border-[#ede7e5] shadow-xs flex flex-col gap-4">
            
            <!-- Mock Blur Visual Preview -->
            <div class="relative w-full h-24 rounded-2xl overflow-hidden bg-slate-900 flex items-center justify-center p-2 shadow-inner">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/30 via-[#590219]/50 to-[#ff007f]/30 backdrop-blur-md flex items-center justify-around px-4">
                    <div class="w-12 h-12 rounded-full bg-white/20 blur-xs border border-white/40"></div>
                    <div class="w-14 h-14 rounded-full bg-white/30 blur-xs border-2 border-amber-400"></div>
                    <div class="w-12 h-12 rounded-full bg-white/20 blur-xs border border-white/40"></div>
                </div>
                <div class="relative z-10 bg-black/70 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/20 text-white text-[11px] font-black flex items-center gap-2 shadow-lg">
                    <i data-lucide="lock" class="w-3.5 h-3.5 text-amber-400"></i>
                    <span>Pessoas já curtiram seu perfil!</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <form action="{{ route('user.see-likes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="semanal">
                    <button type="submit" class="w-full py-3 px-3 bg-[#fdf2f4] text-[#590219] font-black text-xs rounded-2xl hover:bg-[#590219] hover:text-white active:scale-95 flex flex-col items-center transition-all shadow-2xs">
                        <span>Semanal (7 Dias)</span>
                        <span class="font-black text-sm text-[#590219] mt-0.5">R$ 14,90</span>
                    </button>
                </form>

                <form action="{{ route('user.see-likes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="mensal">
                    <button type="submit" class="w-full py-3 px-3 bg-[#590219] text-white font-black text-xs rounded-2xl hover:bg-[#3f0111] active:scale-95 flex flex-col items-center transition-all shadow-md">
                        <span>Mensal (30 Dias)</span>
                        <span class="font-black text-sm text-amber-400 mt-0.5">R$ 29,90</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Security Guarantee Badge -->
    <div class="mx-5 bg-white rounded-2xl p-4 border border-[#ede7e5] flex items-center gap-3 shadow-2xs">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
        </div>
        <div class="flex flex-col">
            <h4 class="text-xs font-black text-[#221417]">Pagamento 100% Seguro</h4>
            <p class="text-[10px] text-[#796a6e] font-medium leading-tight">Ativação instantânea de benefícios no seu perfil Pariva</p>
        </div>
    </div>

    <!-- Footer Links -->
    <div class="flex justify-center gap-4 text-[10px] text-[#796a6e] font-bold mt-2">
        <a href="{{ route('termos') }}" class="hover:underline">Termos de Uso</a>
        <span>•</span>
        <a href="{{ route('privacidade') }}" class="hover:underline">Privacidade</a>
        <span>•</span>
        <a href="{{ route('seguranca') }}" class="hover:underline">Segurança</a>
    </div>

</div>
@endsection
