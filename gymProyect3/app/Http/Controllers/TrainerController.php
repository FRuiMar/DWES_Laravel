<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainer::all();
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:255|unique:trainers,dni',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);

        Trainer::create($validated);

        return redirect()->route('trainers.index')->with('success', 'Entrenador creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:255|unique:trainers,dni,' . $trainer->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);

        $trainer->update($validated);

        return redirect()->route('trainers.index')->with('success', 'Entrenador actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->activities()->delete(); // Elimina actividades relacionadas
        $trainer->delete();
        return redirect()->route('trainers.index')->with('success', 'Entrenador eliminado correctamente.');
    }
}
