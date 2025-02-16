@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Clientes Actuales</h1>
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

                    /* .deleteRegisters{
                        color: red;
                        background-color: red
                    } */
                </style>

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Nuevo Cliente</a>

                        <a href="{{ route('clients.deleteRegister') }}" class="btn btn-danger ms-5">
                            <i class="fas fa-trash me-2"></i>
                            Clientes Eliminados
                        </a>
                </div>
                {{-- <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('clients.deleteRegister') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Clientes Eliminados</a>
                </div> --}}
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif


                <table id="articles" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $clientDetail)
                            <tr>
                                <td>{{ $clientDetail->id }}</td> <!-- ID de la promocion -->
                                <td>{{ $clientDetail->manager_first_name }}</td>
                                <td>{{ $clientDetail->manager_last_name }}</td>
                                <td>{{ $clientDetail->manager_email }}</td>

                                <td>
                                    <a href="{{ route('clients.editClient', $clientDetail->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i> Editar Cliente
                                    </a>
                                </td>
                                {{-- <td><a href="{{ route('clients.deleteRegister', $clientDetail->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-x me-2"></i>
                                        Eliminar</a>
                                </td> --}}

                                <td>
                                    <form action="{{ route('clients.destroy', $clientDetail->id) }}"
                                        method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-promotions">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td>

                               
                                
                            </tr>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No existen registros!</td>
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
    {{-- 
<script>
    $(document).ready(function(){
        $('#articles').DataTable();
    });
</script> --}}
@endsection
