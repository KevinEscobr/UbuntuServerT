<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bienvenida a Doble Encanto</title>
    <style type="text/css">
        /* Base styles */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }

        /* Reset styles */
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #faf6f5; }

        /* Typography */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap');

        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .wrapper { width: 100% !important; }
            .container { padding: 24px 16px !important; }
            .button { width: 100% !important; box-sizing: border-box; text-align: center; }
            .step-card { padding: 12px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #faf6f5; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #faf6f5;">
        <tr>
            <td align="center" style="padding: 40px 0 20px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="wrapper">
                    <!-- LOGO / HEADER -->
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <a href="{{ config('app.url') }}" target="_blank" style="text-decoration: none; display: inline-block;">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="center" valign="middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="display: block; margin-bottom: 8px;">
                                                <path d="M12 22V12"></path>
                                                <path d="M12 12C12 12 9 7 5 7C1 7 1 12 5 15C9 18 12 12 12 12Z"></path>
                                                <path d="M12 12C12 12 15 7 19 7C23 7 23 12 19 15C15 18 12 12 12 12Z"></path>
                                                <path d="M12 12C12 12 9 17 5 17C1 17 1 12 5 9C9 6 12 12 12 12Z" opacity="0.5"></path>
                                                <path d="M12 12C12 12 15 17 19 17C23 17 23 12 19 9C15 6 12 12 12 12Z" opacity="0.5"></path>
                                            </svg>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-family: 'Playfair Display', Georgia, Cambria, 'Times New Roman', Times, serif; font-size: 26px; font-weight: 700; color: #383431; letter-spacing: 1px; text-transform: uppercase;">
                                            Doble Encanto
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 500; color: #a89f9a; letter-spacing: 3px; text-transform: uppercase; padding-top: 4px;">
                                            Estética & Bienestar
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-bottom: 40px;">
                <!-- MAIN CARD -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="wrapper" style="background-color: #ffffff; border-radius: 32px; border: 1px solid #efe6e2; box-shadow: 0 15px 35px -5px rgba(56, 52, 49, 0.05), 0 10px 15px -8px rgba(56, 52, 49, 0.03); overflow: hidden;">
                    <!-- GOLDEN / ROSE DECORATIVE TOP BAR -->
                    <tr>
                        <td height="6" style="background: linear-gradient(90deg, #fbcfe8 0%, #f43f5e 50%, #fda4af 100%);"></td>
                    </tr>
                    <!-- CARD HEADER BANNER -->
                    <tr>
                        <td align="center" style="background: linear-gradient(180deg, #fff5f5 0%, #ffffff 100%); padding: 40px 48px 20px 48px;" class="container">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="font-family: 'Playfair Display', Georgia, Cambria, 'Times New Roman', Times, serif; font-size: 28px; font-weight: 600; color: #2e2a27; line-height: 1.3;">
                                        ¡Tu viaje de autocuidado comienza aquí!
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-family: 'Playfair Display', Georgia, serif; font-style: italic; font-size: 16px; color: #e11d48; padding-top: 8px;">
                                        Bienvenida, {{ $name }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- CARD BODY -->
                    <tr>
                        <td class="container" style="padding: 0 48px 40px 48px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="font-size: 15px; color: #5c5552; line-height: 1.7; padding-bottom: 24px; text-align: center;">
                                        Te agradecemos enormemente haberte registrado en <strong>Doble Encanto</strong>. Estamos listos para brindarte una experiencia única y personalizada en estética y masajes profesionales.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 15px; color: #5c5552; line-height: 1.7; padding-bottom: 32px; text-align: center;">
                                        Por favor, confirma tu dirección de correo electrónico haciendo clic en el botón de abajo para activar tu cuenta y agendar tus visitas:
                                    </td>
                                </tr>
                                
                                <!-- MAIN BUTTON -->
                                <tr>
                                    <td align="center" style="padding-bottom: 40px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="border-radius: 9999px; background-color: #e11d48;">
                                                    <a href="{{ $url }}" class="button" target="_blank" style="display: inline-block; padding: 16px 42px; font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 600; color: #ffffff; text-decoration: none; border-radius: 9999px; border: 1px solid #e11d48; letter-spacing: 0.5px; box-shadow: 0 8px 20px rgba(225, 29, 72, 0.25);">
                                                        CONFIRMAR MI CUENTA
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- STEP-BY-STEP FLOW -->
                                <tr>
                                    <td style="padding: 24px; background-color: #faf6f5; border-radius: 20px; border: 1px dashed #e9dbd5;" class="step-card">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="font-family: 'Playfair Display', Georgia, serif; font-size: 18px; font-weight: 600; color: #383431; padding-bottom: 16px; text-align: center;">
                                                    Tus siguientes pasos:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 12px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="28" valign="top" style="font-size: 16px; color: #e11d48; font-weight: bold;">1.</td>
                                                            <td style="font-size: 14px; color: #5c5552; line-height: 1.5;">
                                                                <strong>Activa tu cuenta:</strong> Al hacer clic en el botón de arriba, tu correo quedará verificado.
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 12px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="28" valign="top" style="font-size: 16px; color: #e11d48; font-weight: bold;">2.</td>
                                                            <td style="font-size: 14px; color: #5c5552; line-height: 1.5;">
                                                                <strong>Agenda tu tratamiento:</strong> Elige entre masajes relajantes, limpieza profunda o peeling desde tu panel de usuario.
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="28" valign="top" style="font-size: 16px; color: #e11d48; font-weight: bold;">3.</td>
                                                            <td style="font-size: 14px; color: #5c5552; line-height: 1.5;">
                                                                <strong>Disfruta tu momento:</strong> Te esperaremos en nuestro espacio diseñado para tu completa desconexión.
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- INSPIRATIONAL QUOTE -->
                                <tr>
                                    <td align="center" style="padding: 32px 0 24px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="80%">
                                            <tr>
                                                <td align="center" style="font-family: 'Playfair Display', Georgia, serif; font-style: italic; font-size: 15px; color: #8a7c77; line-height: 1.6; text-align: center; border-left: 2px solid #fda4af; padding-left: 16px;">
                                                    "El autocuidado no es un lujo, es una prioridad para volver a conectar contigo misma y resaltar tu belleza natural."
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="font-size: 13px; color: #8e8581; line-height: 1.6; padding-top: 16px; border-top: 1px solid #f3eae6; text-align: center;">
                                        Si no has solicitado el registro en nuestra web, puedes ignorar este correo de forma segura. El enlace expirará en 60 minutos.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <!-- LUXURY FOOTER -->
        <tr>
            <td align="center" style="padding-bottom: 40px;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="wrapper">
                    <!-- SOCIAL LINKS -->
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 0 10px;">
                                        <a href="https://www.instagram.com/dobleencanto.cl/" target="_blank" style="display: inline-block; font-size: 12px; font-weight: 600; color: #e11d48; text-decoration: none; background-color: #fff1f2; padding: 6px 16px; border-radius: 9999px; border: 1px solid #ffe4e6;">
                                            Instagram
                                        </a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="{{ config('app.url') }}" target="_blank" style="display: inline-block; font-size: 12px; font-weight: 600; color: #5c5552; text-decoration: none; background-color: #f5ebe6; padding: 6px 16px; border-radius: 9999px; border: 1px solid #e8dbd5;">
                                            Sitio Web
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- ADDRESS & RIGHTS -->
                    <tr>
                        <td align="center" style="font-family: 'Inter', sans-serif; font-size: 12px; color: #a89f9a; line-height: 1.6; text-align: center;">
                            <strong>Doble Encanto Estética</strong>
                            <br />
                            Remigio Castro 74, Oficina 4 — Coronel, Chile
                            <br />
                            <span style="font-size: 11px; color: #c0b7b2; display: inline-block; padding-top: 8px;">
                                &copy; {{ date('Y') }} dobleencanto.cl. Todos los derechos reservados.
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
