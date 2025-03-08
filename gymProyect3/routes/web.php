<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReservationController;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;



//Si no estás autenticado, vamos al Welcome
// Si estás autenticado, vamos al dashboard

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect()->route('dashboard');
//     }

//     // Cargar actividades para la página de bienvenida
//     $activities = Activity::with('trainer')->get();

//     // Agregar debug
//     Log::info('Welcome: Actividades cargadas: ' . count($activities));

//     // Asegúrate de pasar activities a la vista usando una de estas dos opciones:
//     // return view('welcome', compact('activities'));
//     return view('welcome', ['activities' => $activities]);
// });

Route::get('/', [ActivityController::class, 'welcome']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/activities/public',  [ActivityController::class, 'cards'])
    ->name('activities.public');




// -----   RUTAS PARA USUARIOS AUTENTICADOS. 
Route::middleware('auth')->group(function () {

    //Si son Usuarios NORMALES.
    Route::middleware(['isUser'])->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Ruta específica para ver actividades como cards para usuarios normales
        Route::get('/user-activities', [ActivityController::class, 'cardsUser'])
            ->name('activities.user-cards');

        // Ruta para crear reservas
        Route::post('/reservations', [ReservationController::class, 'store'])
            ->name('reservations.store');

        Route::resource('memberships', MembershipController::class);

        Route::get('/mis-reservas', [UserController::class, 'myReservations'])->name('user.reservations');
        Route::delete('/mis-reservas/cancel/{reservationId}', [UserController::class, 'cancelReservation'])
            ->name('user.reservations.cancel');


        // // Ruta para ver membresías disponibles (como tarjetas)
        // Route::get('/memberships-available', [MembershipController::class, 'indexUser'])->name('memberships.available');
    });



    //Si son Usuarios ADMINISTRADORES.
    Route::middleware(['auth', 'isAdmin'])->group(function () {

        //Rutas de Actividades para Administradores
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
        Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
        Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
        Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
        Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

        Route::resource('users', UserController::class);

        Route::get('/pdf/users', [PdfController::class, 'generateUsersPdf'])->name('pdf.users');
        Route::resource('trainers', TrainerController::class);

        Route::get('/admin/reservations', [UserController::class, 'adminReservations'])
            ->name('user.admin.reservations');

        Route::delete('/admin/reservations/{reservationId}', [UserController::class, 'adminCancelReservation'])
            ->name('user.admin.reservations.cancel');
    });
});


require __DIR__ . '/auth.php';
