<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Formulario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/form-builder/form-builder.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('assets/form-builder/form-builder.min.js') }}"></script>
</head>
<style>
    .all-container {
        /* background-image:url("../img/imgs/Forms.gif"); */
        background-image: linear-gradient(to top left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../assets/img/gif/header2.png");
        background-size: cover;
        background-position: center;
        /* background-position: top-left; */
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        text-align: center;
        color: rgb(0, 0, 0);
    }

    #Boton-Title {
        font-family: "Means Web", Georgia, Times, "Times New Roman", serif;
        background-color: #f8f9fa;
        /*Color de fondok
       /* background-color: transparent; Color de fondo */
        */ padding: 10px 15px;
        /* Espaciado dentro del campo */
        border-radius: 5px;
        /* Bordes redondeados */
        font-size: 1.1rem;
        /* Tamaño de la fuente */
        color: #333;
        /* Color del texto */
        border: 1px solid #ccc;
        /* Borde gris claro */
        width: 100%;
    }

    #title {
        font-family: "Means Web", Georgia, Times, "Times New Roman", serif;
        background-color: #fff;
        /*Fondo blanco para el inputk */
        /* background-color: transparent; */

        padding: 10px 15px;
        /* Espaciado dentro del input */
        border-radius: 5px;
        /* Bordes redondeados */
        font-size: 1.1rem;
        /* Tamaño de la fuente */
        color: #333;
        /* Color del texto */
        border: 1px solid #ccc;
        /* Borde gris claro */
        width: 100%;
        /* Hace el input más ancho (ocupa todo el ancho disponible) */
    }

    .header-title {
        font-family: "Means Web", Georgia, Times, "Times New Roman", serif;
        font-size: 4em;
        color: white;
        background-color: transparent;
    }

    /* ESTILOS PARA ELSWITCH */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-left: 0;
        /* Asegúrate de que no haya margen no deseado */
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

    /* Ajuste para el contenedor */
    .switch-container {
        background-color: #fff;
        /* Fondo blanco */
        display: block;
        /* Usamos display: block para que los elementos sigan el flujo normal */
        margin-left: 0;
        /* Elimina cualquier margen izquierdo */
        margin-top: 10px;
        /* Ajusta el margen superior (puedes cambiar el valor) */
        padding-left: 220px;
        /* Ajusta el espacio en el lado izquierdo del contenedor */
        padding-right: 0;
        /* Elimina el padding derecho si lo hay */
    }
</style>
<!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
@include('messageAlerts.messageAlerts')


<body class="all-container">
    <div class="container mt-5">
        <h2 class="header-title">Crea Tu Formulario</h2> <!-- Título encima del formBuilder -->
        <form id="createForm" action="{{ route('forms.saveForm') }}" method="POST">
            @csrf
            <div id="Boton-Title" class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Ingresa el título del formulario">

                <!-- Contenedor de la switch -->
                <label class="col-sm-2 col-form-label" for="basic-default-company">Activo</label>
                <div class="col-sm-10 switch-container">
                    <label class="switch">
                        <input type="checkbox" name="status" class="switch-input" id="status-switch" value="1"
                            {{ isset($form) && $form->status ? 'checked' : '' }} />
                        <span class="switch-toggle-slider">
                            <span class="switch-on">Sí</span>
                            <span class="switch-off">No</span>
                        </span>
                    </label>
                </div>
            </div>



            <!-- Editor de FormBuilder -->
            <div id="fb-editor"></div>

            <!-- Campo oculto que almacenará el contenido del formulario -->
            <input type="hidden" name="form" id="formContent">

            <br>
            <div class="row justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                    {{-- <!-- Botones del FormBuilder -->
                    <button type="button" class="btn btn-danger me-3" onclick="window.history.back();">Salir</button> --}}
                    <button type="button" class="btn btn-danger me-3"
                    onclick="window.location.href='{{ route('forms.index') }}'">
                    Salir
                </button>
                    
                    <!--  botón para guardar el formulario -->
                    {{-- <button type="submit" class="btn btn-primary" id="createFormButton">Crear Formulario</button> --}}
                    <button type="submit" class="btn btn-primary" id="#">Crear Formulario</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        jQuery(function($) {
            // Inicializa FormBuilder
            var formBuilder = $('#fb-editor').formBuilder();

            // Al enviar el formulario, guarda el contenido actualizado en el campo oculto
            $('#createForm').submit(function(e) {
                // Obtén los datos del formulario
                var formData = formBuilder.actions.getData('json');

                // Asegúrate de que el título también se esté enviando junto con el contenido del formulario
                var title = $('#title').val(); // Cambié aquí 'name' por 'title'

                // Agrega el título al contenido del formulario (opcional, si lo necesitas dentro del contenido)
                formData.title = title; // Si deseas incluir el título en el JSON del formulario

                // Actualiza el contenido del formulario en el campo oculto
                $('#formContent').val(JSON.stringify(formData));
            });

            // Funcionalidad para limpiar el formulario
            $('#clearForm').click(function() {
                formBuilder.actions.clear(); // Limpia el formulario
                $('#title').val(''); // Limpia el campo del título
            });
        });
    </script>

    {{-- // Captura el cambio de estado en el interruptor --}}
    <script>
        document.getElementById('status-switch').addEventListener('change', function() {
            this.value = this.checked ? 1 : 0;
        });
    </script>


    {{-- IMPORTACION DEL SWEET ALERT --}}
    <script src="{{ asset('assets/js/sweetAlert/formulariosAlerts/createFormAlert.js') }}"></script>
    <script src="{{ asset('assets/js/sweetAlert/formulariosAlerts/load-FormAlert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
