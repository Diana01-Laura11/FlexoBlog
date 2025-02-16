
@extends('layouts.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    .modal-body {
        padding: 20px;
        display: flex;
        flex-direction: row-reverse;
        gap: 20px;
        height: auto; /* Cambiado para que el modal se ajuste a su contenido */
        overflow-y: auto;
    }
    .info-section h5 {
        font-weight: bold;
        margin-top: 0; /* Elimina el margen superior del título */
        color: white; /* Color blanco para los títulos */
    }
    .info-section p {
        font-weight: bold;
        margin-top: 0; /* Elimina el margen superior del título */
        color: white; /* Color blanco para los parrafos */
    }
    .info-section p {
        margin-bottom: 10px;
        font-size: 1rem;
    }
    .content-section {
        padding: 15px;
        flex: 1; /* Ocupar el espacio restante */
    }
</style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var promotionModal = new bootstrap.Modal(document.getElementById('promotionModal'));
        promotionModal.show();
    });
</script>
@endsection

@section('content')
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl"> <!-- Usar modal-xl para un ancho extra grande -->
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h5 class="modal-title" id="promotionModalLabel" >Contenido de la promoción</h5>
                </div>
                <div class="modal-body">
                    <div class="content-section">
                     
                        <div>{!! $promotionsPreview->content !!}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-3" onclick="window.history.back();">Deseo Regresar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
