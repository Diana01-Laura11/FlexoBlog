@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection


{{-- <style>
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
</style> --}}

<style>
    /* INICIA ESTILOS PARA EL BOTON DE PUBLICADO */
    /* ////////////////////////////////////////////////////////////////////////////// */
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
        /* background-color: #ccc; */
        background-color: transparent;
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
        /* background-color: rgb(255, 255, 255); */
        background-color: #4a4f48;
        /*ICONO INTERIOR DE COLOR NEGRO*/
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.switch-toggle-slider {
        background-color: #2196F3;
    }

    input:checked+.switch-toggle-slider:before {
        transform: translateX(26px);
    }

    .switch-on,
    .switch-off {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        /* color: rgb(153, 34, 34);COLOR DE LETRA POR DENTRO */
        color: transparent;
        /*COLOR DE LETRA POR DENTRO*/
        font-weight: bold;
        transition: 0.4s;
    }

    .switch-on {
        left: 8px;
    }

    .switch-off {
        right: 8px;
    }

    input:checked+.switch-toggle-slider .switch-on {
        opacity: 1;
    }

    input:not(:checked)+.switch-toggle-slider .switch-off {
        opacity: 1;
    }

    input:checked+.switch-toggle-slider .switch-off {
        opacity: 0;
    }

    /* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */


    /* AQUI INICIA ESTILOS PARA EL ICONO DE FECHAS */
</style>




@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">

            <!-- Mostrar mensaje de error si existe -->
            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        {{-- @if (isset($article))
                            <h5 class="mb-0">Editar Noticia</h5>
                        @else
                            <h5 class="mb-0">Nueva Noticia</h5aaa>
                        @endif
                        <h5 class="mb-0">Nueva Articulo</h5> --}}

                        <h5 class="mb-0">Nuevo Articulo</h5>
                        <small class="text-muted float-end">Articulos</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('articles.saveArticle') }}" method="post">

                            @csrf


                            <!-- Título nombre Nombre deL articulo -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Nombre del articulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el título de la promocions "
                                        value="{{ isset($article) ? $article->title : '' }}">
                                </div>
                            </div>


                            <!-- Alias -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($article) ? $article->alias : '' }}" disabled required />
                                </div>
                            </div>



                            <!--Estatus Estado status estatus publicado Publicado-->

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">Publicado</label>
                                <div class="col-sm-10">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $article->status ?? '') == 'Published' ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span> <!--si-->
                                            <span class="switch-off"></span> <!--NO-->
                                        </span>
                                    </label>
                                </div>
                            </div>



                            {{-- SCRIPT PARA EL FUNCIONAMIENTO DEL BOTON SWITCH                         --}}
                            <script>
                                function updateStatus(checkbox) {
                                    // Actualiza el valor del checkbox basado en si está marcado o no
                                    checkbox.value = checkbox.checked ? "Published" : "Unpublished";
                                }
                            </script>








                            {{-- PRUEBAS PARA AUTORES --}}
                            {{-- <div class="form-group">
                                <label for="author_id">Selecciona un autor:</label>
                                <select name="author_id" id="author_id" class="form-control" required>
                                    <option value="">-- Selecciona un autor --</option>
                                    @foreach ($authors as $authorSelect)
                                        <option value="{{ $authorSelect->id_author }}">{{ $authorSelect->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}


                            <!--Autores autor author-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Autor</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        {{-- <label for="author_id">Selecciona un autor:</label> --}}
                                        <select name="author_id" id="author_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona un autor --</option>
                                            @foreach ($authors as $authorSelect)
                                                <option value="{{ $authorSelect->id_author }}">
                                                    {{ $authorSelect->first_name }}{{ $authorSelect->middle_name }}
                                                    {{ $authorSelect->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <style>
                                .transparent-select option {
                                    color: #333;
                                    Texto negro por defecto
                                    /* background-color: white;  Fondo blanco por defecto */
                                }

                                .transparent-select option:checked {
                                    /* color: red;  Texto rojo cuando el option es seleccionado */
                                    /* background-color: blue;  Fondo azul cuando el option es seleccionado */
                                }
                            </style>


                            <!-- Categorias categoria-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="categoria">Categoria</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        {{-- <label for="author_id">Selecciona un autor:</label> --}}
                                        <select name="category_id" id="category_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona Una Categoria --</option>
                                            @foreach ($new_categories as $categorySelect)
                                                <option value="{{ $categorySelect->id }}">
                                                    {{ $categorySelect->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <!--formulario formularios Formularios-->
                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="form_id">Elige Formulario</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name="form_id" id="form_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona un formulario --</option>
                                            @foreach ($form as $formCreate)
                                                <option value="{{ $formCreate->form_id }}">
                                                    {{ $formCreate->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('form_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            {{-- agregar el capturadopr de valores del select --}}














































                            {{-- INTEGRACION DEL CKEDITOR --}}
                            {{-- AQUI SE INSERTA LA INSTANCIA E IMPORTACION DEL CONTENIDO CON CKEDITOR --}}
                            {{-- @include('articles.content-ckeditor') --}}
                            @include('articles.ckeditorCreate')
                            <br>
                            <br>










































                            {{-- inicio pruebas para fechas --}}

                            <!--FECHAS fecha Fecha fechas-->
                            <!--FECHAS fecha Fecha fechas-->








                            {{-- publication_date --}}

                            <div class="row mb-6">
                                <label for="publication_date" class="col-sm-2 col-form-label">Fecha de Publicación</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="datetime-local" name="publication_date" id="publication_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="publication_date" class="form-label">Fecha de Publicación</label>
                                <input type="datetime-local" name="publication_date" id="publication_date" class="form-control" required>
                            </div> --}}





                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="categoria">Categoria</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name="category_id" id="category_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona Una Categoria --</option>
                                            @foreach ($new_categories as $categorySelect)
                                                <option value="{{ $categorySelect->id }}">
                                                    {{ $categorySelect->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}




                            {{-- <style>
                                input[type="date"] {
                                    width: 100%;
                                    padding-right: 30px;
                                    /* Espacio para el ícono */
                                    text-align: left;
                                    /* Asegurar alineación correcta */
                                }
                            </style> --}}




                            {{-- SCRIPT PARA EL CALENDARIO --}}
                            <!-- Incluir Flatpickr JS -->
                            {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
                                // Inicializar flatpickr en el input con id 'flatpickr-datetime'
                                flatpickr("#flatpickr-datetime", {
                                    dateFormat: "Y-m-d", // Formato de fecha
                                });
                            </script> --}}










































































                            <!--INICION DE IMAGENES --->
                            {{-- INSERTA LAS IMAGENES --}}
                            <!--Imagen Principal-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Principal</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="principal_Image"
                                        id="principal_Image" placeholder="/assets/imagenes-blog/...">
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnprincipal_Image"
                                        type="button">Cargar imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            {{-- <input type="hidden" name="principal_Image" id="hiddenImageUrl" value=""> --}}
                            <input type="hidden" name="principal_Image" id="hiddenPrincipal_Image" value="">

                            <!--Imagen Secundaria-->

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Secundaria</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="secondary_Image"
                                        id="secondary_Image" placeholder="/assets/imagenes-blog/...">
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnsecondary_Image"
                                        type="button">Cargar imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl" value="">

                            <!--Imagen Miniatura-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen En
                                    Miniatura</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="mini_Image"
                                        id="mini_Image" placeholder="/assets/imagenes-blog/...">
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnmini_Image"
                                        type="button">Cargar imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <input type="hidden" name="mini_Image" id="hiddenmini_ImageImageUrl" value="">

                            <!--Imagen Banners-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Banners</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="banners"
                                        id="banners" placeholder="/assets/imagenes-blog/...">
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnbanners"
                                        type="button">Cargar
                                        imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <input type="hidden" name="banners" id="hiddenBannersImageUrl" value="">








                            <!--INICION DE METADATOS-->

                            <div class="row mb-6">
                                <label for="microdata_title" class="col-sm-2 control-label">Microdato Titulo <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title"
                                        name="microdata[title]"
                                        placeholder="Ingresa el título para los microdatos (150 caracteres)">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="microdata_description" class="col-sm-2 control-label">Microdato Descripcion
                                    <sup class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]"
                                        placeholder="Ingresa una descripción breve para los microdatos (150 caracteres)">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Metadato descripción <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="descripcion"
                                        name="metadata[descripcion]"
                                        placeholder="Escribe un texto breve para describir el contenido de tu página y mejorar su visibilidad en motores de búsqueda. (150 caracteres)">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="metakey" class="col-sm-2 control-label">Palabras clave <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metakey" name="metadata[metakey]"
                                        placeholder="Ingresa términos o frases relevantes que describan tu contenido para mejorar su posicionamiento en motores de búsqueda. (150 caracteres)">
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label for="og_data" class="col-sm-2 control-label">OG Titulo <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="og_data" name="og_data[ogtitle]"
                                        placeholder="Ingresa un título atractivo para optimizar cómo se muestra tu contenido al compartirlo en redes sociales (150 caracteres)">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="ogdescription" class="col-sm-2 control-label">OG Descripcion <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogdescription"
                                        name="og_data[ogdescription]"
                                        placeholder="Ingresa un texto claro y atractivo para complementar el OG Title y captar la atención en redes sociales. (150 caracteres)">
                                </div>
                            </div>





                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                    <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('articles.index') }}'">
                                        Cancelar
                                    </button>
                                    @if (isset($article))
                                        <button class="btn btn-success" type="submit">Editar Articulo</button>
                                    @else
                                        <button class="btn btn-success" type="submit">Agregar Articulo</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form with Tabs -->


        <!--/ Content -->
        <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
        @include('articles.AddImagen')
        <!-- *************************** -->
    @endsection


    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        {{-- CDN PARA CKeditor --}}
        {{-- <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        <script src="/assets/assets-editor/ckeditor.js"></script> --}}

        {{-- JS del gestor de imagenes --}}
        <!-- PASO 3: PEGAR EL SCRIPT DE MODAL -->
        {{-- <script src="/assets/js/managerImagen.js"></script> --}}
        <script src="/assets/js/managerImagenArticles.js"></script>
        <!-- *************************** -->
        <!-- PASO 4: ES CREAR UN BLADE LLAMADO AddImagen Y PEGAR EL CODIGO -->


        <script>
            $(document).ready(function() {
                $('#articles').DataTable();
            });
        </script>

        {{-- <script>
            // Captura el cambio de estado en el interruptor
            document.getElementById('status-switch').addEventListener('change', function() {
                this.value = this.checked ? 1 : 0;
            });
        </script> --}}


        {{-- FUNCION PARA LLAMAR AL CKEDITOR --}}

        <script>
            $(document).ready(function() {
                CKEDITOR.replace('content-editor', {});
            });
        </script>



        {{-- SCRIPT PARA EL ALIAS --}}
        <script>
            // Script para generar alias automáticamente
            document.getElementById('title').addEventListener('input', function() {
                let title = this.value;
                let alias = title.toLowerCase()
                    .replace(/[^\w\s]/gi, '') // Remueve caracteres especiales
                    .replace(/\s+/g, '-') // Reemplaza espacios por guiones
                    .trim();
                document.getElementById('alias').value = alias;
            });
        </script>
    @endsection
