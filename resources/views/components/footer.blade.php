<!-- Compact & Professional Pariva Footer Component -->
<footer class="w-full bg-[#1b0f12] text-[#fbf9f8] pt-6 pb-6 px-5 border-t border-[#3f0111] flex flex-col gap-4">
    <div class="flex items-center justify-between gap-3">
        <!-- Logo & Brand Name -->
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#7c0d28] to-[#590219] flex items-center justify-center text-white font-bold text-xs shadow-sm border border-white/10">
                ♥
            </div>
            <span class="text-lg font-black text-white tracking-tight">pariva</span>
        </a>

        <!-- Social Media Icons (Instagram, Facebook, TikTok) -->
        <div class="flex items-center gap-2">
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-[#2c1a1e] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all shadow-xs" title="Instagram">
                <i data-lucide="instagram" class="w-4 h-4"></i>
            </a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-[#2c1a1e] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all shadow-xs" title="Facebook">
                <i data-lucide="facebook" class="w-4 h-4"></i>
            </a>
            <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-[#2c1a1e] flex items-center justify-center text-[#d3c7c9] hover:bg-[#7c0d28] hover:text-white transition-all shadow-xs" title="TikTok">
                <!-- Custom SVG for TikTok -->
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 1 1-5.2-1.74 2.89 2.89 0 0 1 2.31-2.84V7.63a6.34 6.34 0 0 0-6.34 6.34c0 3.5 2.84 6.34 6.34 6.34a6.34 6.34 0 0 0 6.34-6.34V9a8.27 8.27 0 0 0 4.76 1.5V7.05a4.84 4.84 0 0 1-1.01-.36z"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Quick Navigation Links -->
    <div class="flex flex-wrap items-center justify-between gap-y-2 text-[11px] text-[#a39598] pt-1 border-t border-[#2c1a1e]">
        <div class="flex items-center gap-3">
            <a href="{{ route('termos') }}" class="hover:text-white transition-colors">Termos</a>
            <span>•</span>
            <a href="{{ route('privacidade') }}" class="hover:text-white transition-colors">Privacidade</a>
            <span>•</span>
            <a href="{{ route('seguranca') }}" class="hover:text-white transition-colors">Segurança</a>
            <span>•</span>
            <a href="mailto:suporte@pariva.com.br" class="hover:text-white transition-colors">Suporte</a>
        </div>

        <div class="text-[10px] text-[#796a6e]">
            &copy; {{ date('Y') }} Pariva Brasil
        </div>
    </div>
</footer>
