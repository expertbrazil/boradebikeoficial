<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Inscrição - {{ $registration->full_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .header-logo {
            background: white;
            padding: 10px;
            border-radius: 8px;
        }
        
        .header-logo img {
            max-height: 60px;
            max-width: 200px;
        }
        
        .header-title {
            text-align: right;
        }
        
        .header-title h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header-title p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .content {
            padding: 0 30px 30px;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .field {
            margin-bottom: 12px;
        }
        
        .field-label {
            font-weight: bold;
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        
        .field-value {
            color: #111827;
            font-size: 12px;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-logo">
            @if($logoPath && file_exists($logoPath))
                <img src="{{ $logoPath }}" alt="Logo do Site" style="max-width: 200px; height: auto;">
            @elseif($siteLogo)
                <img src="{{ asset('storage/' . $siteLogo) }}" alt="Logo do Site" style="max-width: 200px; height: auto;">
            @else
                <div style="padding: 10px; text-align: center; color: #2563eb; font-weight: bold;">
                    BORA DE BIKE
                </div>
            @endif
        </div>
        <div class="header-title">
            <h1>Comprovante de Inscrição</h1>
            <p>Nº {{ $registration->id }} - {{ $registration->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="content">
        <!-- Dados Pessoais -->
        <div class="section">
            <h2 class="section-title">Dados Pessoais</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">Nome Completo</div>
                    <div class="field-value">{{ $registration->full_name }}</div>
                </div>
                <div class="field">
                    <div class="field-label">CPF</div>
                    <div class="field-value">{{ $registration->formatted_cpf }}</div>
                </div>
                <div class="field">
                    <div class="field-label">E-mail</div>
                    <div class="field-value">{{ $registration->email }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Telefone</div>
                    <div class="field-value">{{ $registration->phone }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Data de Nascimento</div>
                    <div class="field-value">{{ $registration->birth_date->format('d/m/Y') }} ({{ $registration->age }} anos)</div>
                </div>
                <div class="field">
                    <div class="field-label">Gênero</div>
                    <div class="field-value">{{ ucfirst($registration->gender) }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Tamanho da Camisa</div>
                    <div class="field-value">{{ $registration->shirt_size }}</div>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="section">
            <h2 class="section-title">Endereço</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">CEP</div>
                    <div class="field-value">{{ $registration->formatted_zip_code }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Número</div>
                    <div class="field-value">{{ $registration->number }}</div>
                </div>
                <div class="field full-width">
                    <div class="field-label">Endereço</div>
                    <div class="field-value">{{ $registration->address }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Bairro</div>
                    <div class="field-value">{{ $registration->neighborhood }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Cidade</div>
                    <div class="field-value">{{ $registration->city }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Estado</div>
                    <div class="field-value">{{ $registration->state }}</div>
                </div>
                <div class="field">
                    <div class="field-label">País</div>
                    <div class="field-value">{{ $registration->country }}</div>
                </div>
            </div>
        </div>

        <!-- Informações da Inscrição -->
        <div class="section">
            <h2 class="section-title">Informações da Inscrição</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">Evento</div>
                    <div class="field-value">{{ $registration->event->name ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Data da Inscrição</div>
                    <div class="field-value">{{ $registration->created_at->format('d/m/Y à\s H:i') }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Status do Kit</div>
                    <div class="field-value">
                        @if($registration->has_kit)
                            <span class="badge badge-success">✓ Com Kit</span>
                        @else
                            <span class="badge badge-danger">✗ Sem Kit</span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Aceitou Regulamento</div>
                    <div class="field-value">
                        @if($registration->accepted_regulations)
                            <span class="badge badge-success">✓ Sim</span>
                        @else
                            <span class="badge badge-danger">✗ Não</span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Status</div>
                    <div class="field-value">
                        @if($registration->is_active)
                            <span class="badge badge-info">Ativa</span>
                        @else
                            <span class="badge badge-danger">Inativa</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Este documento foi gerado automaticamente em {{ now()->format('d/m/Y à\s H:i') }}</p>
            <p>Bora de Bike - Sistema de Gestão de Eventos</p>
        </div>
    </div>
</body>
</html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Inscrição - {{ $registration->full_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .header-logo {
            background: white;
            padding: 10px;
            border-radius: 8px;
        }
        
        .header-logo img {
            max-height: 60px;
            max-width: 200px;
        }
        
        .header-title {
            text-align: right;
        }
        
        .header-title h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header-title p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .content {
            padding: 0 30px 30px;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .field {
            margin-bottom: 12px;
        }
        
        .field-label {
            font-weight: bold;
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        
        .field-value {
            color: #111827;
            font-size: 12px;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-logo">
            @if($logoPath && file_exists($logoPath))
                <img src="{{ $logoPath }}" alt="Logo do Site" style="max-width: 200px; height: auto;">
            @elseif($siteLogo)
                <img src="{{ asset('storage/' . $siteLogo) }}" alt="Logo do Site" style="max-width: 200px; height: auto;">
            @else
                <div style="padding: 10px; text-align: center; color: #2563eb; font-weight: bold;">
                    BORA DE BIKE
                </div>
            @endif
        </div>
        <div class="header-title">
            <h1>Comprovante de Inscrição</h1>
            <p>Nº {{ $registration->id }} - {{ $registration->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="content">
        <!-- Dados Pessoais -->
        <div class="section">
            <h2 class="section-title">Dados Pessoais</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">Nome Completo</div>
                    <div class="field-value">{{ $registration->full_name }}</div>
                </div>
                <div class="field">
                    <div class="field-label">CPF</div>
                    <div class="field-value">{{ $registration->formatted_cpf }}</div>
                </div>
                <div class="field">
                    <div class="field-label">E-mail</div>
                    <div class="field-value">{{ $registration->email }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Telefone</div>
                    <div class="field-value">{{ $registration->phone }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Data de Nascimento</div>
                    <div class="field-value">{{ $registration->birth_date->format('d/m/Y') }} ({{ $registration->age }} anos)</div>
                </div>
                <div class="field">
                    <div class="field-label">Gênero</div>
                    <div class="field-value">{{ ucfirst($registration->gender) }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Tamanho da Camisa</div>
                    <div class="field-value">{{ $registration->shirt_size }}</div>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="section">
            <h2 class="section-title">Endereço</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">CEP</div>
                    <div class="field-value">{{ $registration->formatted_zip_code }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Número</div>
                    <div class="field-value">{{ $registration->number }}</div>
                </div>
                <div class="field full-width">
                    <div class="field-label">Endereço</div>
                    <div class="field-value">{{ $registration->address }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Bairro</div>
                    <div class="field-value">{{ $registration->neighborhood }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Cidade</div>
                    <div class="field-value">{{ $registration->city }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Estado</div>
                    <div class="field-value">{{ $registration->state }}</div>
                </div>
                <div class="field">
                    <div class="field-label">País</div>
                    <div class="field-value">{{ $registration->country }}</div>
                </div>
            </div>
        </div>

        <!-- Informações da Inscrição -->
        <div class="section">
            <h2 class="section-title">Informações da Inscrição</h2>
            <div class="grid">
                <div class="field">
                    <div class="field-label">Evento</div>
                    <div class="field-value">{{ $registration->event->name ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Data da Inscrição</div>
                    <div class="field-value">{{ $registration->created_at->format('d/m/Y à\s H:i') }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Status do Kit</div>
                    <div class="field-value">
                        @if($registration->has_kit)
                            <span class="badge badge-success">✓ Com Kit</span>
                        @else
                            <span class="badge badge-danger">✗ Sem Kit</span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Aceitou Regulamento</div>
                    <div class="field-value">
                        @if($registration->accepted_regulations)
                            <span class="badge badge-success">✓ Sim</span>
                        @else
                            <span class="badge badge-danger">✗ Não</span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="field-label">Status</div>
                    <div class="field-value">
                        @if($registration->is_active)
                            <span class="badge badge-info">Ativa</span>
                        @else
                            <span class="badge badge-danger">Inativa</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Este documento foi gerado automaticamente em {{ now()->format('d/m/Y à\s H:i') }}</p>
            <p>Bora de Bike - Sistema de Gestão de Eventos</p>
        </div>
    </div>
</body>
</html>

