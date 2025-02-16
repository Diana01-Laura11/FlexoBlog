<div class="row mb-6">
    <label class="col-sm-2 col-form-label" for="form_id">Elige Formulario</label>
    <div class="col-sm-10">
        <select name="form_id" id="form_id" class="form-control transparent-select" required>
            <option value="">-- Selecciona un formulario --</option>
            @foreach ($form as $formCreate)
                <option value="{{ $formCreate->form_id }}">
                    {{ $formCreate->title }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<!--INICIA CKEDITOR ckeditor-->
{{-- <textarea id="editorNews"></textarea> --}}
<h2 id="style-title" class="animate__animated animate__bounceIn">Agregar Contenido</h2>
<textarea id="editorNews" name="content"></textarea>

<style>
    #style-title {
        color: #FFD700;
        Color font-size: 2em;
        /* Tamaño de fuente más grande */
        font-weight: bold;
        /* Negrita */
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        animation-duration: 15s;
        /* Duración extendida de la animación */
        text-align: center;
    }
</style>

{{-- 
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inicializar CKEditor
        CKEDITOR.replace('editorNews');

        document.getElementById('form_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex]; // Obtener la opción seleccionada
            let formId = selectedOption.value; // Obtener el ID del formulario

            if (formId) {
                let insertText = `$/id:${formId}/$`; // Formato a insertar

                // Verificar si la instancia de CKEditor está lista
                let editor = CKEDITOR.instances.editorNews;
                if (editor) {
                    editor.insertHtml(insertText); // Insertar en CKEditor
                } else {
                    console.error("CKEditor no está inicializado aún.");
                }
            }
        });
    });
</script> --}}

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
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>