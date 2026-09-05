<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pariva - Conexões Genuínas')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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

        <!-- Main Content -->
        <main class="flex-1 w-full">
            @yield('content')
        </main>

        @unless(request()->is('/') || request()->is('login') || request()->is('register') || request()->is('landing') || request()->is('forgot-password') || request()->is('reset-password'))
        <!-- Bottom Navigation Bar (Design Silencioso & Elegante Pariva) -->
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-[#f7f2f0]/95 backdrop-blur-xl border-t border-[#e8dedb] z-50 py-2 px-1 flex justify-around items-center text-[10px] text-[#796a6e] shadow-[0_-4px_20px_rgba(89,2,25,0.05)]">
            <a href="{{ route('discover') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('discover') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="compass" class="w-5 h-5 {{ request()->routeIs('discover') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Descobrir</span>
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

            <a href="{{ route('chat') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('chat') ? 'text-[#590219] font-bold bg-[#590219]/10 shadow-xs' : 'hover:text-[#590219] hover:bg-[#eee8e5]' }}">
                <i data-lucide="message-square" class="w-5 h-5 {{ request()->routeIs('chat') ? 'stroke-[2.25px]' : 'stroke-[1.75px]' }}"></i>
                <span>Mensagens</span>
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
    </script>
    @stack('scripts')
</body>
</html>
