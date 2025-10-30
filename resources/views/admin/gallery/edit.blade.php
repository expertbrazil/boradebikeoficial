@extends('layouts.admin')

@section('title', 'Editar Imagem - Admin')
@section('page-title', 'Editar Imagem')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Imagem</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Preview da Imagem Atual -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagem Atual</label>
                    <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <!-- Nova Imagem (opcional) -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Nova Imagem (opcional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a imagem atual. Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 50MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $image->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $image->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Texto Alternativo -->
                <div>
                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">Texto Alternativo</label>
                    <input type="text" id="alt_text" name="alt_text" value="{{ old('alt_text', $image->alt_text) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('alt_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição *</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $image->sort_order) }}" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $image->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Imagem ativa
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.gallery') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Atualizar Imagem
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('title', 'Editar Imagem - Admin')
@section('page-title', 'Editar Imagem')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Imagem</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Preview da Imagem Atual -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagem Atual</label>
                    <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <!-- Nova Imagem (opcional) -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Nova Imagem (opcional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a imagem atual. Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 50MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $image->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $image->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Texto Alternativo -->
                <div>
                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">Texto Alternativo</label>
                    <input type="text" id="alt_text" name="alt_text" value="{{ old('alt_text', $image->alt_text) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('alt_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição *</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $image->sort_order) }}" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $image->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Imagem ativa
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.gallery') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Atualizar Imagem
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
