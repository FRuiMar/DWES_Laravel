<?php

use App\Http\Controllers\APICarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('cars', APICarController::class);  //ponemos cars para que cuando busquemos las rutas salgan api/cars .... o api/cars/{car}