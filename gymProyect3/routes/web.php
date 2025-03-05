<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController; // Añade esta importación
use App\Http\Controllers\ActivityController; // Añade esta importación
use App\Http\Controllers\TrainerController; // Añade esta importación
use App\Http\Controllers\MembershipController; // Añade esta importación




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

    Route::resource('users', UserController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('trainers', TrainerController::class);
    Route::resource('memberships', MembershipController::class);

    // Ruta para mostrar las reservas del usuario
    Route::get('/mis-reservas', [UserController::class, 'myReservations'])->name('user.reservations');
    Route::delete('/mis-reservas/{activity}', [UserController::class, 'cancelReservation'])
        ->name('user.reservations.cancel');
});

require __DIR__ . '/auth.php';
