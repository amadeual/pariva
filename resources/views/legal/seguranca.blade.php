@extends('layouts.app')

@section('title', 'Central de Segurança - Pariva')

@section('header')
<header class="w-full px-5 py-4 flex items-center gap-3 bg-white border-b border-[#ede7e5] sticky top-0 z-30">
    <a href="{{ url()->previous() ?: route('landing') }}" class="text-[#590219] p-1 rounded-lg hover:bg-[#fdf2f4]">
        <i data-lucide="arrow-left" class="w-6 h-6"></i>
    </a>
    <h1 class="font-extrabold text-base text-[#590219]">Central de Segurança Pariva</h1>
</header>
@endsection

@section('content')
<div class="px-5 py-6 flex flex-col gap-6 text-[#221417] leading-relaxed">
    
    <!-- Hero Banner -->
    <div class="bg-gradient-to-r from-[#590219] to-[#7c0d28] text-white p-6 rounded-2xl shadow-sm flex flex-col gap-2">
        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-xl">
            🛡️
        </div>
        <h2 class="text-xl font-extrabold">Sua Segurança em Primeiro Lugar</h2>
        <p class="text-xs text-white/80">Guia prático para interações online e encontros no mundo real.</p>
    </div>

    <!-- Safety Tips Grid -->
    <section class="flex flex-col gap-5 text-xs text-[#4a3b3e]">
        
        <h3 class="font-extrabold text-sm text-[#590219] uppercase tracking-wider">💡 Dicas para Conversas Online</h3>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">🚫</span> Nunca envie dinheiro ou dados financeiros
            </h4>
            <p>Jamais faça transferências bancárias, PIX ou forneça informações de cartão de crédito para pessoas que conheceu online, independentemente da justificativa apresentada.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">💬</span> Mantenha a conversa na plataforma
            </h4>
            <p>Recomendamos manter as conversas iniciais dentro do aplicativo Pariva antes de compartilhar seu número pessoal de telefone ou redes sociais fechadas.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">🚩</span> Denuncie comportamentos suspeitos
            </h4>
            <p>Se alguém demonstrar agressividade, chantagem ou criar desconforto, utilize imediatamente a ferramenta de <strong>Denunciar</strong> no perfil ou chat da pessoa.</p>
        </div>

        <h3 class="font-extrabold text-sm text-[#590219] uppercase tracking-wider mt-2">☕ Dicas para o Primeiro Date Presencial</h3>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">🏢</span> Marque sempre em locais públicos
            </h4>
            <p>Prefira lugares movimentados para os primeiros encontros, como cafés, restaurantes conhecidos, shoppings ou parques com boa circulação de pessoas.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">📲</span> Avise amigos ou familiares
            </h4>
            <p>Compartilhe sua localização em tempo real e os detalhes do encontro (onde vai, com quem e horário previsto) com um amigo ou familiar de confiança.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h4 class="font-bold text-sm text-[#221417] flex items-center gap-2">
                <span class="text-base">🚗</span> Cuide do seu próprio transporte
            </h4>
            <p>Vá e volte do primeiro encontro utilizando seus próprios meios (seu carro, aplicativo de transporte individual ou transporte público), sem aceitar caronas no primeiro contato.</p>
        </div>

        <!-- Emergency / Support Banner -->
        <div class="bg-[#fef2f2] p-5 rounded-xl border border-[#fecaca] flex flex-col gap-2 mt-2">
            <h4 class="font-extrabold text-sm text-[#991b1b] flex items-center gap-2">
                🚨 Em caso de Emergência no Encontro
            </h4>
            <p class="text-[#7f1d1d]">Se você se sentir em perigo iminente, vá até um funcionário do estabelecimento, peça ajuda e ligue para a Polícia Militar (190) ou Central de Atendimento à Mulher (180).</p>
        </div>

    </section>

</div>

@include('components.footer')
@endsection
