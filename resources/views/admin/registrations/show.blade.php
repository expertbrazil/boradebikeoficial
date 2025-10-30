@extends('layouts.admin')

@section('title', 'Detalhes da Inscrição - Admin')
@section('page-title', 'Detalhes da Inscrição')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Detalhes da Inscrição</h2>
        <p class="text-gray-600">Informações completas do participante</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.registrations') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
        <a href="{{ route('admin.registrations.pdf', $registration) }}" 
           class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
           target="_blank">
            <i class="fas fa-file-pdf mr-2"></i>Baixar PDF
        </a>
    </div>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- Header com Logo e Info Principal -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-bold mb-2">{{ $registration->full_name }}</h3>
                <p class="text-blue-100">
                    <i class="fas fa-calendar mr-2"></i>
                    Inscrição realizada em {{ $registration->created_at->format('d/m/Y à\s H:i') }}
                </p>
            </div>
            @php
                $siteLogo = \App\Models\SiteSetting::get('site_logo');
            @endphp
            @if($siteLogo)
                <div class="bg-white p-3 rounded-lg">
                    <img src="{{ asset('storage/' . $siteLogo) }}" 
                         alt="Logo do Site" 
                         class="h-16 object-contain">
                </div>
            @endif
        </div>
    </div>

    <div class="px-6 py-6">
        <!-- Dados Pessoais -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-user text-blue-600 mr-2"></i>
                Dados Pessoais
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                    <p class="text-gray-900">{{ $registration->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                    <p class="text-gray-900">{{ $registration->formatted_cpf }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <p class="text-gray-900">{{ $registration->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                    <p class="text-gray-900">{{ $registration->phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                    <p class="text-gray-900">{{ $registration->birth_date->format('d/m/Y') }} ({{ $registration->age }} anos)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gênero</label>
                    <p class="text-gray-900">{{ ucfirst($registration->gender) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tamanho da Camisa</label>
                    <p class="text-gray-900">{{ $registration->shirt_size }}</p>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                Endereço
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                    <p class="text-gray-900">{{ $registration->formatted_zip_code }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                    <p class="text-gray-900">{{ $registration->number }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                    <p class="text-gray-900">{{ $registration->address }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                    <p class="text-gray-900">{{ $registration->neighborhood }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                    <p class="text-gray-900">{{ $registration->city }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <p class="text-gray-900">{{ $registration->state }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">País</label>
                    <p class="text-gray-900">{{ $registration->country }}</p>
                </div>
            </div>
        </div>

        <!-- Informações da Inscrição -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informações da Inscrição
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>
                    <p class="text-gray-900">{{ $registration->event->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status do Kit</label>
                    @if($registration->has_kit)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-2"></i>
                            Com Kit
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-times mr-2"></i>
                            Sem Kit
                        </span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Aceitou Regulamento</label>
                    @if($registration->accepted_regulations)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-2"></i>
                            Sim
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-2"></i>
                            Não
                        </span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status da Inscrição</label>
                    @if($registration->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Ativa
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-ban mr-2"></i>
                            Inativa
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('title', 'Detalhes da Inscrição - Admin')
@section('page-title', 'Detalhes da Inscrição')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Detalhes da Inscrição</h2>
        <p class="text-gray-600">Informações completas do participante</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.registrations') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
        <a href="{{ route('admin.registrations.pdf', $registration) }}" 
           class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
           target="_blank">
            <i class="fas fa-file-pdf mr-2"></i>Baixar PDF
        </a>
    </div>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- Header com Logo e Info Principal -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-bold mb-2">{{ $registration->full_name }}</h3>
                <p class="text-blue-100">
                    <i class="fas fa-calendar mr-2"></i>
                    Inscrição realizada em {{ $registration->created_at->format('d/m/Y à\s H:i') }}
                </p>
            </div>
            @php
                $siteLogo = \App\Models\SiteSetting::get('site_logo');
            @endphp
            @if($siteLogo)
                <div class="bg-white p-3 rounded-lg">
                    <img src="{{ asset('storage/' . $siteLogo) }}" 
                         alt="Logo do Site" 
                         class="h-16 object-contain">
                </div>
            @endif
        </div>
    </div>

    <div class="px-6 py-6">
        <!-- Dados Pessoais -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-user text-blue-600 mr-2"></i>
                Dados Pessoais
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                    <p class="text-gray-900">{{ $registration->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                    <p class="text-gray-900">{{ $registration->formatted_cpf }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <p class="text-gray-900">{{ $registration->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                    <p class="text-gray-900">{{ $registration->phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                    <p class="text-gray-900">{{ $registration->birth_date->format('d/m/Y') }} ({{ $registration->age }} anos)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gênero</label>
                    <p class="text-gray-900">{{ ucfirst($registration->gender) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tamanho da Camisa</label>
                    <p class="text-gray-900">{{ $registration->shirt_size }}</p>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                Endereço
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                    <p class="text-gray-900">{{ $registration->formatted_zip_code }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                    <p class="text-gray-900">{{ $registration->number }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                    <p class="text-gray-900">{{ $registration->address }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                    <p class="text-gray-900">{{ $registration->neighborhood }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                    <p class="text-gray-900">{{ $registration->city }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <p class="text-gray-900">{{ $registration->state }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">País</label>
                    <p class="text-gray-900">{{ $registration->country }}</p>
                </div>
            </div>
        </div>

        <!-- Informações da Inscrição -->
        <div class="mb-8">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informações da Inscrição
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Evento</label>
                    <p class="text-gray-900">{{ $registration->event->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status do Kit</label>
                    @if($registration->has_kit)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-2"></i>
                            Com Kit
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-times mr-2"></i>
                            Sem Kit
                        </span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Aceitou Regulamento</label>
                    @if($registration->accepted_regulations)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-2"></i>
                            Sim
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-2"></i>
                            Não
                        </span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status da Inscrição</label>
                    @if($registration->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Ativa
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-ban mr-2"></i>
                            Inativa
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


