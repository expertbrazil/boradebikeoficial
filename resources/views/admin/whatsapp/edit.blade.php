@extends('layouts.admin')

@section('title', 'Editar Grupo WhatsApp - Admin')
@section('page-title', 'Editar Grupo de WhatsApp')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('admin.whatsapp.update', $group) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nome do Grupo</label>
            <input type="text" name="name" value="{{ old('name', $group->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">URL do Grupo</label>
            <input type="url" name="url" value="{{ old('url', $group->url) }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('url')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Descrição (opcional)</label>
            <input type="text" name="description" value="{{ old('description', $group->description) }}" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ordem</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $group->sort_order) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                @error('sort_order')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('is_active', $group->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm text-gray-700">Ativo</label>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.whatsapp.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection




@section('title', 'Editar Grupo WhatsApp - Admin')
@section('page-title', 'Editar Grupo de WhatsApp')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('admin.whatsapp.update', $group) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nome do Grupo</label>
            <input type="text" name="name" value="{{ old('name', $group->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">URL do Grupo</label>
            <input type="url" name="url" value="{{ old('url', $group->url) }}" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('url')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Descrição (opcional)</label>
            <input type="text" name="description" value="{{ old('description', $group->description) }}" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ordem</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $group->sort_order) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                @error('sort_order')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('is_active', $group->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 text-sm text-gray-700">Ativo</label>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.whatsapp.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection



