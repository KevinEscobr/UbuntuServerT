<x-guest-layout>
    <div class="flex flex-col items-center text-center">
        <!-- Ícono Elegante de Correo -->
        <div class="w-16 h-16 bg-rose-50 rounded-full flex items-center justify-center mb-6 text-rose-500 border border-rose-100 shadow-inner animate-pulse">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
        </div>

        <h3 class="font-serif text-2xl font-bold text-stone-900 mb-3">Verifica tu Correo</h3>

        <p class="text-stone-600 text-sm leading-relaxed mb-4 max-w-sm">
            ¡Gracias por registrarte en <strong>Doble Encanto</strong>! Antes de comenzar a agendar tus citas, necesitamos verificar tu cuenta.
        </p>
        
        <p class="text-stone-500 text-xs leading-relaxed mb-6 max-w-sm">
            Por favor, revisa tu correo electrónico y haz clic en el enlace de confirmación que te acabamos de enviar.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="p-4 mb-6 text-xs text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
            </svg>
            <div class="text-left font-medium">
                Hemos enviado un nuevo enlace de verificación a la dirección de correo que ingresaste. ¡Por favor revisa tu bandeja de entrada o carpeta de spam!
            </div>
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 w-full">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full shadow-md text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition-all duration-150">
                Reenviar Correo
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="text-sm font-medium text-stone-500 hover:text-rose-600 underline underline-offset-4 decoration-stone-300 hover:decoration-rose-500 transition-colors">
                Cerrar Sesión
            </button>
        </form>
    </div>
</x-guest-layout>

