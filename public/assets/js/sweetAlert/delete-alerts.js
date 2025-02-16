

//ALERTA PARA ELIMINACION

// $(document).on('click', '.delete-category', function(e) {
//     e.preventDefault(); // Prevenir el comportamiento por defecto

//     const form = $(this).closest('.delete-form'); // Obtener el formulario más cercano

//     // Agrega un console.log para verificar que el evento se activa
//     console.log("Botón de eliminar clicado");

//     Swal.fire({
//         html: `
//             <div style="text-align: center;">
//                 <h2>¿Estás seguro?</h2>
//                 <p>¡No podrás revertir esto!</p>
//                <img src="/assets/img/gif/delete-gif.gif" style="width: 100px; height: auto; margin-top: 10px;">
//             </div>
//         `,
//         background: '#D7F7FF', // Color de fondo
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#3085d6',
//         confirmButtonText: 'Sí, eliminar!',
//         cancelButtonText: 'Cancelar'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Si se confirma, se envía el formulario
//             form.submit();
//         }
//     });
// });



// // VERSION FUNCIONAL SIN PREGUNTAR ANTES

// $(document).on('click', '.delete-category', function(e) {
//     e.preventDefault(); // Prevenir el comportamiento por defecto

//     const form = $(this).closest('.delete-form'); // Obtener el formulario más cercano

//     // Muestra el SweetAlert bloqueado sin botones de confirmación/cancelación
//     Swal.fire({
//         title: "Eliminando...",
//         html: `
//             <div style="text-align: center;">
//                 <p>Por favor, espere mientras se realiza la acción.</p>
//                 <img src="/assets/img/gif/delete-gif.gif" style="width: 100px; height: auto; margin-top: 10px;">
//             </div>
//         `,
//         background: '#D7F7FF',
//         allowOutsideClick: false,  // Bloquear clics fuera del cuadro
//         showConfirmButton: false,  // Ocultar botón de confirmación
//         showCancelButton: false    // Ocultar botón de cancelación
//     });

//     // Envía el formulario
//     form.submit();

//     // Cierra el SweetAlert al completar la acción
//     $(document).ajaxComplete(function() { // Si usas AJAX o redirección
//         Swal.close(); // Cierra el SweetAlert
//     });
// });



$(document).on('click', '.delete-category', function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto

    const form = $(this).closest('.delete-form'); // Obtener el formulario más cercano

    // Muestra el SweetAlert de confirmación
    Swal.fire({
        title: "¿Estás seguro?",
        // text: "Esta acción no se puede revertir. fuera",
        text: "Realizar Dicha Acción",
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
