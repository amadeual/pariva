@extends('emails.layout')

@section('title', 'Notificação Importante de Conta - Pariva')

@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- Icon Badge (Alert) -->
    <tr>
        <td align="center" style="padding-bottom: 20px;">
            <div style="width: 64px; height: 64px; background-color: #fef2f2; border-radius: 50%; text-align: center; line-height: 64px; font-size: 30px;">
                🚫
            </div>
        </td>
    </tr>

    <!-- Title -->
    <tr>
        <td align="center" style="padding-bottom: 16px;">
            <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #dc2626; letter-spacing: -0.5px; text-align: center;">
                Sua conta foi suspensa
            </h1>
        </td>
    </tr>

    <!-- Body Text -->
    <tr>
        <td style="color: #4a3b3e; font-size: 16px; line-height: 26px; padding-bottom: 24px;">
            <p style="margin: 0 0 16px 0;">Olá, {{ $user->name ?? 'usuário(a)' }}.</p>
            <p style="margin: 0 0 16px 0;">Informamos que o seu acesso à plataforma <strong>Pariva</strong> foi temporariamente ou permanentemente suspenso após uma análise de nossas diretrizes de segurança e termos de uso.</p>
        </td>
    </tr>

    <!-- Reason Box -->
    <tr>
        <td style="padding-bottom: 24px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fef2f2; border-radius: 12px; padding: 20px; border: 1px solid #fecaca;">
                <tr>
                    <td style="color: #991b1b; font-size: 14px; line-height: 22px;">
                        <strong style="font-size: 15px; display: block; margin-bottom: 6px;">Motivo da suspensão:</strong>
                        {{ $reason ?? 'Violação das Diretrizes da Comunidade e Termos de Serviço (comportamento inadequado ou denúncias de usuários).' }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Next steps / Appeal -->
    <tr>
        <td style="color: #4a3b3e; font-size: 15px; line-height: 24px; padding-bottom: 28px;">
            <p style="margin: 0 0 16px 0;">O Pariva preza por uma comunidade respeitosa, segura e autêntica. Atitudes que violem nossas regras de convivência não são toleradas.</p>
            <p style="margin: 0;">Se você acredita que ocorreu um erro ou deseja solicitar uma revisão da decisão, entre em contato com nossa equipe de moderação com o seu e-mail cadastrado.</p>
        </td>
    </tr>

    <!-- CTA Support Button -->
    <tr>
        <td align="center" style="padding-bottom: 20px;">
            <a href="mailto:suporte@pariva.com.br?subject=Contestacao%20de%20Suspensao%20-%20Cont%20{{ $user->id ?? '' }}" class="btn-primary" style="display: inline-block; background-color: #374151; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 700; padding: 14px 32px; border-radius: 30px; text-align: center;">
                Contatar Equipe de Suporte ✉️
            </a>
        </td>
    </tr>
</table>
@endsection
