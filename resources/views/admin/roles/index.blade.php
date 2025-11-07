@extends('layouts.admin')

@section('title', 'Papéis - Admin')
@section('page-title', 'Papéis e Permissões')

@section('content')
<div class="mb-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Gerenciamento de Papéis</h2>
        <p class="text-gray-600">Defina quais módulos cada papel pode acessar no painel administrativo.</p>
    </div>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Papel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissões</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($roles as $role)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">{{ $role->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach($role->permissions->pluck('name')->sort() as $permission)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ $permission }}</span>
                            @endforeach
                            @if($role->permissions->isEmpty())
                                <span class="text-xs text-gray-500">Nenhuma permissão atribuída.</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-sm">
                        <a href="{{ route('admin.roles.edit', $role) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-sliders-h mr-2"></i>
                            Configurar módulos
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                        <i class="fas fa-user-lock text-4xl mb-2"></i>
                        <p>Nenhum papel encontrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
