<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Doble Encanto') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|inter:300,400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            h1, h2, h3, h4, h5, h6, .font-serif {
                font-family: 'Playfair Display', serif;
            }
            body {
                font-family: 'Inter', sans-serif;
            }
            .glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="antialiased text-gray-800 bg-stone-50 selection:bg-rose-200 selection:text-rose-900">
        
        <!-- Navigation -->
        <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
            <div class="glass border-b border-rose-100/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 group">
                                <svg class="w-9 h-9 text-rose-500 group-hover:text-rose-600 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22V12"></path>
                                    <path d="M12 12C12 12 9 7 5 7C1 7 1 12 5 15C9 18 12 12 12 12Z"></path>
                                    <path d="M12 12C12 12 15 7 19 7C23 7 23 12 19 15C15 18 12 12 12 12Z"></path>
                                    <path d="M12 12C12 12 9 17 5 17C1 17 1 12 5 9C9 6 12 12 12 12Z" opacity="0.5"></path>
                                    <path d="M12 12C12 12 15 17 19 17C23 17 23 12 19 9C15 6 12 12 12 12Z" opacity="0.5"></path>
                                </svg>
                                <span class="font-serif text-2xl font-bold tracking-tight text-gray-900">Doble Encanto</span>
                            </a>
                        </div>

                        <!-- Botón de Menú Móvil -->
                        <div class="flex items-center sm:hidden">
                            <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2.5 rounded-xl text-gray-500 hover:text-rose-500 hover:bg-rose-50/50 focus:outline-none transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                                <svg class="h-6 w-6 block" id="hamburger-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg class="h-6 w-6 hidden" id="close-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:space-x-8">
                            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors {{ request()->routeIs('home') ? 'text-rose-600 border-b-2 border-rose-500' : '' }}">Inicio</a>
                            <a href="{{ route('services') }}" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors {{ request()->routeIs('services') ? 'text-rose-600 border-b-2 border-rose-500' : '' }}">Servicios</a>
                            <a href="{{ route('contact') }}" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors {{ request()->routeIs('contact') ? 'text-rose-600 border-b-2 border-rose-500' : '' }}">Contacto</a>
                            
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-rose-600 hover:bg-rose-700 shadow-md hover:shadow-lg transition-all duration-300">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors ml-4">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors">Ingresar</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-rose-600 hover:bg-rose-700 shadow-md hover:shadow-lg transition-all duration-300">Registrarse</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Menú Desplegable Móvil -->
                <div class="hidden sm:hidden" id="mobile-menu">
                    <div class="px-4 pt-2 pb-6 space-y-2 bg-white/95 backdrop-blur-lg border-t border-rose-100/50">
                        <a href="{{ route('home') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-gray-700 hover:text-rose-500 hover:bg-rose-50/50 transition-colors {{ request()->routeIs('home') ? 'bg-rose-50/60 text-rose-600 font-bold' : '' }}">Inicio</a>
                        <a href="{{ route('services') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-gray-700 hover:text-rose-500 hover:bg-rose-50/50 transition-colors {{ request()->routeIs('services') ? 'bg-rose-50/60 text-rose-600 font-bold' : '' }}">Servicios</a>
                        <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-gray-700 hover:text-rose-500 hover:bg-rose-50/50 transition-colors {{ request()->routeIs('contact') ? 'bg-rose-50/60 text-rose-600 font-bold' : '' }}">Contacto</a>
                        
                        <div class="border-t border-rose-100/50 my-2 pt-2"></div>
                        
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-gray-700 hover:text-rose-500 hover:bg-rose-50/50 transition-colors {{ request()->routeIs('dashboard') ? 'bg-rose-50/60 text-rose-600 font-bold' : '' }}">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-3 rounded-2xl text-base font-semibold text-rose-600 hover:bg-rose-50/50 transition-colors">
                                    Cerrar Sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-gray-700 hover:text-rose-500 hover:bg-rose-50/50 transition-colors">Ingresar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-2xl text-base font-semibold text-white bg-rose-600 hover:bg-rose-700 text-center shadow-md">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <footer class="bg-stone-900 text-stone-300 py-12 border-t border-stone-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center gap-2 mb-4 md:mb-0">
                    <svg class="w-7 h-7 text-rose-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22V12"></path>
                        <path d="M12 12C12 12 9 7 5 7C1 7 1 12 5 15C9 18 12 12 12 12Z"></path>
                        <path d="M12 12C12 12 15 7 19 7C23 7 23 12 19 15C15 18 12 12 12 12Z"></path>
                        <path d="M12 12C12 12 9 17 5 17C1 17 1 12 5 9C9 6 12 12 12 12Z" opacity="0.5"></path>
                        <path d="M12 12C12 12 15 17 19 17C23 17 23 12 19 9C15 6 12 12 12 12Z" opacity="0.5"></path>
                    </svg>
                    <span class="font-serif text-xl font-bold text-white tracking-widest">DOBLE ENCANTO</span>
                </div>
                <div class="text-sm text-stone-400">
                    &copy; {{ date('Y') }} dobleencanto.cl. Todos los derechos reservados.
                </div>
            </div>
        </footer>

        <script>
            window.addEventListener('scroll', () => {
                const nav = document.getElementById('navbar');
                if (window.scrollY > 20) {
                    nav.classList.add('shadow-sm');
                } else {
                    nav.classList.remove('shadow-sm');
                }
            });

            // Control de Menú Móvil
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                    mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                    hamburgerIcon.classList.toggle('hidden');
                    closeIcon.classList.toggle('hidden');
                });
            }
        </script>
    </body>
</html>
