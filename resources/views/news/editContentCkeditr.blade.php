<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Incluir Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        #style-title {
            color: #FFD700;
            /* color: #ffffff; */
            /* Color dorado para el título */
            font-size: 3em;
            /* Tamaño de fuente más grande */
            font-weight: bold;
            /* Negrita */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            animation-duration: 4s;
            /* Duración extendida de la animación */
            text-align: center;
        }
    </style>

    {{-- ESTILO PARA EL MODAL DEL ERROR AL CARGAR CONTENIDO --}}
    <style>
        /* Estilo del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: auto;
            padding-top: 60px;
        }

        /* Contenido del modal */
        .modal-content {
            background-color: #fb0c0c;
            color: hsl(0, 0%, 100%);
            margin: 5% auto;
            padding: 20px;
            border: 1px solid hsl(314, 71%, 27%);
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
        }

        /* Estilo del botón de cerrar */
        .close-btn {
            color: hsl(0, 0%, 100%);
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    {{-- ESTILO PARA HACER GRANDE EL CONTORNO DEL CKEDITOR --}}
    <style>
        .content-editor-news {
            width: 100%;
            /* Ajusta el ancho al 100% del contenedor padre */
            height: 400px;
            /* Ajusta la altura */
            border: #FFD700;
        }

        #styleCkeditor {
            border: greenyellow;
            color: blue;
        }
    </style>


</head>

<body>
    <div class="form-group">
        <input type="hidden" id="content" name="content">
    </div>

    {{-- INICIAMOS EL SELECCIONAR EL FORMULARIO --}}
    <div class="row mb-6">
        <label class="col-sm-2 col-form-label" for="title">Elegir Formulario</label>
        <div class="col-sm-10">
            <div class="form-group">
                <label for="formSelect">*</label>
                <select class="form-control" id="formSelect" name="form_id" required>
                    <option value="" disabled selected>Click Para Añadir Tu Formulario</option>
                    @foreach ($forms as $form)
                        <option value="{{ $form->form_id }}" data-content="{{ $form->content }}">
                            {{-- <option value="{{ $form->form_id }}" data-content="{{ json_decode($form->content) }}"> --}}
                            {{ $form->title }}
                        </option>
                    @endforeach

                </select>
               
                {{-- ESTA LINEA HACE INVISIBLE EL TEXT AREA PERONO ALTERA EL FUNCIONAMIOENTO --}}
                {{-- <div class="form-group" style="visibility: hidden;"> --}}
                <div class="form-group" style="visibility: hidden;">
                    <label for="formContent">Contenido del formulario1</label>
                    <textarea class="form-control" id="formContent" name="formContent" readonly></textarea>
                </div>
                <div class="form-group" style="visibility: hidden;">
                    <label for="formContent">Contenido del formulario JSON</label>
                    <textarea class="form-control" id="formContentJson" name="formContentJson" readonly></textarea>
                </div>
            </div>
        </div>

    </div>
    <!-- Área de texto donde se mostrará CKEditor -->
    <h2 id="style-title" class="animate__animated animate__bounceIn">Agregar Contenido</h2>
    <textarea name="content" id="content-editor-news" class="form-control" required>{{ old('content', $newsNotice->content ?? '') }}</textarea>
    {{-- <textarea name="content" id="content-editor-news" class="form-control" required>{{ old('content', $form->content ?? $newsNotice->content ?? '') }}</textarea> --}}

    {{-- CREAMOS EL MODAL PARA EL ERROR DEL MANSAJE AL NO CARGAR --}}
    <!-- Modal de Error -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>¡Error!</h2>
            <p>¡No se pudo cargar el formulario! ¡Edita tus campos en la sección de edición de formularios!</p>
        </div>
    </div>


    <!-- CKEditor y jQuery -->
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="/assets/assets-editor/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/js/sweetAlert/noticiasAlerts/ckeditor-newsAlert .js') }}"></script>

    {{-- SCRIPT PARA FUNCIONAMIENTO DE FORMULARIO VISTA PREVIA --}}
    <script>
        $(document).ready(function() {
            // Inicializa CKEditor
            // CKEDITOR.replace('content-editor-news');
            // Inicializa CKEditor
            CKEDITOR.replace('content-editor-news', {
                width: '100%', // Ancho al 100% del contenedor
                height: 600, // Ajusta la altura (en píxeles)
                resize_enabled: true, // Habilita el cambio de tamaño manual
                resize_maxWidth: 1000, // Ancho máximo
                resize_minWidth: 500, // Ancho mínimo
            });

            // Captura el valor del editor antes de enviar el formulario
            $('form').on('submit', function() {
                $('#content').val(CKEDITOR.instances['content-editor-news'].getData());
            });

            // Lógica para actualizar el contenido del CKEditor y la vista previa
            document.getElementById('formSelect').addEventListener('change', function() {
                // Obtener la opción seleccionada
                var selectedOption = this.options[this.selectedIndex];

                // Obtener el contenido asociado con la opción seleccionada
                var content = selectedOption ? selectedOption.getAttribute('data-content') : '';
                console.log(content); 
                document.getElementById('formContentJson').innerHTML = content;


                // Verificar si el contenido está vacío o no válido
                if (!content) {
                    // Mostrar error en el CKEditor o en la vista previa
                    CKEDITOR.instances['content-editor-news'].setData(
                        '<p>Error: No se ha seleccionado un formulario o el contenido es inválido.</p>');
                    document.getElementById('formContent').innerText =
                        'Error: No se ha seleccionado un formulario o el contenido es inválido.';
                } else {
                    try {
                        // Parsear el contenido como JSON
                        var parsedContent = JSON.parse(content);

                        // Generar HTML dinámico a partir del JSON
                        var htmlPreview = '';

                        parsedContent.forEach(function(item) {
                            switch (item.type) {
                                case 'checkbox-group':
                                    htmlPreview += `<label>${item.label}</label>`;
                                    item.values.forEach(function(value) {
                                        htmlPreview +=
                                            `<div><input type="checkbox" ${value.selected ? 'checked' : ''}> ${value.label}</div>`;
                                    });
                                    break;
                                case 'date':
                                    htmlPreview +=
                                        `<label>${item.label}</label><input type="date" class="${item.className}" />`;
                                    break;
                                case 'file':
                                    htmlPreview +=
                                        `<label>${item.label}</label><input type="file" class="${item.className}" />`;
                                    break;
                                case 'header':
                                    htmlPreview +=
                                        `<${item.subtype}>${item.label}</${item.subtype}>`;
                                    break;
                                case 'hidden':
                                    htmlPreview += `<input type="hidden" name="${item.name}" />`;
                                    break;
                                case 'autocomplete':
                                case 'text':
                                case 'number':
                                    htmlPreview +=
                                        `<label>${item.label}</label><input type="${item.type}" class="${item.className}" placeholder="${item.placeholder || ''}" />`;
                                    break;
                                case 'textarea':
                                    htmlPreview +=
                                        `<label>${item.label}</label><textarea class="${item.className}" placeholder="${item.placeholder || ''}"></textarea>`;
                                    break;
                                case 'button':
                                    htmlPreview +=
                                        `<button type="button" class="${item.className}">${item.label}</button>`;
                                    break;
                                case 'radio-group':
                                    htmlPreview += `<label>${item.label}</label>`;
                                    item.values.forEach(function(value) {
                                        htmlPreview +=
                                            `<div><input type="radio" name="${item.name}" value="${value.value}" ${value.selected ? 'checked' : ''}> ${value.label}</div>`;
                                    });
                                    break;
                                case 'select':
                                    htmlPreview +=
                                        `<label>${item.label}</label><select class="${item.className}">`;
                                    item.values.forEach(function(value) {
                                        htmlPreview +=
                                            `<option value="${value.value}" ${value.selected ? 'selected' : ''}>${value.label}</option>`;
                                    });
                                    htmlPreview += `</select>`;
                                    break;
                                case 'paragraph':
                                    htmlPreview += `<p>${item.label}</p>`;
                                    break;
                                default:
                                    htmlPreview += `<p>Tipo no soportado: ${item.type}</p>`;
                            }
                        });
                        // Obtener el contenido actual de CKEditor
                        var currentContent = CKEDITOR.instances['content-editor-news'].getData();
                        console.log('valor de current content', currentContent );

                        // Agregar el contenido del formulario al contenido actual
                        var newContent = currentContent + '<hr>' + htmlPreview;

                        // Establecer el nuevo contenido combinado en CKEditor
                        CKEDITOR.instances['content-editor-news'].setData(newContent);

                        // Actualizar la vista previa (si es necesario)
                        document.getElementById('formContent').innerHTML = htmlPreview;
                        // // Establecer el contenido en CKEditor
                        // CKEDITOR.instances['content-editor-news'].setData(htmlPreview);

                        // // Actualizar la vista previa
                        // document.getElementById('formContent').innerHTML = htmlPreview;
                    } catch (e) {

                        // Si hay un error al procesar el JSON, muestra el modal de error QUE LLAMAMAMOS EN EL OTRO SCRIPT DE ABAJO
                        showErrorModal();

                    }
                }
            });
        });
    </script>



    {{-- FUNCION PARA MOSTRAR EL MENSAJE DE ERROR SI EXISTE AL CARGAR EL CONTENIDO DEL FORMULARIO --}}
    <script>
        // Mostrar el modal
        function showErrorModal() {
            document.getElementById('errorModal').style.display = 'block';

            // Establecer el contenido en CKEditor
            CKEDITOR.instances['content-editor-news'].setData(
                '<h1>¡No se pudo cargar el formulario! ¡Edita tus campos en la sección de edición de formularios!</h1>');
            document.getElementById('formContent').innerText = 'Error: Contenido no válido.';
        }

        // Cerrar el modal cuando se hace clic en el botón de cerrar
        document.querySelector('.close-btn').addEventListener('click', function() {
            document.getElementById('errorModal').style.display = 'none';
        });
    </script>



</body>

</html>
