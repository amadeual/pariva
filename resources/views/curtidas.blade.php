@extends('layouts.app')

@section('title', 'Quem te Curtiu - Pariva')

@section('header')
    <header class="w-full px-5 py-4 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5]/40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.jpg') }}" alt="Pariva Logo" class="h-8 w-auto object-contain rounded-lg shadow-xs">
            <span class="text-xl font-extrabold text-[#590219] tracking-tight">Pariva</span>
        </div>
        <a href="{{ route('profile.edit') }}" class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#590219]/20 shadow-sm flex items-center justify-center bg-[#eee9e6] font-bold text-xs text-[#590219]" title="{{ Auth::user()->name }}">
            <img src="{{ Auth::user()->avatar ? (str_starts_with(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', Auth::user()->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', Auth::user()->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                 onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'" 
                 alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
        </a>
    </header>
@endsection

@section('content')
<div class="px-5 py-3 flex flex-col gap-5 max-w-md mx-auto pb-12">

    <!-- Flash Notifications -->
    @if(session('success'))
    <div class="bg-[#10b981]/10 text-[#065f46] p-3.5 rounded-xl border border-[#10b981]/20 flex items-center gap-2.5 text-xs font-bold shadow-xs">
        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#10b981] shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Title Section -->
    <div class="flex flex-col gap-1 pt-1">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-extrabold text-[#221417] tracking-tight">
                Quem te Curtiu
            </h1>
            @if(Auth::user()->canSeeWhoLiked())
            <span class="bg-[#10b981]/15 text-[#047857] text-[10px] font-extrabold px-2.5 py-1 rounded-full flex items-center gap-1">
                <i data-lucide="eye" class="w-3 h-3"></i> Revelado
            </span>
            @endif
        </div>
        <p class="text-xs text-[#796a6e] font-normal">
            Descubra quem quer se conectar com você.
        </p>
    </div>

    @if(!Auth::user()->canSeeWhoLiked())
    <!-- Lock / Premium Unlock Banner -->
    <div class="bg-gradient-to-br from-[#590219] via-[#7c0d28] to-[#3f0111] rounded-2xl p-5 text-white flex flex-col gap-4 shadow-lg border border-[#7c0d28]">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-xl shrink-0">
                👀
            </div>
            <div>
                <h3 class="font-extrabold text-sm text-white">Desbloqueie 'Quem Curtiu Você'</h3>
                <p class="text-xs text-white/80 leading-relaxed mt-0.5">
                    Veja instantaneamente todas as pessoas que deram Like no seu perfil sem precisar esperar dar Match!
                </p>
            </div>
        </div>

        <!-- Plan Choice Buttons -->
        <div class="grid grid-cols-2 gap-2.5 pt-1">
            <!-- Semanal -->
            <form action="{{ route('user.see-likes') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="semanal">
                <button type="submit" class="w-full bg-white/10 hover:bg-white/20 border border-white/20 p-3 rounded-xl flex flex-col items-center text-center transition-all">
                    <span class="text-[10px] uppercase font-bold text-white/70">Semanal</span>
                    <span class="text-base font-extrabold text-white">R$ 14,90</span>
                    <span class="text-[9px] text-white/80">R$ 2,12/dia</span>
                </button>
            </form>

            <!-- Mensal -->
            <form action="{{ route('user.see-likes') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="mensal">
                <button type="submit" class="w-full bg-gradient-to-r from-[#f5b800] to-[#e0a700] hover:brightness-105 text-black p-3 rounded-xl flex flex-col items-center text-center shadow-md transition-all relative overflow-hidden">
                    <span class="absolute top-0 right-0 bg-black text-white text-[8px] font-black px-1.5 py-0.5 rounded-bl">POPULAR</span>
                    <span class="text-[10px] uppercase font-black text-black/70">Mensal</span>
                    <span class="text-base font-black text-black">R$ 29,90</span>
                    <span class="text-[9px] font-bold text-black/80">Economize 50%</span>
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- Profiles Grid (2 Columns) -->
    <div class="grid grid-cols-2 gap-3.5 mt-1">

        @forelse($likes as $like)
        <!-- Card: User Like -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-[#ede7e5] flex flex-col relative group">
            
            <div class="relative w-full h-52 overflow-hidden">
                <img src="{{ $like->user->avatar ? (str_starts_with($like->user->avatar, 'http') ? $like->user->avatar : asset('storage/' . $like->user->avatar)) : (file_exists(public_path('images/avatars/' . strtolower(explode(' ', $like->user->name)[0]) . '.jpg')) ? asset('images/avatars/' . strtolower(explode(' ', $like->user->name)[0]) . '.jpg') : asset('images/avatars/placeholder.jpg')) }}" 
                     onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                     alt="{{ $like->user->name }}" 
                     class="w-full h-full object-cover {{ !Auth::user()->canSeeWhoLiked() ? 'blur-md scale-110' : '' }}">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                @if(!Auth::user()->canSeeWhoLiked())
                <!-- Locked Overlay Badge -->
                <div class="absolute inset-0 flex flex-col items-center justify-center gap-1.5 text-white bg-black/30 backdrop-blur-xs">
                    <div class="w-9 h-9 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-md border border-white/20">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <span class="text-[10px] font-bold tracking-wide">Perfil Oculto</span>
                </div>
                @else

                    @if($like->is_superlike)
                    <!-- Superlike Badge -->
                    <div class="absolute top-2.5 left-2.5 bg-[#f5b800] text-black px-2.5 py-0.5 rounded-full flex items-center gap-1 text-[9px] font-extrabold shadow-xs z-10">
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                        <span>SUPER LIKE</span>
                    </div>
                    @endif

                    <!-- Info Overlay -->
                    <div class="absolute bottom-3 left-3 right-3 text-white flex flex-col">
                        <h3 class="font-extrabold text-base leading-tight">{{ $like->user->name }}</h3>
                        <div class="flex items-center gap-1 text-[10px] text-white/90 font-medium">
                            <i data-lucide="map-pin" class="w-3 h-3"></i>
                            <span>São Paulo, SP</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action Buttons (Cross, Direct Chat & Heart) -->
            <div class="p-2.5 flex justify-around items-center bg-white gap-1">
                @if(Auth::user()->canSeeWhoLiked())
                    <a href="{{ route('likes') }}" class="w-9 h-9 rounded-full border border-[#ede7e5] text-[#796a6e] flex items-center justify-center hover:bg-[#fbf9f8]" title="Passar">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('chat', ['user_id' => $like->user->id]) }}" class="w-9 h-9 rounded-full bg-[#fdf2f4] text-[#590219] border border-[#590219]/20 flex items-center justify-center shadow-xs hover:bg-[#590219] hover:text-white transition-colors" title="Conversar Agora">
                        <i data-lucide="message-square" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('match.celebration', ['user' => $like->user->id]) }}" class="w-9 h-9 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-md hover:bg-[#3f0111]" title="Dar Match">
                        <i data-lucide="heart" class="w-4 h-4 fill-current"></i>
                    </a>
                @else
                    <form action="{{ route('user.see-likes') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="plan" value="semanal">
                        <button type="submit" class="w-full py-2 bg-[#fdf2f4] text-[#590219] font-bold text-xs rounded-xl hover:bg-[#fae6e9] flex items-center justify-center gap-1.5">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>Revelar Foto</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @empty
            <div class="col-span-2 text-center py-10 text-[#796a6e]">
                <p>Nenhuma curtida recebida ainda!</p>
            </div>
        @endforelse

    </div>

    <!-- Bottom End of List Indicator -->
    <div class="flex flex-col items-center text-center gap-2 py-6">
        <div class="w-12 h-12 rounded-full bg-[#eee9e6] text-[#796a6e] flex items-center justify-center border border-[#ede7e5]">
            <i data-lucide="heart" class="w-5 h-5"></i>
        </div>
        <h4 class="text-xs font-bold text-[#221417]">Você chegou ao fim da lista.</h4>
        <p class="text-[11px] text-[#796a6e] font-normal">Continue navegando para descobrir mais pessoas.</p>
    </div>

</div>
@endsection
