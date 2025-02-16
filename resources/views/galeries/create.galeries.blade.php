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

            <h5 class="mb-0">Nueva Galeria</h5>

            <small class="text-muted float-end">Galeria</small>
          </div>
          <div class="card-body">
            <form action="{{ route('galeries.store') }}" method="post">
                @csrf
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nombre de la imagen</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Sub Titulo</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control" name="alias"
                    id="basic-default-company"
                    placeholder="Ingresa un alias." />
                </div>
              </div>

              {{-- INTEGRACION DEL CKEDITOR --}}
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Galeria</label>
                <div class="col-sm-10">
                  <textarea name="content-editor" id="content-editor" rows="10" class="form-control"></textarea>
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

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Testimonio titulo</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Testimonio nombre</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Testimonio puesto</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Herramienta</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>
              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Link herramienta</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="name_category" placeholder="Ingresa el nombre de la promocion." />
                </div>
              </div>

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Ventana nueva</label>
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

              <div class="row mb-6">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Fecha de fin de promocion</label>

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
                <label class="col-sm-2 col-form-label" for="basic-default-company">Fotos</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile01" />
                    </div>
                </div>
              </div>




              <div class="row justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                  <button type="submit" class="btn btn-danger me-3">Cancelar</button>

                  <button class="btn btn-success" type="submit">Agregar promocion</button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Form with Tabs -->


  <!--/ Content -->

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
{{--CDN PARA CKeditor --}}
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script src="/assets/assets-editor/ckeditor.js"></script>

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
