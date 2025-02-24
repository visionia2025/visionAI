@extends('layouts.app')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- jQuery y DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#miTabla').DataTable(); // Activación sin configuraciones personalizadas
});
</script>
    <!-- Contenido principal -->
    <div class="app-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Lista de Usuarios</h2>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Crear Usuario
            </a>
        </div>
        <div class="table-responsive mt-3">
            <table id="miTabla" class="table table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th style='text-align:center'>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->roles->nombreRol }}</td>
                        <td>
                            <span class="badge bg-{{ $usuario->estado == 1 ? 'success' : 'danger' }}">
                                {{ $usuario->estado  == 1? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td style="display: flex; gap: 10px; align-items: center;">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" title='Actualizar usuario'>
                                <i style='color: rgb(72 72 72) !important;' class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="{{ route('usuarios.inactivar', $usuario->id) }}" title='Inactivar usuario'>
                                <i style='color: rgb(72 72 72) !important;' class="bi bi-trash-fill"></i>
                            </a>
                            <a href="{{ route('usuarios.logs', $usuario->id) }}" title='Logs'>
                                <i style='color: rgb(72 72 72) !important;' class="bi bi-list-check"></i>
                            </a>
                            <a href="{{ route('usuarios.permisos', $usuario->id) }}" title='Permisos de usuario'>
                                <i style='color: rgb(72 72 72) !important;' class="bi bi-shield-fill"></i>
                            </a>

                        </td>                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
