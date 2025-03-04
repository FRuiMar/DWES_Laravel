<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Trainer;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('trainer')->get();
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::all();
        return view('activities.create', compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string',
            'max_capacity' => 'required|integer|min:1',
            'trainer_id' => 'nullable|exists:trainers,id',
            'image' => 'nullable|string',
        ]);

        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Actividad creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $trainers = Trainer::all();
        return view('activities.edit', compact('activity', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string',
            'max_capacity' => 'required|integer|min:1',
            'trainer_id' => 'nullable|exists:trainers,id',
            'image' => 'nullable|string',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Actividad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Actividad eliminada correctamente.');
    }
}
