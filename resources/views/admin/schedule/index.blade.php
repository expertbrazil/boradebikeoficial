@extends('layouts.admin')

@section('title', 'Programação do Evento - Admin')
@section('page-title', 'Programação do Evento')

@section('content')
<div class="space-y-6">
    <!-- Header com botão de adicionar -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Programação do Evento</h2>
            <p class="text-gray-600 mt-1">Gerencie os horários e atividades do evento</p>
        </div>
        <a href="{{ route('admin.schedule.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Adicionar Item
        </a>
    </div>

    <!-- Lista de itens da programação -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Lista da Programação</h3>
        </div>
        
        @if($scheduleItems->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horário</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($scheduleItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                <span class="text-sm font-medium text-gray-900">{{ $item->formatted_time }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                @if($item->description)
                                    {{ Str::limit($item->description, 50) }}
                                @else
                                    <span class="text-gray-400">Sem descrição</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $item->sort_order }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>
                                    Ativo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1"></i>
                                    Inativo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.schedule.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.schedule.destroy', $item) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este item da programação?')">
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
        
        @if($scheduleItems->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $scheduleItems->links() }}
        </div>
        @endif
        
        @else
        <div class="text-center py-12">
            <i class="fas fa-clock text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum item encontrado</h3>
            <p class="text-gray-600 mb-4">Comece adicionando itens à programação do evento</p>
            <a href="{{ route('admin.schedule.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Adicionar Primeiro Item
            </a>
        </div>
        @endif
    </div>
</div>
@endsection


