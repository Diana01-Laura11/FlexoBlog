@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: auto;
            overflow-y: auto;
        }

        .content-section {
            padding: 15px;
            flex: 1;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formsModal = new bootstrap.Modal(document.getElementById('formsModal'));
            formsModal.show();
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="formsModal" tabindex="-1" aria-labelledby="formsModalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formsModalLabel">Contenido del formulario</h5>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            @if (isset($formContent) && is_array($formContent))
                                <!-- Verifica que formContent es un array -->
                                @foreach ($formContent as $field)
                                    @if (isset($field['type']))
                                        <!-- <p>Campo de tipo: {{ $field['type'] }}</p> solo para ver Mensaje de depuración -->

                                        @switch($field['type'])
                                            @case('date')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <input type="date" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('number')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <input type="number" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('radio-group')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        @if (isset($option['value']) && isset($option['label']))
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field['name'] }}" value="{{ $option['value'] }}">
                                                                <label class="form-check-label">{{ $option['label'] }}</label>
                                                            </div>
                                                        @else
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field['name'] }}" value="">
                                                                <label class="form-check-label">Opción no válida</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('header')
                                                <div class="mb-3">
                                                    <h1>{{ $field['label'] }}</h1> <!-- Renderiza el encabezado -->
                                                </div>
                                            @break

                                            @case('autocomplete')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <input type="text" class="form-control" name="{{ $field['name'] }}"
                                                        autocomplete="on">
                                                </div>
                                            @break

                                            @case('checkbox-group')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        @if (isset($option['value']) && isset($option['label']))
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $field['name'] }}[]" value="{{ $option['value'] }}">
                                                                <label class="form-check-label">{{ $option['label'] }}</label>
                                                            </div>
                                                        @else
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $field['name'] }}[]" value="">
                                                                <label class="form-check-label">Opción no válida</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('file')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <input type="file" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('hidden')
                                                <!-- Agregar este caso para campos ocultos -->
                                                <input type="hidden" class="{{ $field['className'] ?? '' }}"
                                                    name="{{ $field['name'] }}" value="{{ $field['value'] ?? '' }}">
                                            @break

                                            @case('paragraph')
                                                <!-- Aquí se agrega el nuevo caso para el párrafo -->
                                                <div class="mb-3">
                                                    <p>{{ $field['label'] }}</p> <!-- Aquí lo mostramos como un párrafo -->
                                                </div>
                                            @break

                                            @case('select')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <select class="{{ $field['className'] }}" name="{{ $field['name'] }}">
                                                        @foreach ($field['values'] as $option)
                                                            @if (isset($option['value']) && isset($option['label']))
                                                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                                            @else
                                                                <option value="">Opción no válida</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @break

                                            @case('text')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <input type="text" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('textarea')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $field['label'] }}</label>
                                                    <textarea class="{{ $field['className'] }}" name="{{ $field['name'] }}"></textarea>
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
                                                <p>Tipo de campo no reconocido: {{ $field['type'] }}</p>
                                        @endswitch
                                    @else
                                        <p>Error: Campo sin tipo definido</p>
                                    @endif
                                @endforeach
                            @else
                                <p>No se pudo cargar el contenido del formulario o el formato es incorrecto.</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-3"
                            onclick="window.history.back();">Regresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection