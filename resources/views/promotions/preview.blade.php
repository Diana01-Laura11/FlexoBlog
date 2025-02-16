{{-- 
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
@endsection --}}







@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-body {
            padding: 20px;
            display: flex;
            flex-direction: row-reverse;
            gap: 20px;
            height: auto;
            /* Cambiado para que el modal se ajuste a su contenido */
            overflow-y: auto;
        }

        .info-section h5 {
            font-weight: bold;
            margin-top: 0;
            /* Elimina el margen superior del título */
            color: white;
            /* Color blanco para los títulos */
        }

        .info-section p {
            font-weight: bold;
            margin-top: 0;
            /* Elimina el margen superior del título */
            color: white;
            /* Color blanco para los párrafos */
        }

        .info-section p {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .content-section {
            padding: 15px;
            flex: 1;
            /* Ocupar el espacio restante */
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var promotionModal = new bootstrap.Modal(document.getElementById('promotionModal'));
            promotionModal.show();
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl"> <!-- Usar modal-xl para un ancho extra grande -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="promotionModalLabel">Contenido De Tu Noticia</h5>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            <!-- Mostrar el contenido del artículo con el marcador reemplazado -->
                            <div>{!! $promotionPreview->content !!}</div>

                            <hr>

                            <!-- Mostrar el contenido del formulario (decodificado de JSON) -->
                            @if ($formContent)
                                <div>
                                 

                                    @foreach ($formContent as $field)
                                        @switch($field['type'])
                                            @case('header')
                                                <h1>{{ $field['label'] }}</h1>
                                            @break

                                            @case('select')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <select class="{{ $field['className'] }}">
                                                        @foreach ($field['values'] as $option)
                                                            <option value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'selected' : '' }}>
                                                                {{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @break

                                            @case('number')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="number" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break
                                            @case('autocomplete')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="text" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}" list="{{ $field['name'] }}-list">
                                                    <datalist id="{{ $field['name'] }}-list">
                                                        @foreach ($field['values'] as $option)
                                                            <option value="{{ $option['value'] }}">
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            @break

                                            @case('text')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="text" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('textarea')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <textarea class="{{ $field['className'] }}" name="{{ $field['name'] }}"></textarea>
                                                </div>
                                            @break

                                            @case('date')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="date" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('radio-group')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="{{ $field['name'] }}" value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ $option['label'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('checkbox-group')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="{{ $field['name'] }}[]" value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ $option['label'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('file')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="file" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('hidden')
                                                <input type="hidden" class="{{ $field['className'] ?? '' }}"
                                                    name="{{ $field['name'] }}" value="{{ $field['value'] ?? '' }}">
                                            @break

                                            @case('paragraph')
                                                <div class="mb-3">
                                                    <p>{{ $field['label'] }}</p>
                                                </div>
                                            @break

                                            @case('button') 
                                                <div class="mb-3">
                                                    <button type="button" class="{{ $field['className'] ?? 'btn btn-primary' }}">
                                                        {{ $field['label'] }}
                                                    </button>
                                                </div>
                                            @break

                                            @default
                                                <p>Tipo de campo desconocido: {{ $field['type'] }}</p>
                                        @endswitch
                                    @endforeach

                                </div>
                            @else
                                <p>No hay contenido disponible para este formulario.</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-3" onclick="window.history.back();">Deseo
                            Regresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
