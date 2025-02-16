const folder = document.querySelectorAll('.folder-btn');
//Obtener la carpeta selecionarda
folder.forEach(button => {
    button.addEventListener('click', function () {
        const folderName = button.getAttribute('name');
        const folderUrl = folderName;
        // Usando Fetch API para enviar datos al servidor sin recargar la página
        ObtenerImagenes(folderName);
        document.getElementById('nameFolder').textContent = folderName;
    });
});

const buttonsOpenManager = document.getElementsByName('openManager');

console.log(buttonsOpenManager);

buttonsOpenManager.forEach(button => {
    button.addEventListener('click', function () {
        buttonsOpenManager.forEach((btn) => {
            btn.classList.remove('selectedButton');
        });
        button.classList.add('selectedButton');
        // Mostrar el modal
        document.getElementById('ImagenManager').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        // Usando Fetch API para enviar datos al servidor al abrir el gestor
        ObtenerImagenes("autores");
    });
});

// Cerrar el modal 
document.getElementById('closeModal').onclick = function () {
    document.getElementById('ImagenManager').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
};

//Pone la url de la imagen en el input
document.getElementById('AddImagen').onclick = function () {
    let urlValue = $('.selected').data('url');
    const InputsUrl = document.querySelectorAll('.urlimagen');
    InputsUrl.forEach((InputUrl) => {
        const id = InputUrl.getAttribute('id');
        const buttonAddImagen = document.getElementsByClassName("selectedButton")[0];
        const idButton = buttonAddImagen.getAttribute('id');
        if ("Btn" + id == idButton) {
            InputUrl.value = urlValue;
            InputUrl.disabled = true;
            document.getElementById('ImagenManager').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    });
}


function ObtenerImagenes(folder) {
    $.ajax({
        url: '/articles/showImages',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
        },
        data: {
            'folder': folder
        },
        success: function (response) {
            const array_response = Object.values(response.files);
            const listimages = document.getElementById('list-images');
            listimages.innerHTML = "";
        
            array_response.forEach((element) => {
                var url = element.path;
                url = url.slice(11);  // Eliminar la parte inicial no necesaria
                
                // Asegúrate de definir startIndex si lo necesitas
                const startIndex = url.indexOf("assets");
                
                // Si startIndex no está definido, puedes hacer la asignación directamente:
                var urlRelative = url.substring(startIndex);  // Toma la parte después de "/assets"
                urlRelative = "/" + urlRelative;  // Agrega el prefijo "/"
        
                listimages.innerHTML += "<button type='button' class='urlImg btn d-flex flex-column align-items-center' data-url='" + urlRelative + "'>" +
                    "<img src='" + urlRelative + "' alt='" + element.name + "' class='style-img'>" +
                    "<span class='mt-2'>" + element.name + "</span>" +
                "</button>";
            });
        
        
            const btnEnviar = document.getElementById('AddImagen');
            const buttons = document.querySelectorAll('.urlImg');
            buttons.forEach((button) => {
                button.addEventListener('click', function () {
                    buttons.forEach((btn) => {
                        btn.classList.remove('selected');
                        btn.classList.remove('buttonSelected');
                    });

                    button.classList.add('buttonSelected');
                    button.classList.add('selected');
                    btnEnviar.classList.remove('btn-secondary');
                    btnEnviar.classList.add('btn-primary');
                    btnEnviar.disabled = false;
                });
            });

        },
        error: function (xhr, status, error) {
            console.error('Error:', error, xhr, status);
        }
    });

}
