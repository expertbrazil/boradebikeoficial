<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição - Bora de Bike</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .event-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .participant-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .kit-info {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }
        .highlight {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BORA BIKE</h1>
        <h2>Luzes de Natal</h2>
        <p>Confirmação de Inscrição</p>
    </div>
    
    <div class="content">
        <p>Olá <strong>{{ $registration->full_name }}</strong>,</p>
        
        <p>Sua inscrição no evento <strong>Bora de Bike - Luzes de Natal</strong> foi confirmada com sucesso!</p>
        
        <div class="event-info">
            <h3>Informações do Evento</h3>
            <p><strong>Data:</strong> {{ $event->event_date->format('d/m/Y') }}</p>
            <p><strong>Horário:</strong> {{ $event->start_time->format('H:i') }} às {{ $event->end_time->format('H:i') }}</p>
            <p><strong>Local:</strong> {{ $event->location }}</p>
            <p><strong>Cidade:</strong> {{ $event->city }} - {{ $event->state }}</p>
        </div>
        
        <div class="participant-info">
            <h3>Seus Dados</h3>
            <p><strong>Nome:</strong> {{ $registration->full_name }}</p>
            <p><strong>CPF:</strong> {{ $registration->formatted_cpf }}</p>
            <p><strong>E-mail:</strong> {{ $registration->email }}</p>
            <p><strong>Telefone:</strong> {{ $registration->phone }}</p>
            <p><strong>Tamanho da Camiseta:</strong> {{ $registration->shirt_size }}</p>
        </div>
        
        @if($registration->has_kit)
        <div class="kit-info">
            <h3>🎉 Parabéns! Você garantiu seu kit exclusivo!</h3>
            <p>Você está entre os primeiros inscritos e receberá:</p>
            <ul>
                <li>Camiseta exclusiva do evento</li>
                <li>Mochila esportiva</li>
                <li>Garrafa térmica</li>
            </ul>
            <p><strong>O kit será entregue no dia do evento durante o credenciamento.</strong></p>
        </div>
        @else
        <div class="kit-info">
            <h3>Kit Esgotado</h3>
            <p>Infelizmente, os kits exclusivos já foram esgotados. Mas você ainda pode participar do evento e aproveitar toda a experiência!</p>
        </div>
        @endif
        
        <div class="event-info">
            <h3>Próximos Passos</h3>
            <p>1. <strong>Credenciamento:</strong> Chegue com 30 minutos de antecedência</p>
            <p>2. <strong>Documentos:</strong> Leve um documento com foto</p>
            <p>3. <strong>Equipamentos:</strong> Capacete é obrigatório</p>
            <p>4. <strong>Hidratação:</strong> Leve água para o percurso</p>
        </div>
        
        <p>Qualquer dúvida, entre em contato conosco através do e-mail <span class="highlight">contato@boradebike.com</span> ou pelo telefone <span class="highlight">(22) 99999-9999</span>.</p>
        
        <p>Nos vemos no evento!</p>
        
        <p><strong>Equipe Bora de Bike</strong></p>
    </div>
    
    <div class="footer">
        <p>Este é um e-mail automático, por favor não responda.</p>
        <p>&copy; {{ date('Y') }} Bora de Bike. Todos os direitos reservados.</p>
    </div>
</body>
</html>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição - Bora de Bike</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .event-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .participant-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .kit-info {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }
        .highlight {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BORA BIKE</h1>
        <h2>Luzes de Natal</h2>
        <p>Confirmação de Inscrição</p>
    </div>
    
    <div class="content">
        <p>Olá <strong>{{ $registration->full_name }}</strong>,</p>
        
        <p>Sua inscrição no evento <strong>Bora de Bike - Luzes de Natal</strong> foi confirmada com sucesso!</p>
        
        <div class="event-info">
            <h3>Informações do Evento</h3>
            <p><strong>Data:</strong> {{ $event->event_date->format('d/m/Y') }}</p>
            <p><strong>Horário:</strong> {{ $event->start_time->format('H:i') }} às {{ $event->end_time->format('H:i') }}</p>
            <p><strong>Local:</strong> {{ $event->location }}</p>
            <p><strong>Cidade:</strong> {{ $event->city }} - {{ $event->state }}</p>
        </div>
        
        <div class="participant-info">
            <h3>Seus Dados</h3>
            <p><strong>Nome:</strong> {{ $registration->full_name }}</p>
            <p><strong>CPF:</strong> {{ $registration->formatted_cpf }}</p>
            <p><strong>E-mail:</strong> {{ $registration->email }}</p>
            <p><strong>Telefone:</strong> {{ $registration->phone }}</p>
            <p><strong>Tamanho da Camiseta:</strong> {{ $registration->shirt_size }}</p>
        </div>
        
        @if($registration->has_kit)
        <div class="kit-info">
            <h3>🎉 Parabéns! Você garantiu seu kit exclusivo!</h3>
            <p>Você está entre os primeiros inscritos e receberá:</p>
            <ul>
                <li>Camiseta exclusiva do evento</li>
                <li>Mochila esportiva</li>
                <li>Garrafa térmica</li>
            </ul>
            <p><strong>O kit será entregue no dia do evento durante o credenciamento.</strong></p>
        </div>
        @else
        <div class="kit-info">
            <h3>Kit Esgotado</h3>
            <p>Infelizmente, os kits exclusivos já foram esgotados. Mas você ainda pode participar do evento e aproveitar toda a experiência!</p>
        </div>
        @endif
        
        <div class="event-info">
            <h3>Próximos Passos</h3>
            <p>1. <strong>Credenciamento:</strong> Chegue com 30 minutos de antecedência</p>
            <p>2. <strong>Documentos:</strong> Leve um documento com foto</p>
            <p>3. <strong>Equipamentos:</strong> Capacete é obrigatório</p>
            <p>4. <strong>Hidratação:</strong> Leve água para o percurso</p>
        </div>
        
        <p>Qualquer dúvida, entre em contato conosco através do e-mail <span class="highlight">contato@boradebike.com</span> ou pelo telefone <span class="highlight">(22) 99999-9999</span>.</p>
        
        <p>Nos vemos no evento!</p>
        
        <p><strong>Equipe Bora de Bike</strong></p>
    </div>
    
    <div class="footer">
        <p>Este é um e-mail automático, por favor não responda.</p>
        <p>&copy; {{ date('Y') }} Bora de Bike. Todos os direitos reservados.</p>
    </div>
</body>
</html>

