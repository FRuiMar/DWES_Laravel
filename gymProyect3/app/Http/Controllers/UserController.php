<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        $users = User::with('membership')->get();
        return view('users.index', compact('users'));
    }

    // Mostrar detalles de un usuario específico
    public function show(User $user)
    {
        $user->load('membership', 'activities');
        return view('users.show', compact('user'));
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
        try {
            $validated = $request->validate([
                'dni' => 'required|string|unique:users,dni',
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:5|confirmed',
                'role' => 'required|string|in:ADMIN,NORMAL',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'membership_id' => 'nullable|exists:memberships,id'
            ]);

            // Manejar la subida de imagen si existe
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('users', 'public');
                $validated['image'] = $path;
            }

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);
            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Error de base de datos (duplicados, restricciones, etc)
            Log::error('Error al crear usuario (DB): ' . $e->getMessage());
            $errorCode = $e->errorInfo[1] ?? null;

            if ($errorCode == 1062) { // Código de error de duplicate entry
                return back()->withInput()->with('error', 'Ya existe un usuario con ese DNI o correo electrónico.');
            }

            if ($errorCode == 1265) { // Código para data truncated
                return back()->withInput()->with('error', 'El rol seleccionado no es válido. Debe ser ADMIN o NORMAL.');
            }

            // Otros errores de base de datos
            return back()->withInput()->with('error', 'Error de base de datos al crear el usuario.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Los errores de validación ya son manejados por Laravel, pero podemos personalizarlos
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Cualquier otro error
            Log::error('Error al crear usuario: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Ha ocurrido un error al crear el usuario.');
        }
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
        try {
            $validated = $request->validate([
                'dni' => 'string|unique:users,dni,' . $user->id,
                'name' => 'string',
                'email' => 'string|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:5|confirmed',
                'role' => 'string|in:ADMIN,NORMAL',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'membership_id' => 'nullable|exists:memberships,id'
            ]);

            // Manejar la subida de imagen si existe
            if ($request->hasFile('image')) {
                // Eliminar imagen anterior si existe
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }

                $path = $request->file('image')->store('users', 'public');
                $validated['image'] = $path;
            }

            if (isset($validated['password']) && $validated['password']) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Error de base de datos
            Log::error('Error al actualizar usuario (DB): ' . $e->getMessage());
            $errorCode = $e->errorInfo[1] ?? null;

            if ($errorCode == 1062) { // Duplicate entry
                return back()->withInput()->with('error', 'Ya existe un usuario con ese DNI o correo electrónico.');
            }

            return back()->withInput()->with('error', 'Error de base de datos al actualizar el usuario.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Los errores de validación ya son manejados por Laravel
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Cualquier otro error
            Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Ha ocurrido un error al actualizar el usuario.');
        }
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        try {
            // Verificar si el usuario tiene relaciones importantes
            if ($user->activities()->count() > 0) {
                return back()->with('warning', 'No se puede eliminar el usuario porque tiene actividades asociadas.');
            }

            // Puedes agregar más verificaciones de relaciones según tu modelo

            // Eliminar la imagen si existe
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Error al eliminar usuario (DB): ' . $e->getMessage());

            // Comprobar si es un error de restricción de clave foránea
            if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
                return back()->with('error', 'No se puede eliminar el usuario porque tiene relaciones en la base de datos.');
            }

            return back()->with('error', 'Error de base de datos al eliminar el usuario.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al eliminar el usuario.');
        }
    }

    public function myReservations()
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Debug para ver el contenido del usuario
        //dd($user);  // Esto mostrará el objeto completo del usuario

        // Obtiene todas sus actividades con fecha de reserva
        $reservations = $user->activities()
            ->withPivot('reservation_date')
            ->orderBy('reservation_date', 'desc')  // Ordenadas por fecha (más recientes primero)
            ->get();

        return view('user.reservations', compact('reservations'));
    }
}
