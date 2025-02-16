@extends('layouts.app')
{{-- @extends('layouts.appeditor') --}}
{{-- @extends('layouts.appsales') --}} 

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Listado De Autores</h1>
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
                    }

                    .d-flex.justify-content-end.mb-3 a.btn {
                        padding: 10px 20px;
                    }
                </style>

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('authors.createAuthors') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Nuevo Autor
                    </a>
                    <a href="{{ route('authors.deleteRegister') }}" class="btn btn-danger ms-5">
                        <i class="fas fa-trash me-2"></i>
                        Autores Eliminados
                    </a>
                </div>

                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif

                <table id="authors" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre Autor</th>
                            <th>Descripcion</th>
                            <th>Redes Sociales</th>
                            <th>Imagen Del Autor</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authors as $detailAuthor)
                            <tr>
                                <th>{{ $detailAuthor->id_author }}</th>
                                <th>{{ $detailAuthor->first_name }} {{ $detailAuthor->middle_name }}
                                    {{ $detailAuthor->last_name }}</th>

                                <!-- Botón para abrir el modal -->
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#descriptionModal{{ $detailAuthor->id_author }}">
                                        Ver Descripción
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#socialModal{{ $detailAuthor->id_author }}">
                                        Ver Redes Sociales
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#photoModal{{ $detailAuthor->id_author }}">
                                        Ver Imagen Del Autor
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('authors.editAuthor', $detailAuthor->id_author) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i>
                                        Editar
                                    </a>
                                </td>


                                {{-- <td>ORIGINAL
                                    <form action="{{ route('authors.destroy', $detailAuthor->id_author) }}" method="POST"
                                        class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-category">
                                            <i class="fa-solid fa-x me-2"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </td> --}}
                                <td>
                                    <form action="{{ route('authors.destroy', $detailAuthor->id_author) }}"
                                        method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-promotions">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                           

                            <!-- Modal para la descripción -->
                            <div class="modal fade" id="descriptionModal{{ $detailAuthor->id_author }}" tabindex="-1"
                                aria-labelledby="descriptionModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="descriptionModalLabel">Descripción de
                                                {{ $detailAuthor->first_name }} {{ $detailAuthor->last_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $detailAuthor->description }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para las redes sociales -->
                            <div class="modal fade" id="socialModal{{ $detailAuthor->id_author }}" tabindex="-1"
                                aria-labelledby="socialModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="socialModalLabel">Redes Sociales de
                                                {{ $detailAuthor->first_name }} {{ $detailAuthor->last_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Twitter: <a href="https://twitter.com/{{ $detailAuthor->twitter }}"
                                                    target="_blank">{{ $detailAuthor->twitter }}</a></p>
                                            <p>LinkedIn: <a href="https://linkedin.com/in/{{ $detailAuthor->linkedin }}"
                                                    target="_blank">{{ $detailAuthor->linkedin }}</a></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para la photo del autor -->
                            <!-- Modal para la foto del autor -->
                            <div class="modal fade" id="photoModal{{ $detailAuthor->id_author }}" tabindex="-1"
                                aria-labelledby="photoModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            @if ($detailAuthor->photo)
                                            <picture>
                                                <source type="image/webp" srcset="{{ asset($detailAuthor->photo) }}">
                                                <img src="{{ asset($detailAuthor->photo) }}" class="img-fluid" loading="lazy" alt="Foto de {{ $detailAuthor->first_name }} {{ $detailAuthor->last_name }}">
                                            </picture>
                                            
                                                
                                            @else
                                                <p>No se encontró la imagen del autor.</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

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
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="assets/js/sweetAlert/delete-alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#authors').DataTable();
        });
    </script>
@endsection
