<?php

namespace App\Http\Controllers;

use App\Models\Car;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\User;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $mycars = $user->cars()->orderBy('matricula')->get();
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
        $request->validate([
            'matricula' => 'required|unique:cars,matricula, NULL, id, deleted_at, NULL',
            'marca' => 'required',
            'modelo' => 'required',
            'year' => 'required|integer',
            'color' => 'required',
            'fecha' => 'required|date',
            'precio' => 'required|numeric',
            'foto' => 'required|image',
        ]);


        try {
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

            $request->file('foto')->storeAs('img_cars', $nombrefoto);
            //storeAs('public/img_cars', $nombrefoto);
            //crea una carpeta public.. pero dentro de private.. hay que cambiarlo en flisystems.php en la carpeta config. en en el env.

            return to_route('cars.index')->with('msg', 'Coche añadido correctamente');
        } catch (QueryException $qe) {
            return to_route('cars.index')->with('msg', 'Error al añadir el coche. Intentelo más tarde');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        // return view('cars.show', ['car' => $car->id]);
        return view('cars.show')->with('mycar', $car);
    }
    // public function show($id)
    // {
    //     return view('cars.show')->with('mycar',$car);
    // }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit')->with('mycar', $car);
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
        $car->delete();
        return to_route('cars.index')->with('msg', 'Coche eliminado correctamente');
    }
}
