@extends('layouts.admin')

@section('title', 'Parceiros - Admin')
@section('page-title', 'Parceiros')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Gerenciar Parceiros</h2>
    <a href="{{ route('admin.partners.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Novo Parceiro
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-medium text-gray-900">Lista de Parceiros</h3>
    </div>
    
    @if($partners->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-handshake text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum parceiro encontrado</h3>
            <p class="text-gray-600 mb-4">Comece adicionando parceiros ao projeto</p>
            <a href="{{ route('admin.partners.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Adicionar Primeiro Parceiro
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Website</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criado em</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($partners as $partner)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-12 w-auto object-contain">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $partner->name }}</div>
                                @if($partner->description)
                                    <div class="text-sm text-gray-500">{{ Str::limit($partner->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($partner->website)
                                    <a href="{{ $partner->website }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        Visitar
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $partner->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($partner->is_active)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Ativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>
                                        Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $partner->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.partners.edit', $partner) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este parceiro?')">
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
        
        @if($partners->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">
                {{ $partners->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
