
// $(document).on('click', '.edit-promotions', function(e) {
//     e.preventDefault(); // Prevenir el comportamiento por defecto

//     // const form = $(this).closest('.delete-form'); // Obtener el formulario más cercano

//     // Muestra el SweetAlert de confirmación
//     Swal.fire({
//         title: "¿Estás seguro?",
//         text: "Esta acción actualizara su promocion",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#3085d6',
//         confirmButtonText: "Sí, eliminar",
//         cancelButtonText: "Cancelar",
//         allowOutsideClick: false
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Si el usuario confirma, muestra el SweetAlert bloqueado de carga
//             Swal.fire({
            
                
//                     position: "top-end",
//                     icon: "success",
//                     title: "Promocion Actualizada",
//                     showConfirmButton: false,
//                     timer: 1500
                  
//             }).
//             then(() => {
//                 // Redirige al index después de que termine el SweetAlert
//                 window.location.href = '/promotions'; // Cambia '/index' por la ruta correcta
//             });

//             // Envía el formulario
//             form.submit();

//             // Cierra el SweetAlert al completar la acción
//             $(document).ajaxComplete(function() { // Si usas AJAX o redirección
//                 Swal.close(); // Cierra el SweetAlert
//             });
//         }
//     });
// });

$(document).on('click', '.edit-promotions', function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto

    // Muestra el SweetAlert de confirmación
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción actualizará su promoción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: "Sí, actualizar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Muestra el SweetAlert de éxito
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Promoción actualizada",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Redirige al index después de que termine el SweetAlert
                window.location.href = '/promotions'; // Cambia '/index' por la ruta correcta
            });
        }
    });
});
