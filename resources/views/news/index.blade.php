@extends('layouts.app') 
{{-- @extends('layouts.appeditor') --}}

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    {{-- LLAMAMOS EL ESTILO CSS DEL TITULO PARA EL TIPO DE LETRA --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    {{-- LLAMAMOS EL ESTILO CSS DEL TITULO DE "LISTADO DE NOTICIAS" --}}
    <link rel="stylesheet" href="{{ asset('assets/css/estilo-listadoNoticias') }}">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Listado de Noticias</h1>

        <!-- DataTable -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <style>
                    .right-align {
                        text-align: right;
                    }

                    .d-flex.justify-content-end.mb-3 {
                        margin-top: 30px;
                        /* Ajusta la posición del botón */
                        margin-right: 50px;
                        /* Ajusta este valor para moverlo más a la izquierda */
                    }

                    .d-flex.justify-content-end.mb-3 a.btn {
                        padding: 10px 20px;
                        /* Ajusta el padding interno del botón si es necesario */
                    }
                </style>

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Nueva Noticia
                    </a>

                    <a href="{{ route('news.deleteRegister') }}" class="btn btn-danger ms-5">
                        <i class="fas fa-trash me-2"></i>
                        Noticias Eliminadas
                    </a>
                    
                </div>
                <h6 class="mb-0">Cliente ID: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->id : 'Sin Cliente' }}"</h6>
                <h6 class="mb-0">Cliente: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->business_name : 'Sin Cliente' }}"</h6>
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif
                

                <table id="news" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Titulo</th>
                            <th>Ver</th>
                            <th>Estado</th>
                            <th>Editar Noticia</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($new_notice as $newsDetail)
                            <tr>
                                <td>{{ $newsDetail->news_id }}</td> <!-- ID de la noticia -->
                                <td>{{ $newsDetail->title }}</td>
                                  {{-- <td>
                                    <a href="{{ route('news.preview', $newsDetail->news_id) }}"
                                        class="btn btn-secondary">Vista previaa</a>
                                </td>
                                <td>
                                    <a href="{{ route('news.showFinalFinal', ['id' => $newsDetail->news_id, 'alias' => $newsDetail->alias]) }}"
                                        target="_blank" class="btn btn-info me-2">Ver en web</a>
                                </td> --}}
                              
                                <td class="d-flex">
                                    <a href="{{ route('news.preview', $newsDetail->news_id) }}" class="btn btn-secondary me-2">Vista previa</a>
                                    <a href="{{ route('news.showFinalFinal', ['id' => $newsDetail->news_id, 'alias' => $newsDetail->alias]) }}"
                                       target="_blank" class="btn btn-info">Ver en web</a>
                                </td>
                                





                                <td>
                                    @if ($newsDetail->status === 'Published')
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
                                    <a href="{{ route('news.editContent', $newsDetail->news_id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i> Editar Noticia
                                    </a>
                                </td>

                                {{-- <td>ORIGINAL
                                    <form action="{{ route('news.destroy', $newsDetail->news_id) }}" method="POST"
                                        class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-category">
                                            <i class="fa-solid fa-x me-2"></i> Eliminar
                                        </button>
                                    </form>
                                </td> --}}

                                <td>
                                    <form action="{{ route('news.destroy', $newsDetail->news_id) }}"
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
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    {{-- IMPORTACION DEL SWEET ALERT --}}
    <script src="assets/js/sweetAlert/noticiasAlerts/delete-newsAlerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#news').DataTable();
        });
    </script>
@endsection
