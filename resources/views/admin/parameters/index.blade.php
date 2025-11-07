@extends('layouts.admin')

@section('title', 'Parâmetros - Admin')
@section('page-title', 'Parâmetros SMTP')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Parâmetros de E-mail (SMTP)</h3>
            <p class="text-sm text-gray-600">Configure os servidores utilizados para envio de mensagens do sistema</p>
        </div>

        <form method="POST" action="{{ route('admin.parameters.update') }}" class="p-6 space-y-6" id="smtpForm">
            @csrf

            @php
                $smtpHost = App\Models\SiteSetting::get('smtp_host');
                $smtpPort = App\Models\SiteSetting::get('smtp_port');
                $smtpUser = App\Models\SiteSetting::get('smtp_username');
                $smtpEncryption = App\Models\SiteSetting::get('smtp_encryption');
                $smtpFromAddress = App\Models\SiteSetting::get('smtp_from_address');
                $smtpFromName = App\Models\SiteSetting::get('smtp_from_name');
            @endphp

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                <p class="text-sm text-gray-700">
                    Salve as alterações antes de realizar um teste. O envio utiliza sempre as credenciais armazenadas.
                </p>
            </div>

            <div class="space-y-8">
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-server mr-2 text-purple-600"></i>
                        Servidor SMTP
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="smtp_host" class="block text-sm font-medium text-gray-700 mb-1">Servidor (Host)</label>
                            <input type="text" id="smtp_host" name="smtp_host" value="{{ old('smtp_host', $smtpHost) }}"
                                   placeholder="smtp.seudominio.com"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('smtp_host')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_port" class="block text-sm font-medium text-gray-700 mb-1">Porta</label>
                            <input type="number" id="smtp_port" name="smtp_port" value="{{ old('smtp_port', $smtpPort) }}"
                                   placeholder="465"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('smtp_port')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_encryption" class="block text-sm font-medium text-gray-700 mb-1">Criptografia</label>
                            @php
                                $smtpEncryptionSelected = old('smtp_encryption', $smtpEncryption);
                            @endphp
                            <select id="smtp_encryption" name="smtp_encryption"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="" {{ $smtpEncryptionSelected === null || $smtpEncryptionSelected === '' ? 'selected' : '' }}>Padrão da aplicação</option>
                                <option value="ssl" {{ $smtpEncryptionSelected === 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="tls" {{ $smtpEncryptionSelected === 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="starttls" {{ $smtpEncryptionSelected === 'starttls' ? 'selected' : '' }}>STARTTLS</option>
                                <option value="none" {{ $smtpEncryptionSelected === 'none' ? 'selected' : '' }}>Sem criptografia</option>
                            </select>
                            @error('smtp_encryption')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-user-lock mr-2 text-purple-600"></i>
                        Credenciais de acesso
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="smtp_username" class="block text-sm font-medium text-gray-700 mb-1">Usuário</label>
                            <input type="text" id="smtp_username" name="smtp_username" value="{{ old('smtp_username', $smtpUser) }}"
                                   placeholder="usuario@seudominio.com"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('smtp_username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <input type="password" id="smtp_password" name="smtp_password" placeholder="••••••"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <p class="mt-1 text-xs text-gray-500">Deixe em branco para remover a senha atual ou informe uma nova.</p>
                            @error('smtp_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-id-badge mr-2 text-purple-600"></i>
                        Remetente padrão
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="smtp_from_address" class="block text-sm font-medium text-gray-700 mb-1">E-mail Remetente</label>
                            <input type="email" id="smtp_from_address" name="smtp_from_address" value="{{ old('smtp_from_address', $smtpFromAddress) }}"
                                   placeholder="no-reply@seudominio.com"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('smtp_from_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_from_name" class="block text-sm font-medium text-gray-700 mb-1">Nome do Remetente</label>
                            <input type="text" id="smtp_from_name" name="smtp_from_name" value="{{ old('smtp_from_name', $smtpFromName) }}"
                                   placeholder="Equipe Bora de Bike"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('smtp_from_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-purple-50 rounded-lg">
                        <h5 class="text-sm font-medium text-purple-900 mb-2">Dicas rápidas:</h5>
                        <ul class="text-sm text-purple-800 space-y-1">
                            <li>• Essas informações são utilizadas em todos os e-mails enviados pela plataforma.</li>
                            <li>• Se algum campo ficar em branco, o sistema utilizará o valor definido no arquivo .env.</li>
                            <li>• Informe usuário e senha apenas se o servidor exigir autenticação.</li>
                        </ul>
                    </div>
                </div>

                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-paper-plane mr-2 text-purple-600"></i>
                        Testar envio de e-mail
                    </h4>

                    <p class="text-sm text-gray-600 mb-4">Envie um e-mail de teste para confirmar se as credenciais estão corretas.</p>

                    <div class="flex flex-col md:flex-row md:items-end gap-3">
                        <div class="flex-1">
                            <label for="smtp_test_email" class="block text-sm font-medium text-gray-700 mb-1">E-mail destinatário</label>
                            <input type="email" id="smtp_test_email" placeholder="seu-email@seudominio.com"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                        </div>
                        <button type="button" id="smtp_test_button"
                                class="inline-flex items-center justify-center px-4 py-2 bg-white text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors whitespace-nowrap">
                            <i class="fas fa-paper-plane mr-2 text-blue-600"></i>
                            Testar
                        </button>
                    </div>
                    <p id="smtp_test_message" class="text-sm text-gray-600 mt-3"></p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Parâmetros
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const smtpTestButton = document.getElementById('smtp_test_button');
if (smtpTestButton) {
    const smtpTestEmailInput = document.getElementById('smtp_test_email');
    const smtpTestMessage = document.getElementById('smtp_test_message');

    smtpTestButton.addEventListener('click', function () {
        if (!smtpTestEmailInput) {
            return;
        }

        const email = smtpTestEmailInput.value.trim();
        if (!email) {
            smtpTestMessage.textContent = 'Informe um e-mail para realizar o teste.';
            smtpTestMessage.className = 'text-sm text-red-600 mt-2';
            return;
        }

        smtpTestButton.disabled = true;
        smtpTestButton.classList.add('opacity-70');
        smtpTestMessage.textContent = 'Enviando e-mail de teste...';
        smtpTestMessage.className = 'text-sm text-gray-600 mt-2';

        fetch('{{ route('admin.parameters.smtp.test') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ test_email: email })
        })
            .then(async (response) => {
                const data = await response.json();
                if (response.ok && data.success) {
                    smtpTestMessage.textContent = data.message || 'Teste enviado com sucesso! Verifique a caixa de entrada informada.';
                    smtpTestMessage.className = 'text-sm text-green-600 mt-2';
                } else {
                    smtpTestMessage.textContent = data.message || 'Não foi possível enviar o e-mail de teste.';
                    smtpTestMessage.className = 'text-sm text-red-600 mt-2';
                }
            })
            .catch(() => {
                smtpTestMessage.textContent = 'Erro inesperado ao tentar enviar o e-mail de teste.';
                smtpTestMessage.className = 'text-sm text-red-600 mt-2';
            })
            .finally(() => {
                smtpTestButton.disabled = false;
                smtpTestButton.classList.remove('opacity-70');
            });
    });
}
</script>
@endsection


