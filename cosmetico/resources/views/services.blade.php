<x-public-layout>
    <div class="pt-32 pb-24 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-stone-900 mb-4">Nuestros Servicios y Precios</h1>
                <p class="text-lg text-stone-600 max-w-2xl mx-auto">Conoce nuestra lista oficial de tratamientos faciales y masajes diseñados para tu bienestar y belleza.</p>
            </div>

            <!-- Faciales Section -->
            <h2 class="text-3xl font-bold text-stone-900 font-serif mb-8 border-b border-stone-200 pb-4">Faciales</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- 1. Limpieza básica -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/LimpiezaBasica.png" alt="Limpieza básica" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Limpieza Básica</h3>
                            <span class="text-rose-600 font-semibold">$15.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Tratamiento esencial para mantener la higiene de tu piel, eliminando impurezas superficiales.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Limpieza Básica']) : route('contact', ['service' => 'Limpieza Básica']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 2. Limpieza con peeling -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/peling.png" alt="Limpieza con peeling" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Limpieza con Peeling</h3>
                            <span class="text-rose-600 font-semibold">$17.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Renovación celular que mejora la textura de la piel y aporta mayor luminosidad al rostro.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Limpieza con Peeling']) : route('contact', ['service' => 'Limpieza con Peeling']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 3. Limpieza profunda -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/ultrasonido.png" alt="Limpieza Profunda" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Limpieza Profunda</h3>
                            <span class="text-rose-600 font-semibold">$20.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Desintoxicación total de poros, extracción de comedones y oxigenación para una piel sana y equilibrada.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Limpieza Profunda']) : route('contact', ['service' => 'Limpieza Profunda']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 4. Tratamiento nutritivo -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/portada.png" alt="Tratamiento Nutritivo" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Tratamiento Nutritivo</h3>
                            <span class="text-rose-600 font-semibold">$23.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Aporte intensivo de vitaminas e hidratación profunda para revitalizar pieles apagadas o deshidratadas.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Tratamiento Nutritivo']) : route('contact', ['service' => 'Tratamiento Nutritivo']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 5. Tratamiento nutritivo más masaje craneo facial -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/masajefacial.png" alt="Tratamiento Nutritivo + Masaje" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Nutritivo + Masaje Cráneo Facial</h3>
                            <span class="text-rose-600 font-semibold">$25.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">La combinación perfecta de nutrición intensiva facial y un masaje relajante en cráneo y rostro.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Nutritivo + Masaje Cráneo Facial']) : route('contact', ['service' => 'Nutritivo + Masaje Cráneo Facial']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Masajes Section -->
            <h2 class="text-3xl font-bold text-stone-900 font-serif mb-8 border-b border-stone-200 pb-4">Masajes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- 6. Craneo facial -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/masajefacial.png" alt="Masaje Cráneo Facial" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Masaje Cráneo Facial</h3>
                            <span class="text-rose-600 font-semibold">$15.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Alivio de tensión y estrés focalizado en el cráneo, rostro y cuello.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Masaje Cráneo Facial']) : route('contact', ['service' => 'Masaje Cráneo Facial']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 7. Espalda y cuello -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/cuelloEspalda.png" alt="Espalda y cuello" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Espalda y Cuello</h3>
                            <span class="text-rose-600 font-semibold">$20.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Masaje descontracturante y relajante para liberar las cargas acumuladas en espalda y cervical.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Espalda y Cuello']) : route('contact', ['service' => 'Espalda y Cuello']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 8. Cuerpo completo -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/cuerpoCompleto.png" alt="Cuerpo Completo" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Cuerpo Completo</h3>
                            <span class="text-rose-600 font-semibold">$30.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Relajación total para tu bienestar físico y mental, trabajando desde los pies hasta la cabeza.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Cuerpo Completo']) : route('contact', ['service' => 'Cuerpo Completo']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>

                <!-- 9. Masaje con piedras calientes -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-stone-100 group">
                    <div class="h-48 bg-stone-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <img src="https://ik.imagekit.io/ngrok/Cosmetics/masajesPiedras.png" alt="Masaje con Piedras Calientes" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-stone-900 font-serif">Masaje con Piedras Calientes</h3>
                            <span class="text-rose-600 font-semibold">$25.000</span>
                        </div>
                        <p class="text-stone-600 mb-6 line-clamp-3">Terapia profunda de relajación muscular y equilibrio energético a través del calor de las piedras volcánicas.</p>
                        <a href="{{ auth()->check() ? route('dashboard', ['service' => 'Masaje con Piedras Calientes']) : route('contact', ['service' => 'Masaje con Piedras Calientes']) }}" class="inline-block text-rose-600 font-semibold hover:text-rose-700 transition-colors">Agendar Cita &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
