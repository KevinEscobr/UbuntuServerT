use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/test-email', function () {
    try {
        Mail::raw('Si recibes este correo, tu configuración SMTP de Brevo es correcta.', function ($message) {
            $message->to('tu-correo-personal@ejemplo.com') // Pón tu correo aquí
                    ->subject('Prueba de conexión SMTP');
        });

        return '¡Correo enviado con éxito!';
    } catch (\Exception $e) {
        return 'Error al enviar: ' . $e->getMessage();
    }
});
