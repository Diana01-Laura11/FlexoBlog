@extends('layouts.app')
{{-- @extends('layouts.appeditor') --}}


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

                /* ESTILO PARA EL SELECTOR DE AUTORES */
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
                    /* font-family: serif; */
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


            <!-- Mostrar mensaje de error si existe -->

            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')




            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        @if (isset($newsNotice))
                            <h5 class="mb-0">Editar Noticia</h5>
                        @else
                            <h5 class="mb-0">Nueva Noticia</h5>
                        @endif

                        <small class="text-muted float-end">Noticias</small>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{route('news.store')}}"  enctype="multipart/form-data" method="post" > --}}
                        <form
                            action="{{ isset($newsNotice) ? route('news.update', $newsNotice->news_id) : route('news.store') }}"
                            enctype="multipart/form-data" method="post">
                            @csrf

                            @csrf
                            @if (isset($newsNotice))
                                @method('PUT')
                            @endif

                            <!-- Título -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el título de la noticia"
                                        value="{{ isset($newsNotice) ? $newsNotice->title : '' }}">
                                </div>
                            </div>


                            <!-- Alias -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($newsNotice) ? $newsNotice->alias : '' }}" disabled />
                                </div>
                            </div>


                            {{-- PRUEBAS PARA INSERTAR FORMULARIO --}}
                            {{-- <div class="form-group">
                                <label for="formSelect">Selecciona un formulario</label>
                                <select class="form-control" id="formSelect" name="form_id" required>
                                    <option value="" disabled selected>Selecciona un formulario</option>
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->form_id }}" data-content="{{ $form->content }}">
                                            {{ $form->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="formContent">Contenido del formulario</label>
                                <textarea class="form-control" id="formContent" name="formContent" readonly></textarea>
                            </div> --}}



                            {{-- INICIO DE LOS METADATOS --}}

                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Meta descripción <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="descripcion" name="metadata[descripcion]"
                                        placeholder="Escribe un texto breve(150-160 caracteres) para describir el contenido de tu página y mejorar su visibilidad en motores de búsqueda.">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="metakey" class="col-sm-2 control-label">Palabras clave <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metakey" name="metadata[metakey]"
                                        placeholder="Ingresa términos o frases relevantes que describan tu contenido para mejorar su posicionamiento en motores de búsqueda.">
                                </div>
                            </div>




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
                                    Miniaturaa</label>
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
                                        type="button">Cargar imagen</button>
                                </div>
                            </div>
                            <!-- Campo oculto donde se almacenará la URL para enviar al backend -->
                            <input type="hidden" name="banners" id="hiddenBannersImageUrl" value="">



                            <div class="row mb-6">
                                <label for="ogtitle" class="col-sm-2 control-label">OG Title <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogtitle" name="ogdata[ogtitle]"
                                        placeholder="Ingresa un título atractivo para optimizar cómo se muestra tu contenido al compartirlo en redes sociales">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="ogdescription" class="col-sm-2 control-label">OG Description <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ogdescription"
                                        name="ogdata[ogdescription]"
                                        placeholder="Ingresa un texto claro y atractivo para complementar el OG Title y captar la atención en redes sociales">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="microdata_title" class="col-sm-2 control-label">Microdata Title <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title"
                                        name="microdata[title]" placeholder="Ingresa el título para los microdatos">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="microdata_description" class="col-sm-2 control-label">Microdata
                                    Description
                                    <sup class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]"
                                        placeholder="Ingresa una descripción breve para los microdatos">
                                </div>
                            </div>


                            {{-- CODIGO PARA INSERTAR UN AUTHOR --}}
                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Elegir Autor</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="authorSelect">*</label>
                                        <select class="form-control" id="authorSelect" name="id_author">
                                            <option value="" disabled selected>Click Para Añadir Autor</option>
                                            @foreach ($authors as $authorAdd)
                                                <option value="{{ $authorAdd->id_author }}"
                                                    data-firstname="{{ $authorAdd->first_name }}"
                                                    data-lastname="{{ $authorAdd->last_name }}"
                                                    data-middle_name="{{ $authorAdd->middle_name }}"
                                                    data-twitter="{{ $authorAdd->twitter }}"
                                                    data-linkedin="{{ $authorAdd->linkedin }}"
                                                    data-photo="{{ $authorAdd->photo }}"
                                                    data-description="{{ $authorAdd->description }}"
                                                    data-content="{{ $authorAdd->description }}">
                                                    <!-- Agregar data-content -->
                                                    {{ $authorAdd->first_name }} {{ $authorAdd->last_name }}
                                                    {{ $authorAdd->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>


                                        <div class="form-group">
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








                            {{-- VERSION FUNCIONA CON SWITCH PERO SOLO OPCION si Y NO --}}
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

                            <div class="row mb-6">
                                <label for="publish_date" class="col-sm-2 col-form-label">Fecha de Publicación</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="datetime-local" name="publish_date" id="publish_date"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>




                            {{-- AQUI SE INSERTAMOS LA INSTANCIA E IMPORTACION DEL CONTENIDO CON CKEDITOR --}}
                            @include('news.content-ckeditor') <br><br><br><br><br>









                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                        <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('news.index') }}'">
                                        Cancelar
                                    </button>
                                    @if (isset($newsNotice))
                                        <button class="btn btn-success" type="submit" id="editNewsButton">Editar
                                            Noticia</button>
                                    @else
                                        <button class="btn btn-success" type="submit" id="createNewsButton">Agregar

                                            Noticia</button>
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
    @include('news.AddImagenNew')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- SCRIPT PARA IMAGENES --}}
    <script src="/assets/js/managerImagenNews.js"></script>

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




    {{-- SCRIPT PARA  DE SELECCIONAR FORMULARIO --}}
    <script>
        document.getElementById('formSelect').addEventListener('change', function() {
            // Obtener la opción seleccionada
            var selectedOption = this.options[this.selectedIndex];

            // Obtener el contenido asociado con la opción seleccionada
            var content = selectedOption.getAttribute('data-content');

            // Establecer el contenido en el textarea
            document.getElementById('formContent').value = content;
        });
    </script>



    {{-- SCRIPT PARA CAPTURAR EL VALOR QUE TRAE EL AUTHOR Y SU CONTENIDO --}}
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
    </script>
@endsection
