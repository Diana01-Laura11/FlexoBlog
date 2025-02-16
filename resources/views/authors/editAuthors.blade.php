@extends('layouts.app')
{{-- @extends('layouts.appeditor')
@extends('layouts.appsales') --}}

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
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




            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ isset($authorEdit) ? 'Editar Autor' : 'Nueva Autor' }}</h5>
                        <small class="text-muted float-end">Autores</small>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($authorEdit) ? route('authors.updateAuthor', $authorEdit->id_author) : '#' }}"
                            method="POST" id="contentForm" enctype="multipart/form-data">

                            @csrf
                            @if (isset($authorEdit))
                                @method('PUT')
                            @endif


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="first_name">Nombre Completo Edicion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Nombre Completo Del Autor"
                                        value="{{ isset($authorEdit) ? $authorEdit->first_name : '' }}">
                                </div>
                            </div>

                            <!-- Apellido Paterno -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="middle_name">Apellido Paterno</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                                        placeholder="Ingresa Tu Apellido Paterno"
                                        value="{{ isset($authorEdit) ? $authorEdit->middle_name : '' }}">
                                </div>
                            </div>

                            <!-- Apellido Materno -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="last_name">Apellido Materno</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Ingresa Tu Apellido Materno"
                                        value="{{ isset($authorEdit) ? $authorEdit->last_name : '' }}">
                                </div>
                            </div>
                            <!-- Descrption -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="description">Descripcion Del Autor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Ingresa Tu Descripcion Como Autor"
                                        value="{{ isset($authorEdit) ? $authorEdit->description : '' }}">
                                </div>
                            </div>
                            <!-- Likendin -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="linkedin">Likendin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="linkedin" name="linkedin"
                                        placeholder="Escribe la liga Ej: https://www.linkedin.com/in/ejemplo"
                                        value="{{ isset($authorEdit) ? $authorEdit->linkedin : '' }}">
                                </div>
                            </div>
                            <!-- twitter -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="twitter">twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                        placeholder="Escribe la liga Ej: https://twitter.com/ejemplo"
                                        value="{{ isset($authorEdit) ? $authorEdit->twitter : '' }}">
                                </div>
                            </div>

                           
                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label"
                                    for="basic-default-company"style="color: rgb(231, 171, 171);">Foto Del Actual Autor</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="photo"
                                        style="background-color: rgba(156, 72, 72, 0.288);" id="photo"
                                        value="{{ isset($authorEdit) ? $authorEdit->photo : '' }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Actualizar Foto Del Autor</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="photo" id="photo"
                                    placeholder="Si deseas mantener la misma imagen, por favor, selecciónala nuevamente."disabled required>
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnphoto" type="button">Cargar
                                        imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <!-- Campo oculto para la imagen secundaria -->
                            <input type="hidden" name="photo" id="hiddenPhotoImageUrl" value=""> --}}

                             <!-- Imagen Miniatura -->
                             <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Foto Del Autor</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="photo"
                                        id="photo" value="{{ isset($authorEdit) ? $authorEdit->photo : '' }}" disabled>
                                    <button class="btn btn-primary" name="openManager" id="BtnPhoto"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="photo" id="hiddenPhotoImageUrl"
                                value="{{ isset($authorEdit) ? $authorEdit->photo : '' }}">







                            <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
                            @include('authors.AddImagenAuthor')


                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                        <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('authors.index') }}'">
                                        Salir
                                    </button>
                                    <button type="submit" class="btn btn-success">Editar Autor</button>
                                </div>
                            </div>
                        </form>
                        {{-- SCRIPT PARA IMAGENES --}}
                        <script src="/assets/js/managerImagenAuthor.js"></script>
                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    @endsection
