@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center">Listado de Categorias</h1>
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
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Nueva Categoria
            </a>

            <a href="{{ route('categories.deleteRegister') }}" class="btn btn-danger ms-5">
                <i class="fas fa-trash me-2"></i>
                Categorias Eliminadas
            </a>
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
                    <th>Nombre Categoria</th>
                    <th>Alias</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($new_category as $detail)
                    <tr>
                        <th>{{ $detail->id }}</th> <!-- Asegúrate de que esto exista en tu tabla -->
                        <td>{{ $detail->name_category }}</td>
                        <td>{{ $detail->alias }}</td>
                        <td>{{ $detail->status ? 'Activo' : 'Inactivo' }}</td>  {{-- MUESTRA ACTIVO O INACTIVO EN VES DE QUE NOS MUESTRE 1 O 0 BO0LEANO --}}

                        <td>
                            <a href="{{ route('categories.edit', $detail->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pencil me-2"></i>
                                Editar
                            </a>
                        </td>

                        {{-- <td>
                        <form action="{{ route('categories.destroy', $detail->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?');">
                                <i class="fa-solid fa-x me-2"></i>
                                Eliminar
                            </button>
                        </form> 
                        </td> --}}
                        <td>
                            <form action="{{ route('categories.destroy', $detail->id) }}" method="POST" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-category">
                                    <i class="fa-solid fa-x me-2"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No existen registros!</td>
                    </tr>
                @endforelse
            </tbody>

            {{-- <tfoot>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Ver</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </tfoot> --}}
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
{{-- IMPORTACION DEL SWEET ALERT --}}
<script src="assets/js/sweetAlert/delete-alerts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<script>
    $(document).ready(function(){
        $('#articles').DataTable();
    });
</script>
@endsection
