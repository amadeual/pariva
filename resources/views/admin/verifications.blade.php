@extends('layouts.app')

@section('title', 'Painel Admin - Verificação de Identidades | Pariva')

@section('header')
    <header class="w-full px-5 py-3.5 flex justify-between items-center bg-[#590219] text-white sticky top-0 z-40 shadow-md">
        <div class="flex items-center gap-2">
            <a href="{{ route('discover') }}" class="p-1 text-white/80 hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <h1 class="text-base font-black tracking-tight flex items-center gap-2">
                <i data-lucide="shield-check" class="w-5 h-5 text-amber-300"></i>
                <span>Painel Admin: Verificação de Identidade</span>
            </h1>
        </div>
        <span class="text-[10px] font-bold bg-amber-400 text-[#590219] px-2.5 py-0.5 rounded-full uppercase">MODERAÇÃO</span>
    </header>
@endsection

@section('content')
<div class="px-4 py-6 max-w-2xl mx-auto flex flex-col gap-6">

    <!-- Header Summary Card -->
    <div class="bg-gradient-to-r from-[#590219] via-[#7c0d28] to-[#9e1136] text-white p-5 rounded-3xl shadow-xl flex items-center justify-between border border-white/10">
        <div class="flex flex-col gap-1">
            <h2 class="text-lg font-black flex items-center gap-2">
                <span>Auditoria de Documentos & Selfies</span>
            </h2>
            <p class="text-xs text-white/80">Compare a foto do documento oficial com a selfie capturada para validar a identidade do usuário no Pariva.</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md px-3 py-2 rounded-2xl flex flex-col items-center shrink-0 border border-white/20">
            <span class="text-xs text-amber-300 font-bold uppercase">Pendentes</span>
            <span class="text-xl font-black">{{ $verifications->where('status', 'pending')->count() }}</span>
        </div>
    </div>

    @if($verifications->isEmpty())
        <div class="bg-white rounded-3xl p-10 text-center flex flex-col items-center gap-3 border border-[#ede7e5] shadow-xs">
            <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="check-circle-2" class="w-8 h-8"></i>
            </div>
            <h3 class="font-black text-[#221417] text-base">Nenhuma verificação pendente</h3>
            <p class="text-xs text-[#796a6e]">Todas as solicitações de identidade enviadas foram revisadas com sucesso.</p>
        </div>
    @else
        <div class="flex flex-col gap-5">
            @foreach($verifications as $v)
            <div class="bg-white rounded-3xl p-5 shadow-lg border {{ $v->status === 'pending' ? 'border-amber-300 shadow-amber-500/10' : ($v->status === 'approved' ? 'border-emerald-200' : 'border-rose-200') }} flex flex-col gap-4">
                
                <!-- User Header Info -->
                <div class="flex justify-between items-start border-b border-[#ede7e5] pb-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ $v->user->avatar ? (str_starts_with($v->user->avatar, 'http') ? $v->user->avatar : asset('storage/' . $v->user->avatar)) : asset('images/avatars/placeholder.jpg') }}" 
                             alt="{{ $v->user->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-[#590219]/20 shadow-xs">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-[#221417] text-sm">{{ $v->user->name }}</h3>
                                <span class="text-xs text-[#796a6e]">({{ $v->user->age ?? '18+' }} anos)</span>
                            </div>
                            <span class="text-xs text-[#796a6e]">{{ $v->user->email }}</span>
                            <span class="text-[10px] text-[#796a6e] mt-0.5">Enviado em {{ $v->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div>
                        @if($v->status === 'pending')
                            <span class="bg-amber-100 text-amber-800 border border-amber-300 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">⏳ Em Análise</span>
                        @elseif($v->status === 'approved')
                            <span class="bg-emerald-100 text-emerald-800 border border-emerald-300 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">✅ Aprovado</span>
                        @else
                            <span class="bg-rose-100 text-rose-800 border border-rose-300 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">❌ Rejeitado</span>
                        @endif
                    </div>
                </div>

                <!-- Document Info Tag -->
                <div class="flex items-center gap-2 text-xs font-bold text-[#590219]">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span>Documento enviado: <strong class="uppercase text-[#221417]">{{ $v->document_type === 'rg_rne_cnh' ? 'RG / RNE / CNH' : ($v->document_type === 'passport' ? 'Passaporte' : strtoupper($v->document_type)) }}</strong></span>
                </div>

                <!-- Document Photo & Selfie Side-by-Side Comparison -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Document Photo -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] font-extrabold text-[#796a6e] uppercase">Documento Oficial</span>
                        <a href="{{ asset('storage/' . $v->document_photo_path) }}" target="_blank" class="group relative rounded-2xl overflow-hidden border border-[#ede7e5] bg-gray-100 aspect-video block">
                            <img src="{{ asset('storage/' . $v->document_photo_path) }}" alt="Foto Documento" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                🔍 Ampliar
                            </div>
                        </a>
                    </div>

                    <!-- Selfie Photo -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] font-extrabold text-[#796a6e] uppercase">Selfie do Usuário</span>
                        <a href="{{ asset('storage/' . $v->selfie_photo_path) }}" target="_blank" class="group relative rounded-2xl overflow-hidden border border-[#ede7e5] bg-gray-100 aspect-video block">
                            <img src="{{ asset('storage/' . $v->selfie_photo_path) }}" alt="Foto Selfie" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                🔍 Ampliar
                            </div>
                        </a>
                    </div>
                </div>

                @if($v->rejection_reason)
                    <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-900">
                        <strong>Motivo da Recusa:</strong> {{ $v->rejection_reason }}
                    </div>
                @endif

                <!-- Admin Action Buttons (if pending) -->
                @if($v->status === 'pending')
                    <div class="flex items-center gap-3 border-t border-[#ede7e5] pt-3 mt-1">
                        <form method="POST" action="{{ route('admin.verifications.approve', $v->id) }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-emerald-600 text-white font-extrabold text-xs rounded-xl shadow-md hover:bg-emerald-700 transition-colors flex items-center justify-center gap-1.5">
                                <i data-lucide="check" class="w-4 h-4"></i>
                                <span>Aprovar Identidade</span>
                            </button>
                        </form>

                        <button type="button" onclick="document.getElementById('reject-form-{{ $v->id }}').classList.toggle('hidden')" class="px-4 py-3 bg-rose-100 text-rose-700 font-extrabold text-xs rounded-xl border border-rose-200 hover:bg-rose-200 transition-colors flex items-center justify-center gap-1.5">
                            <i data-lucide="x-circle" class="w-4 h-4"></i>
                            <span>Rejeitar</span>
                        </button>
                    </div>

                    <!-- Rejection Reason Form Drawer -->
                    <form id="reject-form-{{ $v->id }}" method="POST" action="{{ route('admin.verifications.reject', $v->id) }}" class="hidden flex-col gap-2 p-3 bg-rose-50 rounded-2xl border border-rose-200">
                        @csrf
                        <label class="text-xs font-bold text-rose-900">Informe o motivo do indeferimento:</label>
                        <input type="text" name="reason" placeholder="Ex: Foto do documento desfocada ou ilegível..." class="w-full bg-white rounded-xl p-2.5 text-xs text-[#221417] border border-rose-300 focus:outline-none" required>
                        <button type="submit" class="py-2 px-4 bg-rose-600 text-white font-bold text-xs rounded-xl hover:bg-rose-700 self-end">
                            Confirmar Rejeição
                        </button>
                    </form>
                @endif
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
