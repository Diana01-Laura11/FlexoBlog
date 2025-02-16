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

        <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
        @include('messageAlerts.messageAlerts')

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
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Nueva Galeria</h5>
                        <small class="text-muted float-end">Galeria</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('galeries.saveGalleries') }}" method="post">
                            @csrf
                            @if (isset($Galeries))
                                @method('PUT')
                            @endif
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="title">Nombre de la galeria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ingresa el nombre de la galeria."
                                        value="{{ isset($galeries) ? $galeries->title : '' }}">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="alias">Alias</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="El alias se genera automáticamente" disabled />
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="status">Publicado</label>
                                <div class="col-sm-10">
                                    <!-- Campo oculto para enviar 'Unpublished' si el checkbox no está marcado -->
                                    <input type="hidden" name="status" value="Unpublished">
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status-switch" value="Published"
                                            {{ old('status', $galeries->status ?? '') == 'Published' ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">Sí</span>
                                            <span class="switch-off">No</span>
                                        </span>
                                    </label>
                                </div>
                            </div>



                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="testimonials-container">Testismonios</label>
                                <div class="col-sm-10">
                                    <div id="testimonials-container">
                                        <div class="testimonio mb-3">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label for="testimonials[0][nombre]">Nombre:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="testimonials[0][name]"
                                                        placeholder="Escribe el nombre de quien hizo el testimonio" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label for="testimonials[0][testimonio]">Testimonio:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <textarea name="testimonials[0][testimonio]" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label for="testimonials[0][cargo]">Cargo:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="testimonials[0][cargo]"
                                                        placeholder="Escribe el cargo dentro de la emprersa de quien reralizo el testimonio" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label for="testimonials[0][empresa]">Empresa:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        name="testimonials[0][empresa]"
                                                        placeholder="Escribe el nombre de la empresa a la que pertenece quien realiza el trestimonio" />
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger remove-testimonio">Eliminar</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-testimonio" class="btn btn-primary mt-3">Agregar
                                        Testimonio</button>
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="herramienta-galeria-container">Herramienta de
                                    galeria</label>
                                <div class="col-sm-10">
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Foto Principal</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control mb-2 urlimagen" type="text"
                                                name="imagenPrincipal" id="imagenPrincipal"
                                                placeholder="/assets/imagenes-blog/...">
                                            <button class="btn btn-primary" name="openManager" id="BtnimagenPrincipal"
                                                type="button">Cargar imagen</button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Imagen</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control mb-2 urlimagen" type="text"
                                                name="imagenPrincipal" id="imagenPrincipal"
                                                placeholder="/assets/imagenes-blog/...">
                                            <button class="btn btn-primary" name="openManager" id="BtnimagenPrincipal"
                                                type="button">Cargar imagen</button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Banner</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control mb-2 urlimagen" type="text"
                                                name="imagenPrincipal" id="imagenPrincipal"
                                                placeholder="/assets/imagenes-blog/...">
                                            <button class="btn btn-primary" name="openManager" id="BtnimagenPrincipal"
                                                type="button">Cargar imagen</button>
                                            <div class="col mb-3">
                                                <label for="basic-default-name">Ventana nueva</label>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" class="switch-input"
                                                        id="status-switch" value="1"
                                                        {{ old('status', $newsNotice->status ?? '') == 'Published' ? 'checked' : '' }}
                                                        onchange="updateStatus(this)">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on">Sí</span>
                                                        <span class="switch-off">No</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Fecha de
                                    publicación</label>
                                <div class="col-sm-10">
                                    <div class="col-md-6 col-12 mb-6">
                                        <input type="date" name="publish_date" class="form-control"
                                            id="publish_date">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Metadatos
                                    necesarios</label>
                                <div class="col-sm-10">
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Meta Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="descripcion"
                                                name="metadata[descripcion]"
                                                placeholder="Escribe un texto breve(150-160 caracteres) para describir el contenido de tu página y mejorar su visibilidad en motores de búsqueda.">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Palabras Clave</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="metakey"
                                                name="metadata[metakey]"
                                                placeholder="Ingresa términos o frases relevantes que describan tu contenido para mejorar su posicionamiento en motores de búsqueda.">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Miocrodatos
                                    necesarios</label>
                                <div class="col-sm-10">
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Microdatos Título</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="microdata_title"
                                                name="microdata[title]"
                                                placeholder="Ingresa el título para los microdatos">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">Microdatos Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="microdata_description"
                                                name="microdata[description]"
                                                placeholder="Ingresa una descripción breve para los microdatos">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">OG Necesarios</label>
                                <div class="col-sm-10">
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">OG Título</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="og_title" name="og[title]"
                                                placeholder="Ingresa el título para el OG">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-3">
                                            <label for="basic-default-name">OG Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="og_description"
                                                name="og[description]"
                                                placeholder="Ingresa una descripción breve para el OG">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="submit" class="btn btn-danger me-3" onclick="window.history.back();">Cancelar</button> --}}
                                    <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('galeries.index') }}'">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-success" type="submit">Guardar cambios</button>

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
        @include('galeries.AddImagen')
        <!-- *************************** -->
    @endsection


    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        {{-- CDN PARA CKeditor --}}
        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        <script src="/assets/assets-editor/ckeditor.js"></script>

        <script>
            $(document).ready(function() {
                $('#articles').DataTable();
            });
        </script>

        <script>
            function updateStatus(checkbox) {
                // Actualiza el valor del checkbox basado en si está marcado o no
                checkbox.value = checkbox.checked ? "Published" : "Unpublished";
            }
        </script>


        <!-- PASO 3: PEGAR EL SCRIPT DE MODAL -->
        <script src="/assets/js/managerImagen.js"></script>
        <!-- *************************** -->
        <!-- PASO 4: ES CREAR UN BLADE LLAMADO AddImagen Y PEGAR EL CODIGO -->

        {{-- FUNCION PARA LLAMAR AL CKEDITOR --}}

        <script>
            $(document).ready(function() {
                CKEDITOR.replace('content-editor', {});
            });
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

        <script>
            //Script para añadior mas testimonos
            document.addEventListener('DOMContentLoaded', function() {
                let testimonioIndex = 0; // Para llevar un índice único para cada testimonio

                // Botón "Agregar Testimonio"
                document.getElementById('add-testimonio').addEventListener('click', function() {
                    testimonioIndex++;
                    const container = document.getElementById('testimonials-container');

                    // Estructura del nuevo testimonio
                    const newTestimonio = `
            <div class="testimonio mb-3">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="testimonials[${testimonioIndex}][nombre]">Nombre:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" 
                        name="testimonials[${testimonioIndex}][name]"
                        placeholder="Escribe el nombre de quien hizo el testimonio"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="testimonials[${testimonioIndex}][testimonio]">Testimonio:</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="testimonials[${testimonioIndex}][testimonio]" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="testimonials[${testimonioIndex}][cargo]">Cargo:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" 
                        name="testimonials[${testimonioIndex}][cargo]"
                        placeholder="Escribe el cargo dentro de la emprersa de quien reralizo el testimonio"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="testimonials[${testimonioIndex}][empresa]">Empresa:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                        name="testimonials[${testimonioIndex}][empresa]"
                        placeholder="Escribe el nombre de la empresa a la que pertenece quien realiza el trestimonio"/>
                    </div>
                </div>
                <button type="button" class="btn btn-danger remove-testimonio">Eliminar</button>
            </div>
        `;

                    // Agregar el nuevo testimonio al contenedor
                    container.insertAdjacentHTML('beforeend', newTestimonio);

                    // Agregar evento al botón "Eliminar" del nuevo testimonio
                    const removeButtons = container.querySelectorAll('.remove-testimonio');
                    removeButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            this.parentElement.remove();
                        });
                    });
                });
            });
        </script>
    @endsection
