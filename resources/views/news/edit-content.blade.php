@extends('layouts.app')
{{-- @extends('layouts.appeditor') --}}


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


            <!-- Mostrar mensaje de error si existe -->

            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')





            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ isset($newsNotice) ? 'Editar Noticia' : 'Nueva Noticia' }}</h5>
                        <small class="text-muted float-end">Noticias</small>
                    </div>
                    <div class="card-body">
                        <!-- Modal para el Editor de Contenido -->
                        <form action="{{ isset($newsNotice) ? route('news.updateContent', $newsNotice->news_id) : '#' }}"
                            method="POST" id="contentForm" enctype="multipart/form-data">

                            @csrf
                            @if (isset($newsNotice))
                                @method('PUT')
                            @endif

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el título de la noticia"
                                        value="{{ isset($newsNotice) ? $newsNotice->title : '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($newsNotice) ? $newsNotice->alias : '' }}" disabled required />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">Publicado</label>
                                <div class="col-sm-10">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $newsNotice->status ?? '') == 'Published' ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">Sí</span>
                                            <span class="switch-off">No</span>
                                        </span>
                                    </label>
                                </div>
                            </div>


                            {{-- <h5 id="style-title" class="animate__animated animate__bounceIn">Agregar Metadatos</h5> --}}
                            {{-- INICIO DE LOS METADATOS --}}

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">Meta descripción</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata" name="metadata[descripcion]"
                                        placeholder="Ingresa el título de la noticia"
                                        value="{{ isset($newsNotice) ? $metadata->descripcion : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metakey">Palabras Clave</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata" name="metadata[metakey]"
                                        placeholder="Ingresa las palabras clave"
                                        value="{{ isset($newsNotice) ? $metadata->metakey : '' }}">
                                </div>
                            </div>




                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="ogdata">Og Data</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogdata" name="ogdata[ogtitle]"
                                        placeholder="Ingresa el título de OG"
                                        value="{{ isset($newsNotice) ? $ogdata->ogtitle : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="ogdescription">Og Descripción</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogdescription"
                                        name="ogdata[ogdescription]" placeholder="Ingresa la descripción de OG"
                                        value="{{ isset($newsNotice) ? $ogdata->ogdescription : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="microdata_title">Microdata Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title" name="microdata[title]"
                                        placeholder="Ingresa el título del microdato"
                                        value="{{ isset($newsNotice) ? $microdata->title : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="microdata_description">Microdata
                                    Descrpcion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]" placeholder="Ingresa la descripción del microdato"
                                        value="{{ isset($newsNotice) ? $microdata->description : '' }}">
                                </div>
                            </div><br>

                            {{-- <h2 id="style-title" class="animate__animated animate__bounceIn">Agregar Imagenes</h2> --}}
                            {{-- IMAGENES --}}
                            {{-- PRUEBAS CON IMAGENES --}}
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Principal</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="principal_Image"
                                        id="principal_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($newsNotice) ? $newsNotice->principal_Image : '' }}" disabled>
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnprincipal_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="principal_Image" id="hiddenPrincipal_Image"
                                value="{{ isset($newsNotice) ? $newsNotice->principal_Image : '' }}">

                            <!-- Imagen Secundaria -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Secundaria</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="secondary_Image"
                                        id="secondary_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($newsNotice) ? $newsNotice->secondary_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnsecondary_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl"
                            value="{{ isset($promotionEdit) ? $promotionEdit->secondary_Image : '' }}"> --}}
                            <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl"
                                value="{{ isset($newsNotice) ? $newsNotice->secondary_Image : '' }}">


                            <!-- Imagen Miniatura -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen
                                    Miniatura</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="mini_Image"
                                        id="mini_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($newsNotice) ? $newsNotice->mini_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnmini_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="mini_Image" id="hiddenmini_ImageImageUrl"
                                value="{{ isset($newsNotice) ? $newsNotice->mini_Image : '' }}">

                            <!-- Imagen Banners -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Banners</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="banners"
                                        id="banners" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($newsNotice) ? $newsNotice->banners : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnbanners"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="banners" id="hiddenBannersImageUrl"
                                value="{{ isset($newsNotice) ? $newsNotice->banners : '' }}">

                            {{-- <br>
                            <br>
                            <br>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="#"><span
                                        style="color: rgb(255, 255, 255); font-size: 20px; margin-right: 10px;">
                                        📖Autor Actual
                                    </span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="#" id="#"
                                        placeholder="Autor Actual"
                                        value="{{ isset($authorName) ? $authorName->first_name . ' ' . $authorName->last_name . ' ' . $authorName->middle_name : 'Autor Disponible' }}"
                                        disabled required />
                                </div>
                            </div> --}}




                            {{-- CODIGO PARA INSERTAR UN AUTHOR --}}
                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="#"><span
                                        style="color: rgb(255, 255, 255); font-size: 20px; margin-right: 10px;">
                                        🖋️Cambiar Autor A:
                                    </span></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="authorSelect">*</label>
                                        <select class="form-control" id="authorSelect" name="id_author" required>
                                            <option value="" disabled selected>Selecciona al mismo autor para
                                                mantenerlo o elige uno nuevo.</option>
                                            @foreach ($authors as $authorAdd)
                                                <option value="{{ $authorAdd->id_author }}"
                                                    data-firstname="{{ $authorAdd->first_name }}"
                                                    data-lastname="{{ $authorAdd->last_name }}"
                                                    data-middle_name="{{ $authorAdd->middle_name }}"
                                                    data-twitter="{{ $authorAdd->twitter }}"
                                                    data-linkedin="{{ $authorAdd->linkedin }}"
                                                    data-description="{{ $authorAdd->description }}"
                                                    data-photo="{{ $authorAdd->photo }}"
                                                    data-content="{{ $authorAdd->description }}">
                                                    <!-- Agregar data-content -->
                                                    {{ $authorAdd->first_name }} {{ $authorAdd->last_name }}
                                                    {{ $authorAdd->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>


                                        <div class="form-group" style="visibility: hidden;">
                                            <label for="authorContent">Contenido del autor</label>
                                            <textarea class="form-control" id="authorContent" name="authorContent" readonly></textarea>
                                        </div>

                                        <!-- Campos ocultos para enviar detalles adicionales del autor -->
                                        <input type="hidden" id="first_name" name="first_name">
                                        <input type="hidden" id="last_name" name="last_name">
                                        <input type="hidden" id="middle_name" name="middle_name">
                                        <input type="hidden" id="twitter" name="twitter">
                                        <input type="hidden" id="linkedin" name="linkedin">
                                        <input type="hidden" id="photo" name="photo">
                                        <input type="hidden" id="description" name="description">
                                    </div>
                                </div>
                            </div>
                            <style>
                                /* Estilo para el fondo del select */
                                .form-control {
                                    background-color: #3E435B;
                                    /* Fondo amigable con el color #2F3349 */
                                    color: #FFFFFF;
                                    /* Texto blanco */
                                    border: 1px solid #4A4F67;
                                    /* Borde sutil */
                                    border-radius: 5px;
                                    /* Bordes redondeados */
                                    padding: 10px;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                                }

                                .form-control:focus {
                                    background-color: #50566D;
                                    /* Fondo más claro al enfocar */
                                    outline: none;
                                    border-color: #6C7090;
                                    /* Resaltar borde */
                                    box-shadow: 0 0 5px rgba(108, 112, 144, 0.5);
                                    /* Sombra al enfocar */
                                }

                                /* Opciones del select */
                                .form-control option {
                                    background-color: #3E435B;
                                    /* Fondo de opciones */
                                    color: #FFFFFF;
                                    /* Texto blanco */
                                }

                                .form-control option:hover {
                                    background-color: #50566D;
                                    /* Fondo al pasar el cursor */
                                }
                            </style>


                            <script>
                                document.getElementById('authorSelect').addEventListener('change', function() {
                                    // Obtener la opción seleccionada
                                    var selectedOption = this.options[this.selectedIndex];

                                    // Obtener el contenido asociado con la opción seleccionada
                                    var content = selectedOption.getAttribute('data-content');
                                    console.log('VALOR DE CONTENT', content);

                                    // Establecer el contenido en el textarea
                                    document.getElementById('authorContent').value = content;
                                    // Verifica si el valor está asignado correctamente
                                    console.log('Contenido del textarea:', document.getElementById('authorContent').value);
                                });
                            </script>
                            <script>
                                // Al seleccionar un autor, actualizamos los campos ocultos con los valores correspondientes
                                document.getElementById('authorSelect').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];

                                    document.getElementById('first_name').value = selectedOption.getAttribute('data-firstname');
                                    document.getElementById('last_name').value = selectedOption.getAttribute('data-lastname');
                                    document.getElementById('middle_name').value = selectedOption.getAttribute('data-middle_name');
                                    document.getElementById('twitter').value = selectedOption.getAttribute('data-twitter');
                                    document.getElementById('linkedin').value = selectedOption.getAttribute('data-linkedin');
                                    document.getElementById('photo').value = selectedOption.getAttribute('data-photo');
                                    document.getElementById('description').value = selectedOption.getAttribute(
                                        'data-description'); // Aquí añadimos el description

                                    // Actualizar el contenido del autor en el textarea
                                    document.getElementById('authorContent').value = selectedOption.getAttribute(
                                        'data-content'); // Se actualiza con data-content
                                });
                            </script> --}}


                            <!--autor-->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Autor</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name="author_id" id="author_id" class="form-control transparent-select"
                                            required>
                                            <option value="">-- Selecciona un autor --</option>
                                            @foreach ($authors as $authorSelect)
                                                <option value="{{ $authorSelect->id_author }}"
                                                    {{ old('author_id', $newsNotice->author_id) == $authorSelect->id_author ? 'selected' : '' }}>
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
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">Fecha Publicacion</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="date" class="form-control" name="publish_date"
                                            id="flatpickr-datetime"
                                            value="{{ old('publish_date', isset($newsNotice) ? $newsNotice->publish_date->format('Y-m-d') : '') }}"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>


                            {{-- AQUI SE INSERTAMOS LA INSTANCIA E IMPORTACION DEL CONTENIDO CON CKEDITOR  --}}
                            {{-- @include('news.editContentCkeditr') <br><br><br><br><br> --}}
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
                                                {{ $form->form_id == $newsNotice->form_id ? 'selected' : '' }}>
                                                {{ $form->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <textarea id="editorNews" name="content">{{ $newsNotice->content }}</textarea>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    CKEDITOR.replace('editorNews'); // Inicializar CKEditor

                                    CKEDITOR.instances.editorNews.on('instanceReady', function() {
                                        document.getElementById('form_id').addEventListener('change', function() {
                                            let selectedOption = this.options[this.selectedIndex];
                                            let formId = selectedOption.value;

                                            if (formId) {
                                                let insertText = `$/id:${formId}/$`;
                                                let editor = CKEDITOR.instances.editorNews;
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
                                        onclick="window.location.href='{{ route('news.index') }}'">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-success">Editar Contenido</button>
                                </div>
                            </div>
                        </form>

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
                        {{-- <script src="assets/js/sweetAlert/noticiasAlerts/edit-news-ckeditor.js"></script> --}}
                        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
                        {{-- FUNCION PARA LLAMAR AL CKEDITOR --}}


                        <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
                        @include('news.AddImagenNew')
                        {{-- SCRIPT PARA IMAGENES --}}
                        <script src="/assets/js/managerImagenNews.js"></script>
                        <script>
                            $(document).ready(function() {
                                // Inicializa CKEditor
                                CKEDITOR.replace('content-editor-news');

                                // Escuchar el evento 'change' de CKEditor para actualizar el textarea
                                CKEDITOR.instances['content-editor-news'].on('change', function() {
                                    const content = CKEDITOR.instances['content-editor-news'].getData();
                                    $('#content-editor-news').val(content);
                                });
                            });
                        </script>



                        {{-- SCRIPT PARA EL FUNCIONAMIENTO DEL BOTON SWITCH                         --}}
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
