





// $(document).ready(function() {
//     $('#saveContent').on('click', function(event) {
//         event.preventDefault(); // Prevenir el comportamiento por defecto

//         // Deshabilitar botones
//         $('.btn-success, .btn-danger').prop('disabled', true);

//         // Muestra la alerta de carga
//         Swal.fire({
//             title: "Espere Un Momento!",
//             html: "Actualizando Su Contenido.",
//             didOpen: () => {
//                 Swal.showLoading();
//             }
//         });

//         // Obtener el formulario
//         const form = $(this).closest('form');
//         const actionUrl = form.attr('action'); // Asegúrate de que esta URL sea correcta
//         const formData = form.serialize(); // Serializar datos del formulario

//         // Enviar el formulario usando AJAX
//         $.ajax({
//             type: 'POST',
//             url: actionUrl,
//             data: formData,
//             success: function(response) {
//                 // Redirigir a la lista de categorías inmediatamente
//                 window.location.href = '/news'; // Cambia esta ruta si es necesario
//             },
//             error: function(xhr) {
//                 // Manejar errores
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Hubo un problema al actualizar su contenido.',
//                 });
//                 // Habilitar botones nuevamente
//                 $('.btn-success, .btn-danger').prop('disabled', false);
//             }
//         });
//     });
// });


