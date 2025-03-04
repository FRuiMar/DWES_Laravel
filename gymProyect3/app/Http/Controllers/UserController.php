<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        $users = User::with(['activities', 'membership'])->get();
        return view('users.index', compact('users'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $memberships = Membership::all();
        return view('users.create', compact('memberships'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string|unique:users,dni',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'image' => 'nullable|string',
            'membership_id' => 'nullable|exists:memberships,id'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        $memberships = Membership::all();
        return view('users.edit', compact('user', 'memberships'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'dni' => 'string|unique:users,dni,' . $user->id,
            'name' => 'string',
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'string',
            'image' => 'nullable|string',
            'membership_id' => 'nullable|exists:memberships,id'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
