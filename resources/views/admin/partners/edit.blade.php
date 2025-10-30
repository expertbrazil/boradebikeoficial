@extends('layouts.admin')

@section('title', 'Editar Parceiro - Admin')
@section('page-title', 'Editar Parceiro')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Parceiro: {{ $partner->name }}</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Parceiro *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $partner->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Logo Atual -->
                @if($partner->logo_path)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Atual</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-auto object-contain border rounded">
                        <div>
                            <p class="text-sm text-gray-600">{{ basename($partner->logo_path) }}</p>
                            <p class="text-xs text-gray-500">Faça upload de uma nova imagem para substituir</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Novo Logo -->
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $partner->logo_path ? 'Novo Logo' : 'Logo *' }}
                    </label>
                    <input type="file" id="logo" name="logo" accept="image/*" {{ !$partner->logo_path ? 'required' : '' }}
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 2MB</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" id="website" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://exemplo.com"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $partner->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição *</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status Ativo -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Parceiro ativo</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">Parceiros inativos não aparecem no site público</p>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.partners') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Atualizar Parceiro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('title', 'Editar Parceiro - Admin')
@section('page-title', 'Editar Parceiro')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Parceiro: {{ $partner->name }}</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Parceiro *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $partner->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Logo Atual -->
                @if($partner->logo_path)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Atual</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-auto object-contain border rounded">
                        <div>
                            <p class="text-sm text-gray-600">{{ basename($partner->logo_path) }}</p>
                            <p class="text-xs text-gray-500">Faça upload de uma nova imagem para substituir</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Novo Logo -->
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $partner->logo_path ? 'Novo Logo' : 'Logo *' }}
                    </label>
                    <input type="file" id="logo" name="logo" accept="image/*" {{ !$partner->logo_path ? 'required' : '' }}
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP. Tamanho máximo: 2MB</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" id="website" name="website" value="{{ old('website', $partner->website) }}" placeholder="https://exemplo.com"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $partner->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição *</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status Ativo -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Parceiro ativo</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">Parceiros inativos não aparecem no site público</p>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.partners') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Atualizar Parceiro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
