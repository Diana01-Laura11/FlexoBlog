@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-6">
          <div class="card-header d-flex align-items-center justify-content-between">

            <h5 class="mb-0">Nueva Articulo</h5>

            <small class="text-muted float-end">Articulos</small>
          </div>
          <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nombre del articulo</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la articulo." />
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Alias</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control" name="alias"
                    id="basic-default-company"
                    placeholder="Ingresa un alias." />
                </div>
              </div>
              <!-- PASO 1: COPEA TODO EL FRACMENTO DE ROW -->
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen Principal</label>
                <div class="col-sm-10 ">
                  <input class="form-control mb-2 urlimagen" type="text" name="imagenPrincipal" id="imagenPrincipal" placeholder="/assets/imagenes-blog/..." >
                  <button class="btn btn-primary" name="openManager" id="BtnimagenPrincipal" type="button">Cargar imagen</button>
                            <!-- Abre el gestor de imagenes del servidor -->
                            <!-- PASO 1: LAS MODIFICACIONES QUE TIENES QUE HACER SON EN EL NAME Y ID DEL INPUT, ID DEL BOTON. ESTOS DEBEN DE SER IGUALES
                              SOLO CON LA DIFERENCIA DE AGREGAR 'Btn' ANTES EN EL ID DEL BOTON.
                              (***AL FINAL DE ESTE ARCHIVO ESTA EL SIGUIENTE PASO***)-->
                           
                </div>
              </div>
              <!-- HAS AQUI -->
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Categoria</label>
                <div class="col-sm-10">
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Selecciona una categoria</option>
                    <option value="1">Ejemplo</option>
                    </select>
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen Principal</label>
                <div class="col-sm-10 ">
                  <input class="form-control mb-2 urlimagen" type="text" name="imagenSecundario" id="imagenSecundario" placeholder="/assets/imagenes-blog/..." >
                  <button class="btn btn-primary" name="openManager" id="BtnimagenSecundario" type="button">Cargar imagen</button>
                            <!-- Abre el gestor de imagenes del servidor -->
                           
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Publicado</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" class="switch-input" id="status-switch" value="1" checked />
                        <span class="switch-toggle-slider">
                          <span class="switch-on">Sí</span>
                          <span class="switch-off">No</span>
                        </span>
                      </label>
                </div>
              </div>




              {{-- <h1>Aqui va CKEDITOR</h1>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Categoria</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control" name="alias"
                    id="basic-default-company"
                    placeholder="Ingresa un alias." />
                </div>
              </div> --}}

              {{-- Version 1 --}}
           {{-- En tu formulario --}}

           {{-- INTEGRACION DEL CKEDITOR --}}
           <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Articulo</label>
            <div class="col-sm-10">
              <textarea name="content-editor" id="content-editor" rows="10" class="form-control"></textarea>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Fecha de carga</label>

            <div class="col-sm-10">

                <div class="col-md-6 col-12 mb-6">
                    <input
                    type="date"
                    class="form-control"
                    placeholder="YYYY-MM-DD HH:MM"
                    id="flatpickr-datetime" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Fecha de  modificacion</label>

            <div class="col-sm-10">

                <div class="col-md-6 col-12 mb-6">
                    <input
                    type="date"
                    class="form-control"
                    placeholder="YYYY-MM-DD HH:MM"
                    id="flatpickr-datetime" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Fecha de publicacion</label>

            <div class="col-sm-10">

                <div class="col-md-6 col-12 mb-6">
                    <input
                    type="date"
                    class="form-control"
                    placeholder="YYYY-MM-DD HH:MM"
                    id="flatpickr-datetime" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Autor</label>
            <div class="col-sm-10">
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                <option selected>Selecciona un autor</option>
                <option value="1">Legal Digital</option>
                </select>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Meta descripcion</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control" name="alias"
                id="basic-default-company"
                placeholder="Meta descripcion." />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Palabras clave</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control" name="alias"
                id="basic-default-company"
                placeholder="Palabras clave." />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen Principal</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen Secundaria</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Imagen 3</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">DG Title</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control" name="alias"
                id="basic-default-company"
                placeholder="Meta descripcion." />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">DG descripcion</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control" name="alias"
                id="basic-default-company"
                placeholder="Meta descripcion." />
            </div>
          </div>


          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">DG Image</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">DG Video</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Banners</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01" />
                </div>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Link</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control" name="alias"
                id="basic-default-company"
                placeholder="Link." />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Selecciona un formulario</label>
            <div class="col-sm-10">
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                <option selected>Selecciona un formulario</option>
                <option value="1">Legal Digital</option>
                </select>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Ventana Nueva</label>
            <div class="col-sm-10">
                <label class="switch">
                    <input type="checkbox" name="status" class="switch-input" id="status-switch" value="1" checked />
                    <span class="switch-toggle-slider">
                      <span class="switch-on">Sí</span>
                      <span class="switch-off">No</span>
                    </span>
                  </label>
            </div>
          </div>


              <div class="row justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                  {{-- <button type="submit" class="btn btn-danger me-3">Cancelar</button> --}}
                  <button type="button" class="btn btn-danger me-3"
                  onclick="window.location.href='{{ route('articles.index') }}'">
                  Cancelar
              </button>
                  @if (isset($categories))
                  <button class="btn btn-success" type="submit">Editar categoria</button>
                @else
                  <button class="btn btn-success" type="submit">Agregar categoria</button>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Form with Tabs -->


  <!--/ Content -->
<!-- PASO 2: PEGAR AL FINAL EL INCLUDE DEL MODAL DEL GESTOR -->
@include('articles.AddImagen')
<!-- *************************** -->
@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
{{--CDN PARA CKeditor --}}
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script src="/assets/assets-editor/ckeditor.js"></script>

{{--JS del gestor de imagenes --}}
<!-- PASO 3: PEGAR EL SCRIPT DE MODAL -->
<script src="/assets/js/managerImagen.js"></script>
<!-- *************************** -->
<!-- PASO 4: ES CREAR UN BLADE LLAMADO AddImagen Y PEGAR EL CODIGO -->


<script>
    $(document).ready(function(){
        $('#articles').DataTable();
    });
</script>

<script>
    // Captura el cambio de estado en el interruptor
    document.getElementById('status-switch').addEventListener('change', function() {
      this.value = this.checked ? 1 : 0;
    });
  </script>


{{-- FUNCION PARA LLAMAR AL CKEDITOR --}}

  <script>
    $(document).ready(function() {
        CKEDITOR.replace('content-editor', {
        });
    });
</script>



@endsection
