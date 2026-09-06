<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="theme-color" content="#fbf9f8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
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
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white/95 backdrop-blur-xl border-t border-[#ede7e5] z-50 pt-2 pb-[max(0.5rem,env(safe-area-inset-bottom))] px-1 flex justify-around items-center text-[10px] text-[#796a6e] shadow-[0_-4px_20px_rgba(89,2,25,0.06)] select-none">
            <!-- Descobrir (Flame Icon, Tinder-style) -->
            <a href="{{ route('discover') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('discover') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="flame" class="w-5 h-5 {{ request()->routeIs('discover') ? 'text-[#ff007f] fill-[#ff007f] stroke-[#ff007f]' : 'stroke-[1.75px]' }}"></i>
                <span>Descobrir</span>
            </a>

            <!-- Explorar (Grid Icon) -->
            <a href="{{ route('explore') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('explore') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="layout-grid" class="w-5 h-5 {{ request()->routeIs('explore') ? 'text-[#590219] stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Explorar</span>
            </a>

            <!-- Agenda (Calendar Heart Icon) -->
            <a href="{{ route('encontros') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('encontros*') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="calendar-heart" class="w-5 h-5 {{ request()->routeIs('encontros*') ? 'text-[#590219] stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Agenda</span>
            </a>
            
            <!-- Curtidas (Heart Icon with Fill when Active) -->
            <a href="{{ route('likes') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('likes') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="heart" class="w-5 h-5 {{ request()->routeIs('likes') ? 'text-[#ff007f] fill-[#ff007f] stroke-[#ff007f]' : 'stroke-[1.75px]' }}"></i>
                <span>Curtidas</span>
            </a>

            <!-- Jogos (Dices Icon) -->
            <a href="{{ route('games.trivia') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('games*') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="dices" class="w-5 h-5 {{ request()->routeIs('games*') ? 'text-[#590219] stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Jogos</span>
            </a>

            <!-- Chat (Message Circle with Unread Pulse Badge) -->
            @php
                $unreadMessages = Auth::check() ? Auth::user()->unreadMessagesCount() : 0;
            @endphp
            <a href="{{ route('chat') }}" class="relative flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('chat') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <div class="relative">
                    <i data-lucide="message-circle" class="w-5 h-5 {{ request()->routeIs('chat') ? 'text-[#590219] fill-[#590219]/20 stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                    @if($unreadMessages > 0)
                        <span class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 bg-gradient-to-r from-[#ff007f] to-rose-600 text-white text-[9px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-sm animate-pulse">
                            {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                        </span>
                    @endif
                </div>
                <span>Chat</span>
            </a>

            <!-- Perfil (Real Profile Avatar Thumbnail) -->
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs scale-105' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                @if(Auth::check())
                    <img src="{{ Auth::user()->avatar_url }}" onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" class="w-5 h-5 rounded-full object-cover border-2 {{ request()->routeIs('profile.edit') ? 'border-[#590219] ring-2 ring-[#ff007f]/40' : 'border-transparent' }}" alt="Perfil">
                @else
                    <i data-lucide="user-round" class="w-5 h-5 {{ request()->routeIs('profile.edit') ? 'text-[#590219] stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                @endif
                <span>Perfil</span>
            </a>
        </nav>
        @endunless
    </div>

    <!-- Custom Pariva Professional Modal Dialog -->
    <div id="pariva-custom-modal" class="fixed inset-0 z-[100] bg-black/60 backdrop-blur-md flex items-center justify-center p-4 hidden animate-fadeIn">
        <div class="bg-white rounded-3xl p-6 max-w-xs w-full shadow-2xl border border-[#ede7e5] flex flex-col items-center text-center gap-4 transition-all transform scale-100">
            <!-- Modal Icon Container -->
            <div id="pariva-modal-icon-wrapper" class="w-14 h-14 rounded-2xl bg-[#fdf2f4] text-[#590219] flex items-center justify-center shadow-xs">
                <div id="pariva-modal-icon">
                    <i data-lucide="help-circle" class="w-7 h-7"></i>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="flex flex-col gap-1">
                <h3 id="pariva-modal-title" class="text-base font-extrabold text-[#221417] leading-tight">Confirmação</h3>
                <p id="pariva-modal-message" class="text-xs text-[#796a6e] font-medium leading-relaxed">Tem certeza que deseja prosseguir?</p>
            </div>

            <!-- Modal Buttons -->
            <div class="grid grid-cols-2 gap-2.5 w-full mt-1">
                <button id="pariva-modal-cancel" type="button" class="py-3 px-4 rounded-xl bg-[#eee9e6] hover:bg-[#e2dad6] text-[#221417] font-bold text-xs transition-colors cursor-pointer flex-1">
                    Cancelar
                </button>
                <button id="pariva-modal-confirm" type="button" class="py-3 px-4 rounded-xl bg-[#590219] hover:bg-[#3f0111] text-white font-extrabold text-xs transition-colors shadow-md cursor-pointer flex-1">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // Custom Promise-based Pariva Modal Confirmation
        window.parivaConfirm = function({ title = 'Confirmação', message = 'Tem certeza que deseja continuar?', icon = 'help-circle', confirmText = 'Confirmar', cancelText = 'Cancelar', isDestructive = false }) {
            return new Promise((resolve) => {
                const modal = document.getElementById('pariva-custom-modal');
                const iconContainer = document.getElementById('pariva-modal-icon-wrapper');
                const iconEl = document.getElementById('pariva-modal-icon');
                const titleEl = document.getElementById('pariva-modal-title');
                const msgEl = document.getElementById('pariva-modal-message');
                const confirmBtn = document.getElementById('pariva-modal-confirm');
                const cancelBtn = document.getElementById('pariva-modal-cancel');

                titleEl.innerText = title;
                msgEl.innerText = message;
                confirmBtn.innerText = confirmText;
                cancelBtn.innerText = cancelText;

                if (isDestructive) {
                    iconContainer.className = 'w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center shadow-xs';
                    confirmBtn.className = 'py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs transition-colors shadow-md cursor-pointer flex-1';
                } else {
                    iconContainer.className = 'w-14 h-14 rounded-2xl bg-[#fdf2f4] text-[#590219] flex items-center justify-center shadow-xs';
                    confirmBtn.className = 'py-3 px-4 rounded-xl bg-[#590219] hover:bg-[#3f0111] text-white font-extrabold text-xs transition-colors shadow-md cursor-pointer flex-1';
                }

                iconEl.innerHTML = `<i data-lucide="${icon}" class="w-7 h-7"></i>`;
                if (window.lucide) lucide.createIcons();

                modal.classList.remove('hidden');

                const cleanup = () => {
                    modal.classList.add('hidden');
                    confirmBtn.onclick = null;
                    cancelBtn.onclick = null;
                };

                confirmBtn.onclick = () => { cleanup(); resolve(true); };
                cancelBtn.onclick = () => { cleanup(); resolve(false); };
            });
        };

        // Custom Pariva Toast Notification
        window.parivaToast = function(message, type = 'success') {
            const toast = document.createElement('div');
            const isSuccess = type === 'success';
            const isError = type === 'error';
            toast.className = `fixed top-5 left-1/2 -translate-x-1/2 z-[110] ${isError ? 'bg-gradient-to-r from-rose-700 to-rose-900' : 'bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#ff007f]'} text-white px-5 py-3 rounded-full text-xs font-extrabold shadow-2xl flex items-center gap-2 border border-white/20 transition-all duration-400 transform -translate-y-2 opacity-0 pointer-events-none`;
            toast.innerHTML = `<i data-lucide="${isError ? 'alert-circle' : 'check-circle'}" class="w-4 h-4 text-white"></i><span>${message}</span>`;
            document.body.appendChild(toast);
            if (window.lucide) lucide.createIcons();
            
            setTimeout(() => {
                toast.style.transform = 'translate(-50%, 0)';
                toast.style.opacity = '1';
            }, 50);

            setTimeout(() => {
                toast.style.transform = 'translate(-50%, -20px)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 2500);
        };
        
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
