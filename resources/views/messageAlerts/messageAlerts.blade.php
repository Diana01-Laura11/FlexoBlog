

{{-- MENSAJE PARA CASOS DE ERRORES --}}

<style>
    /* Estilos para el fondo del modal */
    .modal-overlay {
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
    .alert-modal {
        background-color: #f44336;
        color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease; /* Animación de desvanecimiento */
        width: 80%;
        max-width: 500px;
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

    .alert-modal ul {
        margin-top: 10px;
        list-style-type: none;
        padding-left: 0;
    }

    .alert-modal li {
        margin-bottom: 8px;
    }
</style>


@if ($errors->any())
    <div class="modal-overlay" id="modalOverlay">
        <div class="alert-modal" id="alertModal">
            
            <strong>¡Error! Tu problema se debe a:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <!-- Modal con botón a la derecha usando Flexbox -->
            <div class="d-flex justify-content-end">
                <button class="alert btn btn-warning"
                    onclick="document.getElementById('modalOverlay').style.display='none'">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        // Mostrar el modal
        document.getElementById("modalOverlay").style.display = "flex";

        // Función para reiniciar la animación
        function resetAnimation() {
            var modal = document.getElementById("alertModal");
            modal.classList.remove('animate'); // Eliminar la clase de animación
            void modal.offsetWidth; // Forzar reflujo para reiniciar la animación
            modal.classList.add('animate'); // Volver a aplicar la clase de animación
        }

        // Esperar 1 milisegundo antes de reiniciar la animación
        setTimeout(resetAnimation, 1);

        // Cerrar el modal después de 6 segundos
        setTimeout(() => {
            document.getElementById("modalOverlay").style.display = "none";
        }, 6000);
    </script>
@endif








