<!-- Professional Pariva Footer Component -->
<footer class="w-full bg-[#221417] text-[#fbf9f8] pt-10 pb-8 px-6 border-t border-[#3f0111] flex flex-col gap-8">
    <div class="flex flex-col items-center text-center gap-4">
        <!-- Logo & Brand Name -->
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#7c0d28] to-[#590219] flex items-center justify-center text-white font-bold text-lg shadow-md border border-white/10">
                ♥
            </div>
            <span class="text-2xl font-black text-white tracking-tight">pariva</span>
        </div>
        <p class="text-xs text-[#a39598] max-w-xs leading-relaxed">
            Conectando pessoas genuínas para relacionamentos reais, seguros e duradouros.
        </p>
    </div>

    <hr class="border-[#39262a] w-full my-1">

    <!-- Address & Contact Info -->
    <div class="flex flex-col gap-3 text-xs text-[#d3c7c9]">
        <p class="leading-relaxed">
            Av. Paulista, 91 - Bela Vista<br>
            São Paulo - SP, 01311-000
        </p>
        
        <div class="flex flex-col gap-1.5 pt-2">
            <span class="flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4 text-[#7c0d28]"></i>
                <a href="mailto:suporte@pariva.com.br" class="hover:underline text-white">suporte@pariva.com.br</a>
            </span>
            <span class="flex items-center gap-2">
                <i data-lucide="shield-check" class="w-4 h-4 text-[#7c0d28]"></i>
                <span>Atendimento 24/7 para Segurança</span>
            </span>
        </div>
    </div>

    <hr class="border-[#39262a] w-full my-1">

    <!-- Links & Legal -->
    <div class="grid grid-cols-2 gap-4 text-xs">
        <div class="flex flex-col gap-2">
            <h5 class="text-white font-bold text-xs uppercase tracking-wider mb-1">Plataforma</h5>
            <a href="{{ route('discover') }}" class="text-[#a39598] hover:text-white transition-colors">Descobrir</a>
            <a href="{{ route('encontros') }}" class="text-[#a39598] hover:text-white transition-colors">Agenda de Dates</a>
            <a href="{{ route('games.trivia') }}" class="text-[#a39598] hover:text-white transition-colors">Pariva Games</a>
            <a href="{{ route('premium') }}" class="text-[#a39598] hover:text-white transition-colors">Planos Premium</a>
        </div>
        <div class="flex flex-col gap-2">
            <h5 class="text-white font-bold text-xs uppercase tracking-wider mb-1">Legal & Ajuda</h5>
            <a href="{{ route('termos') }}" class="text-[#a39598] hover:text-white transition-colors">Termos de Uso</a>
            <a href="{{ route('privacidade') }}" class="text-[#a39598] hover:text-white transition-colors">Privacidade</a>
            <a href="{{ route('seguranca') }}" class="text-[#a39598] hover:text-white transition-colors">Central de Segurança</a>
            <a href="mailto:suporte@pariva.com.br" class="text-[#a39598] hover:text-white transition-colors">Suporte</a>
        </div>
    </div>

    <!-- Social Media Icons -->
    <div class="flex justify-center items-center gap-4 pt-2">
        <a href="#" class="w-9 h-9 rounded-full bg-[#39262a] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all">
            <i data-lucide="instagram" class="w-4 h-4"></i>
        </a>
        <a href="#" class="w-9 h-9 rounded-full bg-[#39262a] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all">
            <i data-lucide="twitter" class="w-4 h-4"></i>
        </a>
        <a href="#" class="w-9 h-9 rounded-full bg-[#39262a] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all">
            <i data-lucide="linkedin" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- Copyright -->
    <div class="text-center text-[11px] text-[#796a6e] pt-2">
        &copy; {{ date('Y') }} Pariva Brasil Tecnologia Ltda. Todos os direitos reservados.
    </div>
</footer>
