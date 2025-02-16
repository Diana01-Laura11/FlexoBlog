@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Listado de Articulos</h1>
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

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('articles.createArticle') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Nuevo articulo</a>
                        <a href="{{ route('articles.deleteRegister') }}" class="btn btn-danger ms-5">
                            <i class="fas fa-trash me-2"></i>
                            Articulos Eliminados
                        </a>
                </div>
                <h6 class="mb-0">Cliente ID: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->id : 'Sin Cliente' }}"</h6>
                <h6 class="mb-0">Cliente: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->business_name : 'Sin Cliente' }}"</h6>
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif



                <table id="articles" class="table table-striped" style="width:100%">
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
                        @forelse ($article as $articleDetail)
                            <tr>
                                <td>{{ $articleDetail->id_post }}</td> <!-- ID de la promocion -->
                                <td>{{ $articleDetail->title }}</td>

                                {{-- <tr>
                                <td>1</td>
                                <td>Nueva tecnología en 2024</td> --}}
                                <td>
                                    {{-- <a href="#" class="btn btn-sm btn-info"> --}}
                                    <a href="{{ route('articles.preview', $articleDetail->id_post) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa-regular fa-eye me-2"></i>
                                        Vista previa</a>

                                    {{-- <a href="{{ route('articles.viewOnWeb', $articleDetail->id_post) }}" class="btn btn-sm btn-secondary"> --}}
                                        <a href="{{ route('articles.viewOnWeb', ['id_post' => $articleDetail->id_post, 'alias' => $articleDetail->alias]) }}"
                                            class="btn btn-sm btn-secondary">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        Ver en web</a>



                                </td>
                                {{-- <td>
                                    <a href="#" class="btn btn-sm btn-success">
                                        <i class="fas fa-check me-2"></i>Publicado</a>
                                </td> --}}

                                <td>
                                    @if ($articleDetail->status === 'Published')
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-2"></i> Publicado
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-sm"
                                            style="background-color: rgb(192, 15, 109); color: white;">
                                            <i class="fas fa-times me-2"></i> No Publicado
                                        </a>
                                    @endif
                                </td>
                               

                                <td>
                                    <a href="{{ route('articles.editArticle', $articleDetail->id_post) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i> Editar Articulo
                                    </a>
                                </td>

                                {{-- <td>
                                    <form action="{{ route('articles.deleteArticle', $articleDetail->id_post) }}"
                                        method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-article">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td> --}}


                                
                                <td>
                                    <form action="{{ route('articles.destroy', $articleDetail->id_post) }}"
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
    {{-- IMPORTACION DEL SWEET ALERT --}}
    {{-- <script src="assets/js/sweetAlert/noticiasAlerts/delete-newsAlerts.js"></script> --}}
    <script src="assets/js/sweetAlert/articles/delete-ArticleAlerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        });
    </script>
@endsection
