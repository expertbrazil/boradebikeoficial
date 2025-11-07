<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Bora de Bike')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Assets compilados -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">Bora de Bike</h1>
                <p class="text-sm text-gray-600">Painel Administrativo</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                @can('view-registrations')
                <a href="{{ route('admin.registrations') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.registrations*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Inscrições
                </a>
                @endcan

                @can('view-registrations')
                <a href="{{ route('admin.kits.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.kits*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-box-open mr-3"></i>
                    Entrega de Kits
                </a>
                @endcan

                @can('view-gallery')
                <a href="{{ route('admin.gallery') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.gallery*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-images mr-3"></i>
                    Galeria
                </a>
                @endcan

                @can('view-partners')
                <a href="{{ route('admin.partners') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.partners*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-handshake mr-3"></i>
                    Parceiros
                </a>
                @endcan

                @can('view-events')
                <a href="{{ route('admin.schedule') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.schedule*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-clock mr-3"></i>
                    Programação
                </a>
                @endcan

                @can('view-whatsapp')
                <a href="{{ route('admin.whatsapp.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.whatsapp*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fab fa-whatsapp mr-3"></i>
                    Grupos WhatsApp
                </a>
                @endcan

                @can('view-users')
                <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.users*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-user-cog mr-3"></i>
                    Usuários
                </a>
                @endcan

                @can('assign-roles')
                <a href="{{ route('admin.roles.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.roles*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-user-shield mr-3"></i>
                    Papéis
                </a>
                @endcan

                @can('view-settings')
                <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.settings*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Configurações
                </a>
                @endcan

                @can('view-parameters')
                <a href="{{ route('admin.parameters') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.parameters*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : '' }}">
                    <i class="fas fa-sliders-h mr-3"></i>
                    Parâmetros
                </a>
                @endcan
            </nav>
            
            <div class="absolute bottom-0 w-64 p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Sair
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('home') }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Ver Site
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>
