<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lstRoles(){
        $lstRoles = Rol::all(); // Obtener todos los roles
        return view('roles.lstRoles', compact('lstRoles'));
    }
    public function create(){
        return view('roles.create');
    }

    public function createProcess(Request $request){  
        // Validación de datos
        $request->validate([
            'nombreRol' => 'required|string|max:255',
        ]);
             
        // Creación del usuario
        $result = Rol::create([
            'nombreRol' => $request->nombreRol,
            'estado' => 1,
        ]);

        $redirect = redirect()->route('roles.lstRoles');
        if(!$result){
            $redirect->with('danger', 'Error,el rol no se registro.');
        }else{
            $redirect->with('success', 'El rol se registro exitosamente.');
        }
        return $redirect;
    }
    public function edit($id){ 
        $rol = $this->finRol($id);
        if (!$rol) {
            return redirect()->route('roles.lstRoles')->with('danger', 'El registro solicitado no se encuentra en el sistema.');
        }
        $relUser = $this->relUser($id);
        return view('roles.edit',compact('rol','relUser'));

    }

    public function editProcess(Request $request){  
        // Obtener el ID del rol
        $rol = $this->finRol($request->id);
        if (!$rol) {
            return redirect()->route('roles.lstRoles')->with('danger', 'El registro solicitado no se encuentra en el sistema.');
        }

        $request->validate([
            'nombreRol' => 'required|string|max:255',
        ]);
      
        // Actualizar los datos del usuario
        $rol->nombreRol = $request->nombreRol;
        $result = $rol->save();
         
        $redirect = redirect()->route('roles.lstRoles');
        if(!$result){
            $redirect->with('danger', 'Error,el rol no se pudo actualizar.');
        }else{
            $redirect->with('success', 'El rol se actualizó exitosamente.');
        }
        return $redirect;
    }

    public function inactiveProccess(Request $request){  
        $id = $request->id;
        $rol = $this->finRol($id);
        if (!$rol) {
            return redirect()->route('roles.lstRoles')->with('danger', 'El registro solicitado no se encuentra en el sistema.');
        }
        $newState = $rol->estado == 1 ? 0 : 1; 
        $relUser = $this->relUser($id);
        if (!is_null($relUser) && $newState == 0) {
            return redirect()->route('roles.lstRoles')->with('danger', 'El rol no se puede inactivar, tiene usuarios asociados.');
        }
        $rol->estado = $newState;
        $result = $rol->save();
        $redirect = redirect()->route('roles.lstRoles');
        if(!$result){
            $redirect->with('danger', 'Error al cambiar el estado del rol.');
        }else{
            $redirect->with('success', 'El estado se actualizó exitosamente.');
        }
        return $redirect;
    }

    public function finRol($id){
        return Rol::findOrFail($id);
    }

    public function relUser($idRol){
        return User::where('idRol',$idRol)->first();
    }

}
