<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string',
            'date'    => 'required|date|after:today',
            'time'    => 'required',
        ], [
            'date.after' => 'Las reservas deben realizarse con al menos un día de anticipación. Si necesitas atención urgente, llámanos directamente al +56 9 1234 5678.',
        ]);

        $slotTaken = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($slotTaken) {
            return back()
                ->withInput()
                ->withErrors(['time' => 'Este horario ya está reservado para esa fecha. Por favor elige otro horario disponible.']);
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'service' => $request->service,
            'date'    => $request->date,
            'time'    => $request->time,
            'status'  => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', '¡Tu cita ha sido agendada con éxito!');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        if (!Auth::user()->is_admin) abort(403);

        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        $appointment->update(['status' => $request->status]);

        return redirect()->route('dashboard')->with('success', '¡El estado de la cita ha sido actualizado!');
    }

    public function bulkUpdateStatus(Request $request)
    {
        if (!Auth::user()->is_admin) abort(403);

        $request->validate([
            'ids'    => 'required|array',
            'ids.*'  => 'integer|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        Appointment::whereIn('id', $request->ids)->update(['status' => $request->status]);
        $count = count($request->ids);

        return redirect()->route('dashboard')->with('success', "¡{$count} cita(s) actualizadas correctamente!");
    }

    public function bulkDestroy(Request $request)
    {
        if (!Auth::user()->is_admin) abort(403);

        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:appointments,id',
        ]);

        $count = Appointment::whereIn('id', $request->ids)->delete();

        return redirect()->route('dashboard')->with('success', "¡{$count} cita(s) eliminadas correctamente!");
    }
}
