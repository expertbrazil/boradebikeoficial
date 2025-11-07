<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher de Inscrição - {{ $appName }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#0f172a;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9;padding:24px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 15px 35px rgba(15,23,42,0.15);">
                    <tr>
                        <td style="padding:0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:linear-gradient(135deg,#1e40af,#3b82f6);color:#ffffff;">
                                <tr>
                                    <td style="padding:28px 32px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td valign="middle" style="text-align:left;">
                                                    @if($siteLogoDataUri)
                                                        <img src="{{ $siteLogoDataUri }}" alt="Logo {{ $appName }}" style="max-height:56px;display:block;">
                                                    @else
                                                        <span style="font-size:24px;font-weight:700;letter-spacing:0.05em;display:block;">{{ $appName }}</span>
                                                    @endif
                                                </td>
                                                <td valign="middle" style="text-align:right;">
                                                    <span style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:0.15em;opacity:0.85;">Voucher de Inscrição</span>
                                                    <span style="display:block;font-size:22px;font-weight:700;margin-top:6px;">{{ $voucherNumber }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 28px;">
                            <p style="margin:0 0 16px 0;font-size:18px;">Olá <strong>{{ $registration->full_name }}</strong>,</p>
                            <p style="margin:0 0 24px 0;font-size:15px;line-height:1.6;">Seu cadastro no evento <strong>{{ $event->title }}</strong> foi confirmado. Apresente este voucher no credenciamento para agilizar sua entrada.</p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 28px 0;">
                                <tr>
                                    <td style="width:50%;vertical-align:top;padding-right:8px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;border-radius:12px;padding:18px;border:1px solid #e2e8f0;">
                                            <tr><td style="font-size:15px;letter-spacing:0.05em;text-transform:uppercase;color:#1d4ed8;font-weight:600;padding-bottom:8px;">Informações do Evento</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Data:</strong> {{ optional($event->event_date)->format('d/m/Y') }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Horário:</strong> {{ optional($event->start_time)->format('H:i') }} às {{ optional($event->end_time)->format('H:i') }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Local:</strong> {{ $event->location }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Cidade:</strong> {{ $event->city }} - {{ $event->state }}</td></tr>
                                        </table>
                                    </td>
                                    <td style="width:50%;vertical-align:top;padding-left:8px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;border-radius:12px;padding:18px;border:1px solid #e2e8f0;">
                                            <tr><td style="font-size:15px;letter-spacing:0.05em;text-transform:uppercase;color:#1d4ed8;font-weight:600;padding-bottom:8px;">Dados do Inscrito</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Nome:</strong> {{ $registration->full_name }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>CPF:</strong> {{ $registration->formatted_cpf }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>E-mail:</strong> {{ $registration->email }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Telefone:</strong> {{ $registration->phone }}</td></tr>
                                            <tr><td style="font-size:14px;padding:4px 0;line-height:1.5;"><strong>Tamanho da camiseta:</strong> {{ $registration->shirt_size }}</td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 28px 0;border:1px dashed #94a3b8;border-radius:12px;padding:24px;background-color:#f1f5f9;text-align:center;">
                                <tr>
                                    <td>
                                        <h3 style="margin:0 0 10px 0;font-size:18px;color:#1e293b;">Número da sua inscrição</h3>
                                        <p style="margin:0 0 16px 0;font-size:14px;color:#334155;line-height:1.6;">Guarde este código e apresente no credenciamento para validar sua participação.</p>
                                        <span style="display:inline-block;padding:10px 18px;border-radius:999px;background-color:#1d4ed8;color:#ffffff;font-size:18px;font-weight:700;letter-spacing:0.12em;">{{ $voucherNumber }}</span>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px 0;background-color:#f8fafc;border-radius:12px;padding:18px;border:1px solid #e2e8f0;">
                                <tr><td style="font-size:15px;letter-spacing:0.05em;text-transform:uppercase;color:#1d4ed8;font-weight:600;padding-bottom:8px;">Documentos e Recomendações</td></tr>
                                <tr><td style="font-size:14px;line-height:1.6;padding:6px 0;">• Chegue com pelo menos 30 minutos de antecedência para o credenciamento.</td></tr>
                                <tr><td style="font-size:14px;line-height:1.6;padding:6px 0;">• Leve documento oficial com foto e este voucher (impresso ou no celular).</td></tr>
                                <tr><td style="font-size:14px;line-height:1.6;padding:6px 0;">• Utilize capacete e itens de segurança obrigatórios durante o trajeto.</td></tr>
                                <tr><td style="font-size:14px;line-height:1.6;padding:6px 0;">• Hidrate-se bem e leve sua garrafa de água reutilizável.</td></tr>
                            </table>

                            @if($registration->has_kit)
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px 0;background:linear-gradient(135deg,#16a34a,#22c55e);border-radius:12px;padding:20px;color:#ffffff;">
                                    <tr><td style="font-size:18px;font-weight:600;padding-bottom:8px;">Kit confirmado</td></tr>
                                    <tr><td style="font-size:14px;line-height:1.6;">Seu kit está reservado. Retire com a equipe no credenciamento apresentando este voucher.</td></tr>
                                </table>
                            @else
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px 0;background:linear-gradient(135deg,#ea580c,#f97316);border-radius:12px;padding:20px;color:#ffffff;">
                                    <tr><td style="font-size:18px;font-weight:600;padding-bottom:8px;">Sem kit incluso</td></tr>
                                    <tr><td style="font-size:14px;line-height:1.6;">Os kits promocionais estão esgotados. Você continua confirmado para o passeio e poderá aproveitar toda a experiência.</td></tr>
                                </table>
                            @endif

                            <p style="margin:0;font-size:14px;line-height:1.6;color:#334155;">Em caso de dúvidas, estamos à disposição pelo e-mail <strong>contato@boradebike.com</strong> ou pelo telefone <strong>(22) 99999-9999</strong>.</p>
                        </td>
                    </tr>
                </table>
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;margin-top:16px;">
                    <tr>
                        <td style="text-align:center;font-size:12px;color:#64748b;">Este é um e-mail automático, por favor não responda. {{ date('Y') }} {{ $appName }}. Todos os direitos reservados.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

