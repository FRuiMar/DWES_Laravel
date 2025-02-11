<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class APICarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return response()->json([
            'status' => true,
            'cars' => $cars,
            'msg' => 'Listado de coches'
        ], 200); //el número 200 es el código de respuesta que significa que todo ha ido bien
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        return response()->json([
            'status' => true,
            'car' => $car,
            'msg' => 'Detalle del coche'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
