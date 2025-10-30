@extends('layouts.app')

@section('title', 'Bora de Bike - Portal Oficial')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative min-h-screen flex items-center justify-center text-white overflow-hidden">
    @if($heroVideo)
        <!-- Video Background -->
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('storage/' . $heroVideo) }}" type="video/mp4">
        </video>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
    @else
        <!-- Fallback Background -->
        <div class="hero-bg absolute inset-0 w-full h-full z-0"></div>
    @endif
    
    <!-- Content -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Pedale conosco, transforme seu caminho!
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                O maior evento da região dos lagos
            </p>
        </div>
        
        <!-- Countdown Timer -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">Contagem regressiva para o evento:</h3>
            <div class="flex justify-center space-x-4 mb-6">
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="days" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Dias</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="hours" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Horas</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="minutes" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Minutos</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="seconds" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Segundos</div>
                </div>
            </div>
        </div>
        
        <!-- Event Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-calendar-alt text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Data do Evento</h4>
                <p class="text-sm">{{ $event->event_date->format('d/m/Y') }}</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-map-marker-alt text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Local</h4>
                <p class="text-sm">{{ $event->location }}</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-clock text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Horário</h4>
                <p class="text-sm">{{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }}</p>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="mb-8">
            <a href="#registration" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                Inscreva-se Agora
            </a>
        </div>
        
        <!-- Kit Info -->
        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 max-w-2xl mx-auto">
            <h3 class="text-lg font-semibold mb-2">Kit Exclusivo</h3>
            <p class="text-sm mb-4">{{ $event->kit_description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-sm">Kits restantes:</span>
                <span id="remaining-kits" class="text-lg font-bold">{{ $event->getRemainingKits() }}</span>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Sobre o Evento</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: Dia Completo -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bolt text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Dia Completo</h3>
                <p class="text-gray-600">Programação completa para todas as idades, com atividades para toda a família.</p>
            </div>
            
            <!-- Card 2: Comunidade Unida -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Comunidade Unida</h3>
                <p class="text-gray-600">Conecte-se com outros ciclistas e faça parte de uma comunidade apaixonada pelo esporte.</p>
            </div>
            
            <!-- Card 3: Paixão pelo Esporte -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Paixão pelo Esporte</h3>
                <p class="text-gray-600">Celebre o ciclismo e promova um estilo de vida saudável e ativo.</p>
            </div>
        </div>
    </div>
</section>

<!-- Kit Section -->
<section id="kit" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kit do 
                <span class="bg-orange-500 text-white px-3 py-1 rounded-lg">Participante</span>
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Os primeiros inscritos garantem um kit exclusivo com camiseta, mochila e garrafa!
            </p>
            <div class="flex items-center justify-center text-red-600 mb-8">
                <i class="fas fa-gift mr-2"></i>
                <span class="font-semibold">Quantidade limitada!</span>
            </div>
        </div>
        
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Kit Visual -->
            <div class="bg-white rounded-lg p-8 shadow-lg">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kit Completo</h3>
                    @if($kitPhoto)
                        <div class="w-full h-96 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $kitPhoto) }}" alt="Kit do Participante" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="bg-gray-100 rounded-lg p-6">
                            <!-- Kit Items Representation -->
                            <div class="flex flex-col items-center space-y-4">
                                <!-- T-shirts -->
                                <div class="flex space-x-4">
                                    <div class="bg-blue-500 text-white p-4 rounded-lg text-center min-w-[120px]">
                                        <div class="text-xs mb-2">BRB BANCO DE BRASILIA</div>
                                        <div class="text-sm font-bold">Bora Bike</div>
                                        <div class="text-xs">Luzes de Natal</div>
                                    </div>
                                    <div class="bg-blue-500 text-white p-4 rounded-lg text-center min-w-[120px]">
                                        <div class="text-xs mb-2">RECORDTV BRASILIA</div>
                                        <div class="text-xs">BRB BANCO DE BRASILIA</div>
                                        <div class="text-xs mt-2">sabin • Bellavia</div>
                                    </div>
                                </div>
                                
                                <!-- Backpack -->
                                <div class="bg-blue-500 text-white p-3 rounded-lg text-center min-w-[140px]">
                                    <div class="text-sm font-bold">Bora Bike Luzes de Natal</div>
                                    <div class="text-xs">BRB • sabin • Bellavia</div>
                                </div>
                                
                                <!-- Water Bottle -->
                                <div class="bg-white border-2 border-blue-500 p-3 rounded-lg text-center min-w-[80px]">
                                    <div class="text-blue-500 text-xs font-bold">Bora Bike</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Kit Details -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">O que está incluído no kit:</h3>
                <div class="space-y-6">
                    <!-- Camiseta -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Camiseta Esportiva</h4>
                            <p class="text-gray-600">Tecido de alta qualidade com tecnologia dry fit</p>
                        </div>
                    </div>
                    
                    <!-- Mochila -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Mochila Esportiva</h4>
                            <p class="text-gray-600">Ideal para levar seus pertences durante o pedal</p>
                        </div>
                    </div>
                    
                    <!-- Garrafa -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Garrafa de Água</h4>
                            <p class="text-gray-600">Mantenha-se hidratado durante todo o percurso</p>
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="mt-8 text-center">
                    <a href="#registration" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-300">
                        Não perca esta oportunidade! Vagas limitadas!
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="schedule" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Programação do Evento</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Confira a programação completa do evento e prepare-se para um dia incrível de ciclismo
            </p>
        </div>
        
        @if($scheduleItems->count() > 0)
        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-orange-500"></div>
            
            <!-- Timeline Items -->
            <div class="space-y-12">
                @foreach($scheduleItems as $index => $item)
                <div class="relative flex items-center">
                    @if($index % 2 == 0)
                        <!-- Item à esquerda -->
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                                <div class="text-orange-500 font-bold text-lg mb-2">{{ $item->formatted_time }}</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-orange-500 rounded-full"></div>
                        <div class="w-1/2 pl-8"></div>
                    @else
                        <!-- Item à direita -->
                        <div class="w-1/2 pr-8"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-gray-800 rounded-full"></div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                                <div class="text-orange-500 font-bold text-lg mb-2">{{ $item->formatted_time }}</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-clock text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Programação em Construção</h3>
            <p class="text-gray-600 max-w-md mx-auto">
                Em breve você poderá conferir a programação completa do evento.
            </p>
        </div>
        @endif
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Galeria de Fotos</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Confira os melhores momentos dos nossos eventos e a beleza da região dos lagos
            </p>
        </div>
        
        @if($galleryImages->count() > 0)
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleryImages as $image)
                    <div class="relative group card-hover overflow-hidden rounded-lg shadow-lg">
                        <div class="aspect-w-16 aspect-h-12">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->alt_text }}" 
                                 class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500"
                                 data-gallery-image
                                 data-src="{{ asset('storage/' . $image->image_path) }}"
                                 data-title="{{ $image->title }}"
                                 data-description="{{ $image->description }}">
                        </div>
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-lg font-semibold mb-1">{{ $image->title }}</h3>
                        @if($image->description)
                            <p class="text-sm text-gray-200 line-clamp-2">{{ $image->description }}</p>
                        @endif
                    </div>
                </div>
                
                        <!-- Zoom Icon -->
                        <div class="absolute top-4 right-4 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}', '{{ $image->title }}', '{{ $image->description }}')">
                            <i class="fas fa-search-plus text-white text-sm"></i>
                        </div>
            </div>
            @endforeach
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-images text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Galeria em Construção</h3>
            <p class="text-gray-600 max-w-md mx-auto">
                Em breve você poderá conferir as melhores fotos dos nossos eventos e da região dos lagos.
            </p>
        </div>
        @endif
        
        <!-- Modal de Visualização Ampliada -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
            <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center">
                <!-- Botão Fechar -->
                <button onclick="closeImageModal()" class="absolute top-4 right-4 z-60 text-white hover:text-gray-300 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <!-- Imagem -->
                <div class="relative max-w-full max-h-full">
                    <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    
                    <!-- Informações da Imagem -->
                    <div id="modalInfo" class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 rounded-b-lg">
                        <h3 id="modalTitle" class="text-xl font-semibold text-white mb-2"></h3>
                        <p id="modalDescription" class="text-gray-200"></p>
                    </div>
                </div>
                
                <!-- Botões de Navegação (se houver múltiplas imagens) -->
                @if($galleryImages->count() > 1)
                <button id="prevBtn" onclick="navigateImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors bg-black/50 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="nextBtn" onclick="navigateImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors bg-black/50 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section id="partners" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nossos Parceiros</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>
        
        <!-- Slider Container -->
        <div class="relative overflow-hidden">
            <div class="partners-slider flex animate-scroll">
                <!-- Primeira linha de parceiros -->
                @foreach($partners as $partner)
                <div class="flex-shrink-0 mx-4 flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg p-4 h-32 w-40 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                             alt="{{ $partner->name }}" 
                             class="max-h-20 max-w-full object-contain">
                    </div>
                </div>
                @endforeach
                
                <!-- Segunda linha (duplicada para loop infinito) -->
                @foreach($partners as $partner)
                <div class="flex-shrink-0 mx-4 flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg p-4 h-32 w-40 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                             alt="{{ $partner->name }}" 
                             class="max-h-20 max-w-full object-contain">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Registration Section -->
@if($registrationEnabled)
<section id="registration" class="py-20 bg-blue-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Inscreva-se no Evento</h2>
            <p class="text-xl text-blue-100">Preencha o formulário abaixo e garante sua participação</p>
        </div>
        
        <div class="bg-white rounded-lg p-8">
            <form id="registration-form" class="space-y-6">
                @csrf
                
                <!-- Step 1: Personal Info -->
                <div id="step-1" class="step">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold mr-3">1</div>
                        <h3 class="text-xl font-semibold text-gray-900">Dados Pessoais</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                            <input type="text" id="full_name" name="full_name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF *</label>
                            <input type="text" id="cpf" name="cpf" required maxlength="14"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                            <input type="text" id="phone" name="phone" required placeholder="(00) 00000-0000" maxlength="15"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento *</label>
                            <input type="date" id="birth_date" name="birth_date" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gênero *</label>
                            <select id="gender" name="gender" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="shirt_size" class="block text-sm font-medium text-gray-700 mb-2">Tamanho da Camisa *</label>
                            <select id="shirt_size" name="shirt_size" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="PP">PP</option>
                                <option value="P">P</option>
                                <option value="M">M</option>
                                <option value="G">G</option>
                                <option value="GG">GG</option>
                                <option value="XG">XG</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Address Info -->
                <div id="step-2" class="step hidden">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold mr-3">2</div>
                        <h3 class="text-xl font-semibold text-gray-900">Endereço</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">CEP *</label>
                            <input type="text" id="zip_code" name="zip_code" required maxlength="9" placeholder="00000-000"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i> Digite o CEP e o endereço será preenchido automaticamente
                            </p>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label>
                            <input type="text" id="address" name="address" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700 mb-2">Número *</label>
                            <input type="text" id="number" name="number" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-2">Bairro *</label>
                            <input type="text" id="neighborhood" name="neighborhood" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                            <input type="text" id="city" name="city" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                            <select id="state" name="state" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Terms -->
                <div id="step-3" class="step hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Termos e Condições</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informações Importantes:</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• O evento será realizado em {{ $event->location }} no dia {{ $event->event_date->format('d/m/Y') }}</li>
                            <li>• O kit será entregue apenas para os primeiros {{ $event->kit_limit }} inscritos</li>
                            <li>• É obrigatório o uso de capacete durante todo o percurso</li>
                            <li>• O participante deve estar em boas condições físicas para participar</li>
                            <li>• Em caso de cancelamento, o reembolso será feito conforme política do evento</li>
                        </ul>
                    </div>
                    
                    <div class="flex items-start">
                        <input type="checkbox" id="accepted_regulations" name="accepted_regulations" value="1" required
                               class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="accepted_regulations" class="ml-2 text-sm text-gray-700">
                            Li e aceito o regulamento do Bora Bike 2025. *
                        </label>
                    </div>
                </div>
                
                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-6">
                    <button type="button" id="prev-btn" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 hidden">
                        Anterior
                    </button>
                    <button type="button" id="next-btn" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Próximo
                    </button>
                    <button type="submit" id="submit-btn" class="px-8 py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 transition-colors hidden">
                        Realizar Inscrição
                    </button>
                </div>
            </form>
            
            <!-- Success Message -->
            <div id="success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Inscrição realizada com sucesso! Você receberá um e-mail de confirmação.</span>
                </div>
            </div>
            
            <!-- Error Message -->
            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="error-text">Ocorreu um erro. Tente novamente.</span>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- WhatsApp Groups Section shown when registrations are disabled -->
@if(isset($whatsappGroups) && $whatsappGroups->count() > 0)
<section class="py-20 bg-white" id="whatsapp">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <i class="fab fa-whatsapp text-green-500 text-6xl mb-4"></i>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Entre nos nossos grupos do WhatsApp!</h2>
            <p class="text-lg text-gray-600 mb-8">Conecte-se com outros ciclistas, receba dicas, participe de eventos futuros e muito mais!</p>
        </div>

        @php $firstGroup = $whatsappGroups->first(); @endphp

        <div class="mt-8 flex flex-col items-center">
            @if($firstGroup)
            <a id="wa-random-btn" href="{{ $firstGroup->url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg text-lg font-medium shadow-lg transition-colors">
                <i class="fab fa-whatsapp mr-3 text-xl"></i>
                Entrar em um grupo de WhatsApp
            </a>

            <div class="mt-10 flex flex-col items-center">
                <img id="wa-random-qr" src="https://api.qrserver.com/v1/create-qr-code/?size=256x256&data={{ urlencode($firstGroup->url) }}" alt="QR Code do Grupo" class="mx-auto border-2 border-gray-200 rounded-lg p-2 bg-white">
                <p class="text-center text-gray-500 mt-3 text-sm">Aponte a câmera para entrar</p>
            </div>
            @endif

            @if($whatsappGroups->count() > 1)
            <div class="mt-12 w-full">
                <h3 class="text-xl font-semibold text-gray-900 text-center mb-6">Outros grupos disponíveis</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($whatsappGroups->slice(1) as $group)
                    <a href="{{ $group->url }}" target="_blank" class="flex items-center px-4 py-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-colors">
                        <i class="fab fa-whatsapp text-green-600 mr-3 text-xl"></i>
                        <div>
                            <div class="font-medium text-gray-900">{{ $group->name }}</div>
                            @if($group->description)
                            <div class="text-sm text-gray-600">{{ $group->description }}</div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
@endif

@if(isset($whatsappGroups) && $whatsappGroups->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urls = @json($whatsappGroups->pluck('url')->values());
    if (!Array.isArray(urls) || urls.length === 0) return;

    // Sorteia uma URL ao carregar a página
    const randomUrl = urls[Math.floor(Math.random() * urls.length)];

    // Atualiza o botão principal
    const btn = document.getElementById('wa-random-btn');
    if (btn) {
        btn.href = randomUrl;
    }

    // Atualiza o QR Code
    const qr = document.getElementById('wa-random-qr');
    if (qr) {
        const base = 'https://api.qrserver.com/v1/create-qr-code/?size=256x256&data=';
        qr.src = base + encodeURIComponent(randomUrl);
    }
});
</script>
@endif
@endsection

<script>
// Variáveis globais para o modal
let currentImageIndex = 0;
let galleryImages = [];

// Inicializar array de imagens quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    const imageElements = document.querySelectorAll('[data-gallery-image]');
    galleryImages = Array.from(imageElements).map(img => ({
        src: img.dataset.src,
        title: img.dataset.title,
        description: img.dataset.description
    }));
});

// Função para abrir o modal
function openImageModal(src, title, description) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    // Encontrar o índice da imagem atual
    currentImageIndex = galleryImages.findIndex(img => img.src === src);
    
    // Configurar o modal
    modalImage.src = src;
    modalImage.alt = title;
    modalTitle.textContent = title;
    modalDescription.textContent = description || '';
    
    // Mostrar o modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevenir scroll da página
    
    // Adicionar efeito de fade-in
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

// Função para fechar o modal
function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restaurar scroll da página
}

// Função para navegar entre imagens
function navigateImage(direction) {
    if (galleryImages.length <= 1) return;
    
    currentImageIndex += direction;
    
    // Loop circular
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    
    const currentImage = galleryImages[currentImageIndex];
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    // Atualizar com efeito de fade
    modalImage.style.opacity = '0';
    
    setTimeout(() => {
        modalImage.src = currentImage.src;
        modalImage.alt = currentImage.title;
        modalTitle.textContent = currentImage.title;
        modalDescription.textContent = currentImage.description || '';
        modalImage.style.opacity = '1';
    }, 150);
}

// Fechar modal com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Fechar modal clicando fora da imagem
const imageModal = document.getElementById('imageModal');
if (imageModal) {
    imageModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });
}

// Navegação com teclado
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (!modal.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') {
            navigateImage(-1);
        } else if (e.key === 'ArrowRight') {
            navigateImage(1);
        }
    }
});
</script>

@push('scripts')
<script>
// Countdown Timer
function updateCountdown() {
    const eventDate = new Date('{{ $event->event_date->format("Y-m-d") }} {{ $event->start_time->format("H:i:s") }}').getTime();
    const now = new Date().getTime();
    const distance = eventDate - now;
    
    if (distance < 0) {
        document.getElementById('days').innerHTML = '00';
        document.getElementById('hours').innerHTML = '00';
        document.getElementById('minutes').innerHTML = '00';
        document.getElementById('seconds').innerHTML = '00';
        return;
    }
    
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById('days').innerHTML = days.toString().padStart(2, '0');
    document.getElementById('hours').innerHTML = hours.toString().padStart(2, '0');
    document.getElementById('minutes').innerHTML = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').innerHTML = seconds.toString().padStart(2, '0');
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown();

// Form Step Management
let currentStep = 1;
const totalSteps = 3;

// Check if registration form exists
const registrationForm = document.getElementById('registration-form');

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
    
    // Show current step
    const currentStepEl = document.getElementById(`step-${step}`);
    if (currentStepEl) {
        currentStepEl.classList.remove('hidden');
    }
    
    // Update navigation buttons
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    
    if (prevBtn) prevBtn.classList.toggle('hidden', step === 1);
    if (nextBtn) nextBtn.classList.toggle('hidden', step === totalSteps);
    if (submitBtn) submitBtn.classList.toggle('hidden', step !== totalSteps);
}

// Navigation buttons (já declarados no showStep, reutilizando)
const nextBtnEl = document.getElementById('next-btn');
if (nextBtnEl) {
    nextBtnEl.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });
}

const prevBtnEl = document.getElementById('prev-btn');
if (prevBtnEl) {
    prevBtnEl.addEventListener('click', function() {
        currentStep--;
        showStep(currentStep);
    });
}

function validateStep(step) {
    const stepElement = document.getElementById(`step-${step}`);
    if (!stepElement) {
        console.error('Step element not found:', step);
        return false;
    }
    
    const requiredFields = stepElement.querySelectorAll('[required]');
    
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            field.focus();
            showError('Por favor, preencha todos os campos obrigatórios.');
            return false;
        }
    }
    
    // Additional validations
    if (step === 1) {
        const cpfField = document.getElementById('cpf');
        if (!cpfField) {
            return false;
        }
        const cpf = cpfField.value;
        
        if (cpf.length === 14) {
            if (!validateCPF(cpf)) {
                cpfField.focus();
                cpfField.classList.add('border-red-500');
                showError('Por favor, informe um CPF válido.');
                
                // Adiciona mensagem de erro se não existir
                const cpfFieldParent = cpfField.parentElement;
                const existingMsg = cpfFieldParent.querySelector('.cpf-validation-message');
                if (!existingMsg || !existingMsg.classList.contains('text-red-600')) {
                    const existingMsgToRemove = cpfFieldParent.querySelector('.cpf-validation-message');
                    if (existingMsgToRemove) existingMsgToRemove.remove();
                    
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'cpf-validation-message mt-1 text-sm text-red-600';
                    errorDiv.innerHTML = '<i class="fas fa-times-circle mr-1"></i> CPF inválido';
                    cpfFieldParent.appendChild(errorDiv);
                }
                return false;
            }
        } else if (cpf.length > 0) {
            cpfField.focus();
            showError('CPF incompleto. Por favor, preencha todos os dígitos.');
            return false;
        }
    }
    
    return true;
}

function validateCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/[^\d]/g, '');
    
    // Verifica se tem 11 dígitos
    if (cpf.length !== 11) return false;
    
    // Verifica se todos os dígitos são iguais (CPFs inválidos)
    if (/^(\d)\1+$/.test(cpf)) return false;
    
    // Validação dos dígitos verificadores
    let sum = 0;
    let remainder;
    
    // Valida primeiro dígito verificador
    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;
    
    // Valida segundo dígito verificador
    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(10, 11))) return false;
    
    return true;
}

// CPF formatting and validation
const cpfInputElement = document.getElementById('cpf');
if (cpfInputElement) {
    cpfInputElement.addEventListener('input', function(e) {
    const cpfInput = e.target;
    const cpfFieldParent = cpfInput.parentElement;
    
    // Formata o CPF
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    e.target.value = value;
    
    // Remove mensagens anteriores
    const existingMsg = cpfFieldParent.querySelector('.cpf-validation-message');
    if (existingMsg) {
        existingMsg.remove();
    }
    
    // Remove classes de validação
    cpfInput.classList.remove('border-green-500', 'border-red-500');
    
    // Valida quando o CPF está completo (14 caracteres com máscara)
    if (value.length === 14) {
        if (validateCPF(value)) {
            // CPF válido
            cpfInput.classList.add('border-green-500');
            const successDiv = document.createElement('div');
            successDiv.className = 'cpf-validation-message mt-1 text-sm text-green-600';
            successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> CPF válido';
            cpfFieldParent.appendChild(successDiv);
        } else {
            // CPF inválido
            cpfInput.classList.add('border-red-500');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'cpf-validation-message mt-1 text-sm text-red-600';
            errorDiv.innerHTML = '<i class="fas fa-times-circle mr-1"></i> CPF inválido';
            cpfFieldParent.appendChild(errorDiv);
        }
    } else if (value.length > 0 && value.length < 14) {
        // CPF incompleto - remove mensagens
        cpfInput.classList.remove('border-green-500', 'border-red-500');
    }
    });
}

// Phone formatting - formato brasileiro
const phoneField = document.getElementById('phone');
if (phoneField) {
    phoneField.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    // Limita a 11 dígitos (DDD + número)
    if (value.length > 11) {
        value = value.substring(0, 11);
    }
    
    // Detecta se é celular (terceiro dígito após DDD é 9)
    const isMobile = value.length >= 3 && value.charAt(2) === '9';
    
    // Aplica máscara incremental
    if (value.length <= 2) {
        // Apenas DDD: (XX
        value = value.length > 0 ? `(${value}` : '';
    } else if (isMobile) {
        // Celular: (XX) 9XXXX-XXXX
        if (value.length <= 7) {
            value = value.replace(/(\d{2})(\d{5})/, '($1) $2');
        } else {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
    } else {
        // Telefone fixo: (XX) XXXX-XXXX
        if (value.length <= 6) {
            value = value.replace(/(\d{2})(\d{4})/, '($1) $2');
        } else {
            value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
    }
    
    e.target.value = value;
    });
}

// ZIP code formatting and auto-fill via ViaCEP
const zipCodeField = document.getElementById('zip_code');
if (zipCodeField) {
    zipCodeField.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{5})(\d)/, '$1-$2');
    e.target.value = value;
    
    // Remove mensagem de erro anterior
    const errorMsg = document.getElementById('cep-error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
    
    // Remove indicador de loading anterior
    const loadingIndicator = document.getElementById('cep-loading');
    if (loadingIndicator) {
        loadingIndicator.remove();
    }
    
    // Verifica se o CEP tem 9 caracteres (com hífen)
    if (value.length === 9) {
        const cepInput = document.getElementById('zip_code');
        const cepField = cepInput.parentElement;
        
        // Adiciona indicador de loading
        const loadingDiv = document.createElement('div');
        loadingDiv.id = 'cep-loading';
        loadingDiv.className = 'mt-1 text-sm text-blue-600';
        loadingDiv.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Buscando CEP...';
        cepField.appendChild(loadingDiv);
        
        // Remove hífen do CEP para a consulta
        const cepClean = value.replace('-', '');
        
        // Busca o CEP na API ViaCEP
        fetch(`https://viacep.com.br/ws/${cepClean}/json/`)
            .then(response => response.json())
            .then(data => {
                // Remove loading indicator
                if (loadingIndicator || document.getElementById('cep-loading')) {
                    const loadingEl = document.getElementById('cep-loading');
                    if (loadingEl) loadingEl.remove();
                }
                
                if (data.erro) {
                    // CEP não encontrado
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'cep-error-message';
                    errorDiv.className = 'mt-1 text-sm text-red-600';
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> CEP não encontrado. Por favor, preencha o endereço manualmente.';
                    cepField.appendChild(errorDiv);
                    
                    // Limpa os campos de endereço
                    document.getElementById('address').value = '';
                    document.getElementById('neighborhood').value = '';
                    document.getElementById('city').value = '';
                    document.getElementById('state').value = 'RJ';
                } else {
                    // Preenche os campos automaticamente
                    document.getElementById('address').value = data.logradouro || '';
                    document.getElementById('neighborhood').value = data.bairro || '';
                    document.getElementById('city').value = data.localidade || '';
                    document.getElementById('state').value = data.uf || 'RJ';
                    
                    // Adiciona mensagem de sucesso
                    const successDiv = document.createElement('div');
                    successDiv.id = 'cep-success-message';
                    successDiv.className = 'mt-1 text-sm text-green-600';
                    successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Endereço encontrado!';
                    cepField.appendChild(successDiv);
                    
                    // Remove mensagem de sucesso após 3 segundos
                    setTimeout(() => {
                        const successMsg = document.getElementById('cep-success-message');
                        if (successMsg) successMsg.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                // Remove loading indicator em caso de erro
                const loadingEl = document.getElementById('cep-loading');
                if (loadingEl) loadingEl.remove();
                
                // Mostra mensagem de erro
                const errorDiv = document.createElement('div');
                errorDiv.id = 'cep-error-message';
                errorDiv.className = 'mt-1 text-sm text-red-600';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Erro ao buscar CEP. Por favor, tente novamente ou preencha manualmente.';
                document.getElementById('zip_code').parentElement.appendChild(errorDiv);
                
                console.error('Erro ao buscar CEP:', error);
            });
    } else if (value.length > 0 && value.length < 9) {
        // Remove campos de endereço se o CEP for incompleto
        const addressField = document.getElementById('address');
        const neighborhoodField = document.getElementById('neighborhood');
        const cityField = document.getElementById('city');
        const stateField = document.getElementById('state');
        
        if (addressField && addressField.value && addressField.value.includes('ViaCEP')) {
            addressField.value = '';
            neighborhoodField.value = '';
            cityField.value = '';
            stateField.value = 'RJ';
        }
    }
    });
}

// Busca CEP quando o usuário sair do campo (blur) se o CEP estiver completo
if (zipCodeField) {
    zipCodeField.addEventListener('blur', function(e) {
    const value = e.target.value.replace(/\D/g, '');
    
    // Se o CEP tem 8 dígitos mas não tem hífen, formata e busca
    if (value.length === 8 && !e.target.value.includes('-')) {
        e.target.value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
        
        // Dispara o evento de input para buscar o CEP
        const inputEvent = new Event('input', { bubbles: true });
        e.target.dispatchEvent(inputEvent);
    }
    });
}

// Form submission
if (registrationForm) {
    registrationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateStep(currentStep)) return;
        
        // Valida checkbox do regulamento
        const acceptedRegulationsCheckbox = document.getElementById('accepted_regulations');
        if (!acceptedRegulationsCheckbox || !acceptedRegulationsCheckbox.checked) {
            showError('É necessário aceitar o regulamento do evento para continuar.');
            if (acceptedRegulationsCheckbox) {
                acceptedRegulationsCheckbox.focus();
            }
            return;
        }
        
        // Desabilita o botão de submit durante o processamento
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processando...';
        }
        
        const formData = new FormData(this);
        
        // Garante que o checkbox seja enviado com valor "1"
        if (acceptedRegulationsCheckbox && acceptedRegulationsCheckbox.checked) {
            formData.set('accepted_regulations', '1');
        }
        
        fetch('{{ route("registration.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            // Verifica se a resposta é JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                // Se não for JSON, tenta ler como texto para ver o erro
                const text = await response.text();
                console.error('Resposta não JSON:', text);
                throw new Error('Resposta inválida do servidor');
            }
            
            // Verifica se a resposta foi bem-sucedida
            if (!response.ok) {
                const errorData = await response.json();
                throw { response, errorData };
            }
            
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showSuccess(data.message || 'Inscrição realizada com sucesso!');
                registrationForm.reset();
                currentStep = 1;
                showStep(currentStep);
                
                // Update remaining kits if element exists
                if (data.remaining_kits !== undefined) {
                    const remainingKitsEl = document.getElementById('remaining-kits');
                    const kitCounterEl = document.getElementById('kit-counter');
                    if (remainingKitsEl) remainingKitsEl.textContent = data.remaining_kits;
                    if (kitCounterEl) kitCounterEl.textContent = data.remaining_kits;
                }
            } else {
                // Mostra mensagem de erro ou erros de validação
                let errorMessage = data.message || 'Ocorreu um erro. Tente novamente.';
                
                if (data.errors) {
                    // Se houver erros de validação, mostra o primeiro
                    const firstError = Object.values(data.errors)[0];
                    if (Array.isArray(firstError)) {
                        errorMessage = firstError[0];
                    } else {
                        errorMessage = firstError;
                    }
                }
                
                showError(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            let errorMessage = 'Ocorreu um erro. Tente novamente.';
            
            // Se for erro de validação com dados
            if (error.errorData) {
                if (error.errorData.errors) {
                    const firstError = Object.values(error.errorData.errors)[0];
                    if (Array.isArray(firstError)) {
                        errorMessage = firstError[0];
                    } else {
                        errorMessage = firstError;
                    }
                } else if (error.errorData.message) {
                    errorMessage = error.errorData.message;
                }
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            showError(errorMessage);
        })
        .finally(() => {
            // Reabilita o botão de submit
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Realizar Inscrição';
            }
        });
    });
}

function showSuccess(message) {
    const successMessage = document.getElementById('success-message');
    const successText = document.getElementById('success-text');
    
    if (successMessage) {
        if (successText && message) {
            successText.textContent = message;
        }
        successMessage.classList.remove('hidden');
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.classList.add('hidden');
        }
        setTimeout(() => {
            successMessage.classList.add('hidden');
        }, 5000);
    }
}

function showError(message) {
    document.getElementById('error-text').textContent = message;
    document.getElementById('error-message').classList.remove('hidden');
    document.getElementById('success-message').classList.add('hidden');
    setTimeout(() => {
        document.getElementById('error-message').classList.add('hidden');
    }, 5000);
}

// Initialize form (only if registration form exists)
if (registrationForm) {
    showStep(currentStep);
}
</script>
@endpush
@section('title', 'Bora de Bike - Portal Oficial')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative min-h-screen flex items-center justify-center text-white overflow-hidden">
    @if($heroVideo)
        <!-- Video Background -->
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('storage/' . $heroVideo) }}" type="video/mp4">
        </video>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
    @else
        <!-- Fallback Background -->
        <div class="hero-bg absolute inset-0 w-full h-full z-0"></div>
    @endif
    
    <!-- Content -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Pedale conosco, transforme seu caminho!
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                O maior evento da região dos lagos
            </p>
        </div>
        
        <!-- Countdown Timer -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">Contagem regressiva para o evento:</h3>
            <div class="flex justify-center space-x-4 mb-6">
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="days" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Dias</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="hours" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Horas</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="minutes" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Minutos</div>
                </div>
                <div class="countdown-item rounded-lg p-4 text-center min-w-[80px]">
                    <div id="seconds" class="text-2xl font-bold">00</div>
                    <div class="text-sm">Segundos</div>
                </div>
            </div>
        </div>
        
        <!-- Event Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-calendar-alt text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Data do Evento</h4>
                <p class="text-sm">{{ $event->event_date->format('d/m/Y') }}</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-map-marker-alt text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Local</h4>
                <p class="text-sm">{{ $event->location }}</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 text-center">
                <i class="fas fa-clock text-3xl mb-4"></i>
                <h4 class="text-lg font-semibold mb-2">Horário</h4>
                <p class="text-sm">{{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }}</p>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="mb-8">
            <a href="#registration" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                Inscreva-se Agora
            </a>
        </div>
        
        <!-- Kit Info -->
        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-lg p-6 max-w-2xl mx-auto">
            <h3 class="text-lg font-semibold mb-2">Kit Exclusivo</h3>
            <p class="text-sm mb-4">{{ $event->kit_description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-sm">Kits restantes:</span>
                <span id="remaining-kits" class="text-lg font-bold">{{ $event->getRemainingKits() }}</span>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Sobre o Evento</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: Dia Completo -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bolt text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Dia Completo</h3>
                <p class="text-gray-600">Programação completa para todas as idades, com atividades para toda a família.</p>
            </div>
            
            <!-- Card 2: Comunidade Unida -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Comunidade Unida</h3>
                <p class="text-gray-600">Conecte-se com outros ciclistas e faça parte de uma comunidade apaixonada pelo esporte.</p>
            </div>
            
            <!-- Card 3: Paixão pelo Esporte -->
            <div class="bg-white rounded-lg p-8 text-center card-hover shadow-lg">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Paixão pelo Esporte</h3>
                <p class="text-gray-600">Celebre o ciclismo e promova um estilo de vida saudável e ativo.</p>
            </div>
        </div>
    </div>
</section>

<!-- Kit Section -->
<section id="kit" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kit do 
                <span class="bg-orange-500 text-white px-3 py-1 rounded-lg">Participante</span>
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Os primeiros inscritos garantem um kit exclusivo com camiseta, mochila e garrafa!
            </p>
            <div class="flex items-center justify-center text-red-600 mb-8">
                <i class="fas fa-gift mr-2"></i>
                <span class="font-semibold">Quantidade limitada!</span>
            </div>
        </div>
        
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Kit Visual -->
            <div class="bg-white rounded-lg p-8 shadow-lg">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kit Completo</h3>
                    @if($kitPhoto)
                        <div class="w-full h-96 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $kitPhoto) }}" alt="Kit do Participante" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="bg-gray-100 rounded-lg p-6">
                            <!-- Kit Items Representation -->
                            <div class="flex flex-col items-center space-y-4">
                                <!-- T-shirts -->
                                <div class="flex space-x-4">
                                    <div class="bg-blue-500 text-white p-4 rounded-lg text-center min-w-[120px]">
                                        <div class="text-xs mb-2">BRB BANCO DE BRASILIA</div>
                                        <div class="text-sm font-bold">Bora Bike</div>
                                        <div class="text-xs">Luzes de Natal</div>
                                    </div>
                                    <div class="bg-blue-500 text-white p-4 rounded-lg text-center min-w-[120px]">
                                        <div class="text-xs mb-2">RECORDTV BRASILIA</div>
                                        <div class="text-xs">BRB BANCO DE BRASILIA</div>
                                        <div class="text-xs mt-2">sabin • Bellavia</div>
                                    </div>
                                </div>
                                
                                <!-- Backpack -->
                                <div class="bg-blue-500 text-white p-3 rounded-lg text-center min-w-[140px]">
                                    <div class="text-sm font-bold">Bora Bike Luzes de Natal</div>
                                    <div class="text-xs">BRB • sabin • Bellavia</div>
                                </div>
                                
                                <!-- Water Bottle -->
                                <div class="bg-white border-2 border-blue-500 p-3 rounded-lg text-center min-w-[80px]">
                                    <div class="text-blue-500 text-xs font-bold">Bora Bike</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Kit Details -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">O que está incluído no kit:</h3>
                <div class="space-y-6">
                    <!-- Camiseta -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Camiseta Esportiva</h4>
                            <p class="text-gray-600">Tecido de alta qualidade com tecnologia dry fit</p>
                        </div>
                    </div>
                    
                    <!-- Mochila -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Mochila Esportiva</h4>
                            <p class="text-gray-600">Ideal para levar seus pertences durante o pedal</p>
                        </div>
                    </div>
                    
                    <!-- Garrafa -->
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-2">Garrafa de Água</h4>
                            <p class="text-gray-600">Mantenha-se hidratado durante todo o percurso</p>
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="mt-8 text-center">
                    <a href="#registration" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-300">
                        Não perca esta oportunidade! Vagas limitadas!
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="schedule" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Programação do Evento</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Confira a programação completa do evento e prepare-se para um dia incrível de ciclismo
            </p>
        </div>
        
        @if($scheduleItems->count() > 0)
        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-orange-500"></div>
            
            <!-- Timeline Items -->
            <div class="space-y-12">
                @foreach($scheduleItems as $index => $item)
                <div class="relative flex items-center">
                    @if($index % 2 == 0)
                        <!-- Item à esquerda -->
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                                <div class="text-orange-500 font-bold text-lg mb-2">{{ $item->formatted_time }}</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-orange-500 rounded-full"></div>
                        <div class="w-1/2 pl-8"></div>
                    @else
                        <!-- Item à direita -->
                        <div class="w-1/2 pr-8"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-gray-800 rounded-full"></div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                                <div class="text-orange-500 font-bold text-lg mb-2">{{ $item->formatted_time }}</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-600">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-clock text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Programação em Construção</h3>
            <p class="text-gray-600 max-w-md mx-auto">
                Em breve você poderá conferir a programação completa do evento.
            </p>
        </div>
        @endif
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Galeria de Fotos</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Confira os melhores momentos dos nossos eventos e a beleza da região dos lagos
            </p>
        </div>
        
        @if($galleryImages->count() > 0)
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleryImages as $image)
                    <div class="relative group card-hover overflow-hidden rounded-lg shadow-lg">
                        <div class="aspect-w-16 aspect-h-12">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->alt_text }}" 
                                 class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500"
                                 data-gallery-image
                                 data-src="{{ asset('storage/' . $image->image_path) }}"
                                 data-title="{{ $image->title }}"
                                 data-description="{{ $image->description }}">
                        </div>
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-lg font-semibold mb-1">{{ $image->title }}</h3>
                        @if($image->description)
                            <p class="text-sm text-gray-200 line-clamp-2">{{ $image->description }}</p>
                        @endif
                    </div>
                </div>
                
                        <!-- Zoom Icon -->
                        <div class="absolute top-4 right-4 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}', '{{ $image->title }}', '{{ $image->description }}')">
                            <i class="fas fa-search-plus text-white text-sm"></i>
                        </div>
            </div>
            @endforeach
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-images text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Galeria em Construção</h3>
            <p class="text-gray-600 max-w-md mx-auto">
                Em breve você poderá conferir as melhores fotos dos nossos eventos e da região dos lagos.
            </p>
        </div>
        @endif
        
        <!-- Modal de Visualização Ampliada -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
            <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center">
                <!-- Botão Fechar -->
                <button onclick="closeImageModal()" class="absolute top-4 right-4 z-60 text-white hover:text-gray-300 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <!-- Imagem -->
                <div class="relative max-w-full max-h-full">
                    <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    
                    <!-- Informações da Imagem -->
                    <div id="modalInfo" class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 rounded-b-lg">
                        <h3 id="modalTitle" class="text-xl font-semibold text-white mb-2"></h3>
                        <p id="modalDescription" class="text-gray-200"></p>
                    </div>
                </div>
                
                <!-- Botões de Navegação (se houver múltiplas imagens) -->
                @if($galleryImages->count() > 1)
                <button id="prevBtn" onclick="navigateImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors bg-black/50 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="nextBtn" onclick="navigateImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition-colors bg-black/50 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section id="partners" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nossos Parceiros</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>
        
        <!-- Slider Container -->
        <div class="relative overflow-hidden">
            <div class="partners-slider flex animate-scroll">
                <!-- Primeira linha de parceiros -->
                @foreach($partners as $partner)
                <div class="flex-shrink-0 mx-4 flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg p-4 h-32 w-40 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                             alt="{{ $partner->name }}" 
                             class="max-h-20 max-w-full object-contain">
                    </div>
                </div>
                @endforeach
                
                <!-- Segunda linha (duplicada para loop infinito) -->
                @foreach($partners as $partner)
                <div class="flex-shrink-0 mx-4 flex items-center justify-center">
                    <div class="bg-gray-100 rounded-lg p-4 h-32 w-40 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                             alt="{{ $partner->name }}" 
                             class="max-h-20 max-w-full object-contain">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Registration Section -->
@if($registrationEnabled)
<section id="registration" class="py-20 bg-blue-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Inscreva-se no Evento</h2>
            <p class="text-xl text-blue-100">Preencha o formulário abaixo e garante sua participação</p>
        </div>
        
        <div class="bg-white rounded-lg p-8">
            <form id="registration-form" class="space-y-6">
                @csrf
                
                <!-- Step 1: Personal Info -->
                <div id="step-1" class="step">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold mr-3">1</div>
                        <h3 class="text-xl font-semibold text-gray-900">Dados Pessoais</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                            <input type="text" id="full_name" name="full_name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF *</label>
                            <input type="text" id="cpf" name="cpf" required maxlength="14"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                            <input type="text" id="phone" name="phone" required placeholder="(00) 00000-0000" maxlength="15"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento *</label>
                            <input type="date" id="birth_date" name="birth_date" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gênero *</label>
                            <select id="gender" name="gender" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="shirt_size" class="block text-sm font-medium text-gray-700 mb-2">Tamanho da Camisa *</label>
                            <select id="shirt_size" name="shirt_size" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="PP">PP</option>
                                <option value="P">P</option>
                                <option value="M">M</option>
                                <option value="G">G</option>
                                <option value="GG">GG</option>
                                <option value="XG">XG</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Address Info -->
                <div id="step-2" class="step hidden">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold mr-3">2</div>
                        <h3 class="text-xl font-semibold text-gray-900">Endereço</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">CEP *</label>
                            <input type="text" id="zip_code" name="zip_code" required maxlength="9" placeholder="00000-000"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i> Digite o CEP e o endereço será preenchido automaticamente
                            </p>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label>
                            <input type="text" id="address" name="address" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700 mb-2">Número *</label>
                            <input type="text" id="number" name="number" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-2">Bairro *</label>
                            <input type="text" id="neighborhood" name="neighborhood" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                            <input type="text" id="city" name="city" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                            <select id="state" name="state" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Terms -->
                <div id="step-3" class="step hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Termos e Condições</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informações Importantes:</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• O evento será realizado em {{ $event->location }} no dia {{ $event->event_date->format('d/m/Y') }}</li>
                            <li>• O kit será entregue apenas para os primeiros {{ $event->kit_limit }} inscritos</li>
                            <li>• É obrigatório o uso de capacete durante todo o percurso</li>
                            <li>• O participante deve estar em boas condições físicas para participar</li>
                            <li>• Em caso de cancelamento, o reembolso será feito conforme política do evento</li>
                        </ul>
                    </div>
                    
                    <div class="flex items-start">
                        <input type="checkbox" id="accepted_regulations" name="accepted_regulations" value="1" required
                               class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="accepted_regulations" class="ml-2 text-sm text-gray-700">
                            Li e aceito o regulamento do Bora Bike 2025. *
                        </label>
                    </div>
                </div>
                
                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-6">
                    <button type="button" id="prev-btn" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 hidden">
                        Anterior
                    </button>
                    <button type="button" id="next-btn" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Próximo
                    </button>
                    <button type="submit" id="submit-btn" class="px-8 py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 transition-colors hidden">
                        Realizar Inscrição
                    </button>
                </div>
            </form>
            
            <!-- Success Message -->
            <div id="success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Inscrição realizada com sucesso! Você receberá um e-mail de confirmação.</span>
                </div>
            </div>
            
            <!-- Error Message -->
            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="error-text">Ocorreu um erro. Tente novamente.</span>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- WhatsApp Groups Section shown when registrations are disabled -->
@if(isset($whatsappGroups) && $whatsappGroups->count() > 0)
<section class="py-20 bg-white" id="whatsapp">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <i class="fab fa-whatsapp text-green-500 text-6xl mb-4"></i>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Entre nos nossos grupos do WhatsApp!</h2>
            <p class="text-lg text-gray-600 mb-8">Conecte-se com outros ciclistas, receba dicas, participe de eventos futuros e muito mais!</p>
        </div>

        @php $firstGroup = $whatsappGroups->first(); @endphp

        <div class="mt-8 flex flex-col items-center">
            @if($firstGroup)
            <a id="wa-random-btn" href="{{ $firstGroup->url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg text-lg font-medium shadow-lg transition-colors">
                <i class="fab fa-whatsapp mr-3 text-xl"></i>
                Entrar em um grupo de WhatsApp
            </a>

            <div class="mt-10 flex flex-col items-center">
                <img id="wa-random-qr" src="https://api.qrserver.com/v1/create-qr-code/?size=256x256&data={{ urlencode($firstGroup->url) }}" alt="QR Code do Grupo" class="mx-auto border-2 border-gray-200 rounded-lg p-2 bg-white">
                <p class="text-center text-gray-500 mt-3 text-sm">Aponte a câmera para entrar</p>
            </div>
            @endif

            @if($whatsappGroups->count() > 1)
            <div class="mt-12 w-full">
                <h3 class="text-xl font-semibold text-gray-900 text-center mb-6">Outros grupos disponíveis</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($whatsappGroups->slice(1) as $group)
                    <a href="{{ $group->url }}" target="_blank" class="flex items-center px-4 py-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-colors">
                        <i class="fab fa-whatsapp text-green-600 mr-3 text-xl"></i>
                        <div>
                            <div class="font-medium text-gray-900">{{ $group->name }}</div>
                            @if($group->description)
                            <div class="text-sm text-gray-600">{{ $group->description }}</div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
@endif

@if(isset($whatsappGroups) && $whatsappGroups->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urls = @json($whatsappGroups->pluck('url')->values());
    if (!Array.isArray(urls) || urls.length === 0) return;

    // Sorteia uma URL ao carregar a página
    const randomUrl = urls[Math.floor(Math.random() * urls.length)];

    // Atualiza o botão principal
    const btn = document.getElementById('wa-random-btn');
    if (btn) {
        btn.href = randomUrl;
    }

    // Atualiza o QR Code
    const qr = document.getElementById('wa-random-qr');
    if (qr) {
        const base = 'https://api.qrserver.com/v1/create-qr-code/?size=256x256&data=';
        qr.src = base + encodeURIComponent(randomUrl);
    }
});
</script>
@endif
@endsection

<script>
// Variáveis globais para o modal
let currentImageIndex = 0;
let galleryImages = [];

// Inicializar array de imagens quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    const imageElements = document.querySelectorAll('[data-gallery-image]');
    galleryImages = Array.from(imageElements).map(img => ({
        src: img.dataset.src,
        title: img.dataset.title,
        description: img.dataset.description
    }));
});

// Função para abrir o modal
function openImageModal(src, title, description) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    // Encontrar o índice da imagem atual
    currentImageIndex = galleryImages.findIndex(img => img.src === src);
    
    // Configurar o modal
    modalImage.src = src;
    modalImage.alt = title;
    modalTitle.textContent = title;
    modalDescription.textContent = description || '';
    
    // Mostrar o modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevenir scroll da página
    
    // Adicionar efeito de fade-in
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

// Função para fechar o modal
function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restaurar scroll da página
}

// Função para navegar entre imagens
function navigateImage(direction) {
    if (galleryImages.length <= 1) return;
    
    currentImageIndex += direction;
    
    // Loop circular
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    
    const currentImage = galleryImages[currentImageIndex];
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    // Atualizar com efeito de fade
    modalImage.style.opacity = '0';
    
    setTimeout(() => {
        modalImage.src = currentImage.src;
        modalImage.alt = currentImage.title;
        modalTitle.textContent = currentImage.title;
        modalDescription.textContent = currentImage.description || '';
        modalImage.style.opacity = '1';
    }, 150);
}

// Fechar modal com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Fechar modal clicando fora da imagem
const imageModal = document.getElementById('imageModal');
if (imageModal) {
    imageModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });
}

// Navegação com teclado
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (!modal.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') {
            navigateImage(-1);
        } else if (e.key === 'ArrowRight') {
            navigateImage(1);
        }
    }
});
</script>

@push('scripts')
<script>
// Countdown Timer
function updateCountdown() {
    const eventDate = new Date('{{ $event->event_date->format("Y-m-d") }} {{ $event->start_time->format("H:i:s") }}').getTime();
    const now = new Date().getTime();
    const distance = eventDate - now;
    
    if (distance < 0) {
        document.getElementById('days').innerHTML = '00';
        document.getElementById('hours').innerHTML = '00';
        document.getElementById('minutes').innerHTML = '00';
        document.getElementById('seconds').innerHTML = '00';
        return;
    }
    
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById('days').innerHTML = days.toString().padStart(2, '0');
    document.getElementById('hours').innerHTML = hours.toString().padStart(2, '0');
    document.getElementById('minutes').innerHTML = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').innerHTML = seconds.toString().padStart(2, '0');
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown();

// Form Step Management
let currentStep = 1;
const totalSteps = 3;

// Check if registration form exists
const registrationForm = document.getElementById('registration-form');

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
    
    // Show current step
    const currentStepEl = document.getElementById(`step-${step}`);
    if (currentStepEl) {
        currentStepEl.classList.remove('hidden');
    }
    
    // Update navigation buttons
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    
    if (prevBtn) prevBtn.classList.toggle('hidden', step === 1);
    if (nextBtn) nextBtn.classList.toggle('hidden', step === totalSteps);
    if (submitBtn) submitBtn.classList.toggle('hidden', step !== totalSteps);
}

// Navigation buttons (já declarados no showStep, reutilizando)
const nextBtnEl = document.getElementById('next-btn');
if (nextBtnEl) {
    nextBtnEl.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });
}

const prevBtnEl = document.getElementById('prev-btn');
if (prevBtnEl) {
    prevBtnEl.addEventListener('click', function() {
        currentStep--;
        showStep(currentStep);
    });
}

function validateStep(step) {
    const stepElement = document.getElementById(`step-${step}`);
    if (!stepElement) {
        console.error('Step element not found:', step);
        return false;
    }
    
    const requiredFields = stepElement.querySelectorAll('[required]');
    
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            field.focus();
            showError('Por favor, preencha todos os campos obrigatórios.');
            return false;
        }
    }
    
    // Additional validations
    if (step === 1) {
        const cpfField = document.getElementById('cpf');
        if (!cpfField) {
            return false;
        }
        const cpf = cpfField.value;
        
        if (cpf.length === 14) {
            if (!validateCPF(cpf)) {
                cpfField.focus();
                cpfField.classList.add('border-red-500');
                showError('Por favor, informe um CPF válido.');
                
                // Adiciona mensagem de erro se não existir
                const cpfFieldParent = cpfField.parentElement;
                const existingMsg = cpfFieldParent.querySelector('.cpf-validation-message');
                if (!existingMsg || !existingMsg.classList.contains('text-red-600')) {
                    const existingMsgToRemove = cpfFieldParent.querySelector('.cpf-validation-message');
                    if (existingMsgToRemove) existingMsgToRemove.remove();
                    
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'cpf-validation-message mt-1 text-sm text-red-600';
                    errorDiv.innerHTML = '<i class="fas fa-times-circle mr-1"></i> CPF inválido';
                    cpfFieldParent.appendChild(errorDiv);
                }
                return false;
            }
        } else if (cpf.length > 0) {
            cpfField.focus();
            showError('CPF incompleto. Por favor, preencha todos os dígitos.');
            return false;
        }
    }
    
    return true;
}

function validateCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/[^\d]/g, '');
    
    // Verifica se tem 11 dígitos
    if (cpf.length !== 11) return false;
    
    // Verifica se todos os dígitos são iguais (CPFs inválidos)
    if (/^(\d)\1+$/.test(cpf)) return false;
    
    // Validação dos dígitos verificadores
    let sum = 0;
    let remainder;
    
    // Valida primeiro dígito verificador
    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;
    
    // Valida segundo dígito verificador
    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(10, 11))) return false;
    
    return true;
}

// CPF formatting and validation
const cpfInputElement = document.getElementById('cpf');
if (cpfInputElement) {
    cpfInputElement.addEventListener('input', function(e) {
    const cpfInput = e.target;
    const cpfFieldParent = cpfInput.parentElement;
    
    // Formata o CPF
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    e.target.value = value;
    
    // Remove mensagens anteriores
    const existingMsg = cpfFieldParent.querySelector('.cpf-validation-message');
    if (existingMsg) {
        existingMsg.remove();
    }
    
    // Remove classes de validação
    cpfInput.classList.remove('border-green-500', 'border-red-500');
    
    // Valida quando o CPF está completo (14 caracteres com máscara)
    if (value.length === 14) {
        if (validateCPF(value)) {
            // CPF válido
            cpfInput.classList.add('border-green-500');
            const successDiv = document.createElement('div');
            successDiv.className = 'cpf-validation-message mt-1 text-sm text-green-600';
            successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> CPF válido';
            cpfFieldParent.appendChild(successDiv);
        } else {
            // CPF inválido
            cpfInput.classList.add('border-red-500');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'cpf-validation-message mt-1 text-sm text-red-600';
            errorDiv.innerHTML = '<i class="fas fa-times-circle mr-1"></i> CPF inválido';
            cpfFieldParent.appendChild(errorDiv);
        }
    } else if (value.length > 0 && value.length < 14) {
        // CPF incompleto - remove mensagens
        cpfInput.classList.remove('border-green-500', 'border-red-500');
    }
    });
}

// Phone formatting - formato brasileiro
const phoneField = document.getElementById('phone');
if (phoneField) {
    phoneField.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    // Limita a 11 dígitos (DDD + número)
    if (value.length > 11) {
        value = value.substring(0, 11);
    }
    
    // Detecta se é celular (terceiro dígito após DDD é 9)
    const isMobile = value.length >= 3 && value.charAt(2) === '9';
    
    // Aplica máscara incremental
    if (value.length <= 2) {
        // Apenas DDD: (XX
        value = value.length > 0 ? `(${value}` : '';
    } else if (isMobile) {
        // Celular: (XX) 9XXXX-XXXX
        if (value.length <= 7) {
            value = value.replace(/(\d{2})(\d{5})/, '($1) $2');
        } else {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
    } else {
        // Telefone fixo: (XX) XXXX-XXXX
        if (value.length <= 6) {
            value = value.replace(/(\d{2})(\d{4})/, '($1) $2');
        } else {
            value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
    }
    
    e.target.value = value;
    });
}

// ZIP code formatting and auto-fill via ViaCEP
const zipCodeField = document.getElementById('zip_code');
if (zipCodeField) {
    zipCodeField.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{5})(\d)/, '$1-$2');
    e.target.value = value;
    
    // Remove mensagem de erro anterior
    const errorMsg = document.getElementById('cep-error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
    
    // Remove indicador de loading anterior
    const loadingIndicator = document.getElementById('cep-loading');
    if (loadingIndicator) {
        loadingIndicator.remove();
    }
    
    // Verifica se o CEP tem 9 caracteres (com hífen)
    if (value.length === 9) {
        const cepInput = document.getElementById('zip_code');
        const cepField = cepInput.parentElement;
        
        // Adiciona indicador de loading
        const loadingDiv = document.createElement('div');
        loadingDiv.id = 'cep-loading';
        loadingDiv.className = 'mt-1 text-sm text-blue-600';
        loadingDiv.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Buscando CEP...';
        cepField.appendChild(loadingDiv);
        
        // Remove hífen do CEP para a consulta
        const cepClean = value.replace('-', '');
        
        // Busca o CEP na API ViaCEP
        fetch(`https://viacep.com.br/ws/${cepClean}/json/`)
            .then(response => response.json())
            .then(data => {
                // Remove loading indicator
                if (loadingIndicator || document.getElementById('cep-loading')) {
                    const loadingEl = document.getElementById('cep-loading');
                    if (loadingEl) loadingEl.remove();
                }
                
                if (data.erro) {
                    // CEP não encontrado
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'cep-error-message';
                    errorDiv.className = 'mt-1 text-sm text-red-600';
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> CEP não encontrado. Por favor, preencha o endereço manualmente.';
                    cepField.appendChild(errorDiv);
                    
                    // Limpa os campos de endereço
                    document.getElementById('address').value = '';
                    document.getElementById('neighborhood').value = '';
                    document.getElementById('city').value = '';
                    document.getElementById('state').value = 'RJ';
                } else {
                    // Preenche os campos automaticamente
                    document.getElementById('address').value = data.logradouro || '';
                    document.getElementById('neighborhood').value = data.bairro || '';
                    document.getElementById('city').value = data.localidade || '';
                    document.getElementById('state').value = data.uf || 'RJ';
                    
                    // Adiciona mensagem de sucesso
                    const successDiv = document.createElement('div');
                    successDiv.id = 'cep-success-message';
                    successDiv.className = 'mt-1 text-sm text-green-600';
                    successDiv.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Endereço encontrado!';
                    cepField.appendChild(successDiv);
                    
                    // Remove mensagem de sucesso após 3 segundos
                    setTimeout(() => {
                        const successMsg = document.getElementById('cep-success-message');
                        if (successMsg) successMsg.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                // Remove loading indicator em caso de erro
                const loadingEl = document.getElementById('cep-loading');
                if (loadingEl) loadingEl.remove();
                
                // Mostra mensagem de erro
                const errorDiv = document.createElement('div');
                errorDiv.id = 'cep-error-message';
                errorDiv.className = 'mt-1 text-sm text-red-600';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Erro ao buscar CEP. Por favor, tente novamente ou preencha manualmente.';
                document.getElementById('zip_code').parentElement.appendChild(errorDiv);
                
                console.error('Erro ao buscar CEP:', error);
            });
    } else if (value.length > 0 && value.length < 9) {
        // Remove campos de endereço se o CEP for incompleto
        const addressField = document.getElementById('address');
        const neighborhoodField = document.getElementById('neighborhood');
        const cityField = document.getElementById('city');
        const stateField = document.getElementById('state');
        
        if (addressField && addressField.value && addressField.value.includes('ViaCEP')) {
            addressField.value = '';
            neighborhoodField.value = '';
            cityField.value = '';
            stateField.value = 'RJ';
        }
    }
    });
}

// Busca CEP quando o usuário sair do campo (blur) se o CEP estiver completo
if (zipCodeField) {
    zipCodeField.addEventListener('blur', function(e) {
    const value = e.target.value.replace(/\D/g, '');
    
    // Se o CEP tem 8 dígitos mas não tem hífen, formata e busca
    if (value.length === 8 && !e.target.value.includes('-')) {
        e.target.value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
        
        // Dispara o evento de input para buscar o CEP
        const inputEvent = new Event('input', { bubbles: true });
        e.target.dispatchEvent(inputEvent);
    }
    });
}

// Form submission
if (registrationForm) {
    registrationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateStep(currentStep)) return;
        
        // Valida checkbox do regulamento
        const acceptedRegulationsCheckbox = document.getElementById('accepted_regulations');
        if (!acceptedRegulationsCheckbox || !acceptedRegulationsCheckbox.checked) {
            showError('É necessário aceitar o regulamento do evento para continuar.');
            if (acceptedRegulationsCheckbox) {
                acceptedRegulationsCheckbox.focus();
            }
            return;
        }
        
        // Desabilita o botão de submit durante o processamento
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processando...';
        }
        
        const formData = new FormData(this);
        
        // Garante que o checkbox seja enviado com valor "1"
        if (acceptedRegulationsCheckbox && acceptedRegulationsCheckbox.checked) {
            formData.set('accepted_regulations', '1');
        }
        
        fetch('{{ route("registration.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            // Verifica se a resposta é JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                // Se não for JSON, tenta ler como texto para ver o erro
                const text = await response.text();
                console.error('Resposta não JSON:', text);
                throw new Error('Resposta inválida do servidor');
            }
            
            // Verifica se a resposta foi bem-sucedida
            if (!response.ok) {
                const errorData = await response.json();
                throw { response, errorData };
            }
            
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showSuccess(data.message || 'Inscrição realizada com sucesso!');
                registrationForm.reset();
                currentStep = 1;
                showStep(currentStep);
                
                // Update remaining kits if element exists
                if (data.remaining_kits !== undefined) {
                    const remainingKitsEl = document.getElementById('remaining-kits');
                    const kitCounterEl = document.getElementById('kit-counter');
                    if (remainingKitsEl) remainingKitsEl.textContent = data.remaining_kits;
                    if (kitCounterEl) kitCounterEl.textContent = data.remaining_kits;
                }
            } else {
                // Mostra mensagem de erro ou erros de validação
                let errorMessage = data.message || 'Ocorreu um erro. Tente novamente.';
                
                if (data.errors) {
                    // Se houver erros de validação, mostra o primeiro
                    const firstError = Object.values(data.errors)[0];
                    if (Array.isArray(firstError)) {
                        errorMessage = firstError[0];
                    } else {
                        errorMessage = firstError;
                    }
                }
                
                showError(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            let errorMessage = 'Ocorreu um erro. Tente novamente.';
            
            // Se for erro de validação com dados
            if (error.errorData) {
                if (error.errorData.errors) {
                    const firstError = Object.values(error.errorData.errors)[0];
                    if (Array.isArray(firstError)) {
                        errorMessage = firstError[0];
                    } else {
                        errorMessage = firstError;
                    }
                } else if (error.errorData.message) {
                    errorMessage = error.errorData.message;
                }
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            showError(errorMessage);
        })
        .finally(() => {
            // Reabilita o botão de submit
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Realizar Inscrição';
            }
        });
    });
}

function showSuccess(message) {
    const successMessage = document.getElementById('success-message');
    const successText = document.getElementById('success-text');
    
    if (successMessage) {
        if (successText && message) {
            successText.textContent = message;
        }
        successMessage.classList.remove('hidden');
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.classList.add('hidden');
        }
        setTimeout(() => {
            successMessage.classList.add('hidden');
        }, 5000);
    }
}

function showError(message) {
    document.getElementById('error-text').textContent = message;
    document.getElementById('error-message').classList.remove('hidden');
    document.getElementById('success-message').classList.add('hidden');
    setTimeout(() => {
        document.getElementById('error-message').classList.add('hidden');
    }, 5000);
}

// Initialize form (only if registration form exists)
if (registrationForm) {
    showStep(currentStep);
}
</script>
@endpush