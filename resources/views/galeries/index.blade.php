@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Lista de Galerias</h1>
        <!-- DataTable with  -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <style>
                    .right-align {
                        text-align: right;
                    }

                    .d-flex.justify-content-end.mb-3 {
                        margin-top: 30px;
                        margin-right: 50px;
                        /* Ajusta este valor para moverlo más a la izquierda */
                    }

                    .d-flex.justify-content-end.mb-3 a.btn {
                        padding: 10px 20px 10px;
                        /* Ajusta el padding interno del botón si es necesario */
                    }
                </style>
                <!-- Mostrar mensaje de error si existe -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif


                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('galeries.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Nueva Galeria</a>

                        <a href="{{ route('galeries.deleteRegister') }}" class="btn btn-danger ms-5">
                            <i class="fas fa-trash me-2"></i>
                            Galerias Eliminadas
                        </a>
                </div>
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif


                <table id="galeries" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Titulo</th>
                            <th>Ver</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->gallery_id }}</td> <!-- ID de la galería -->
                                <td>{{ $gallery->title }}</td>
                                <td>
                                    <a href="{{ route('galeries.preview', $gallery->gallery_id) }}" class="btn btn-sm btn-info">
                                        <i class="fa-regular fa-eye me-2"></i> Vista previa
                                    </a>

                                    <!--<a href="{{ route('galeries.preview', ['gallery_id' => $gallery->gallery_id, 'alias' => $gallery->alias]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye me-2"></i> Ver en web
                                    </a>-->
                                </td>
                                <td>
                                    @if ($gallery->status === 'Published')
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-2"></i> Sí Publicado
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-sm" style="background-color: rgb(192, 15, 109); color: white;">
                                            <i class="fas fa-times me-2"></i> No Publicado
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('galeries.edit', $gallery->gallery_id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i> Editar Galería
                                    </a>
                                </td>
                                {{-- <td> ORIGINAL
                                    <form action="{{ route('galeries.deleteGalleries', $gallery->gallery_id) }}" method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-galeries">
                                            <i class="fa-solid fa-x me-2"></i> Eliminar
                                        </button>
                                    </form>
                                </td> --}}

                                <td>
                                    <form action="{{ route('galeries.destroy', $gallery->gallery_id) }}"
                                        method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-promotions">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
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
    {{-- IMPORTACION DEL SWEET ALERT --}}
    <script src="assets/js/sweetAlert/promocionesAlerts/delete-galerieAlerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        });
    </script>
@endsection
