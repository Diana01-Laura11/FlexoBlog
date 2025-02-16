{{-- @extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Articulos Eliminados</h1>
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


                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Creado</th>
                            <th>Publicado</th>
                            <th>Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articleDelete as $deleteArticle)
                            <tr>
                                <td>{{ $deleteArticle->id_post }}</td>
                                <td>{{ $deleteArticle->title }}</td>
                                <td>{{ $deleteArticle->creation_date }}</td>
                                <td>{{ $deleteArticle->publication_date }}</td>
                                <td>
                                    <!-- Botón para restaurar articulo -->
                                    <a href="{{ route('articles.restoreArticle', $deleteArticle->id_post) }}"
                                        class="btn btn-success btn-sm">Restaurar</a>
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
    

   
@endsection --}}



@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Articulos Eliminados</h1>
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

                <table id="articles" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Creado</th>
                            <th>Publicado</th>
                            <th>Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articleDelete as $deleteArticle)
                            <tr>
                                <td>{{ $deleteArticle->id_post }}</td>
                                <td>{{ $deleteArticle->title }}</td>
                                <td>{{ $deleteArticle->creation_date }}</td>
                                <td>{{ $deleteArticle->publication_date }}</td>
                                <td>
                                    <!-- Botón para restaurar articulo -->
                                    <a href="{{ route('articles.restoreArticle', $deleteArticle->id_post) }}"
                                        class="btn btn-success btn-sm">Restaurar</a>
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

    <script>
        $(document).ready(function() {
            // Inicialización de DataTable con paginación
            $('#articles').DataTable({
                "lengthMenu": [ 10, 25, 50, 75, 100 ], // Opciones de "Show entries"
                "pageLength": 10, // Cantidad predeterminada de registros por página
                "paging": true, // Habilita la paginación
                "searching": true, // Habilita la búsqueda
                "ordering": true, // Habilita el ordenamiento de columnas
                "info": true, // Muestra la información de la tabla
            });
        });
    </script>
@endsection
