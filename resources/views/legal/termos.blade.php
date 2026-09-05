@extends('layouts.app')

@section('title', 'Termos e Condições de Uso - Pariva')

@section('header')
<header class="w-full px-5 py-4 flex items-center gap-3 bg-white border-b border-[#ede7e5] sticky top-0 z-30">
    <a href="{{ url()->previous() ?: route('landing') }}" class="text-[#590219] p-1 rounded-lg hover:bg-[#fdf2f4]">
        <i data-lucide="arrow-left" class="w-6 h-6"></i>
    </a>
    <h1 class="font-extrabold text-base text-[#590219]">Termos e Condições de Uso</h1>
</header>
@endsection

@section('content')
<div class="px-5 py-6 flex flex-col gap-6 text-[#221417] leading-relaxed">
    
    <!-- Hero Banner -->
    <div class="bg-gradient-to-r from-[#590219] to-[#7c0d28] text-white p-6 rounded-2xl shadow-sm flex flex-col gap-2">
        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-xl">
            📜
        </div>
        <h2 class="text-xl font-extrabold">Termos de Serviço Pariva</h2>
        <p class="text-xs text-white/80">Última atualização: 04 de Setembro de 2026</p>
    </div>

    <!-- Article Sections -->
    <section class="flex flex-col gap-5 text-xs text-[#4a3b3e]">
        
        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">1. Aceitação dos Termos</h3>
            <p>Ao criar uma conta ou utilizar a plataforma Pariva (seja pelo aplicativo ou navegador), você concorda expressamente em cumprir estes Termos e Condições de Uso. Se você não concordar com qualquer parte destes termos, não deverá utilizar nossos serviços.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">2. Elegibilidade e Idade Mínima</h3>
            <p>Você deve ter pelo menos <strong>18 (dezoito) anos de idade</strong> para se cadastrar e utilizar o Pariva. Ao criar uma conta, você declara e garante ter capacidade legal plena e que não possui qualquer impedimento judicial ou cadastral para utilizar a plataforma.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">3. Regras de Conduta e Segurança</h3>
            <p>O Pariva mantém política de <strong>tolerância zero</strong> contra comportamentos abusivos. É estritamente proibido:</p>
            <ul class="list-disc pl-5 space-y-1 mt-1 text-[#594a4e]">
                <li>Publicar conteúdo explícito, pornográfico, racista, homofóbico ou de ódio.</li>
                <li>Assediar, intimidar, perseguir ou ameaçar outros usuários.</li>
                <li>Criar perfis falsos, passar-se por outra pessoa ou usar fotos de terceiros.</li>
                <li>Solicitar dinheiro, golpes financeiros ou praticar atividades comerciais não autorizadas.</li>
                <li>Divulgar dados pessoais de terceiros sem consentimento (doxxing).</li>
            </ul>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">4. Compras, Moedas Virtuais e Planos Premium</h3>
            <p>O Pariva pode oferecer assinaturas Premium, Super Likes, Rosas e Presentes Virtuais. Todas as transações são finais e não reembolsáveis, salvo quando exigido expressamente pelo Código de Defesa do Consumidor. A renovação de assinaturas pode ser cancelada a qualquer momento nas configurações da conta.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">5. Suspensão e Encerramento de Conta</h3>
            <p>Reservamo-nos o direito de suspender ou banir permanentemente qualquer conta que violar nossas diretrizes de comunidade, sem aviso prévio e sem reembolso de créditos ou assinaturas pendentes.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">6. Legislação Aplicável e Foro</h3>
            <p>Estes termos são regidos pelas leis da República Federativa do Brasil. Fica eleito o foro da Comarca de São Paulo/SP para dirimir quaisquer controvérsias decorrentes deste documento.</p>
        </div>

    </section>

    <!-- Support Help Box -->
    <div class="bg-[#fdf2f4] p-4 rounded-xl border border-[#fae6e9] flex items-center justify-between text-xs">
        <span class="text-[#590219] font-medium">Dúvidas sobre os termos?</span>
        <a href="mailto:suporte@pariva.com.br" class="font-bold text-[#7c0d28] hover:underline">Fale Conosco</a>
    </div>

</div>

@include('components.footer')
@endsection
