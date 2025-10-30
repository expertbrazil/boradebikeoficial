@extends('layouts.admin')

@section('title', 'Editar Item da Programação - Admin')
@section('page-title', 'Editar Item da Programação')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Item da Programação</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.schedule.update', $scheduleItem) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Horário -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">Horário *</label>
                    <input type="time" id="time" name="time" value="{{ old('time', $scheduleItem->time->format('H:i')) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Horário do evento (ex: 07:00)</p>
                    @error('time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $scheduleItem->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ex: Concentração e Credenciamento">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Descrição detalhada da atividade">{{ old('description', $scheduleItem->description) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Descrição opcional da atividade</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $scheduleItem->sort_order) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro (opcional)</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $scheduleItem->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Item Ativo
                    </label>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.schedule') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('title', 'Editar Item da Programação - Admin')
@section('page-title', 'Editar Item da Programação')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Editar Item da Programação</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.schedule.update', $scheduleItem) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Horário -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">Horário *</label>
                    <input type="time" id="time" name="time" value="{{ old('time', $scheduleItem->time->format('H:i')) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Horário do evento (ex: 07:00)</p>
                    @error('time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $scheduleItem->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ex: Concentração e Credenciamento">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Descrição detalhada da atividade">{{ old('description', $scheduleItem->description) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Descrição opcional da atividade</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ordem -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordem de Exibição</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $scheduleItem->sort_order) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número menor aparece primeiro (opcional)</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $scheduleItem->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Item Ativo
                    </label>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.schedule') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

