@extends('layouts.app')
{{-- @extends('layouts.appeditor')
@extends('layouts.appsales') --}}


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout  & Basic with Icons-->
        <div class="row">

            {{-- INICIA ESTILOS PARA EL BOTON DEL SWITCH --}}
            <style>
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 60px;
                    height: 34px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .switch-toggle-slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    transition: .4s;
                    border-radius: 34px;
                }

                .switch-toggle-slider:before {
                    position: absolute;
                    content: "";
                    height: 26px;
                    width: 26px;
                    left: 4px;
                    bottom: 4px;
                    background-color: white;
                    transition: .4s;
                    border-radius: 50%;
                }

                input:checked+.switch-toggle-slider {
                    background-color: #2196F3;
                }

                input:checked+.switch-toggle-slider:before {
                    transform: translateX(26px);
                }

                .switch-on {
                    display: none;
                }

                input:checked+.switch-toggle-slider .switch-on {
                    display: block;
                }

                input:checked+.switch-toggle-slider .switch-off {
                    display: none;
                }
                .form-control {
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                }
            </style>


            <!-- Mostrar mensaje de error si existe -->

            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')




            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        @if (isset($authorsCreate))
                            <h5 class="mb-0">Editar Autor</h5>
                        @else
                            <h5 class="mb-0">Nuevo Autor</h5>
                        @endif

                        <small class="text-muted float-end">Autores</small>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('authors.createAuthors') }}" method="post"> --}}
                        <form action="{{ route('authors.createAuthors') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            {{-- @csrf
                            @if (isset($authors))
                                @method('PUT')
                            @endif --}}



                            {{-- Nombre Completo --}}
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Nombre Completo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Ingresa Tu Nombre Completo"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->first_name : '' }}">
                                </div>
                            </div>
                            <!-- Apellido Paterno -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Apellido Paterno</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                                        placeholder="Ingresa Tu Apellido Paterno"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->middle_name : '' }}">
                                </div>
                            </div>
                            <!-- Apellido Materno -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Apellido Materno</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Ingresa Tu Apellido Materno"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->last_name : '' }}">
                                </div>
                            </div>
                            <!-- Descrption -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Descripcion Del Autor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Ingresa Tu Descripcion Como Autor"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->description : '' }}">
                                </div>
                            </div>
                            <!-- Likendin -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Likendin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="linkedin" name="linkedin"
                                        placeholder="Escribe la liga Ej: https://www.linkedin.com/in/ejemplo"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->linkedin : '' }}">
                                </div>
                            </div>
                            <!-- twitter -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                        placeholder="Escribe la liga Ej: https://twitter.com/ejemplo"
                                        value="{{ isset($authorsCreate) ? $authorsCreate->twitter : '' }}">
                                </div>
                            </div>


                            {{-- subir imagern --}}

                            {{-- <div class="row mb-6">
                                <label for="photo" class="col-sm-2 control-label">Imagena:<sup class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="photo" name="photo" type="file" placeholder="Sube Una Imagen Al Servidor">
                                </div>
                            </div> --}}

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Foto Del Autor</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="photo" id="photo"
                                        placeholder="/assets/imagenes-blog/...">
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="BtnPhoto" type="button">Cargar
                                        imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <!-- Campo oculto para la imagen secundaria -->
                            <input type="hidden" name="photo" id="hiddenPhotoImageUrl" value="">


                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                        <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('authors.index') }}'">
                                        Salir
                                    </button>
                                    @if (isset($authorsCreate))
                                        <button class="btn btn-success" type="submit" id="editNewsButton">Editar
                                            Noticia</button>
                                    @else
                                        <button class="btn btn-success" type="submit" id="createNewsButton">Agregar Autor</button>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Content -->
    <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
    @include('authors.AddImagenAuthor')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- SCRIPT PARA IMAGENES --}}
    <script src="/assets/js/managerImagenAuthor.js"></script>

    {{-- SCRIPT PARA EL FUNCIONAMIENTO DEL BOTON SWITCH                         --}}
    <script> 
        function updateStatus(checkbox) {
            // Actualiza el valor del checkbox basado en si está marcado o no
            checkbox.value = checkbox.checked ? "Published" : "Unpublished";
        }
    </script>
@endsection
