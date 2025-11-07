<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exportação de Inscrições</title>
</head>
<body>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Evento</th>
            <th>Nome completo</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de nascimento</th>
            <th>Idade</th>
            <th>Gênero</th>
            <th>Tamanho da camisa</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>País</th>
            <th>Com kit?</th>
            <th>Aceitou termos?</th>
            <th>Aceitou regulamento?</th>
            <th>Ativo?</th>
            <th>Kit entregue em</th>
            <th>Alimento (kg)</th>
            <th>Alimento (litros)</th>
            <th>Data da inscrição</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $registration)
        <tr>
            <td>{{ $registration->id }}</td>
            <td>{{ optional($registration->event)->title }}</td>
            <td>{{ $registration->full_name }}</td>
            <td>{{ $registration->formatted_cpf }}</td>
            <td>{{ $registration->email }}</td>
            <td>{{ $registration->phone }}</td>
            <td>{{ optional($registration->birth_date)?->format('d/m/Y') }}</td>
            <td>{{ optional($registration->birth_date)?->age }}</td>
            <td>{{ $registration->gender }}</td>
            <td>{{ $registration->shirt_size }}</td>
            <td>{{ $registration->formatted_zip_code }}</td>
            <td>{{ $registration->address }}</td>
            <td>{{ $registration->number }}</td>
            <td>{{ $registration->neighborhood }}</td>
            <td>{{ $registration->city }}</td>
            <td>{{ $registration->state }}</td>
            <td>{{ $registration->country }}</td>
            <td>{{ $registration->has_kit ? 'Sim' : 'Não' }}</td>
            <td>{{ $registration->terms_accepted ? 'Sim' : 'Não' }}</td>
            <td>{{ $registration->accepted_regulations ? 'Sim' : 'Não' }}</td>
            <td>{{ $registration->is_active ? 'Sim' : 'Não' }}</td>
            <td>{{ optional($registration->kit_delivered_at)?->format('d/m/Y H:i') }}</td>
            <td>{{ number_format($registration->food_kg ?? 0, 2, ',', '.') }}</td>
            <td>{{ number_format($registration->food_liters ?? 0, 2, ',', '.') }}</td>
            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

