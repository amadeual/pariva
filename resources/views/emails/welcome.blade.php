@extends('emails.layout')

@section('title', 'Bem-vindo ao Pariva! 💕')

@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- Icon Badge -->
    <tr>
        <td align="center" style="padding-bottom: 20px;">
            <div style="width: 64px; height: 64px; background-color: #fdf2f4; border-radius: 50%; text-align: center; line-height: 64px; font-size: 30px;">
                ✨
            </div>
        </td>
    </tr>

    <!-- Greeting & Title -->
    <tr>
        <td align="center" style="padding-bottom: 16px;">
            <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #590219; letter-spacing: -0.5px; text-align: center;">
                Sua jornada começa agora, {{ $user->name ?? 'bem-vindo(a)' }}! 🎉
            </h1>
        </td>
    </tr>

    <!-- Body Text -->
    <tr>
        <td style="color: #4a3b3e; font-size: 16px; line-height: 26px; padding-bottom: 24px;">
            <p style="margin: 0 0 16px 0;">Estamos muito felizes em ter você no <strong>Pariva</strong>! Nossa comunidade foi feita para conectar pessoas incríveis, criar momentos inesquecíveis e proporcionar encontros reais com total segurança.</p>
            
            <p style="margin: 0;">Para começar com o pé direito e aumentar suas chances de dar **Match**, recomendamos concluir os seguintes passos:</p>
        </td>
    </tr>

    <!-- Steps Box -->
    <tr>
        <td style="padding-bottom: 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fdf2f4; border-radius: 16px; padding: 20px; border: 1px solid #fae6e9;">
                <tr>
                    <td style="padding-bottom: 12px;">
                        <span style="font-size: 18px; margin-right: 10px;">📸</span>
                        <strong style="color: #590219; font-size: 15px;">Adicione suas melhores fotos</strong>
                        <p style="margin: 4px 0 0 32px; color: #796a6e; font-size: 14px;">Perfis com foto têm até 5x mais curtidas.</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 12px;">
                        <span style="font-size: 18px; margin-right: 10px;">✍️</span>
                        <strong style="color: #590219; font-size: 15px;">Escreva uma breve bio</strong>
                        <p style="margin: 4px 0 0 32px; color: #796a6e; font-size: 14px;">Conte um pouco sobre seus gostos e o que procura.</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0;">
                        <span style="font-size: 18px; margin-right: 10px;">🎯</span>
                        <strong style="color: #590219; font-size: 15px;">Defina seus interesses</strong>
                        <p style="margin: 4px 0 0 32px; color: #796a6e; font-size: 14px;">Facilite encontrar conexões com afinidades parecidas.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Call to Action Button -->
    <tr>
        <td align="center" style="padding-bottom: 24px;">
            <a href="{{ config('app.url') }}/discover" class="btn-primary" style="display: inline-block; background: linear-gradient(135deg, #7c0d28 0%, #590219 100%); color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 700; padding: 16px 36px; border-radius: 30px; box-shadow: 0 8px 20px rgba(89, 2, 25, 0.25); text-align: center;">
                Completar Meu Perfil Agora 🔥
            </a>
        </td>
    </tr>

    <!-- Footer Note -->
    <tr>
        <td align="center" style="color: #796a6e; font-size: 14px;">
            Se tiver qualquer dúvida, nosso suporte está sempre pronto para te ajudar.
        </td>
    </tr>
</table>
@endsection
