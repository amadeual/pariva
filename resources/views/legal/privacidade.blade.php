@extends('layouts.app')

@section('title', 'Política de Privacidade - Pariva')

@section('header')
<header class="w-full px-5 py-4 flex items-center gap-3 bg-white border-b border-[#ede7e5] sticky top-0 z-30">
    <a href="{{ url()->previous() ?: route('landing') }}" class="text-[#590219] p-1 rounded-lg hover:bg-[#fdf2f4]">
        <i data-lucide="arrow-left" class="w-6 h-6"></i>
    </a>
    <h1 class="font-extrabold text-base text-[#590219]">Política de Privacidade (LGPD)</h1>
</header>
@endsection

@section('content')
<div class="px-5 py-6 flex flex-col gap-6 text-[#221417] leading-relaxed">
    
    <!-- Hero Banner -->
    <div class="bg-gradient-to-r from-[#590219] to-[#7c0d28] text-white p-6 rounded-2xl shadow-sm flex flex-col gap-2">
        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-xl">
            🔒
        </div>
        <h2 class="text-xl font-extrabold">Privacidade e Proteção de Dados</h2>
        <p class="text-xs text-white/80">Em conformidade com a LGPD (Lei Nº 13.709/2018)</p>
    </div>

    <!-- Privacy Content -->
    <section class="flex flex-col gap-5 text-xs text-[#4a3b3e]">
        
        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">1. Dados que Coletamos</h3>
            <p>Para proporcionar a melhor experiência de conexão, coletamos as seguintes categorias de dados:</p>
            <ul class="list-disc pl-5 space-y-1 mt-1 text-[#594a4e]">
                <li><strong>Informações de Perfil:</strong> Nome, e-mail, data de nascimento, fotos, biografia e preferências de relacionamento.</li>
                <li><strong>Dados de Localização:</strong> Dados aproximados de geolocalização para sugerir perfis próximos.</li>
                <li><strong>Dados de Uso e Interação:</strong> Histórico de curtidas, matches, mensagens no chat e presentes enviados.</li>
                <li><strong>Informações do Dispositivo:</strong> Endereço IP, tipo de navegador, sistema operacional e identificadores únicos.</li>
            </ul>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">2. Como Utilizamos Seus Dados</h3>
            <p>Seus dados são utilizados exclusivamente para:</p>
            <ul class="list-disc pl-5 space-y-1 mt-1 text-[#594a4e]">
                <li>Exibir seu perfil para potenciais combinações no Pariva.</li>
                <li>Garantir a segurança da plataforma e prevenir fraudes ou abusos.</li>
                <li>Processar pagamentos e gerenciar assinaturas ativas.</li>
                <li>Enviar notificações relevantes sobre matches, mensagens e atualizações.</li>
            </ul>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">3. Seus Direitos sob a LGPD</h3>
            <p>Como titular dos dados, você possui os seguintes direitos garantidos por lei:</p>
            <ul class="list-disc pl-5 space-y-1 mt-1 text-[#594a4e]">
                <li>Acessar e confirmar a existência de tratamento de seus dados.</li>
                <li>Corrigir dados incompletos, inexatos ou desatualizados.</li>
                <li>Solicitar a exclusão definitiva da sua conta e dados pessoais.</li>
                <li>Revogar seu consentimento a qualquer momento nas configurações do aplicativo.</li>
            </ul>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">4. Compartilhamento de Dados</h3>
            <p>O Pariva <strong>nunca vende seus dados pessoais</strong> para terceiros. O compartilhamento ocorre apenas com fornecedores de infraestrutura confiáveis (servidores de hospedagem, gateways de pagamento) sob estritos acordos de confidencialidade.</p>
        </div>

        <div class="bg-white p-5 rounded-xl border border-[#ede7e5] shadow-xs flex flex-col gap-2">
            <h3 class="font-bold text-sm text-[#590219]">5. Exclusão de Conta</h3>
            <p>Você pode solicitar a exclusão imediata e permanente da sua conta diretamente no painel de perfil ou enviando um e-mail para nosso Encarregado de Dados (DPO) em <a href="mailto:privacidade@pariva.com.br" class="text-[#7c0d28] font-bold">privacidade@pariva.com.br</a>.</p>
        </div>

    </section>

</div>

@include('components.footer')
@endsection
