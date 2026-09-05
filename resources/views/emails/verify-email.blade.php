@extends('emails.layout')

@section('title', 'Confirme seu E-mail - Pariva ✉️')

@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- Icon Badge -->
    <tr>
        <td align="center" style="padding-bottom: 20px;">
            <div style="width: 64px; height: 64px; background-color: #fdf2f4; border-radius: 50%; text-align: center; line-height: 64px; font-size: 30px;">
                ✉️
            </div>
        </td>
    </tr>

    <!-- Title -->
    <tr>
        <td align="center" style="padding-bottom: 16px;">
            <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #590219; letter-spacing: -0.5px; text-align: center;">
                Confirme seu endereço de e-mail
            </h1>
        </td>
    </tr>

    <!-- Body Text -->
    <tr>
        <td style="color: #4a3b3e; font-size: 16px; line-height: 26px; padding-bottom: 24px;">
            <p style="margin: 0 0 16px 0;">Olá, {{ $user->name ?? 'usuário(a)' }}!</p>
            <p style="margin: 0 0 16px 0;">Falta apenas um passo para ativar completamente sua conta no <strong>Pariva</strong>. Por favor, confirme seu e-mail utilizando o código de verificação abaixo ou clicando no botão:</p>
        </td>
    </tr>

    <!-- Code Display Box (If verification code is provided) -->
    @if(isset($code))
    <tr>
        <td align="center" style="padding-bottom: 24px;">
            <div style="background-color: #fdf2f4; border: 2px dashed #7c0d28; border-radius: 16px; padding: 18px 36px; display: inline-block;">
                <span style="font-size: 32px; font-weight: 900; letter-spacing: 8px; color: #590219;">{{ $code }}</span>
            </div>
        </td>
    </tr>
    @endif

    <!-- CTA Button -->
    <tr>
        <td align="center" style="padding-bottom: 28px;">
            <a href="{{ $verifyUrl ?? '#' }}" class="btn-primary" style="display: inline-block; background: linear-gradient(135deg, #7c0d28 0%, #590219 100%); color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 700; padding: 16px 36px; border-radius: 30px; box-shadow: 0 8px 20px rgba(89, 2, 25, 0.25); text-align: center;">
                Confirmar Meu E-mail Agora ✔️
            </a>
        </td>
    </tr>

    <!-- Security Note -->
    <tr>
        <td align="center" style="color: #796a6e; font-size: 13px;">
            Se você não criou uma conta no Pariva, nenhuma ação é necessária.
        </td>
    </tr>
</table>
@endsection
