<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Incluir Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        #style-title {
            color: #FFD700; Color 
            font-size: 2em; /* Tamaño de fuente más grande */
            font-weight: bold; /* Negrita */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            animation-duration: 15s; /* Duración extendida de la animación */
           text-align: center;
        }

        
    </style>
</head>
<body>
    <div class="form-group">
        <input type="hidden" id="content" name="content">
    </div>

    <!-- Área de texto donde se mostrará CKEditor -->
    <!-- Aquí puedes cambiar la clase de animación a lo que prefieras (bounceIn, rotateIn, etc.) -->
    <h2 id="style-title" class="animate__animated animate__bounceIn">Agregar Contenido</h2>
    <textarea id="content-editor-promotions" name="content"></textarea>

    <!-- CKEditor y jQuery -->
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="/assets/assets-editor/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/js/sweetAlert/noticiasAlerts/ckeditor-newsAlert .js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inicializa CKEditor directamente en el textarea
            CKEDITOR.replace('content-editor-promotions');

            // Captura el valor del editor antes de enviar el formulario
            $('form').on('submit', function() {
                $('#content').val(CKEDITOR.instances['content-editor-promotions'].getData());
            });
        });
    </script>
</body>
</html>
