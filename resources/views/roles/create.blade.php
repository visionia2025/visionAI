@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Crear rol</h2>
    <form action="{{ route('rolesRegister.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombreRol" class="form-label">Nombre rol</label>
            <input type="text" class="form-control" id="nombreRol" name="nombreRol" required>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg"></i> Guardar rol
        </button>
        <a href="{{ route('roles.lstRoles') }}" class="btn btn-danger">
            <i class="bi bi-arrow-left"></i> Cancelar
        </a>
    </form>
</div>
@endsection
