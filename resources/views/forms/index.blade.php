@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

  <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
  {{-- @include('messageAlerts.messageAlerts') --}}
  @include('messageAlerts.messageAlerts')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="text-center">Listado de Formularios</h1>
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
                    <a href="{{ route('forms.createForm') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Crear Mi Formulario</a>

                        <a href="{{ route('forms.deleteRegister') }}" class="btn btn-danger ms-5">
                            <i class="fas fa-trash me-2"></i>
                            Formularios Eliminados
                        </a>

                </div>
           
                <h6 class="mb-0">Cliente ID: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->id : 'Sin Cliente' }}"</h6>
                <h6 class="mb-0">Cliente: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->business_name : 'Sin Cliente' }}"</h6>
                
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif

                <!-- Mostrar mensaje de error -->
                @if (Session::has('error'))
                    <div class="alert alert-danger my-5">
                        {{ Session::get('error') }}
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
                        @forelse ($FormsData as $formsDetail)
                            <tr>
                                <td>{{ $formsDetail->form_id }}</td> <!-- ID del formulario -->
                                <td>{{ $formsDetail->title ?: 'No Título Disponible' }}</td>

                                <td>
                                   

                                    <a href="{{ route('forms.viewPreviewForm', ['forms' => $formsDetail->form_id]) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa-solid fa-file-signature me-2"></i>
                                        Vista previa formulario
                                    </a>
                                </td>
                               

                                <!-- Mostrar el status -->
                                <td>
                                    @if ($formsDetail->status)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>

                                <td><a href="{{ route('forms.editForm', $formsDetail->form_id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i>
                                        Editar</a>
                                </td>
                                
                                {{-- ORIGNAL --}}
                                {{-- <td>
                                    <form action="{{ route('forms.destroy', $formsDetail->form_id) }}" method="POST"
                                        class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-form">
                                            <i class="fa-solid fa-x me-2"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>  --}}

                                <td>
                                    <form action="{{ route('forms.destroy', $formsDetail->form_id) }}"
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
                                <td colspan="6" class="text-center">No hay formularios disponibles</td>
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
    <script src="assets/js/sweetAlert/formulariosAlerts/deleteFormAlerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        });
    </script>
@endsection
