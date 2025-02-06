<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cars.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validatge([
            'matricula' => 'required|unique:cars,matricula',
            'marca' => 'required',
            'modelo' => 'required',
            'year' => 'required|integer',
            'color' => 'required',
            'fecha' => 'required|date',
            'precio' => 'required|numeric',
            'foto' => 'required|image',
        ]);



        $newcar = new Car();
        $newcar->matricula = $request->matricula;
        $newcar->marca = $request->marca;
        $newcar->modelo = $request->modelo;
        $newcar->year = $request->year;
        $newcar->color = $request->color;
        $newcar->fecha = $request->fecha;
        $newcar->precio = $request->precio;

        $newcar->user_id = Auth::id();

        $nombrefoto = time() . "-" . $request->file('foto')->getClientOriginalName();
        $newcar->foto = $nombrefoto;

        $newcar->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
