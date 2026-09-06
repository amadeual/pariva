<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Pariva - Aplicativo de Relacionamento Sério e Conexões Genuínas')</title>
    <meta name="title" content="@yield('meta_title', 'Pariva - Aplicativo de Relacionamento Sério e Conexões Genuínas')">
    <meta name="description" content="@yield('meta_description', 'Conheça solteiros com interesses em comum no Pariva. Aplicativo de relacionamento focado em conexões reais, encontros seguros, encontros com IA e dinâmicas interativas.')">
    <meta name="keywords" content="@yield('meta_keywords', 'aplicativo de relacionamento, site de namoro, encontros serios, namoro online brasil, solteiros em sao paulo, pariva app, namoro seguro, encontros com ia, encontros de casal')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Pariva Brasil Tecnologia Ltda">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Pariva - Conexões Genuínas e Relacionamento Sério')">
    <meta property="og:description" content="@yield('og_description', 'Encontre alguém que realmente combina com você. Cadastro gratuito com verificação de perfil e agendamento de encontros seguros.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.jpg'))">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Pariva">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('og_title', 'Pariva - Conexões Genuínas e Relacionamento Sério')">
    <meta name="twitter:description" content="@yield('og_description', 'Encontre alguém que realmente combina com você. Cadastro gratuito com verificação de perfil e agendamento de encontros seguros.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.jpg'))">

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MobileApplication",
      "name": "Pariva",
      "operatingSystem": "iOS, Android, Web",
      "applicationCategory": "LifestyleApplication",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "BRL"
      },
      "description": "Aplicativo de relacionamento sério e encontros genuínos com verificação de segurança e recomendação por IA.",
      "author": {
        "@type": "Organization",
        "name": "Pariva Brasil Tecnologia Ltda",
        "url": "{{ url('/') }}"
      }
    }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Stitch Design CSS -->
    <link rel="stylesheet" href="{{ asset('css/pariva.css') }}">
    
    <!-- Tailwind CSS (via CDN for local dev speed & utility fallback) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pariva: {
                            burgundy: '#590219',
                            'burgundy-dark': '#3f0111',
                            'burgundy-light': '#7c0d28',
                            pink: '#fdf2f4',
                            'pink-light': '#fae6e9',
                            bg: '#fbf9f8',
                            card: '#f5f2f0',
                            text: '#221417',
                            muted: '#796a6e'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#fbf9f8] text-[#221417] min-h-screen flex flex-col items-center justify-start pb-20">

    <!-- Container wrapper mimicking Stitch App Shell -->
    <div class="w-full max-w-md min-h-screen bg-[#fbf9f8] shadow-2xl flex flex-col relative overflow-x-hidden border-x border-[#ede7e5]">
        
        <!-- Header -->
        @yield('header')

        <!-- Global Toast Notification for Flash Messages -->
        @if(session('success'))
            <div id="flash-toast" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#ff007f] text-white px-5 py-3 rounded-full text-xs font-extrabold shadow-2xl flex items-center gap-2 border border-white/20 transition-all duration-500 transform translate-y-0 opacity-100 pointer-events-none">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-300"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1 w-full relative">
            @yield('content')
        </main>

        @unless(request()->is('/') || request()->is('login') || request()->is('register') || request()->is('landing') || request()->is('forgot-password') || request()->is('reset-password'))
        <!-- Bottom Navigation Bar (Design Silencioso & Elegante Pariva) -->
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-[#f7f2f0]/95 backdrop-blur-xl border-t border-[#e8dedb] z-50 py-2 px-1 flex justify-around items-center text-[10px] text-[#796a6e] shadow-[0_-4px_20px_rgba(89,2,25,0.05)]">
            <a href="{{ route('discover') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('discover') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="sparkles" class="w-5 h-5 {{ request()->routeIs('discover') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Descobrir</span>
            </a>

            <a href="{{ route('explore') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('explore') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="compass" class="w-5 h-5 {{ request()->routeIs('explore') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Explorar</span>
            </a>

            <a href="{{ route('encontros') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('encontros*') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="calendar" class="w-5 h-5 {{ request()->routeIs('encontros*') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Agenda</span>
            </a>
            
            <a href="{{ route('likes') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('likes') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="heart" class="w-5 h-5 {{ request()->routeIs('likes') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Curtidas</span>
            </a>

            <a href="{{ route('games.trivia') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('games*') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="gamepad-2" class="w-5 h-5 {{ request()->routeIs('games*') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Jogos</span>
            </a>

            @php
                $unreadMessages = Auth::check() ? Auth::user()->unreadMessagesCount() : 0;
            @endphp
            <a href="{{ route('chat') }}" class="relative flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('chat') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <div class="relative">
                    <i data-lucide="message-square" class="w-5 h-5 {{ request()->routeIs('chat') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                    @if($unreadMessages > 0)
                        <span class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 bg-gradient-to-r from-[#ff007f] to-rose-600 text-white text-[9px] font-black rounded-full flex items-center justify-center border-2 border-[#f7f2f0] shadow-sm animate-pulse">
                            {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                        </span>
                    @endif
                </div>
                <span>Chat</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="user" class="w-5 h-5 {{ request()->routeIs('profile.edit') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Perfil</span>
            </a>
        </nav>
        @endunless
    </div>

    <script>
        lucide.createIcons();
        
        // Auto-dismiss toast notification smoothly after 1.8s
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('flash-toast');
            if (toast) {
                setTimeout(() => {
                    toast.style.transform = 'translate(-50%, -20px)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }, 1800);
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
