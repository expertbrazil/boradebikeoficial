@extends('layouts.admin')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    <!-- Total Inscrições -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Inscrições</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_registrations']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Kits Utilizados -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-gift text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Kits Utilizados</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_kits_used']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Kits Disponíveis -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-shopping-bag text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Kits Disponíveis</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['remaining_kits']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Imagens na Galeria -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-images text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Imagens na Galeria</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_gallery_images']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Parceiros -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <i class="fas fa-handshake text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Parceiros</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_partners']) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Ações Rápidas -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Ações Rápidas</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                
                
                <a href="{{ route('admin.partners.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <i class="fas fa-handshake text-purple-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-purple-900">Novo Parceiro</p>
                        <p class="text-sm text-purple-700">Adicionar parceiro</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.registrations') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                    <i class="fas fa-list text-orange-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-orange-900">Ver Inscrições</p>
                        <p class="text-sm text-orange-700">Listar participantes</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Aniversariantes do Mês -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Aniversariantes do mês</h3>
        </div>
        <div class="p-6">
            @if($birthdays->count())
            <ul class="divide-y">
                @foreach($birthdays as $b)
                <li class="py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">
                            {{ Str::upper(Str::substr($b->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 leading-tight">{{ $b->full_name }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($b->birth_date)->format('d/m') }}</p>
                        </div>
                    </div>
                    <i class="fas fa-birthday-cake text-pink-500"></i>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500">Nenhum aniversariante este mês.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    <!-- Total Inscrições -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Inscrições</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_registrations']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Kits Utilizados -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-gift text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Kits Utilizados</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_kits_used']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Kits Disponíveis -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-shopping-bag text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Kits Disponíveis</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['remaining_kits']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Imagens na Galeria -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-images text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Imagens na Galeria</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_gallery_images']) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Parceiros -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <i class="fas fa-handshake text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Parceiros</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_partners']) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Ações Rápidas -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Ações Rápidas</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                
                
                <a href="{{ route('admin.partners.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <i class="fas fa-handshake text-purple-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-purple-900">Novo Parceiro</p>
                        <p class="text-sm text-purple-700">Adicionar parceiro</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.registrations') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                    <i class="fas fa-list text-orange-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-orange-900">Ver Inscrições</p>
                        <p class="text-sm text-orange-700">Listar participantes</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Aniversariantes do Mês -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Aniversariantes do mês</h3>
        </div>
        <div class="p-6">
            @if($birthdays->count())
            <ul class="divide-y">
                @foreach($birthdays as $b)
                <li class="py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">
                            {{ Str::upper(Str::substr($b->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 leading-tight">{{ $b->full_name }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($b->birth_date)->format('d/m') }}</p>
                        </div>
                    </div>
                    <i class="fas fa-birthday-cake text-pink-500"></i>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500">Nenhum aniversariante este mês.</p>
            @endif
        </div>
    </div>
</div>
@endsection
