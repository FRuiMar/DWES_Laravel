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
        $car = Car::create(request()->all());
        return response()->json([
            'status' => true,
            'msg' => 'Coche creado correctamente',
            //'car' => $car
        ], 201); //el número 201 es el código de respuesta que significa que se ha creado un recurso

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
        $car = Car::find($id); //primero lo busco
        $car->update(request()->all()); //ahora lo sobre escribo con los datos nuevos. /actualizo/update
        return response()->json([
            'status' => true,
            'msg' => 'Coche actualizado correctamente',
            //'car' => $car
        ], 200); //el número 200 es el código de respuesta que significa que todo ha ido bien

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id); //primero lo busco
        $car->delete(); //ahora lo sobre escribo con los datos nuevos. /actualizo/update
        return response()->json([
            'status' => true,
            'msg' => 'Coche borrado correctamente',
            //'car' => $car
        ], 200); //el número 200 es el código de respuesta que significa que todo ha ido bien

    }
}
