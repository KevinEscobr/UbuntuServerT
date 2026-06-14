<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Doble Encanto') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Prevent FOUC (Flash of Unstyled Content) */
            html { background-color: #fafaf9; }
            body { opacity: 0; transition: opacity 0.5s ease-in-out; }
            body.loaded { opacity: 1; }

            @keyframes fade-in-up {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { 
                animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
            }
            .delay-100 { animation-delay: 100ms; }
            .delay-200 { animation-delay: 200ms; }
            .delay-300 { animation-delay: 300ms; }
            
            @keyframes slow-zoom {
                0% { transform: scale(1); }
                100% { transform: scale(1.08); }
            }
            .animate-slow-zoom { 
                animation: slow-zoom 25s ease-in-out infinite alternate; 
            }
        </style>
        <script>
            // Revelar el body una vez que el DOM y estilos estén listos
            window.addEventListener('load', () => {
                document.body.classList.add('loaded');
            });
        </script>
    </head>
    <body class="antialiased text-stone-900 bg-stone-50 selection:bg-rose-200 selection:text-rose-900 overflow-x-hidden">
        <div class="min-h-screen flex w-full bg-white">
            <!-- Left Side Image (Hidden on Mobile) -->
            <div class="hidden lg:flex w-1/2 relative bg-stone-100 overflow-hidden">
                <div class="absolute inset-0 bg-stone-900/20 z-10"></div>
                <img src="https://ik.imagekit.io/ngrok/Cosmetics/portada.png" alt="Doble Encanto" class="absolute inset-0 w-full h-full object-cover animate-slow-zoom origin-center">
                <div class="absolute inset-0 flex flex-col justify-end p-12 z-20">
                    <div class="text-white max-w-md opacity-0 animate-fade-in-up delay-300">
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold tracking-wider uppercase mb-4 shadow-sm border border-white/20">Doble Encanto</span>
                        <h2 class="text-4xl font-serif font-bold mb-4 leading-tight drop-shadow-md">Realza tu belleza natural</h2>
                        <p class="text-white/90 text-lg font-light drop-shadow">Agenda tu cita hoy y descubre la mejor versión de ti misma con nuestros tratamientos exclusivos.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side Form (Centered on all screens) -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 relative">
                <!-- Mobile Background Decorative -->
                <div class="lg:hidden absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-rose-50/80 to-transparent -z-10 rounded-b-[3rem]"></div>
                
                <div class="w-full max-w-md flex flex-col items-center">
                    <!-- Logo -->
                    <a href="/" class="flex flex-col items-center gap-3 group mb-10 opacity-0 animate-fade-in-up">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-rose-100 group-hover:shadow-md group-hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-10 h-10 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22V12"></path>
                                <path d="M12 12C12 12 9 7 5 7C1 7 1 12 5 15C9 18 12 12 12 12Z"></path>
                                <path d="M12 12C12 12 15 7 19 7C23 7 23 12 19 15C15 18 12 12 12 12Z"></path>
                                <path d="M12 12C12 12 9 17 5 17C1 17 1 12 5 9C9 6 12 12 12 12Z" opacity="0.5"></path>
                                <path d="M12 12C12 12 15 17 19 17C23 17 23 12 19 9C15 6 12 12 12 12Z" opacity="0.5"></path>
                            </svg>
                        </div>
                        <h1 class="font-serif text-2xl font-bold tracking-tight text-stone-900 mt-1">Doble Encanto</h1>
                    </a>

                    <!-- Form Container -->
                    <div class="w-full bg-white sm:bg-transparent sm:shadow-none shadow-xl rounded-3xl p-6 sm:p-0 border sm:border-none border-stone-100 opacity-0 animate-fade-in-up delay-200">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
