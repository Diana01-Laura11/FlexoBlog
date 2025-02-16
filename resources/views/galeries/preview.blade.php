@extends('layouts.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="modal fade show d-block" id="galeriesModal" tabindex="-1" aria-labelledby="galeriesModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vista Previa de la Galería</h5>
                </div>
                <div class="modal-body">

                    <!--  Título -->
                    <h2 class="text-primary">{{ $galleriesPreview->title }}</h2>

                    <hr>

                    <!-- Testimonios -->
                    @if (count($galleriesPreview->testimonials) > 0)
                        <h4>Testimonios:</h4>
                        @foreach ($galleriesPreview->testimonials as $testimonial)
                            <blockquote class="blockquote">
                                <p>{{ $testimonial['testimonio'] ?? 'Sin testimonio' }}</p>
                                <footer class="blockquote-footer">{{ $testimonial['name'] ?? 'Sin autor' }}</footer>
                            </blockquote>
                        @endforeach
                    @else
                        <p>No hay testimonios.</p>
                    @endif


                    <hr>

                    <!-- Imágenes -->
                    {{-- @if ($galleriesPreview->images->isNotEmpty())
                        <h4>Imágenes:</h4>
                        <div class="row">
                            @foreach ($galleriesPreview->images as $image)
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded shadow-sm">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No hay imágenes.</p>
                    @endif --}}

                    <hr>

                    <!-- OG Data -->
                    <h4>Open Graph Data (OG Data):</h4>
                    <ul>
                        <li><strong>Título OG:</strong> {{ isset($galleriesPreview->ogdata['title']) ? $galleriesPreview->ogdata['title'] : 'No definido' }}</li>
                        <li><strong>Descripción OG:</strong> {{ isset($galleriesPreview->ogdata['description']) ? $galleriesPreview->ogdata['description'] : 'No definido' }}</li>
                        {{-- <li><strong>Imagen OG:</strong> 
                            @if (!empty($galleriesPreview->ogdata['image']))
                                <img src="{{ asset('storage/' . $galleriesPreview->ogdata['image']) }}" class="img-thumbnail" width="150">
                            @else
                                No definido
                            @endif
                        </li> --}}
                    </ul>

                    <hr>

                    <!-- Microdata -->
                    <h4>Microdata:</h4>
                    {{-- <pre>{{ json_encode($galleriesPreview->microdata, JSON_PRETTY_PRINT) }}</pre> --}}
                    <ul>
                        <li><strong>Título:</strong> {{ isset($galleriesPreview->microdata['title']) ? $galleriesPreview->microdata['title'] : 'No definido' }}</li>
                        <li><strong>Descripción:</strong> {{ isset($galleriesPreview->microdata['description']) ? $galleriesPreview->microdata['description'] : 'No definido' }}</li>
                    </ul>                    
                    <hr>

                    <!-- Metadata -->
                    <h4>Metadata:</h4>
                    <ul>
                        <li><strong>Metakey:</strong> {{ isset($galleriesPreview->metadata['metakey']) ? $galleriesPreview->metadata['metakey'] : 'No definido' }}</li>
                        <li><strong>Descripción:</strong> {{ isset($galleriesPreview->metadata['descripcion']) ? $galleriesPreview->metadata['descripcion'] : 'No definido' }}</li>
                    </ul>

                    <hr>

                    <!--Formulario (Decodificado de JSON) -->
                    @if ($formContent)
                        <h4>Formulario:</h4>
                        @foreach ($formContent as $field)
                            <div class="mb-3">
                                <label class="fw-bold">{{ $field['label'] }}</label>
                                @switch($field['type'])
                                    @case('text')
                                        <input type="text" class="{{ $field['className'] ?? 'form-control' }}" value="{{ $field['value'] ?? '' }}" disabled>
                                    @break

                                    @case('textarea')
                                        <textarea class="{{ $field['className'] ?? 'form-control' }}" disabled>{{ $field['value'] ?? '' }}</textarea>
                                    @break

                                    @case('select')
                                        <select class="{{ $field['className'] ?? 'form-control' }}" disabled>
                                            @foreach ($field['values'] as $option)
                                                <option {{ $option['selected'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
                                            @endforeach
                                        </select>
                                    @break

                                    @case('checkbox-group')
                                        <div>
                                            @foreach ($field['values'] as $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" {{ $option['selected'] ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label">{{ $option['label'] }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @break

                                    @case('radio-group')
                                        <div>
                                            @foreach ($field['values'] as $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{ $field['name'] }}" {{ $option['selected'] ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label">{{ $option['label'] }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @break

                                    @default
                                        <p>Tipo de campo desconocido: {{ $field['type'] }}</p>
                                @endswitch
                            </div>
                        @endforeach
                    @else
                        <p>No hay formulario asociado.</p>
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-3" onclick="window.history.back();">Regresar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
