@extends('layouts.app')

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
                        <h5 class="mb-0">{{ isset($articleEdit) ? 'Editar Promocion' : 'Nueva Promocion' }}</h5>
                        <small class="text-muted float-end">Edición De Artículos </small>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($articleEdit) ? route('articles.updateArticle', $articleEdit->id_post) : '#' }}"
                            method="POST" id="contentForm" enctype="multipart/form-data">

                            @csrf
                            @if (isset($articleEdit))
                                @method('PUT')
                            @endif

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Nombre del articulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el título de la promocions "
                                        value="{{ isset($articleEdit) ? $articleEdit->title : '' }}">
                                </div>
                            </div>

                            <!-- Alias -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($articleEdit) ? $articleEdit->alias : '' }}" disabled required />
                                </div>
                            </div>



                            <!--Estatus Estado status estatus publicado Publicado-->

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">Publicado</label>
                                <div class="col-sm-10">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $articleEdit->status ?? '') == 'Published' ? 'checked' : '' }}
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































                            <!-- Imagen imagen IMAGEB imagenesPrincipal -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Principal</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="principal_Image"
                                        id="principal_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($articleEdit) ? $articleEdit->principal_Image : '' }}" disabled>
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnprincipal_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="principal_Image" id="hiddenPrincipal_Image"
                                value="{{ isset($articleEdit) ? $articleEdit->principal_Image : '' }}">

                            <!-- Imagen Secundaria -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen Secundaria</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="secondary_Image"
                                        id="secondary_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($articleEdit) ? $articleEdit->secondary_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnsecondary_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl"
                            value="{{ isset($articleEdit) ? $articleEdit->secondary_Image : '' }}"> --}}
                            <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl"
                                value="{{ isset($articleEdit) ? $articleEdit->secondary_Image : '' }}">


                            <!-- Imagen Miniatura -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Miniatura</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="mini_Image"
                                        id="mini_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($articleEdit) ? $articleEdit->mini_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnmini_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="mini_Image" id="hiddenmini_ImageImageUrl"
                                value="{{ isset($articleEdit) ? $articleEdit->mini_Image : '' }}">

                            <!-- Imagen Banners -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Banners</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="banners"
                                        id="banners" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($articleEdit) ? $articleEdit->banners : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnbanners"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="banners" id="hiddenBannersImageUrl"
                                value="{{ isset($articleEdit) ? $articleEdit->banners : '' }}">


                            <!--Inicia metadatos--->


                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">META DESCRIPTION</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata"
                                        name="metadata[descripcion]" placeholder="Ingresa el título de la promocion"
                                        value="{{ isset($promotionEdit) ? $metadata->descripcion : '' }}">
                                </div>
                            </div> --}}


                            <div class="row mb-6">
                                <label for="microdata_title" class="col-sm-2 control-label">Microdato Titulo <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title"
                                        name="microdata[title]"
                                        placeholder="Ingresa el título para los microdatos (150 caracteres)"
                                        value="{{ isset($articleEdit) ? $microdata->title : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="microdata_description" class="col-sm-2 control-label">Microdato Descripcion
                                    <sup class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]"
                                        placeholder="Ingresa una descripción breve para los microdatos (150 caracteres)"
                                        value="{{ isset($articleEdit) ? $microdata->description : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Metadato descripción <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="descripcion"
                                        name="metadata[descripcion]"
                                        placeholder="Escribe un texto breve para describir el contenido de tu página y mejorar su visibilidad en motores de búsqueda. (150 caracteres)"
                                        value="{{ isset($articleEdit) ? $metadata->descripcion : '' }}">
                                        {{-- value="{{ isset($metadata) && isset($metadata->descripcion) ? $metadata->descripcion : '' }}"> --}}

                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="metakey" class="col-sm-2 control-label">Palabras Clave<sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metakey" name="metadata[metakey]"
                                        placeholder="Ingresa términos o frases relevantes que describan tu contenido para mejorar su posicionamiento en motores de búsqueda. (150 caracteres)"
                                        value="{{ isset($articleEdit) ? $metadata->metakey : '' }}">

                                </div>
                            </div>



                            <div class="row mb-6">
                                <label for="og_data" class="col-sm-2 control-label">OG Titulo <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="og_data" name="og_data[ogtitle]"
                                        placeholder="Ingresa un título atractivo para optimizar cómo se muestra tu contenido al compartirlo en redes sociales (150 caracteres)"
                                             value="{{ isset($articleEdit) ? $og_data->ogtitle : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="ogdescription" class="col-sm-2 control-label">OG Descripcion <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogdescription"
                                        name="og_data[ogdescription]"
                                        placeholder="Ingresa un texto claro y atractivo para complementar el OG Title y captar la atención en redes sociales. (150 caracteres)"
                                             value="{{ isset($articleEdit) ? $og_data->ogdescription : '' }}">
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">Fecha Publicacion</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="date" class="form-control" name="publication_date"
                                            id="flatpickr-datetime"
                                            value="{{ old('publication_date', isset($articleEdit) ? $articleEdit->publication_date->format('Y-m-d') : '') }}"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Autor</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name="author_id" id="author_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona un autor --</option>
                                            @foreach ($authors as $authorSelect)
                                                <option value="{{ $authorSelect->id_author }}"
                                                    {{ old('author_id', $articleEdit->author_id) == $authorSelect->id_author ? 'selected' : '' }}>
                                                    {{ $authorSelect->first_name }} {{ $authorSelect->middle_name }}
                                                    {{ $authorSelect->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Categorias</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name="category_id" id="category_id"
                                            class="form-control transparent-select" required>
                                            <option value="">-- Selecciona una categoria --</option>
                                            @foreach ($new_categories as $categoryEdit)
                                                <option value="{{ $categoryEdit->id }}"
                                                    {{ old('category_id', $articleEdit->category_id) == $categoryEdit->id ? 'selected' : '' }}>
                                                    {{ $categoryEdit->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <style>
                                .transparent-select option {
                                    color: #333;
                                    /* Texto negro por defecto */
                                }
                            </style>





                            <br>
                            <hr>
                            <!--EDITAR FORMULARIOS formulario formularios form-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="form_id">Elige Formulario</label>
                                <div class="col-sm-10">

                                    <select name="form_id" id="form_id" class="form-control transparent-select"
                                        required>
                                        <option value="">-- Selecciona un formulario --</option>
                                        @foreach ($formEdit as $form)
                                            <option value="{{ $form->form_id }}"
                                                {{ $form->form_id == $articleEdit->form_id ? 'selected' : '' }}>
                                                {{ $form->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <textarea id="editorArticle" name="content">{{ $articleEdit->content }}</textarea>
                            {{-- <script>FUNCIONA PERO SOLO MUESTRA EL FORMULARIO ARRIBA Y NO ABAJO
                                document.addEventListener("DOMContentLoaded", function() {
                                    CKEDITOR.replace('editorArticle'); // Inicializar CKEditor

                                    CKEDITOR.instances.editorArticle.on('instanceReady', function() {
                                        document.getElementById('form_id').addEventListener('change', function() {
                                            let formId = this.value;
                                            if (formId) {
                                                let editor = CKEDITOR.instances.editorArticle;
                                                let currentContent = editor.getData();

                                                // Expresión regular para buscar cualquier `$/id:X/$` en el contenido actual
                                                let updatedContent = currentContent.replace(/\$\/id:\d+\/\$/g, '');

                                                // Insertar solo el nuevo `$/id:{formId}/$`
                                                editor.setData(`$/id:${formId}/$` + updatedContent);
                                            }
                                        });


                                    });
                                });
                            </script> --}}
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    CKEDITOR.replace('editorArticle'); // Inicializar CKEditor

                                    CKEDITOR.instances.editorArticle.on('instanceReady', function() {
                                        document.getElementById('form_id').addEventListener('change', function() {
                                            let selectedOption = this.options[this.selectedIndex];
                                            let formId = selectedOption.value;

                                            if (formId) {
                                                let insertText = `$/id:${formId}/$`;
                                                let editor = CKEDITOR.instances.editorArticle;
                                                let content = editor.getData()
                                                    .trim(); // Obtener contenido actual sin espacios innecesarios

                                                // Eliminar cualquier ID existente antes de insertar el nuevo
                                                content = content.replace(/\$\/id:\d+\/\$/g, '');

                                                // Insertar el nuevo ID al final del contenido
                                                editor.setData(content + "\n\n" + insertText);
                                            }
                                        });
                                    });
                                });
                            </script>
                            <br>
                            <hr>


   
                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                        <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('articles.index') }}'">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        {{-- <button type="submit" class="btn btn-success edit-promotions">Editar Contenido --}}
                                        Editar Artículo</button>
                                </div>
                            </div>
                        </form>

                        <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
                        @include('promotions.addImagenPromotion')

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
                        <script src="{{ asset('assets/js/sweetAlert/promocionesAlerts/editAlertPromotion.js') }}"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        {{-- SCRIPT PARA IMAGENES --}}
                        <script src="/assets/js/managerImagenPromotion.js"></script>

                        {{-- FUNCION PARA LLAMAR AL CKEDITOR --}}
                        <script>
                            $(document).ready(function() {
                                // Inicializa CKEditor
                                CKEDITOR.replace('content-editor-promotions');

                                // Escuchar el evento 'change' de CKEditor para actualizar el textarea
                                CKEDITOR.instances['content-editor-news'].on('change', function() {
                                    const content = CKEDITOR.instances['content-editor-promotions'].getData();
                                    $('#content-editor-promotions').val(content);
                                });
                            });
                        </script>

                        {{-- SCRIPT PARA EL FUNCIONAMIENTO DEL BOTON SWITCH --}}
                        <script>
                            function updateStatus(checkbox) {
                                // Actualiza el valor del checkbox basado en si está marcado o no
                                checkbox.value = checkbox.checked ? "Published" : "Unpublished";
                            }
                        </script>

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
