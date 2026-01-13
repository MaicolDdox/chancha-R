<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ReservaDeportiva - Reserva Canchas en Segundos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

        <!-- Tailwind CSS (already integrated in Laravel 12) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- AOS Animations Library (CDN) -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Lucide Icons (CDN) -->
        <script src="https://unpkg.com/lucide@latest"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .hero-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-8px);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">

        <!-- ============================================ -->
        <!-- HEADER / NAVIGATION -->
        <!-- ============================================ -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="/" class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">ReservaDeportiva</span>
                        </a>
                    </div>

                    <!-- Auth Links -->
                    @if (Route::has('login'))
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 transition-colors duration-200">
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <!-- ============================================ -->
        <!-- HERO SECTION -->
        <!-- ============================================ -->
        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden hero-gradient">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="text-white" data-aos="fade-right">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                            Reserva Tu Cancha en <span class="text-yellow-300">Segundos</span>
                        </h1>
                        <p class="text-xl text-purple-100 mb-8 leading-relaxed">
                            Encuentra y reserva canchas deportivas cerca de ti. Disponibilidad en tiempo real, pagos seguros y confirmación instantánea.
                        </p>

                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-purple-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
                                    <i data-lucide="calendar-check" class="w-5 h-5 mr-2"></i>
                                    Reservar Ahora
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-purple-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
                                    <i data-lucide="calendar-check" class="w-5 h-5 mr-2"></i>
                                    Reservar Ahora
                                </a>
                            @endauth
                            <a href="#canchas" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 backdrop-blur-sm border-2 border-white/30 rounded-lg hover:bg-white/30 transition-all duration-200">
                                <i data-lucide="search" class="w-5 h-5 mr-2"></i>
                                Ver Canchas
                            </a>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-white/20">
                            <div data-aos="fade-up" data-aos-delay="100">
                                <div class="text-3xl font-bold text-white">500+</div>
                                <div class="text-sm text-purple-200">Canchas Disponibles</div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="200">
                                <div class="text-3xl font-bold text-white">10K+</div>
                                <div class="text-sm text-purple-200">Usuarios Activos</div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="300">
                                <div class="text-3xl font-bold text-white">50K+</div>
                                <div class="text-sm text-purple-200">Reservas Realizadas</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="relative" data-aos="fade-left">
                        <div class="relative z-10">
                            <!-- Replace with your actual hero image -->
                            <img src="/welcome/assets/hero.png" alt="Canchas Deportivas" class="rounded-2xl shadow-2xl" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- FEATURES / BENEFITS SECTION -->
        <!-- ============================================ -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        ¿Por Qué Elegirnos?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Hacemos que reservar una cancha deportiva sea rápido, fácil y confiable
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-14 h-14 bg-purple-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="zap" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Reserva en Segundos</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Proceso simplificado para que reserves tu cancha favorita en menos de un minuto.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="clock" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Disponibilidad en Tiempo Real</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Consulta horarios disponibles al instante y reserva sin esperas ni llamadas.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-14 h-14 bg-green-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="shield-check" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pagos Seguros</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Transacciones protegidas y confirmación instantánea por email y SMS.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-14 h-14 bg-orange-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="map-pin" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Ubicación Precisa</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Encuentra canchas cerca de ti con mapas integrados y direcciones exactas.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-14 h-14 bg-pink-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="star" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Reseñas Verificadas</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Lee opiniones reales de otros usuarios para elegir la mejor cancha.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-gradient-to-br from-violet-50 to-purple-50 rounded-xl p-8 card-hover" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-14 h-14 bg-violet-600 rounded-lg flex items-center justify-center mb-6">
                            <i data-lucide="calendar" class="w-7 h-7 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Gestión Flexible</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Modifica o cancela tus reservas fácilmente desde tu panel de control.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- COURTS SECTION -->
        <!-- ============================================ -->
        <section id="canchas" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Canchas Destacadas
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Explora nuestras canchas más populares y encuentra la perfecta para ti
                    </p>
                </div>

                <!-- Courts Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Court Card 1 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative h-48 overflow-hidden">
                            <!-- Replace with your actual court image -->
                            <img src="/welcome/assets/courts/football.jpg" alt="Cancha de Fútbol" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" />
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Disponible
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                <span>Centro Deportivo Norte</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Cancha de Fútbol 7</h3>
                            <p class="text-gray-600 mb-4">Césped sintético de última generación, iluminación LED</p>
                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-bold text-purple-600">$25<span class="text-sm text-gray-600">/hora</span></div>
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 inline-flex items-center gap-2">
                                    <span>Ver Disponibilidad</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court Card 2 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative h-48 overflow-hidden">
                            <!-- Replace with your actual court image -->
                            <img src="/welcome/assets/courts/tennis.jpg" alt="Cancha de Tenis" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" />
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Disponible
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                <span>Club Deportivo Sur</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Cancha de Tenis</h3>
                            <p class="text-gray-600 mb-4">Superficie dura profesional, techada y climatizada</p>
                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-bold text-purple-600">$30<span class="text-sm text-gray-600">/hora</span></div>
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 inline-flex items-center gap-2">
                                    <span>Ver Disponibilidad</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Court Card 3 -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover" data-aos="fade-up" data-aos-delay="300">
                        <div class="relative h-48 overflow-hidden">
                            <!-- Replace with your actual court image -->
                            <img src="/welcome/assets/courts/basketball.jpg" alt="Cancha de Básquetbol" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" />
                            <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Pocos Espacios
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                <span>Arena Polideportiva</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Cancha de Básquetbol</h3>
                            <p class="text-gray-600 mb-4">Cancha cubierta con graderías, vestidores incluidos</p>
                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-bold text-purple-600">$35<span class="text-sm text-gray-600">/hora</span></div>
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 inline-flex items-center gap-2">
                                    <span>Ver Disponibilidad</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View All Button -->
                <div class="text-center mt-12" data-aos="fade-up">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 text-lg font-semibold text-purple-700 bg-white border-2 border-purple-600 rounded-lg hover:bg-purple-50 transition-all duration-200 shadow-md hover:shadow-lg">
                        Ver Todas las Canchas
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- HOW IT WORKS SECTION -->
        <!-- ============================================ -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        ¿Cómo Funciona?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Reserva tu cancha en 3 simples pasos
                    </p>
                </div>

                <!-- Steps -->
                <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                    <!-- Step 1 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                                <span class="text-3xl font-bold text-white">1</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Busca y Elige</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Explora canchas disponibles cerca de ti, filtra por deporte, ubicación y horario
                            </p>
                        </div>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-6 lg:-right-12">
                            <i data-lucide="arrow-right" class="w-8 h-8 text-purple-300"></i>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                                <span class="text-3xl font-bold text-white">2</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Reserva y Paga</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Selecciona tu horario preferido y completa el pago de forma segura en segundos
                            </p>
                        </div>
                        <!-- Arrow -->
                        <div class="hidden md:block absolute top-10 -right-6 lg:-right-12">
                            <i data-lucide="arrow-right" class="w-8 h-8 text-purple-300"></i>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                                <span class="text-3xl font-bold text-white">3</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">¡Juega!</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Recibe tu confirmación al instante y disfruta de tu partido en la cancha reservada
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TESTIMONIALS SECTION -->
        <!-- ============================================ -->
        <section class="py-20 bg-gradient-to-br from-purple-600 to-indigo-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                        Lo Que Dicen Nuestros Usuarios
                    </h2>
                    <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                        Miles de deportistas confían en nosotros
                    </p>
                </div>

                <!-- Testimonials Grid -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-8" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center gap-1 mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                        </div>
                        <p class="text-white mb-6 leading-relaxed">
                            "Increíble lo fácil que es reservar. Antes perdía horas llamando a diferentes lugares. Ahora lo hago en mi celular en menos de un minuto."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-300 rounded-full flex items-center justify-center text-purple-900 font-bold">
                                JM
                            </div>
                            <div>
                                <div class="text-white font-semibold">Juan Martínez</div>
                                <div class="text-purple-200 text-sm">Jugador de Fútbol</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center gap-1 mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                        </div>
                        <p class="text-white mb-6 leading-relaxed">
                            "La mejor app para organizar partidos. Las notificaciones y recordatorios son muy útiles. ¡La recomiendo 100%!"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-300 rounded-full flex items-center justify-center text-purple-900 font-bold">
                                ML
                            </div>
                            <div>
                                <div class="text-white font-semibold">María López</div>
                                <div class="text-purple-200 text-sm">Tenista Profesional</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-8" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center gap-1 mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-300 fill-yellow-300"></i>
                        </div>
                        <p class="text-white mb-6 leading-relaxed">
                            "Excelente servicio. Las canchas están verificadas y la información es precisa. Nunca he tenido problemas con mis reservas."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-300 rounded-full flex items-center justify-center text-purple-900 font-bold">
                                CR
                            </div>
                            <div>
                                <div class="text-white font-semibold">Carlos Rodríguez</div>
                                <div class="text-purple-200 text-sm">Entrenador</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CTA SECTION -->
        <!-- ============================================ -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    ¿Listo para Tu Próximo Partido?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Únete a miles de deportistas que ya reservan con ReservaDeportiva
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Ir al Dashboard
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Comenzar Gratis
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-purple-700 bg-purple-50 border-2 border-purple-200 rounded-lg hover:bg-purple-100 transition-all duration-200">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- FOOTER -->
        <!-- ============================================ -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <!-- Brand -->
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold">ReservaDeportiva</span>
                        </div>
                        <p class="text-gray-400 mb-4 max-w-md">
                            La plataforma más fácil y confiable para reservar canchas deportivas. Encuentra, reserva y juega.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors duration-200">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors duration-200">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors duration-200">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Links Column 1 -->
                    <div>
                        <h4 class="font-semibold mb-4">Plataforma</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Cómo Funciona</a></li>
                            <li><a href="#canchas" class="hover:text-white transition-colors duration-200">Canchas</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Precios</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Para Propietarios</a></li>
                        </ul>
                    </div>

                    <!-- Links Column 2 -->
                    <div>
                        <h4 class="font-semibold mb-4">Soporte</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Centro de Ayuda</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Contacto</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Términos de Servicio</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-200">Privacidad</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="pt-8 border-t border-gray-800 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} ReservaDeportiva. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>

        <!-- AOS Animation Library (CDN) -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Initialize AOS and Lucide Icons -->
        <script>
            // Initialize AOS animations
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });

            // Initialize Lucide icons
            lucide.createIcons();
        </script>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

    </body>
</html>
