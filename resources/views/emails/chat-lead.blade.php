<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Нов контакт од чатбот</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;color:#1f2933;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background:#ffffff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">
                    <tr>
                        <td style="background:#b42318;padding:22px 28px 18px;">
                            <p style="margin:0;color:#fecaca;font-size:12px;letter-spacing:.08em;text-transform:uppercase;">Автошкола Мартин</p>
                            <h1 style="margin:8px 0 0;color:#ffffff;font-size:22px;line-height:1.3;font-weight:700;">Нов контакт од чатботот</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:4px;background:#f5d90a;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 22px;font-size:16px;line-height:1.55;">
                                Потенцијален клиент го користеше чатботот на веб-страницата и остави контакт податоци.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 28px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;">
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;color:#6b7280;width:140px;">Име</td>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;font-weight:700;">{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;color:#6b7280;">Телефон</td>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;font-weight:700;">
                                        <a href="tel:{{ $phoneDigits }}" style="color:#b42318;text-decoration:none;">{{ $phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;font-size:13px;color:#6b7280;">Датум и време</td>
                                    <td style="padding:14px 16px;font-size:15px;">{{ $when }} <span style="color:#6b7280;">(македонско време)</span></td>
                                </tr>
                            </table>

                            <h2 style="margin:0 0 6px;font-size:16px;">Целосен разговор</h2>
                            <p style="margin:0 0 16px;font-size:13px;line-height:1.5;color:#6b7280;">
                                Прашањата на посетителот и одговорите на асистентот, по редослед како што се зачувани.
                            </p>

                            @forelse ($messages as $message)
                                <p style="margin:18px 0 8px;font-size:12px;color:#6b7280;">{{ $message['at'] }}</p>
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 8px;">
                                    <tr>
                                        <td style="padding:12px 14px;background:#fff7ed;border:1px solid #fed7aa;border-radius:8px;">
                                            <p style="margin:0 0 6px;font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#9a3412;font-weight:700;">Посетител</p>
                                            <p style="margin:0;font-size:14px;line-height:1.55;">{!! nl2br(e($message['question'])) !!}</p>
                                        </td>
                                    </tr>
                                </table>
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 4px;">
                                    <tr>
                                        <td style="padding:12px 14px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;">
                                            <p style="margin:0 0 6px;font-size:11px;letter-spacing:.06em;text-transform:uppercase;color:#374151;font-weight:700;">Асистент</p>
                                            <p style="margin:0;font-size:14px;line-height:1.55;">{!! nl2br(e($message['answer'])) !!}</p>
                                        </td>
                                    </tr>
                                </table>
                            @empty
                                <p style="margin:0;font-size:14px;color:#6b7280;">Нема зачувани пораки за овој разговор.</p>
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;background:#f8fafc;border-top:1px solid #e5e7eb;font-size:12px;line-height:1.5;color:#6b7280;">
                            Автоматска порака од веб-страницата на Автошкола Мартин. Часовите се по македонско време.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
