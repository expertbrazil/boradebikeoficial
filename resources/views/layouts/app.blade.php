<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bora de Bike - Portal Oficial')</title>
    <meta name="description" content="Portal oficial do evento Bora de Bike - O maior evento de ciclismo da região dos lagos">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
        
        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: #e5e7eb;
        }
        
        .timeline-item:last-child::before {
            display: none;
        }
        
        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }
        
        /* Partners Slider Animation */
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        .animate-scroll {
            animation: scroll 30s linear infinite;
        }
        
        .animate-scroll:hover {
            animation-play-state: paused;
        }
        
        .partners-slider {
            width: calc(200% + 2rem);
        }
        
                .timeline-dot {
                    width: 12px;
                    height: 12px;
                    background: #3b82f6;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 0 3px #e5e7eb;
                }
                
                /* Gallery Styles */
                .line-clamp-2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                
                .aspect-w-16 {
                    position: relative;
                    padding-bottom: 75%; /* 16:12 aspect ratio */
                }
                
        .aspect-w-16 > * {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        
        /* Modal Styles */
        #imageModal {
            transition: opacity 0.3s ease-in-out;
        }
        
        #imageModal img {
            transition: opacity 0.15s ease-in-out;
        }
        
        /* Smooth scrolling for modal */
        .modal-open {
            overflow: hidden;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="Bora de Bike" class="h-12 w-auto">
                        @else
                            <h1 class="text-2xl font-bold text-gray-900">Bora de Bike</h1>
                        @endif
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Início</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Sobre</a>
                    <a href="#kit" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Kit</a>
                    <a href="#schedule" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Programação</a>
                    <a href="#gallery" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Galeria</a>
                    <a href="#partners" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Parceiros</a>
                </nav>
                
                <!-- CTA Button -->
                <div class="flex items-center">
                    <a href="#registration" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Inscreva-se
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="#home" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Início</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Sobre</a>
                <a href="#kit" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Kit</a>
                <a href="#schedule" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Programação</a>
                <a href="#gallery" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Galeria</a>
                <a href="#partners" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Parceiros</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo and Description -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Bora de Bike</h3>
                    <p class="text-gray-300 mb-4">
                        O maior evento de ciclismo da região dos lagos. Junte-se a nós para uma experiência única que une pessoas através da paixão pelo ciclismo.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contato</h4>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-envelope mr-2"></i> contato@boradebike.com</p>
                        <p><i class="fas fa-phone mr-2"></i> (22) 99999-9999</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Cabo Frio - RJ</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} Bora de Bike. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: #e5e7eb;
        }
        
        .timeline-item:last-child::before {
            display: none;
        }
        
        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }
        
        /* Partners Slider Animation */
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        .animate-scroll {
            animation: scroll 30s linear infinite;
        }
        
        .animate-scroll:hover {
            animation-play-state: paused;
        }
        
        .partners-slider {
            width: calc(200% + 2rem);
        }
        
                .timeline-dot {
                    width: 12px;
                    height: 12px;
                    background: #3b82f6;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 0 3px #e5e7eb;
                }
                
                /* Gallery Styles */
                .line-clamp-2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                
                .aspect-w-16 {
                    position: relative;
                    padding-bottom: 75%; /* 16:12 aspect ratio */
                }
                
        .aspect-w-16 > * {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        
        /* Modal Styles */
        #imageModal {
            transition: opacity 0.3s ease-in-out;
        }
        
        #imageModal img {
            transition: opacity 0.15s ease-in-out;
        }
        
        /* Smooth scrolling for modal */
        .modal-open {
            overflow: hidden;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="Bora de Bike" class="h-12 w-auto">
                        @else
                            <h1 class="text-2xl font-bold text-gray-900">Bora de Bike</h1>
                        @endif
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Início</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Sobre</a>
                    <a href="#kit" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Kit</a>
                    <a href="#schedule" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Programação</a>
                    <a href="#gallery" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Galeria</a>
                    <a href="#partners" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Parceiros</a>
                </nav>
                
                <!-- CTA Button -->
                <div class="flex items-center">
                    <a href="#registration" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Inscreva-se
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="#home" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Início</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Sobre</a>
                <a href="#kit" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Kit</a>
                <a href="#schedule" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Programação</a>
                <a href="#gallery" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Galeria</a>
                <a href="#partners" class="text-gray-700 hover:text-blue-600 block px-3 py-2 text-base font-medium">Parceiros</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo and Description -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Bora de Bike</h3>
                    <p class="text-gray-300 mb-4">
                        O maior evento de ciclismo da região dos lagos. Junte-se a nós para uma experiência única que une pessoas através da paixão pelo ciclismo.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contato</h4>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-envelope mr-2"></i> contato@boradebike.com</p>
                        <p><i class="fas fa-phone mr-2"></i> (22) 99999-9999</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Cabo Frio - RJ</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} Bora de Bike. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>