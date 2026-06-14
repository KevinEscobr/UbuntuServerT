<x-guest-layout>
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 font-serif">Crear Cuenta</h2>
        <p class="text-stone-500 mt-2 text-sm sm:text-base">Únete a Doble Encanto y agenda tu próxima cita.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Nombre Completo</label>
            <input id="name" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm" 
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                placeholder="Tu nombre y apellido" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Correo Electrónico</label>
            <input id="email" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm" 
                type="email" name="email" :value="old('email')" required autocomplete="username" 
                placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-stone-700 mb-1.5">Teléfono</label>
            <input id="phone" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm" 
                type="tel" name="phone" :value="old('phone', '+56')" required 
                placeholder="+56 9 1234 5678" />
            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Contraseña</label>
            <input id="password" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm"
                type="password"
                name="password"
                required autocomplete="new-password"
                placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-stone-700 mb-1.5">Confirmar Contraseña</label>
            <input id="password_confirmation" 
                class="block w-full h-11 px-4 rounded-xl border border-stone-200 focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all bg-stone-50/50 hover:bg-stone-50 text-stone-800 text-sm"
                type="password"
                name="password_confirmation" required autocomplete="new-password"
                placeholder="Repite tu contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full h-12 flex justify-center items-center px-4 rounded-xl text-sm font-semibold text-white bg-stone-900 hover:bg-stone-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-900 transition-all duration-300 shadow-md hover:shadow-lg">
                Crear Cuenta
            </button>
        </div>

        <div class="text-center pt-6 sm:text-left">
            <p class="text-sm text-stone-500">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline transition-all">Inicia sesión aquí</a>
            </p>
        </div>
    </form>
</x-guest-layout>
