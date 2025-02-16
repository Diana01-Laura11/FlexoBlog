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


            <!-- Mostrar mensaje de error si existe -->
            {{-- @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>¡Error! Tu problema se debe a:</strong>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif --}}


            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ isset($promotionEdit) ? 'Editar Promocion' : 'Nueva Promocion' }}</h5>
                        <small class="text-muted float-end">Promociones</small>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($promotionEdit) ? route('promotions.updatePromotion', $promotionEdit->promotion_id) : '#' }}"
                            method="POST" id="contentForm" enctype="multipart/form-data">

                            @csrf
                            @if (isset($promotionEdit))
                                @method('PUT')
                            @endif

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">NOMBRE DE PROMOCION</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Titulo de la promocion"
                                        value="{{ isset($promotionEdit) ? $promotionEdit->title : '' }}">
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">ALIAS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($promotionEdit) ? $promotionEdit->alias : '' }}" disabled />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">SUBTITULO</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="subtitle"
                                        placeholder="Subtitulo de la promocion"
                                        value="{{ isset($promotionEdit) ? $promotionEdit->subtitle : '' }}">
                                </div>
                            </div>




                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">PUBLICADOO</label>
                                <div class="col-sm-10">
                                    <!-- Campo oculto para enviar 'Unpublished' si el checkbox no está marcado -->
                                    <input type="hidden" name="status" value="Unpublished">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $promotionEdit->status ?? '') == 'Published' ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">Sí</span>
                                            <span class="switch-off">No</span>
                                        </span>
                                    </label>
                                </div>
                            </div>





                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">FECHA INICIO
                                    PROMOCIÓN</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="date" class="form-control" name="start_date" id="flatpickr-datetime"
                                            value="{{ old('start_date', isset($promotionEdit) ? $promotionEdit->start_date->format('Y-m-d') : '') }}"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">FECHA FIN DE
                                    PROMOCIÓN</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="date" class="form-control" name="end_date" id="flatpickr-datetime"
                                            value="{{ old('end_date', isset($promotionEdit) ? $promotionEdit->end_date->format('Y-m-d') : '') }}"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">CONDICIÓN DE PROMOCION</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="terms" name="terms"
                                        placeholder="Condicion de la promocion"
                                        value="{{ isset($promotionEdit) ? $promotionEdit->terms : '' }}">
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">EXTRAS DE PROMOCION </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata" name="extras[extras]"
                                        placeholder="Ingresa  EXTRAS de la promocion"
                                        value="{{ isset($promotionEdit) ? $extras->extras : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">NOMBRE DE HERRAMIENTA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="link[name]"
                                        placeholder="Ingresa el nombre de la herramienta de promocion"
                                        value="{{ isset($promotionEdit) ? $link->name : '' }}">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">LINK DE HERRAMIENTA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="link[link]"
                                        placeholder="Ingresa el link de herramienta de la promocion"
                                        value="{{ isset($promotionEdit) ? $link->link : '' }}">
                                </div>
                            </div>



                            <!-- Imagenes imagen -->
                            <!-- Imagen Principal -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">IMG PRINCIPAL</label>
                                <div class="col-sm-10">
                                    <!-- Campo visible donde el usuario ve la URL -->
                                    <input class="form-control mb-2 urlimagen" type="text" name="principal_Image"
                                        id="principal_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($promotionEdit) ? $promotionEdit->principal_Image : '' }}" disabled>
                                    <!-- Botón para cargar la imagen -->
                                    <button class="btn btn-primary" name="openManager" id="Btnprincipal_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="principal_Image" id="hiddenPrincipal_Image"
                            value="{{ isset($promotionEdit) ? $promotionEdit->principal_Image : '' }}">

                            <!-- Imagen Secundaria -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">IMG SECUNDARIA</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="secondary_Image"
                                        id="secondary_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($promotionEdit) ? $promotionEdit->secondary_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnsecondary_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl"
                            value="{{ isset($promotionEdit) ? $promotionEdit->secondary_Image : '' }}"> --}}
                            <input type="hidden" name="secondary_Image" id="hiddenSecondaryImageUrl" value="{{ isset($promotionEdit) ? $promotionEdit->secondary_Image : '' }}">


                            <!-- Imagen Miniatura -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">IMG MINIATURA</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="mini_Image"
                                        id="mini_Image" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($promotionEdit) ? $promotionEdit->mini_Image : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnmini_Image"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="mini_Image" id="hiddenmini_ImageImageUrl"
                            value="{{ isset($promotionEdit) ? $promotionEdit->mini_Image : '' }}">

                            <!-- Imagen Banners -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">BANNERS</label>
                                <div class="col-sm-10">
                                    <input class="form-control mb-2 urlimagen" type="text" name="banners"
                                        id="banners" placeholder="/assets/imagenes-blog/..."
                                        value="{{ isset($promotionEdit) ? $promotionEdit->banners : '' }}"disabled>
                                    <button class="btn btn-primary" name="openManager" id="Btnbanners"
                                        type="button">Cambiar Imagen</button>
                                </div>
                            </div>
                            <input type="hidden" name="banners" id="hiddenBannersImageUrl"
                            value="{{ isset($promotionEdit) ? $promotionEdit->banners : '' }}">



                            {{-- INICIO DE LOS METADATOS --}}
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metadata">META DESCRIPCIÓN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata"
                                        name="metadata[descripcion]" placeholder="Ingresa el título de la promocion"
                                        value="{{ isset($promotionEdit) ? $metadata->descripcion : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="metakey">PALABRAS CLAVE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metadata" name="metadata[metakey]"
                                        placeholder="Ingresa las palabras clave"
                                        value="{{ isset($promotionEdit) ? $metadata->metakey : '' }}">
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="microdata_title">MICRODATA TÍTULO</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title"
                                        name="microdata[title]" placeholder="Título del microdato"
                                        value="{{ isset($promotionEdit) ? $microdata->title : '' }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="microdata_description">MICRODATA DESCRIPCIÓN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]" placeholder="Ingresa la descripción del microdato"
                                        value="{{ isset($promotionEdit) ? $microdata->description : '' }}">
                                </div>
                            </div>





                            {{-- <div class="modal-body">
                                <textarea name="content" id="content-editor-promotions" class="form-control" required>{{ old('content', $promotionEdit->content ?? '') }}</textarea>
                            </div><br><br><br> --}}


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
                                                {{ $form->form_id == $promotionEdit->form_id ? 'selected' : '' }}>
                                                {{ $form->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <textarea id="editorPromotions" name="content">{{ $promotionEdit->content }}</textarea>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    CKEDITOR.replace('editorPromotions'); // Inicializar CKEditor

                                    CKEDITOR.instances.editorPromotions.on('instanceReady', function() {
                                        document.getElementById('form_id').addEventListener('change', function() {
                                            let selectedOption = this.options[this.selectedIndex];
                                            let formId = selectedOption.value;

                                            if (formId) {
                                                let insertText = `$/id:${formId}/$`;
                                                let editor = CKEDITOR.instances.editorPromotions;
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
                                        onclick="window.location.href='{{ route('promotions.index') }}'">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-success">Editar Contenido
                                        {{-- <button type="submit" class="btn btn-success edit-promotions">Editar Contenido --}}
                                        Promocion</button>
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
                        {{-- <script>
                            $(document).ready(function() {
                                // Inicializa CKEditor
                                CKEDITOR.replace('content-editor-promotions');

                                // Escuchar el evento 'change' de CKEditor para actualizar el textarea
                                CKEDITOR.instances['content-editor-news'].on('change', function() {
                                    const content = CKEDITOR.instances['content-editor-promotions'].getData();
                                    $('#content-editor-promotions').val(content);
                                });
                            });
                        </script> --}}

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
