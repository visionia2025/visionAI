<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function lstUsuarios ()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('usuarios.lstUsuarios', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all(); // Obtener todos los usuarios
        return view('usuarios.create',compact('roles'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function permisos($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.permisos', compact('usuario'));
    }

    public function inactivar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update(['activo' => false]);
        return redirect()->route('usuarios.lstUsuarios')->with('success', 'Usuario inactivado');
    }

    public function logs($id)
    {
        // Lógica para mostrar el registro de inicios de sesión
        return view('usuarios.logs', compact('id'));
    }
    /**
     * Función para registrar el usuario dentro de la plataforma
     */
    public function createProcess(Request $request){
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'password' => 'required|string|min:8|confirmed',
            'rol_id' => 'required|integer|exists:roles,id'            
        ]);

        // Creación del usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'idRol' => 1,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('usuarios.lstUsuarios')->with('success', 'El usuario se registro exitosamente.');
    }
}
