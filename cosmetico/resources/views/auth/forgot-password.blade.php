<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-stone-900 font-serif">Recuperar Contraseña</h2>
        <p class="text-stone-500 mt-2">¿Olvidaste tu contraseña? No hay problema. Dinos tu correo y te enviaremos un enlace para restablecerla.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-stone-700 mb-2">Correo Electrónico</label>
            <input id="email" 
                class="block w-full h-12 px-4 rounded-2xl border-stone-200 shadow-sm focus:border-rose-400 focus:ring focus:ring-rose-200 focus:ring-opacity-50 transition-all bg-stone-50 hover:bg-white text-stone-800" 
                type="email" name="email" :value="old('email')" required autofocus 
                placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full h-12 flex justify-center items-center px-4 border border-transparent rounded-2xl shadow-lg text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95">
                Enviar Enlace de Recuperación
            </button>
        </div>

        <div class="text-center pt-4 border-t border-stone-100">
            <a href="{{ route('login') }}" class="text-sm font-bold text-rose-600 hover:text-rose-700 transition-colors">Volver al inicio de sesión</a>
        </div>
    </form>
</x-guest-layout>
