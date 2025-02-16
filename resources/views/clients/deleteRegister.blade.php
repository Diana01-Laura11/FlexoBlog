 @extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Clientes Eliminados Temporalmente</h1>
        <!-- DataTable with  -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <style>
                    .right-align {
                        text-align: right;
                    }

                    .d-flex.justify-content-end.mb-3 {
                        margin-top: 30px;
                        /* Ya lo habíamos agregado */
                        margin-right: 50px;
                        /* Ajusta este valor para moverlo más a la izquierda */
                    }

                    .d-flex.justify-content-end.mb-3 a.btn {
                        padding: 10px 20px 10px;
                        /* Ajusta el padding interno del botón si es necesario */
                    }

                  
                </style>

                
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif


                {{-- <table class="table"> --}}
                    <table id="deletedClientsTable" class="table">
                    <thead> 
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientDelete as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->manager_first_name }}</td>
                                <td>{{ $client->manager_last_name }}</td>
                                <td>{{ $client->manager_email }}</td>
                                <td>
                                    <!-- Botón para restaurar cliente -->
                                    <a href="{{ route('clients.restoreClient', $client->id) }}" class="btn btn-success btn-sm">Restaurar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No existen registros!</td> 
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </div>
        <hr class="my-12" />

    </div>
    <!--/ Content -->
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
  {{-- Scrip para paginacion --}}
  <script>
    $(document).ready(function() {
        // Inicialización de DataTable
        $('#deletedClientsTable').DataTable({
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
