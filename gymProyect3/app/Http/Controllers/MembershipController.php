<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::all();
        return view('memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memberships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
        ]);

        Membership::create($validated);

        return redirect()->route('memberships.index')->with('success', 'Membresía creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        return view('memberships.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
        ]);

        $membership->update($validated);

        return redirect()->route('memberships.index')->with('success', 'Membresía actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.    cambio a los usuarios a SIN MEMBRESÍA.
     */
    public function destroy(Membership $membership)
    {
        $defaultMembership = Membership::where('type', 'Sin membresía')->first();
        if (!$defaultMembership) {
            $defaultMembership = Membership::create([
                'type' => 'Sin membresía',
                'price' => 0,
                'duration_months' => 0,
            ]);
        }

        $membership->users()->update(['membership_id' => $defaultMembership->id]);
        $membership->delete();

        return redirect()->route('memberships.index')->with('success', 'Membresía eliminada correctamente.');
    }
}
