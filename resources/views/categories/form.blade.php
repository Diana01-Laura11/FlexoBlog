@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection



@section('content')
    <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
    @include('messageAlerts.messageAlerts')


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        @if (isset($category))
                            <h5 class="mb-0">Editar Categoria</h5>
                        @else
                            <h5 class="mb-0">Nueva Categoria</h5>
                        @endif
                        <small class="text-muted float-end">Categorias</small>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                            method="post">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="name_category">Nombre de la categoria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name_category" name="name_category"
                                        placeholder="Ingresa el nombre de la categoria."
                                        value="{{ isset($category) ? $category->name_category : '' }}" />
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($category) ? $category->alias : '' }}" disabled required />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status-switch">Estado</label>
                                <div class="col-sm-10">
                                    <label class="switch">
                                        <input type="checkbox" name="status" class="switch-input" id="status-switch"
                                            value="1" {{ isset($category) && $category->status ? 'checked' : '' }} />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">Sí</span>
                                            <span class="switch-off">No</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                    <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('categories.index') }}'">
                                        Salir
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        {{ isset($category) ? 'Editar categoría' : 'Agregar categoría' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="/assets/js/sweetAlert/load-alert.js"></script>
    <script src="/assets/js/sweetAlert/create-categoryAlert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        });

        // Captura el cambio de estado en el interruptor
        document.getElementById('status-switch').addEventListener('change', function() {
            this.value = this.checked ? 1 : 0;
        });

        // Script para generar alias automáticamente
        document.getElementById('name_category').addEventListener('input', function() {
            let title = this.value;
            let alias = title.toLowerCase()
                .replace(/[^\w\s]/gi, '') // Remueve caracteres especiales
                .replace(/\s+/g, '-') // Reemplaza espacios por guiones
                .trim();
            document.getElementById('alias').value = alias;
        });
    </script>
@endsection
