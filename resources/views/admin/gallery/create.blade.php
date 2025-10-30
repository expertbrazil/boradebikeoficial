@extends('layouts.admin')

@section('title', 'Nova Imagem - Admin')
@section('page-title', 'Nova Imagem')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Adicionar Nova(s) Imagem(ns)</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Upload Múltiplo -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Imagens *</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Você pode selecionar múltiplas imagens de uma vez. Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo por arquivo: 50MB</p>
                    @error('images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Preview das Imagens Selecionadas -->
                <div id="image-preview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview das Imagens:</label>
                    <div id="preview-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
                </div>
                
                <!-- Configurações Globais -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Configurações Globais (aplicadas a todas as imagens)</h4>
                    
                    <!-- Texto Alternativo Padrão -->
                    <div class="mb-4">
                        <label for="default_alt_text" class="block text-sm font-medium text-gray-700 mb-2">Texto Alternativo Padrão</label>
                        <input type="text" id="default_alt_text" name="default_alt_text" value="{{ old('default_alt_text') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Será aplicado a todas as imagens se não especificado individualmente</p>
                    </div>
                    
                    <!-- Ordem Inicial -->
                    <div class="mb-4">
                        <label for="start_sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem Inicial *</label>
                        <input type="number" id="start_sort_order" name="start_sort_order" value="{{ old('start_sort_order', 0) }}" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">As imagens serão numeradas sequencialmente a partir deste número</p>
                    </div>
                    
                    <!-- Status Padrão -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Padrão</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" checked
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Ativar todas as imagens
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Configurações Individuais -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Configurações Individuais</h4>
                    <p class="text-sm text-gray-600 mb-4">Você pode personalizar cada imagem individualmente após o upload</p>
                    
                    <!-- Container para configurações individuais -->
                    <div id="individual-settings" class="space-y-4"></div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.gallery') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Imagens
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const individualSettings = document.getElementById('individual-settings');
    
    // Limpar preview anterior
    previewContainer.innerHTML = '';
    individualSettings.innerHTML = '';
    
    if (files.length > 0) {
        imagePreview.classList.remove('hidden');
        
        Array.from(files).forEach((file, index) => {
            // Preview da imagem
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative';
                previewDiv.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                    <div class="absolute top-1 left-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">
                        ${file.name}
                    </div>
                `;
                previewContainer.appendChild(previewDiv);
            };
            reader.readAsDataURL(file);
            
            // Configurações individuais
            const settingsDiv = document.createElement('div');
            settingsDiv.className = 'border rounded-lg p-4 bg-gray-50';
            settingsDiv.innerHTML = `
                <h5 class="font-medium text-gray-900 mb-3">${file.name}</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" name="titles[${index}]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Texto Alternativo</label>
                        <input type="text" name="alt_texts[${index}]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea name="descriptions[${index}]" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>
                        <input type="number" name="sort_orders[${index}]" value="${index + 1}" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            `;
            individualSettings.appendChild(settingsDiv);
        });
    } else {
        imagePreview.classList.add('hidden');
    }
});
</script>
@endsection

@section('title', 'Nova Imagem - Admin')
@section('page-title', 'Nova Imagem')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Adicionar Nova(s) Imagem(ns)</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Upload Múltiplo -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Imagens *</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Você pode selecionar múltiplas imagens de uma vez. Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo por arquivo: 50MB</p>
                    @error('images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Preview das Imagens Selecionadas -->
                <div id="image-preview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview das Imagens:</label>
                    <div id="preview-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
                </div>
                
                <!-- Configurações Globais -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Configurações Globais (aplicadas a todas as imagens)</h4>
                    
                    <!-- Texto Alternativo Padrão -->
                    <div class="mb-4">
                        <label for="default_alt_text" class="block text-sm font-medium text-gray-700 mb-2">Texto Alternativo Padrão</label>
                        <input type="text" id="default_alt_text" name="default_alt_text" value="{{ old('default_alt_text') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Será aplicado a todas as imagens se não especificado individualmente</p>
                    </div>
                    
                    <!-- Ordem Inicial -->
                    <div class="mb-4">
                        <label for="start_sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem Inicial *</label>
                        <input type="number" id="start_sort_order" name="start_sort_order" value="{{ old('start_sort_order', 0) }}" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">As imagens serão numeradas sequencialmente a partir deste número</p>
                    </div>
                    
                    <!-- Status Padrão -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Padrão</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" checked
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Ativar todas as imagens
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Configurações Individuais -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Configurações Individuais</h4>
                    <p class="text-sm text-gray-600 mb-4">Você pode personalizar cada imagem individualmente após o upload</p>
                    
                    <!-- Container para configurações individuais -->
                    <div id="individual-settings" class="space-y-4"></div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.gallery') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Imagens
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const individualSettings = document.getElementById('individual-settings');
    
    // Limpar preview anterior
    previewContainer.innerHTML = '';
    individualSettings.innerHTML = '';
    
    if (files.length > 0) {
        imagePreview.classList.remove('hidden');
        
        Array.from(files).forEach((file, index) => {
            // Preview da imagem
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative';
                previewDiv.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                    <div class="absolute top-1 left-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">
                        ${file.name}
                    </div>
                `;
                previewContainer.appendChild(previewDiv);
            };
            reader.readAsDataURL(file);
            
            // Configurações individuais
            const settingsDiv = document.createElement('div');
            settingsDiv.className = 'border rounded-lg p-4 bg-gray-50';
            settingsDiv.innerHTML = `
                <h5 class="font-medium text-gray-900 mb-3">${file.name}</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" name="titles[${index}]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Texto Alternativo</label>
                        <input type="text" name="alt_texts[${index}]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea name="descriptions[${index}]" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>
                        <input type="number" name="sort_orders[${index}]" value="${index + 1}" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            `;
            individualSettings.appendChild(settingsDiv);
        });
    } else {
        imagePreview.classList.add('hidden');
    }
});
</script>
@endsection
