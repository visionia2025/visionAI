<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $roles;

    public function __construct()
    {
        $this->roles = Rol::all(); // Obtener todos los usuarios
        $this->middleware('auth');
    }
    public function lstUsuarios ()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('usuarios.lstUsuarios', compact('usuarios'));
    }

    public function create()
    {
        $roles = $this->roles; // Obtener todos los usuarios
        return view('usuarios.create',compact('roles'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = $this->roles; // Obtener todos los usuarios
        return view('usuarios.edit', compact('roles','usuario'));
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
     
        if ($request->has('rol_id')) {
            $id_rol = $request->rol_id;
        }else{
            $id_rol = 1;
        }
        // Creación del usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'idRol' => $id_rol,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('usuarios.lstUsuarios')->with('success', 'El usuario se registro exitosamente.');
    }

    public function editProcess(Request $request){        
        // Obtener el ID del usuario
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->route('usuarios.lstUsuarios')->with('danger', 'El registro solicitado no se encuentra en el sistema.');
        }
        // Validación de datos
        $request->validate([
            'birthdate' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'password' => 'required|string|min:8|confirmed',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $request->id . ',id',
            'rol_id' => 'required|integer|exists:roles,id'    
        ]);

        // Actualizar los datos del usuario
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        
        if ($request->has('birthdate')) {
            $user->birthdate = $request->birthdate;
        }
        
        if ($request->has('rol_id')) {
            $user->idRol = $request->rol_id;
        }
        $result = $user->save();
        if(!$result){
            return redirect()->route('usuarios.lstUsuarios')->with('danger', 'Error, el usuario no se pudo actualizar.');
        }else{
            return redirect()->route('usuarios.lstUsuarios')->with('success', 'El usuario se actualizó exitosamente.');
        }
    }
}
