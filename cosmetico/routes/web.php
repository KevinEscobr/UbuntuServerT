<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppointmentController;
use App\Models\Appointment;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    // Slots ocupados: fecha => [horas...]
    $bookedSlots = \App\Models\Appointment::whereIn('status', ['pending', 'confirmed'])
        ->selectRaw('date, time')
        ->get()
        ->groupBy(fn($a) => \Carbon\Carbon::parse($a->date)->format('Y-m-d'))
        ->map(fn($group) => $group->pluck('time')->map(fn($t) => \Carbon\Carbon::parse($t)->format('H:i'))->values());

    $bookedSlotsJson = $bookedSlots->toJson();

    if (auth()->user()->is_admin) {
        $appointments = \App\Models\Appointment::with('user')->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        return view('dashboard', compact('appointments', 'bookedSlotsJson'));
    } else {
        $appointments = auth()->user()->appointments()->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        return view('dashboard', compact('appointments', 'bookedSlotsJson'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointments.update');
    Route::post('/appointments/bulk-status', [AppointmentController::class, 'bulkUpdateStatus'])->name('appointments.bulk-status');
    Route::delete('/appointments/bulk-delete', [AppointmentController::class, 'bulkDestroy'])->name('appointments.bulk-delete');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
