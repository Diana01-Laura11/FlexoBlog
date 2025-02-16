<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Formulario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/form-builder/form-builder.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('assets/form-builder/form-builder.min.js') }}"></script>

</head>

<style>
    .all-containerEdit {

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
        background-image: linear-gradient(to top left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/assets/img/imgs/header2.png');
    }

    #border {
        border: rgba(100, 27, 27, 0.539) 8px outset;
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

<body class="all-containerEdit">

    <div class="container mt-5">
        <h2 class="header-title">Contenido Del Formulario</h2> <!-- Título encima del formBuilder -->
        <form id="editForm" action="{{ route('forms.updateForm', $form->form_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div id="Boton-Title" class="col-sm-10">
                <input type="text" id="title" name="title" class="form-control mb-3"
                    value="{{ old('title', $form->title) }}" required>

                <!-- Contenedor de la switch -->
                <label class="col-sm-2 col-form-label" for="basic-default-company">Activo</label>
                <div class="col-sm-10 switch-container">
                    <div class=""></div>
                    <label class="switch">
                        <input type="checkbox" name="status" id="status-switch" value="1"
                            {{ old('status', $form->status) ? 'checked' : '' }} onchange="updateStatus(this)">
                        <span class="switch-toggle-slider">
                            <span class="switch-on">Sí</span>
                            <span class="switch-off">No</span>
                        </span>
                    </label>
                </div>
            </div>
            <br>

            <div class="border">
                <!-- Editor de FormBuilder -->
                <div id="fb-editor"></div>
            </div>


            <!-- Campo oculto que almacenará el contenido del formulario -->
            <input type="hidden" name="form" id="formContent">

            <br>
            <div class="row justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-3">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger me-3"
                    onclick="window.location.href='{{ route('forms.index') }}'">
                    Salir
                </button>
                    {{-- <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button> --}}
                </div>
            </div>
        </form>
    </div>

    <script>
        jQuery(function($) {
            var initialFormData = {!! json_encode($form->content) !!};

            if (typeof initialFormData === 'string') {
                try {
                    initialFormData = JSON.parse(initialFormData); // Convierte la cadena JSON en un objeto
                } catch (e) {
                    console.error("Error al parsear el JSON: ", e);
                    initialFormData = {}; // Si el JSON no es válido, usar un objeto vacío
                }
            }

            var formBuilder = $('#fb-editor').formBuilder({
                formData: initialFormData // Pasa los datos al formBuilder como un objeto
            });

            $('#editForm').submit(function() {
                var formData = formBuilder.actions.getData('json');

                // Guarda el contenido actualizado como JSON en el campo oculto
                $('#formContent').val(formData);
            });
        });
    </script>
</body>

</html>
