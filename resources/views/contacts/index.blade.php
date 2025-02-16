@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center">Listado de Contactosdds</h1>
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

        <div class="d-flex justify-content-end mb-3">
            <a href="" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Nuevo articulo</a>
        </div>
        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5">
                {{ Session::get('mensaje') }}
            </div>
        @endif


        <table id="articles" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Ver</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nueva tecnología en 2024</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-eye me-2"></i>
                            Ver en web</a>
                        <a href="#" class="btn btn-sm btn-info">
                            <i class="fa-regular fa-eye me-2"></i>
                            Vista previa</a>
                        <a href="#" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-file-signature me-2"></i>
                            Vista previa formulario</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-success">
                            <i class="fas fa-check me-2"></i>Publicado</a>
                    </td>
                    <td><a href="#" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil me-2"></i>
                        Editar</a></td>
                    <td><a href="#" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-x me-2"></i>
                        Eliminar</a></td>
                </tr>

                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Ver</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </tfoot>
        </table>
      </div>
    </div>
    <hr class="my-12" />

  </div>
  <!--/ Content -->

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<script>
    $(document).ready(function(){
        $('#articles').DataTable();
    });
</script>
@endsection
