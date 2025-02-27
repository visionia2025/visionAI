@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Actualizar Usuario</h2>
    <form action="{{ route('usuarioUpdate.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="hidden" class="form-control" id="id" name="id" required value="{{$usuario->id}}">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$usuario->name}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required value="{{$usuario->email}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control" required value="{{$usuario->birthdate}}">
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" id="rol" name="rol_id" required>
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $rol)
                    <option @if($usuario->idRol ==$rol->id ) selected @endif value="{{ $rol->id }}">{{ $rol->nombreRol }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Confirmar contraseña">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg"></i> Actualizar Usuario
        </button>
        <a href="{{ route('usuarios.lstUsuarios') }}" class="btn btn-danger">
            <i class="bi bi-arrow-left"></i> Cancelar
        </a>
    </form>
</div>
@endsection
