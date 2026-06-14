<x-public-layout>
    <div class="relative pt-32 sm:pt-32 pb-20 sm:pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-stone-50 to-stone-50/50 mix-blend-multiply"></div>
            <div class="absolute top-0 right-0 w-1/2 h-full bg-rose-50/40 rounded-l-[100px] transform translate-x-1/4 skew-x-12 opacity-60"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left space-y-8 animate-fade-in-up">
                    <span class="inline-block px-4 py-1 rounded-full bg-rose-100 text-rose-700 text-sm font-semibold tracking-wider uppercase mb-2">Belleza que Ilumina</span>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-stone-900 leading-[1.1]">
                        Descubre tu <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-pink-600">resplandor</span> natural
                    </h1>
                    <p class="mt-4 text-xl text-stone-600 max-w-2xl mx-auto lg:mx-0 font-light">
                        Tratamientos cosméticos personalizados diseñados para realzar tu belleza única, utilizando ciencia avanzada y un toque de lujo.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-white bg-stone-900 hover:bg-stone-800 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            Explorar Servicios
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-stone-900 bg-white border border-stone-200 hover:border-rose-300 hover:bg-rose-50 shadow-sm hover:shadow-md transition-all duration-300">
                            Agendar Cita
                        </a>
                    </div>
                </div>
                <div class="relative lg:h-[600px] flex justify-center lg:justify-end">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-rose-200 to-pink-100 rounded-full blur-2xl opacity-50"></div>
                    <img src="https://ik.imagekit.io/ngrok/Cosmetics/portada.png" alt="Cosmetics" class="relative rounded-3xl shadow-2xl object-cover w-full max-w-md lg:max-w-full lg:h-full transform hover:scale-[1.02] transition-transform duration-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-stone-900">¿Por qué elegir dobleencanto.cl?</h2>
                <p class="mt-4 text-lg text-stone-600 max-w-2xl mx-auto">Nuestra filosofía se centra en la excelencia, utilizando productos de primera calidad y técnicas de vanguardia.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="text-center p-8 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-rose-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-stone-900">Expertos</h3>
                    <p class="text-stone-600">Profesionales altamente capacitados en el cuidado de la piel y cosmética avanzada.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center p-8 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-rose-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-stone-900">Ciencia</h3>
                    <p class="text-stone-600">Tecnología de última generación y productos científicamente probados.</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center p-8 rounded-2xl bg-stone-50 border border-stone-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-rose-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-stone-900">Resultados</h3>
                    <p class="text-stone-600">Tratamientos enfocados en resultados reales y duraderos para tu piel.</p>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
