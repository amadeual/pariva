<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Pariva')</title>
    <style>
        /* Reset styles for email clients */
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #fbf9f8;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #221417;
        }
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 12px !important;
            }
            .content-box {
                padding: 24px 20px !important;
            }
            .btn-primary {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
        }
    </style>
</head>
<body style="background-color: #fbf9f8; margin: 0; padding: 0; -webkit-font-smoothing: antialiased;">

    <!-- Container Table -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fbf9f8; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <!-- Email Inner Container (600px max) -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="email-container" style="max-width: 600px; width: 100%; margin: 0 auto;">
                    
                    <!-- Header with Pariva Logo & Gradient Accent -->
                    <tr>
                        <td align="center" style="padding-bottom: 24px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <div style="display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                                            <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #7c0d28 0%, #590219 100%); border-radius: 12px; text-align: center; line-height: 44px; color: #ffffff; font-size: 22px; font-weight: bold; box-shadow: 0 4px 12px rgba(89, 2, 25, 0.25);">
                                                ♥
                                            </div>
                                            <span style="font-size: 28px; font-weight: 800; color: #590219; letter-spacing: -0.5px; margin-left: 8px; vertical-align: middle;">pariva</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Main Content Card -->
                    <tr>
                        <td align="left" class="content-box" style="background-color: #ffffff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(89, 2, 25, 0.05); border: 1px solid #ede7e5;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding-top: 32px; padding-bottom: 16px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="color: #796a6e; font-size: 13px; line-height: 20px;">
                                        <p style="margin: 0 0 10px 0; color: #594a4e; font-size: 12px; line-height: 18px;">
                                            Av. Paulista, 91 - Bela Vista, São Paulo - SP, 01311-000
                                        </p>
                                        <p style="margin: 0 0 14px 0;">Este é um e-mail automático enviado pelo <strong>Pariva</strong>.</p>
                                        
                                        <div style="margin-bottom: 16px;">
                                            <a href="{{ config('app.url') }}/termos" style="color: #7c0d28; text-decoration: none; font-weight: 600; margin: 0 8px;">Termos de Uso</a> •
                                            <a href="{{ config('app.url') }}/privacidade" style="color: #7c0d28; text-decoration: none; font-weight: 600; margin: 0 8px;">Privacidade</a> •
                                            <a href="mailto:suporte@pariva.com.br" style="color: #7c0d28; text-decoration: none; font-weight: 600; margin: 0 8px;">Suporte</a>
                                        </div>

                                        <p style="margin: 0; color: #a39598; font-size: 12px;">&copy; {{ date('Y') }} Pariva. Todos os direitos reservados.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
