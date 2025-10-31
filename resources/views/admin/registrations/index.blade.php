@extends('layouts.admin')

@section('title', 'Inscrições - Admin')
@section('page-title', 'Inscrições')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Inscrições de Participantes</h2>
    <p class="text-gray-600">Gerencie todas as inscrições do evento</p>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Inscrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($registrations as $registration)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $registration->full_name }}</div>
                        <div class="text-sm text-gray-500">{{ $registration->gender }} - {{ $registration->shirt_size }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $registration->formatted_cpf }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $registration->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $registration->phone }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($registration->has_kit)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Com Kit
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-times mr-1"></i>
                                Sem Kit
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $registration->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.registrations.show', $registration) }}" 
                               class="text-blue-600 hover:text-blue-900" 
                               title="Ver detalhes">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.registrations.pdf', $registration) }}" 
                               class="text-red-600 hover:text-red-900" 
                               title="Baixar PDF"
                               target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2"></i>
                        <p>Nenhuma inscrição encontrada.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($registrations->hasPages())
    <div class="px-6 py-3 border-t">
        {{ $registrations->links() }}
    </div>
    @endif
</div>

<!-- Estatísticas -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total de Inscrições</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $registrations->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-gift text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Com Kit</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $registrations->where('has_kit', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-gray-100 text-gray-600">
                <i class="fas fa-user-slash text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Sem Kit</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $registrations->where('has_kit', false)->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
