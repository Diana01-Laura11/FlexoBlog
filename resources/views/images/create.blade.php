@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center">Agregar una imagen</h1>
    <!-- DataTable with  -->
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <style>
            .right-align {
                text-align: right;
            }

            .d-flex.justify-content-end.mb-3 {
                margin-top: 30px; /* Ya lo habíamos agregado */
                margin-right: 50px; /* Ajusta este valor para moverlo más a la izquierda */
            }

            .d-flex.justify-content-end.mb-3 a.btn {
                padding: 10px 20px 10px; /* Ajusta el padding interno del botón si es necesario */
            }
        </style>
        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5">
                {{ Session::get('mensaje') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger my-5">
                {{ Session::get('mensaje') }}
            </div>
        @endif

        <form action="{{ route('images.saveimagen') }}" method="post" class="p-2"  enctype="multipart/form-data">
          @csrf 
            <div class="mb-3">
                <label for="carpeta" class="form-label">Selecciona la carpeta donde deseas guardar la imagen</label>
                <br>
                <select class="form-select" name="carpeta" id="carpeta">
                    <option value="autores">autores</option>
                    <option value="banners">banners</option>
                    <option value="completas">completas</option>
                    <option value="galerias">galerias</option>
                    <option value="gifs">gifs</option>
                    <option value="guias">guias</option>
                    <option value="home">home</option>
                    <option value="mini">mini</option>
                    <option value="noticias">noticias</option>
                    <option value="noticiashome">noticiashome</option>
                    <option value="ogimagen">ogimagen</option>
                    <option value="post">post</option>
                    <option value="promociones">promociones</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Seleccione la imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen" accept=".jpg, .jpeg, .png, .webp, .gif">
            </div>
            <button type="submit" class="btn btn-primary">Subir Imagen</button>
        </form>
      </div>
    </div>
    <hr class="my-12" />

  </div>
  <!--/ Content -->

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
