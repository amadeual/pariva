@extends('layouts.app')

@section('title', 'Chat & Mensagens - Pariva')

@section('header')
    <header class="w-full px-4 py-3.5 flex justify-between items-center bg-[#fbf9f8] border-b border-[#ede7e5] sticky top-0 z-40">
        <div class="flex items-center gap-3">
            <a href="{{ route('discover') }}" class="text-[#221417] p-1 rounded-full hover:bg-[#eee9e6] transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div class="flex flex-col">
                <h2 class="font-extrabold text-sm text-[#221417]">Chat</h2>
                <span class="text-[10px] text-[#796a6e] font-semibold">Créditos de Chat Direto: {{ Auth::user()->direct_chat_credits }}</span>
            </div>
        </div>

        <a href="{{ route('premium') }}" class="flex items-center gap-1 text-[10px] font-extrabold text-[#590219] bg-[#590219]/10 px-2.5 py-1 rounded-full hover:bg-[#590219]/20 transition-colors">
            <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
            <span>Comprar Chats</span>
        </a>
    </header>
@endsection

@section('content')
<div class="flex flex-col min-h-[calc(100vh-130px)] bg-[#fbf9f8]">

    <!-- Active Connections / Matches Carousel Bar -->
    <div class="w-full bg-white border-b border-[#ede7e5] px-4 py-3 flex flex-col gap-2 shadow-2xs">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#796a6e]">Seus Matches & Conversas</span>
            <span class="text-[10px] font-bold text-[#590219]">{{ count($activeChats) }} ativas</span>
        </div>

        <div class="flex items-center gap-3 overflow-x-auto pb-1 scrollbar-none">
            @forelse($activeChats as $chatUser)
                <a href="{{ route('chat', ['user_id' => $chatUser->id]) }}" class="flex flex-col items-center gap-1 shrink-0 group">
                    <div class="relative w-12 h-12 rounded-full overflow-hidden border-2 {{ isset($selectedUser) && $selectedUser->id === $chatUser->id ? 'border-[#590219] shadow-md scale-105' : 'border-white shadow-xs' }} transition-all">
                        <img src="{{ $chatUser->avatar_url }}" 
                             onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                             alt="{{ $chatUser->name }}" class="w-full h-full object-cover">
                    </div>
                    <span class="text-[10px] font-bold text-[#221417] truncate max-w-[60px]">{{ explode(' ', $chatUser->name)[0] }}</span>
                </a>
            @empty
                <div class="text-xs text-[#796a6e] py-1 italic">Nenhum match ainda. Faça um match no Descobrir ou use Crédito de Chat!</div>
            @endforelse
        </div>
    </div>

    <!-- Main Active Conversation Box -->
    <div class="flex-1 px-4 py-4 flex flex-col justify-between max-w-md mx-auto w-full">

        @if($selectedUser)
            <!-- Chat Recipient Header Info -->
            <div class="bg-white rounded-2xl p-3 border border-[#ede7e5] flex items-center justify-between mb-4 shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="relative w-10 h-10 rounded-full overflow-hidden border border-[#ede7e5]">
                        <img src="{{ $selectedUser->avatar_url }}" 
                             onerror="this.src='{{ asset('images/avatars/placeholder.jpg') }}'"
                             alt="{{ $selectedUser->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <h3 class="font-extrabold text-xs text-[#221417]">{{ $selectedUser->name }}</h3>
                            @if($selectedUser->is_verified)
                                <i data-lucide="badge-check" class="w-3.5 h-3.5 text-amber-500 fill-amber-500/20"></i>
                            @endif
                        </div>
                        <span class="text-[10px] text-[#796a6e] font-medium">{{ $selectedUser->profession ?? 'Pariva Member' }} • {{ $selectedUser->location ?? 'São Paulo' }}</span>
                    </div>
                </div>

                <a href="{{ route('encontros.agendar', $selectedUser->id) }}" class="px-3 py-1.5 bg-[#fdf2f4] text-[#590219] text-[10px] font-extrabold rounded-xl border border-[#590219]/20 hover:bg-[#590219] hover:text-white transition-colors">
                    📅 Agendar
                </a>
            </div>

            <!-- Messages Stream -->
            <div class="flex flex-col gap-3 overflow-y-auto mb-4 max-h-[380px] px-1 scrollbar-thin">
                @forelse($messages as $msg)
                    @if($msg->sender_id === Auth::id())
                        <!-- Sent Message (Right Bubble) -->
                        <div class="flex flex-col items-end gap-1 ml-auto max-w-[80%]">
                            <div class="bg-[#590219] text-white p-3 rounded-2xl rounded-tr-none text-xs shadow-xs font-normal leading-relaxed">
                                {{ $msg->message }}
                            </div>
                            <span class="text-[9px] text-[#796a6e] font-semibold">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                    @else
                        <!-- Received Message (Left Bubble) -->
                        <div class="flex flex-col items-start gap-1 mr-auto max-w-[80%]">
                            <div class="bg-white border border-[#ede7e5] text-[#221417] p-3 rounded-2xl rounded-tl-none text-xs shadow-xs font-normal leading-relaxed">
                                {{ $msg->message }}
                            </div>
                            <span class="text-[9px] text-[#796a6e] font-semibold">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-8 text-xs text-[#796a6e] flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-[#fdf2f4] text-[#590219] flex items-center justify-center">
                            <i data-lucide="message-square-heart" class="w-5 h-5"></i>
                        </div>
                        <p class="font-bold text-[#221417]">Diga Olá para {{ explode(' ', $selectedUser->name)[0] }}! 👋</p>
                        <p class="text-[11px]">Quebre o gelo enviando uma mensagem simpática.</p>
                    </div>
                @endforelse
            </div>

            <!-- Validation Error Alert -->
            @if($errors->has('chat_credit'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold p-3 rounded-2xl mb-2 flex justify-between items-center shadow-xs">
                    <span>{{ $errors->first('chat_credit') }}</span>
                    <a href="{{ route('premium') }}" class="px-2.5 py-1 bg-[#590219] text-white text-[10px] font-extrabold rounded-lg shrink-0">Comprar (R$ 15)</a>
                </div>
            @endif

            <!-- Message Input Form -->
            <form action="{{ route('chat.send') }}" method="POST" class="sticky bottom-14 pt-2 bg-[#fbf9f8]">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">
                <div class="bg-white rounded-full p-1.5 pr-2 pl-4 flex items-center gap-2 shadow-md border border-[#ede7e5]">
                    <input type="text" name="message" required placeholder="Escreva sua mensagem..." class="bg-transparent flex-1 text-xs text-[#221417] focus:outline-none placeholder-[#a09497] font-medium">

                    <button type="submit" class="w-9 h-9 rounded-full bg-[#590219] text-white flex items-center justify-center shadow-sm hover:bg-[#3f0111] transition-all cursor-pointer">
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                </div>
            </form>
        @else
            <!-- Empty Chat State -->
            <div class="bg-white border border-[#ede7e5] rounded-3xl p-6 text-center flex flex-col items-center gap-4 my-auto shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-[#fdf2f4] text-[#590219] flex items-center justify-center">
                    <i data-lucide="message-square-heart" class="w-8 h-8"></i>
                </div>
                <div class="flex flex-col gap-1.5">
                    <h3 class="font-extrabold text-base text-[#221417]">Sem conversas ativas no momento</h3>
                    <p class="text-xs text-[#796a6e] leading-relaxed max-w-xs font-medium">
                        Dê Likes no Descobrir para gerar Matches ou compre <strong>Créditos de Chat Direto (R$ 15,00)</strong> para conversar imediatamente com qualquer pessoa!
                    </p>
                </div>

                <div class="flex gap-2 mt-2 w-full">
                    <a href="{{ route('discover') }}" class="flex-1 py-3 bg-[#fdf2f4] text-[#590219] font-extrabold text-xs rounded-2xl border border-[#590219]/20 hover:bg-[#590219] hover:text-white transition-all text-center">
                        Ir ao Descobrir
                    </a>
                    <a href="{{ route('premium') }}" class="flex-1 py-3 bg-[#590219] text-white font-extrabold text-xs rounded-2xl shadow-md hover:bg-[#3f0111] transition-all text-center">
                        Comprar Chats (R$ 15)
                    </a>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
