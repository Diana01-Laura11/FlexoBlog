

$(document).on('click', '.delete-promotions', function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto

    const form = $(this).closest('.delete-form'); // Obtener el formulario más cercano

    // Muestra el SweetAlert de confirmación
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede revertir. promociones",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, muestra el SweetAlert bloqueado de carga
            Swal.fire({
                title: "Eliminando...",
                html: `
                    <div style="text-align: center;">
                        <p>Por favor, espere mientras se realiza la acción.</p>
                        <img src="/assets/img/gif/delete-gif.gif" style="width: 100px; height: auto; margin-top: 10px;">
                    </div>
                `,
                background: '#D7F7FF',
                allowOutsideClick: false,
                showConfirmButton: false,
                showCancelButton: false
            });

            // Envía el formulario
            form.submit();

            // Cierra el SweetAlert al completar la acción
            $(document).ajaxComplete(function() { // Si usas AJAX o redirección
                Swal.close(); // Cierra el SweetAlert
            });
        }
    });
});
