<x-guest-layout>
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 font-serif">¡Bienvenida de vuelta!</h2>
        <p class="text-stone-500 mt-2 text-sm sm:text-base">Ingresa tus credenciales para acceder a tu panel.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Correo Electrónico</label>
            <input id="email" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm" 
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-sm font-semibold text-stone-700">Contraseña</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-stone-500 hover:text-stone-900 transition-colors" href="{{ route('password.request') }}">
                        ¿La olvidaste?
                    </a>
                @endif
            </div>

            <input id="password" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm"
                type="password"
                name="password"
                required autocomplete="current-password"
                placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-1">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-stone-300 text-stone-900 focus:ring-stone-900 cursor-pointer transition-colors" name="remember">
            <label for="remember_me" class="ms-3 text-sm text-stone-600 cursor-pointer select-none">Recordarme en este equipo</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full h-12 flex justify-center items-center px-4 rounded-xl text-sm font-semibold text-white bg-stone-900 hover:bg-stone-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-900 transition-all duration-300 shadow-md hover:shadow-lg">
                Iniciar Sesión
            </button>
        </div>

        <div class="text-center pt-6 sm:text-left">
            <p class="text-sm text-stone-500">
                ¿Aún no tienes cuenta? 
                <a href="{{ route('register') }}" class="font-semibold text-stone-900 hover:underline transition-all">Regístrate aquí</a>
            </p>
        </div>
    </form>
</x-guest-layout>
