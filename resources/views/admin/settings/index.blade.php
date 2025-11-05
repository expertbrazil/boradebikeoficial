@extends('layouts.admin')

@section('title', 'Configurações - Admin')
@section('page-title', 'Configurações do Site')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Configurações do Site</h3>
            <p class="text-sm text-gray-600">Gerencie as configurações gerais do site</p>
        </div>
        
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="p-6" id="settingsForm">
            @csrf
            
            <!-- Campos ocultos para ações de vídeo -->
            <input type="hidden" name="select_existing_video" id="select_existing_video" value="">
            <input type="hidden" name="delete_video" id="delete_video" value="">
            
            <div class="space-y-8">
                <!-- Logo do Site -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-image mr-2 text-blue-600"></i>
                        Logo do Site Público
                    </h4>
                    
                    @php
                        $currentLogo = App\Models\SiteSetting::get('site_logo');
                    @endphp
                    
                    @if($currentLogo)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Logo atual:</p>
                            <img src="{{ asset('storage/' . $currentLogo) }}" alt="Logo do site" class="h-16 w-auto object-contain border rounded">
                            <p class="text-xs text-gray-500 mt-1">{{ $currentLogo }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-2">
                            Nova Logo do Site
                        </label>
                        <input type="file" id="site_logo" name="site_logo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 50MB
                        </p>
                        @error('site_logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h5 class="text-sm font-medium text-blue-900 mb-2">Como usar:</h5>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• A logo será exibida no cabeçalho do site público</li>
                            <li>• Recomenda-se usar formato WEBP para melhor performance</li>
                            <li>• Tamanho recomendado: 200x80px</li>
                            <li>• Fundo transparente é preferível</li>
                        </ul>
                    </div>
                </div>

                <!-- Foto do Kit -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-gift mr-2 text-orange-600"></i>
                        Foto do Kit do Participante
                    </h4>
                    
                    @php
                        $currentKitPhoto = App\Models\SiteSetting::get('kit_photo');
                    @endphp
                    
                    @if($currentKitPhoto)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto atual do kit:</p>
                            <img src="{{ asset('storage/' . $currentKitPhoto) }}" alt="Foto do kit" class="h-48 w-auto object-contain border rounded">
                            <p class="text-xs text-gray-500 mt-1">{{ $currentKitPhoto }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label for="kit_photo" class="block text-sm font-medium text-gray-700 mb-2">
                            Nova Foto do Kit
                        </label>
                        <input type="file" id="kit_photo" name="kit_photo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 50MB
                        </p>
                        @error('kit_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4 p-4 bg-orange-50 rounded-lg">
                        <h5 class="text-sm font-medium text-orange-900 mb-2">Como usar:</h5>
                        <ul class="text-sm text-orange-800 space-y-1">
                            <li>• A foto será exibida na seção do kit do site público</li>
                            <li>• Recomenda-se usar formato WEBP para melhor performance</li>
                            <li>• Tamanho recomendado: 800x600px</li>
                            <li>• Mostre todos os itens incluídos no kit</li>
                        </ul>
                    </div>
                </div>

                <!-- Data de Encerramento das Inscrições -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-calendar-times mr-2 text-red-600"></i>
                        Data de Encerramento das Inscrições
                    </h4>
                    
                    @php
                        $currentDeadline = App\Models\SiteSetting::get('registration_deadline');
                    @endphp
                    
                    @if($currentDeadline)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Data atual:</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-lg font-medium text-gray-900">{{ \Carbon\Carbon::parse($currentDeadline)->format('d/m/Y') }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($currentDeadline)->format('H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <label for="registration_deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Nova Data de Encerramento
                        </label>
                        <input type="datetime-local" id="registration_deadline" name="registration_deadline" 
                               value="{{ $currentDeadline ? \Carbon\Carbon::parse($currentDeadline)->format('Y-m-d\TH:i') : '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Após esta data, o formulário de inscrição será desabilitado
                        </p>
                        @error('registration_deadline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                        <h5 class="text-sm font-medium text-red-900 mb-2">Importante:</h5>
                        <ul class="text-sm text-red-800 space-y-1">
                            <li>• Após a data definida, inscrições serão bloqueadas</li>
                            <li>• A data deve ser posterior ao dia atual</li>
                            <li>• Configure com antecedência para evitar problemas</li>
                            <li>• Usuários verão aviso quando próximo do prazo</li>
                        </ul>
                    </div>
                </div>

                <!-- Toggle de Inscrições -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-toggle-on mr-2 text-green-600"></i>
                        Controle de Inscrições
                    </h4>
                    
                    @php
                        $registrationEnabled = App\Models\SiteSetting::get('registration_enabled', true);
                    @endphp
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="text-sm font-medium text-gray-900">Habilitar Formulário de Inscrições</h5>
                            <p class="text-sm text-gray-600">Controle se o formulário de inscrições está disponível no site público</p>
                        </div>
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="registration_enabled" value="{{ $registrationEnabled ? 'true' : 'false' }}" id="registration_enabled_hidden">
                                <input type="checkbox" 
                                       id="registration_enabled_checkbox"
                                       {{ $registrationEnabled ? 'checked' : '' }}
                                       class="sr-only peer"
                                       onchange="document.getElementById('registration_enabled_hidden').value = this.checked ? 'true' : 'false';">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900">
                                    {{ $registrationEnabled ? 'Habilitado' : 'Desabilitado' }}
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 {{ $registrationEnabled ? 'bg-green-50' : 'bg-red-50' }} rounded-lg">
                        <h5 class="text-sm font-medium {{ $registrationEnabled ? 'text-green-900' : 'text-red-900' }} mb-2">
                            Status Atual: {{ $registrationEnabled ? 'Habilitado' : 'Desabilitado' }}
                        </h5>
                        <ul class="text-sm {{ $registrationEnabled ? 'text-green-800' : 'text-red-800' }} space-y-1">
                            @if($registrationEnabled)
                                <li>• Formulário de inscrições está visível no site</li>
                                <li>• Usuários podem se inscrever normalmente</li>
                                <li>• Respeita a data de encerramento configurada</li>
                            @else
                                <li>• Formulário de inscrições está oculto</li>
                                <li>• Usuários não conseguem se inscrever</li>
                                <li>• Útil para manutenção ou pausas temporárias</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Arquivo KML do Trajeto -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-route mr-2 text-blue-600"></i>
                        Trajeto do Evento
                    </h4>
                    
                    @php
                        $currentKmlFile = App\Models\SiteSetting::get('kml_route_file');
                        $currentKmlCode = App\Models\SiteSetting::get('kml_route_code');
                    @endphp
                    
                    @if($currentKmlCode)
                        <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                            <p class="text-sm text-green-800 font-semibold mb-2">
                                <i class="fas fa-code mr-2"></i>
                                Código KML está configurado
                            </p>
                            <p class="text-xs text-green-700">
                                O trajeto está sendo exibido usando o código KML fornecido. Você pode substituí-lo pelo código abaixo ou fazer upload de um arquivo.
                            </p>
                        </div>
                    @endif
                    
                    @if($currentKmlFile)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Arquivo KML atual:</p>
                            <div class="bg-gray-50 p-3 rounded-lg flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-mono text-gray-900">{{ basename($currentKmlFile) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $currentKmlFile }}</p>
                                </div>
                                <form method="POST" action="{{ route('admin.settings.update') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="delete_kml_file" value="1">
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors"
                                            onclick="return confirm('Tem certeza que deseja remover o arquivo KML?')">
                                        <i class="fas fa-trash mr-1"></i>
                                        Remover
                                    </button>
                                </form>
                            </div>
                            <a href="{{ asset('storage/' . $currentKmlFile) }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                <i class="fas fa-download mr-1"></i>
                                Baixar arquivo KML
                            </a>
                        </div>
                    @endif
                    
                    <div>
                        <label for="kml_route_file" class="block text-sm font-medium text-gray-700 mb-2">
                            Enviar Arquivo KML/KMZ
                        </label>
                        <input type="file" id="kml_route_file" name="kml_route_file" accept=".kml,.kmz"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Formatos aceitos: KML, KMZ. Tamanho máximo: 10MB. O arquivo será usado para exibir o trajeto diretamente na página inicial do site usando Google Maps.
                        </p>
                        @error('kml_route_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <label for="kml_route_code" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-code mr-2 text-green-600"></i>
                            Ou cole o código KML diretamente
                        </label>
                        <textarea id="kml_route_code" name="kml_route_code" rows="10"
                                  placeholder="Cole aqui o código XML do KML..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 font-mono text-xs">{{ $currentKmlCode }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">
                            Cole o código XML completo do KML aqui. Isso substituirá qualquer arquivo KML enviado anteriormente.
                        </p>
                        @error('kml_route_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h5 class="text-sm font-medium text-blue-900 mb-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Como obter o arquivo KML:
                        </h5>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• <strong>Opção 1 - Arquivo:</strong> Exporte do Google Earth como KML/KMZ e faça upload</li>
                            <li>• <strong>Opção 2 - Código:</strong> Copie o código XML do KML e cole no campo acima</li>
                            <li>• O trajeto será exibido automaticamente no site usando Google Maps</li>
                            <li>• <strong>Nota:</strong> Apenas uma opção será usada (arquivo ou código). A última salva tem prioridade.</li>
                        </ul>
                    </div>
                </div>

                <!-- Vídeo de Fundo -->
                <div class="border rounded-lg p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-video mr-2 text-blue-600"></i>
                        Vídeo de Fundo do Hero Section
                    </h4>
                    
                    @php
                        $currentVideo = App\Models\SiteSetting::get('hero_video');
                    @endphp
                    
                    @if($currentVideo)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Vídeo atual:</p>
                            <video controls class="w-full max-w-md rounded-lg shadow">
                                <source src="{{ asset('storage/' . $currentVideo) }}" type="video/mp4">
                                Seu navegador não suporta vídeos HTML5.
                            </video>
                            <p class="text-xs text-gray-500 mt-1">{{ $currentVideo }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label for="hero_video" class="block text-sm font-medium text-gray-700 mb-2">
                            Novo Vídeo de Fundo
                        </label>
                        <input type="file" id="hero_video" name="hero_video" accept="video/mp4,video/webm,video/ogg"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Formatos aceitos: MP4, WebM, OGG. Tamanho máximo: 100MB
                        </p>
                        @error('hero_video')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h5 class="text-sm font-medium text-blue-900 mb-2">Como usar:</h5>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• O vídeo será exibido como fundo no topo do site</li>
                            <li>• Recomenda-se usar vídeos com duração de 10-30 segundos</li>
                            <li>• Para melhor performance, use vídeos otimizados</li>
                            <li>• O vídeo será reproduzido em loop automático</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Informações sobre o vídeo existente -->
                @if(file_exists(storage_path('app/public/videos')))
                    <div class="border rounded-lg p-6 bg-gray-50">
                        <h4 class="text-md font-medium text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                            Vídeo Existente na Pasta
                        </h4>
                        
                        @php
                            $videoFiles = glob(storage_path('app/public/videos/*.{mp4,webm,ogg}'), GLOB_BRACE);
                        @endphp
                        
                        @if(count($videoFiles) > 0)
                            <div class="space-y-2">
                                @foreach($videoFiles as $videoFile)
                                    @php
                                        $fileName = basename($videoFile);
                                        $fileSize = round(filesize($videoFile) / 1024 / 1024, 2);
                                        $isCurrentVideo = $currentVideo && basename($currentVideo) === $fileName;
                                    @endphp
                                    <div class="flex items-center justify-between p-3 bg-white rounded border {{ $isCurrentVideo ? 'border-blue-500 bg-blue-50' : '' }}">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-video text-red-500 mr-3"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $fileName }}
                                                    @if($isCurrentVideo)
                                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            <i class="fas fa-check mr-1"></i>
                                                            Em uso
                                                        </span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500">{{ $fileSize }} MB</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="text-xs text-gray-500 mr-3">
                                                {{ date('d/m/Y H:i', filemtime($videoFile)) }}
                                            </div>
                                            
                                            @if(!$isCurrentVideo)
                                                <button type="button" onclick="selectVideo('{{ $fileName }}')" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Usar
                                                </button>
                                            @endif
                                            
                                            <button type="button" onclick="deleteVideo('{{ $fileName }}')" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                <i class="fas fa-trash mr-1"></i>
                                                Excluir
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-sm text-gray-600 mt-3">
                                <i class="fas fa-lightbulb mr-1"></i>
                                Clique em "Usar" para selecionar um vídeo existente ou "Excluir" para remover da pasta. Você também pode fazer upload de um novo vídeo.
                            </p>
                        @else
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-folder-open mr-1"></i>
                                Nenhum vídeo encontrado na pasta storage/app/public/videos
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function selectVideo(fileName) {
    document.getElementById('select_existing_video').value = fileName;
    document.getElementById('delete_video').value = '';
    document.getElementById('settingsForm').submit();
}

function deleteVideo(fileName) {
    if (confirm('Tem certeza que deseja excluir este vídeo?')) {
        document.getElementById('delete_video').value = fileName;
        document.getElementById('select_existing_video').value = '';
        document.getElementById('settingsForm').submit();
    }
}

// Garante que o campo hidden seja atualizado antes do submit
document.getElementById('settingsForm').addEventListener('submit', function(e) {
    const checkbox = document.getElementById('registration_enabled_checkbox');
    const hidden = document.getElementById('registration_enabled_hidden');
    if (checkbox && hidden) {
        hidden.value = checkbox.checked ? '1' : '0';
    }
});
</script>
@endsection
