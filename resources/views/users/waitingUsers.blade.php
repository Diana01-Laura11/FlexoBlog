@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <br>
    <br>
    <h1 class="text-center">Usuarios En Espera </h1>

    {{-- <h2 class="mb-4">Usuarios en Espera</h2> --}}

    {{-- <table class="table table-striped"> --}}
        <table id="deletedUsersTable" class="table">
 
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userWait as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('users.editUser', $user->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Asignar Rol, Permisos Y Activar Usuario
                        </a>
                    </td>

                 
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay usuarios en espera</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> 

@endsection

  

@section('js')
  {{-- Scrip para la paginacion --}}
  <script>
    $(document).ready(function() {
        // Inicialización de DataTable
        $('#deletedUsersTable').DataTable({
            "paging": true, // Habilita la paginación
            "lengthMenu": [ 10, 25, 50, 75, 100 ], // Opciones de "Show entries"
            "pageLength": 10, // Número predeterminado de registros por página
            "searching": true, // Habilita la búsqueda
            "ordering": true, // Habilita el ordenamiento de las columnas
            "info": true, // Muestra información de la tabla
        });
    });
</script>

@endsection
