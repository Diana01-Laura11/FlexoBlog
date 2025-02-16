


{{-- MENSAJE DE ALERTA PARA ERRORES EN FORMULARIOS --}}
<style>
    /* Estilos para el fondo del modal */
    .modal-overlayForms {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* Modal de alerta */
    .alert-modalForm {
        background-color: #4eab18;
        color: white;
        padding: 40px; /* Aumenta el padding para mayor espacio */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease; /* Animación de desvanecimiento */
        width: 70%; /* Hacer el modal más ancho */
        max-width: 800px; /* Aumentar el máximo ancho */
        min-height: 300px; /* Definir una altura mínima */
    }

    /* Animación de desvanecimiento */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Animación de rebote */
    @keyframes bounce {
        0% {
            transform: scale(1) translateY(0);
        }
        25% {
            transform: scale(1.1) translateY(-10px);
        }
        50% {
            transform: scale(1) translateY(0);
        }
        75% {
            transform: scale(1.1) translateY(-5px);
        }
        100% {
            transform: scale(1) translateY(0);
        }
    }

    /* Clase para la animación de rebote */
    .animate {
        animation: fadeIn 0.5s ease, bounce 0.6s ease; /* Combina fadeIn y bounce */
    }

    .alert-modalForm ul {
        margin-top: 10px;
        list-style-type: none;
        padding-left: 0;
    }

    .alert-modalForm li {
        margin-bottom: 8px;
    }
</style>



@if ($errors->any() && session('error_form'))
    <div class="modal-overlayForms" id="modal-overlayForms">
        <div class="alert-modalForm" id="alert-modalForm">
            <h3>Error</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <div class="d-flex justify-content-end">
                <button class="alert btn btn-warning"
                        onclick="document.getElementById('modal-overlayForms').style.display='none'">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        // Asegurando que el modal se muestre
        document.getElementById("modal-overlayForms").style.display = "flex";

        // Reiniciar animación
        function resetAnimation() {
            var modal = document.getElementById("alert-modalForm");
            modal.classList.remove('animate');
            void modal.offsetWidth; // Forzar reflujo para reiniciar la animación
            modal.classList.add('animate'); // Volver a aplicar la clase de animación
        }

        // Ejecutar animación inmediatamente
        setTimeout(resetAnimation, 1);

        // Cerrar el modal después de 6 segundos
        setTimeout(() => { document.getElementById("modal-overlayForms").style.display = "none"; }, 20000);
    </script>
@endif

