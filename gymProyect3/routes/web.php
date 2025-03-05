<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PdfController;





Route::get('/', function () {
    // Si el usuario está autenticado, redirigir al dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostrar la página de bienvenida
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('activities', ActivityController::class);

    Route::resource('memberships', MembershipController::class);
});


Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/mis-reservas', [UserController::class, 'myReservations'])->name('user.reservations');
    Route::delete('/mis-reservas/cancel/{reservationId}', [UserController::class, 'cancelReservation'])
        ->name('user.reservations.cancel');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::resource('users', UserController::class);
    // Ruta para generar PDF de usuarios
    Route::get('/pdf/users', [PdfController::class, 'generateUsersPdf'])->name('pdf.users');
    Route::resource('trainers', TrainerController::class);

    // Vista para gestionar todas las reservas (solo admin)
    Route::get('/admin/reservations', [UserController::class, 'adminReservations'])
        ->name('user.admin.reservations');

    // Cancelar una reserva específica (solo admin)
    Route::delete('/admin/reservations/{reservationId}', [UserController::class, 'adminCancelReservation'])
        ->name('user.admin.reservations.cancel');
});

require __DIR__ . '/auth.php';
