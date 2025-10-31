@extends('layouts.admin')

@section('title', 'Grupos de WhatsApp - Admin')
@section('page-title', 'Grupos de WhatsApp')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Grupos de WhatsApp</h2>
        <p class="text-gray-600">Gerencie os links dos grupos/comunidades</p>
    </div>
    <a href="{{ route('admin.whatsapp.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        <i class="fas fa-plus mr-2"></i>Novo Grupo
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ativo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($groups as $group)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="font-medium">{{ $group->name }}</div>
                        @if($group->description)
                        <div class="text-gray-500">{{ $group->description }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-blue-700 break-all">
                        <a href="{{ $group->url }}" target="_blank" class="hover:underline">{{ $group->url }}</a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $group->sort_order }}</td>
                    <td class="px-6 py-4">
                        @if($group->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i> Ativo
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-minus mr-1"></i> Inativo
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.whatsapp.edit', $group) }}" class="text-blue-600 hover:text-blue-900" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.whatsapp.destroy', $group) }}" method="POST" onsubmit="return confirm('Excluir este grupo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum grupo cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($groups->hasPages())
    <div class="px-6 py-3 border-t">
        {{ $groups->links() }}
    </div>
    @endif
</div>
@endsection

