



// $(document).ready(function() {
//     // Alerta para editar categoría
//     $('#editCategoryButton').on('click', function() {
//         Swal.fire({
//             title: "Espere Un Momento!",
//             html: "Actualizando <b></b> Datos.",
//             timer: 2000,
//             timerProgressBar: true,
//             didOpen: () => {
//                 Swal.showLoading();
//                 const timer = Swal.getPopup().querySelector("b");
//                 timerInterval = setInterval(() => {
//                     timer.textContent = `${Swal.getTimerLeft()}`;
//                 }, 100);
//             },
//             willClose: () => {
//                 clearInterval(timerInterval);
//             }
//         }).then((result) => {
//             // Este es el lugar correcto para enviar el formulario
//             if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
//                 // Envía el formulario
//                 $(this).closest('form').submit();
//             }
//         });
//     });
// });



//     // VERSIOIN 3 FUNCIONA
// $(document).ready(function() {
//     $('#editCategoryButton').on('click', function(event) {
//         event.preventDefault(); // Prevenir el comportamiento por defecto

//         // Deshabilitar botones
//         $('.btn-success, .btn-danger').prop('disabled', true);

//         // Muestra la alerta de carga
//         Swal.fire({
//             title: "Espere Un Momento!",
//             html: "Actualizando <b></b> Datos.",
//             timer: 2000,
//             timerProgressBar: true,
//             didOpen: () => {
//                 Swal.showLoading();
//                 const timer = Swal.getPopup().querySelector("b");
//                 timerInterval = setInterval(() => {
//                     timer.textContent = `${Swal.getTimerLeft()}`;
//                 }, 100);
//             },
//             willClose: () => {
//                 clearInterval(timerInterval);
//             }
//         }).then(() => {
//             // Obtener el formulario
//             const form = $(this).closest('form');
//             const actionUrl = form.attr('action'); // Asegúrate de que esta URL sea correcta
//             const formData = form.serialize(); // Serializar datos del formulario

//             // Enviar el formulario usando AJAX
//             $.ajax({
//                 type: 'POST',
//                 url: actionUrl,
//                 data: formData,
//                 success: function(response) {
//                     // Redirigir a la lista de categorías
//                     window.location.href = '/categories'; // Cambia esta ruta si es necesario
//                 },
//                 error: function(xhr) {
//                     // Manejar errores
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: 'Hubo un problema al actualizar la categoría.',
//                     });
//                     // Habilitar botones nuevamente
//                     $('.btn-success, .btn-danger').prop('disabled', false);
//                 }
//             });
//         });
//     });
// });



$(document).ready(function() {
    $('#editCategoryButton').on('click', function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto

        // Deshabilitar botones
        $('.btn-success, .btn-danger').prop('disabled', true);

        // Muestra la alerta de carga
        Swal.fire({
            title: "Espere Un Momento!",
            html: "Actualizando datos.",
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Obtener el formulario
        const form = $(this).closest('form');
        const actionUrl = form.attr('action'); // Asegúrate de que esta URL sea correcta
        const formData = form.serialize(); // Serializar datos del formulario

        // Enviar el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formData,
            success: function(response) {
                // Redirigir a la lista de categorías inmediatamente
                window.location.href = '/categories'; // Cambia esta ruta si es necesario
            },
            error: function(xhr) {
                // Manejar errores
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un problema al actualizar la categoría.',
                });
                // Habilitar botones nuevamente
                $('.btn-success, .btn-danger').prop('disabled', false);
            }
        });
    });
});
