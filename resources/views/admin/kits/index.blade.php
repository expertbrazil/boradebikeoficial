@extends('layouts.admin')

@section('title', 'Entrega de Kits - Admin')
@section('page-title', 'Entrega de Kits')

@section('content')
<div class="mb-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Entrega de Kits</h2>
        <p class="text-gray-600">Gerencie a retirada dos kits pelos participantes</p>
        @if($kitLimit)
        <p class="mt-1 text-sm text-gray-500">Limite configurado: <span class="font-semibold">{{ number_format($kitLimit) }}</span> kits</p>
        @endif
    </div>

    <form method="GET" action="{{ route('admin.kits.index') }}" class="flex flex-col sm:flex-row sm:items-center gap-2">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fas fa-search"></i></span>
            <input type="text" name="search" value="{{ $search }}" placeholder="Código (BB-000123) ou CPF" 
                   class="pl-10 w-64 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <select name="status" class="w-44 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Todos os status</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pendentes</option>
                <option value="delivered" {{ $status === 'delivered' ? 'selected' : '' }}>Entregues</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Buscar
            </button>
            @if($search !== '' || $status !== 'all')
            <a href="{{ route('admin.kits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors">
                Limpar
            </a>
            @endif
        </div>
    </form>
</div>

<!-- Estatísticas rápidas -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex items-center gap-4">
        <div class="p-3 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
            <i class="fas fa-clipboard-check text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600">Kits entregues</p>
            <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalDelivered) }}</p>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex items-center gap-4">
        <div class="p-3 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
            <i class="fas fa-box text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600">Kits pendentes</p>
            <p class="text-2xl font-semibold text-gray-900">{{ number_format($pendingCount) }}</p>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex items-center gap-4">
        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
            <i class="fas fa-weight-hanging text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600">Alimentos em quilos</p>
            <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalFoodKg, 2, ',', '.') }} kg</p>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex items-center gap-4">
        <div class="p-3 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
            <i class="fas fa-tint text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600">Alimentos em litros</p>
            <p class="text-2l font-semibold text-gray-900">{{ number_format($totalFoodLiters, 2, ',', '.') }} L</p>
        </div>
    </div>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cidade/UF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrega</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($registrations as $registration)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">BB-{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</div>
                        <div class="text-xs text-gray-500">{{ $registration->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $registration->full_name }}</div>
                        <div class="text-xs text-gray-500">{{ $registration->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $registration->formatted_cpf }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $registration->city }} / {{ $registration->state }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($registration->kit_delivered_at)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Entregue em {{ $registration->kit_delivered_at->format('d/m/Y H:i') }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1">
                                Quilos: {{ number_format($registration->food_kg ?? 0, 2, ',', '.') }} kg<br>
                                Litros: {{ number_format($registration->food_liters ?? 0, 2, ',', '.') }} L
                            </div>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>
                                Aguardando retirada
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if(!$registration->kit_delivered_at)
                        <form method="POST" action="{{ route('admin.kits.deliver', $registration) }}" class="flex flex-col sm:flex-row sm:items-center gap-2">
                            @csrf
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <div class="flex items-center gap-1">
                                <label for="food_kg_{{ $registration->id }}" class="text-xs text-gray-600">Kg</label>
                                <input type="number" id="food_kg_{{ $registration->id }}" name="food_kg" min="0" max="1000" step="0.1"
                                       value="{{ old('food_kg', $registration->food_kg ?? null) }}"
                                       class="w-24 px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       placeholder="0,0">
                            </div>
                            <div class="flex items-center gap-1">
                                <label for="food_liters_{{ $registration->id }}" class="text-xs text-gray-600">L</label>
                                <input type="number" id="food_liters_{{ $registration->id }}" name="food_liters" min="0" max="1000" step="0.1"
                                       value="{{ old('food_liters', $registration->food_liters ?? null) }}"
                                       class="w-24 px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       placeholder="0,0">
                            </div>
                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded-lg text-xs font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Registrar entrega
                            </button>
                        </form>
                        @else
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                            <div class="flex items-center gap-1">
                                <label class="text-xs text-gray-600">Kg</label>
                                <input type="text" value="{{ number_format($registration->food_kg ?? 0, 2, ',', '.') }}"
                                       class="w-24 px-2 py-1 border border-gray-200 rounded bg-gray-50 text-gray-700 text-sm"
                                       readonly>
                            </div>
                            <div class="flex items-center gap-1">
                                <label class="text-xs text-gray-600">L</label>
                                <input type="text" value="{{ number_format($registration->food_liters ?? 0, 2, ',', '.') }}"
                                       class="w-24 px-2 py-1 border border-gray-200 rounded bg-gray-50 text-gray-700 text-sm"
                                       readonly>
                            </div>
                            <span class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">
                                <i class="fas fa-lock mr-2"></i>Entrega já registrada
                            </span>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-2"></i>
                        <p>Nenhum participante elegível encontrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($registrations->hasPages())
    <div class="px-6 py-3 border-t bg-gray-50">
        {{ $registrations->links() }}
    </div>
    @endif
</div>
@endsection

