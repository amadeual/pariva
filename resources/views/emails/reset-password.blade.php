@extends('emails.layout')

@section('title', 'Redefinição de Senha - Pariva 🔒')

@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- Icon Badge -->
    <tr>
        <td align="center" style="padding-bottom: 20px;">
            <div style="width: 64px; height: 64px; background-color: #fdf2f4; border-radius: 50%; text-align: center; line-height: 64px; font-size: 30px;">
                🔑
            </div>
        </td>
    </tr>

    <!-- Title -->
    <tr>
        <td align="center" style="padding-bottom: 16px;">
            <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #590219; letter-spacing: -0.5px; text-align: center;">
                Solicitação de nova senha
            </h1>
        </td>
    </tr>

    <!-- Body Text -->
    <tr>
        <td style="color: #4a3b3e; font-size: 16px; line-height: 26px; padding-bottom: 24px;">
            <p style="margin: 0 0 16px 0;">Olá, {{ $user->name ?? 'usuário(a)' }}!</p>
            <p style="margin: 0 0 16px 0;">Recebemos uma solicitação para redefinir a senha da sua conta no <strong>Pariva</strong>. Se foi você quem pediu, clique no botão abaixo para escolher uma nova senha segura:</p>
        </td>
    </tr>

    <!-- CTA Button -->
    <tr>
        <td align="center" style="padding-bottom: 28px;">
            <a href="{{ $resetUrl }}" class="btn-primary" style="display: inline-block; background: linear-gradient(135deg, #7c0d28 0%, #590219 100%); color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 700; padding: 16px 36px; border-radius: 30px; box-shadow: 0 8px 20px rgba(89, 2, 25, 0.25); text-align: center;">
                Redefinir Minha Senha 🔒
            </a>
        </td>
    </tr>

    <!-- Expiration & Security Notice Box -->
    <tr>
        <td style="padding-bottom: 24px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fbf9f8; border-radius: 12px; padding: 16px; border: 1px solid #ede7e5;">
                <tr>
                    <td style="color: #796a6e; font-size: 13px; line-height: 20px;">
                        <strong style="color: #221417;">⚠️ Informações de Segurança:</strong>
                        <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                            <li>Este link é válido por <strong>60 minutos</strong> por razões de segurança.</li>
                            <li>Se você não solicitou a alteração de senha, pode ignorar este e-mail com segurança. Sua senha permanecerá a mesma.</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Alternative Link -->
    <tr>
        <td style="color: #796a6e; font-size: 12px; line-height: 18px; word-break: break-all;">
            Se estiver enfrentando problemas para clicar no botão, copie e cole o link abaixo em seu navegador:<br>
            <a href="{{ $resetUrl }}" style="color: #7c0d28;">{{ $resetUrl }}</a>
        </td>
    </tr>
</table>
@endsection
