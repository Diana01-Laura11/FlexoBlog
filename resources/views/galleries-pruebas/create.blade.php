@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <!-- Incluir Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
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

                /* estilo de boton del modal de imagenes */
                /* Ajustes para los botones en el modal */
                .modal-body {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                    /* Ajusta el valor según lo que necesites */
                }

                .modal-footer {
                    display: flex;
                    justify-content: flex-end;
                    /* Alinea el botón de cerrar a la derecha */
                }

                .selectImage,
                .submitImage {
                    width: auto;
                    /* Ajusta el tamaño de los botones */
                }
                .form-control {
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                }
            </style>



            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h5 class="mb-0">Nueva Promocion</h5>

                        <small class="text-muted float-end">Promocion</small>
                    </div>


                    <div class="card-body">
                        {{-- <form action="{{ route('categories.store') }}" method="post"> --}}
                        <form action="{{ route('promotions.savePromotion') }}" method="post">

                            @csrf
                            @if (isset($promotions))
                                @method('PUT')
                            @endif


                            <!-- Título de la promocion -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Nombre de la promocion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el título de la promocions "
                                        value="{{ isset($promotions) ? $promotions->title : '' }}">
                                </div>
                            </div>


                            <!-- Alias -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente"
                                        value="{{ isset($promotions) ? $promotions->alias : '' }}" disabled required />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">SubTitulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subtitle" id="subtitle"
                                        placeholder="Ingresa un subtitulo." />
                                </div>
                            </div>




                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">Publicado</label>
                                <div class="col-sm-10">
                                    <!-- Campo oculto para enviar 'Unpublished' si el checkbox no está marcado -->
                                    <input type="hidden" name="status" value="Unpublished">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $promotions->status ?? '') == 'Published' ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">Sí</span>
                                            <span class="switch-off">No</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!--FECHAS fecha Fecha fechas-->

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">Fecha inicio de
                                    promoción</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="date" class="form-control" name="start_date" id="flatpickr-datetime"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="flatpickr-datetime">Fecha de fin de
                                    promoción</label>
                                <div class="col-sm-10">
                                    <div class="col-md-15 col-12 mb-6">
                                        <input type="datetime" class="form-control" name="end_date" id="flatpickr-datetime"
                                            placeholder="Click Para Abrir Panel De Fechas Dia-Mes-Año" />
                                    </div>
                                </div>
                            </div>






                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Condicion de la
                                    promocion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="terms"
                                        placeholder="Ingresa la condicion de la promocion." />
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Extra de la opromocion <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="extras" name="extras[extras]"
                                        placeholder="Escribe un texto extra de la promocion">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Nombre De Herramienta <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="link[name]"
                                        placeholder="Escribe la herramienta de promocion">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Link De La Herramienta <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="link[link]"
                                        placeholder="Escribe la herramienta de promocion">
                                </div>
                            </div>





                            {{-- IMAGENES --}}
                            {{-- <label class="col-sm-2 col-form-label">Imagen principal (850x300) </label>
                            <!-- Botón que abre el modal de imagenes -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                Agregar Imagenes
                            </button>


                            <!--BotstrapSytle  Modal De Imagenes,  -->
                            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Elige una opción</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Opciones para ver y subir imágenes -->
                                            <a href="{{ route('images.selectServer') }}"
                                                class="selectImage btn btn-primary btn-lg">
                                                Seleccionar imágenes en el servidor
                                            </a>
                                            <a href="{{ route('images.create') }}"
                                                class="submitImage btn btn-primary btn-lg" carpeta="promociones">
                                                Quiero Subir Mi Propia Imagen
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <br><br> --}}

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


                            {{-- INICIO DE LOS METADATOS --}}
                            <div class="row mb-6">
                                <label for="descripcion" class="col-sm-2 control-label">Meta descripción <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="descripcion"
                                        name="metadata[descripcion]"
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


                            {{-- IMAGENES  PARA MICRODATA --}}
                            {{-- <label class="col-sm-2 col-form-label">OG Image (1200x630)</label>
                            <!-- Botón que abre el modal de imagenes -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                Agregar Imagenes
                            </button>


                            <!--BotstrapSytle  Modal De Imagenes,  -->
                            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Elige una opción</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Opciones para ver y subir imágenes -->
                                            <a href="#imagenes" class="selectImage btn btn-warning btn-lg"
                                                carpeta="archivos.php?carpeta=promociones&amp;tipo=promociones">
                                                Seleccionar imágenes en el servidor
                                            </a>
                                            <a href="#subirmarca" class="submitImage btn btn-primary btn-lg"
                                                carpeta="promociones">
                                                Quiero Subir Mi Propia Imagen
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <br><br> --}}


                            <div class="row mb-6">
                                <label for="microdata_title" class="col-sm-2 control-label">Microdata Title <sup
                                        class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_title"
                                        name="microdata[title]" placeholder="Ingresa el título para los microdatos">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="microdata_description" class="col-sm-2 control-label">Microdata Description
                                    <sup class="campo_obligatorio">*</sup></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="microdata_description"
                                        name="microdata[description]"
                                        placeholder="Ingresa una descripción breve para los microdatos">
                                </div>
                            </div>





                            {{-- INTEGRACION DEL CKEDITOR --}}
                            {{-- AQUI SE INSERTA LA INSTANCIA E IMPORTACION DEL CONTENIDO CON CKEDITOR --}}
                            @include('promotions.content-ckeditor')
                            <br>
                            <br>


                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button>
                                    {{-- <button type="submit" class="btn btn-danger me-3">Cancelar</button> --}}

                                    <button class="btn btn-success" type="submit">Agregar promocion</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form with Tabs -->

        <!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
        @include('promotions.addImagenPromotion')

        <!--/ Content -->
    @endsection


    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        {{-- CDN PARA CKeditor --}}
        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        <script src="/assets/assets-editor/ckeditor.js"></script>
        {{-- SCRIPT PARA IMAGENES --}}
        <script src="/assets/js/managerImagenPromotion.js"></script>

        <script>
            $(document).ready(function() {
                $('#articles').DataTable();
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


        {{-- FUNCION PARA LLAMAR AL CKEDITOR --}}

        <script>
            $(document).ready(function() {
                CKEDITOR.replace('content-editor', {});
            });
        </script>

        {{-- SCRIPT PARA EL CALENDARIO --}}
        <!-- Incluir Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            // Inicializar flatpickr en el input con id 'flatpickr-datetime'
            flatpickr("#flatpickr-datetime", {
                dateFormat: "Y-m-d", // Formato de fecha
            });
        </script>
    @endsection
