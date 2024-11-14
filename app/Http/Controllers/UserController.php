<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Adjust the namespace according to your structure


class UserController extends Controller
{
    public function index()
    {
        // Obtiene todos los usuarios
        $users = User::all();

        // Retorna la vista de index con los usuarios
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        // Retrieve the user along with their reservations using eager loading
        $user = User::with('reservations.event')->findOrFail($id);

        // Return the 'show' view with the user data
        return view('users.show', compact('user'));
    }


    public function changeRole(Request $request, User $user)
    {
        // Validate the role input
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        // Update the user's role
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit()
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit your profile.');
        }

        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Retorna la vista de edición con el usuario actual en la nueva ubicación
        return view('profile.edit', compact('user')); // Cambiado aquí
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Obtiene el usuario autenticado
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Solo actualiza la contraseña si se proporciona
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Guarda los cambios
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
