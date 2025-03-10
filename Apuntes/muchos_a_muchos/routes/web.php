<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/profesor', [UserController::class, 'index'])->name('profesor.index');
Route::get('/profesor/create', [UserController::class, 'create'])->name('profesor.create');
Route::post('/profesor/create', [UserController::class, 'store'])->name('profesor.store');
Route::get('/profesor/nota', [UserController::class, 'nota'])->name('profesor.nota');
Route::post('/profesor/nota', [UserController::class, 'putnota'])->name('profesor.nota');

require __DIR__.'/auth.php';
