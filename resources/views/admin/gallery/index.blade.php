@extends('layouts.admin')

@section('title', 'Galeria - Admin')
@section('page-title', 'Galeria')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Gerenciar Galeria</h2>
    <a href="{{ route('admin.gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Nova Imagem
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Lista de Imagens</h3>
    </div>
    
    @if($images->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($images as $image)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex-shrink-0 h-16 w-16">
                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}">
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $image->title }}</div>
                        @if($image->alt_text)
                            <div class="text-sm text-gray-500">{{ $image->alt_text }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            @if($image->description)
                                {{ Str::limit($image->description, 50) }}
                            @else
                                <span class="text-gray-400">Sem descrição</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $image->sort_order }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($image->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Ativa
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>
                                Inativa
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.gallery.edit', $image) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta imagem?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($images->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $images->links() }}
    </div>
    @endif
    
    @else
    <div class="text-center py-12">
        <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhuma imagem encontrada</h3>
        <p class="text-gray-600 mb-4">Comece adicionando imagens à galeria</p>
        <a href="{{ route('admin.gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Adicionar Primeira Imagem
        </a>
    </div>
    @endif
</div>
@endsection
