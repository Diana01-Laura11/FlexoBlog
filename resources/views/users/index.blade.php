@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="text-center styleTex">Usuarios Gestionados Por : {{ Auth::user()->name }}</h3>
        {{-- <h1 class="text-center styleTex">Permisos Y Roles De Usuario</h1> --}}

        <!-- DataTable with  -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <style>
                    .right-align {
                        text-align: right;
                    }

                    .d-flex.justify-content-end.mb-3 {
                        margin-top: 30px;
                        margin-right: 50px;
                        /* Ajusta este valor para moverlo más a la izquierda */
                    }

                    .d-flex.justify-content-end.mb-3 a.btn {
                        padding: 10px 20px 10px;
                        /* Ajusta el padding interno del botón si es necesario */
                    }

                    .styleTex {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    }

                    /*ESTILO DEL BOTON DE EDIT*/
                    .styleEdit {
                        background-color: rgb(255, 255, 255);
                        color: rgb(0, 0, 0);
                        border-block-color: rgb(0, 0, 0);
                    }

                    /* Mantener el color cuando pasas el cursor */
                    .styleEdit:hover {
                        background-color: rgb(255, 255, 255);
                        /* Un verde más oscuro para el hover */
                        color: rgb(0, 0, 0);
                        /* Mantener el color del texto */
                    }
                </style>
                <!-- Mostrar mensaje de error si existe -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('user.editUser', ['id' => $user->id]) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Asignar Permisos Y Roles</a>
                </div> --}}
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Crear Nuevo Usuario</a> 

                        <a href="{{ route('users.deleteRegister') }}" class="btn btn-danger ms-5">
                            <i class="fas fa-trash me-2"></i>
                            Usuarios Eliminados
                        </a>

                        <a href="{{ route('users.waitingUsers') }}" class="btn btn-secondary ms-5">
                            <i class="fas fa-clock me-2"></i>
                            Usuarios En Espera
                        </a>
                        {{-- <a href="{{ route('users.welcomeClient') }}" class="btn btn-secondary ms-5">
                            <i class="fas fa-clock me-2"></i>
                          bienvenido cliente
                        </a> --}}
                </div>
                @if (Session::has('mensaje'))
                    <div class="alert alert-info my-5">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif


                <table id="articles" class="table table-striped" style="width:100%">
        <h5 class="mb-0" style="color: rgb(110, 100, 100);">Roles Y Permisos</h5>
        {{-- <h5 class="mb-0" style="color: rgb(110, 100, 100);">Usuarios gestionados por : {{ Auth::user()->name }}"</h5> --}}

                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Editar Permisos</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td> <!-- ID de la promocion -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- Mostrar el nombre del rol que tiene ese usuaario y si no tiene rol entonces dira invitado --}}
                                <td>
                                    {{ $user->roles ? $user->roles->name : 'Invitado Sin Roles Ni Permisos' }}
                                </td>
                                
                                {{-- <td>{{ $user->roles->name }}</td> <!-- Acceder al nombre del rol --> --}}
                                {{-- <td>Rol : "{{ Auth::check() && Auth::user()->role ? Auth::user()->role->name : 'Invitado' }}"</td> --}}
                            

                                {{-- <td>
                                    <a href="{{ route('promotions.preview', $user->promotion_id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fa-regular fa-eye me-2"></i>
                                        Vista previa</a>

                                    <a href="{{ route('promotions.previewFinalWeb', ['promotion_id' => $user->promotion_id, 'alias' => $user->alias]) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        Ver en web</a>




                                </td> --}}


                                {{-- <td>
                                    @if ($user->status === 'Published')
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-2"></i> Si Publicado
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-sm"
                                            style="background-color: rgb(192, 15, 109); color: white;">
                                            <i class="fas fa-times me-2"></i> No Publicado
                                        </a>
                                    @endif
                                </td> --}}


                                {{-- <td>
                                    <a href="{{ route('promotions.editPromotion', $user->promotion_id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil me-2"></i> Editar Usuario
                                    </a>
                                </td> --}}
                                <td>
                                    <a href="{{ route('users.editUser', $user->id) }}" {{-- class="btn btn-sm btn-warning"> --}}
                                        class="btn btn-sm styleEdit">
                                        <i class="fa-solid fa-pencil me-2"></i> Asignar Permisos Y Roles
                                    </a>
                                </td>






                                {{-- <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-promotions">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td> --}}

                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                        method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <button type="submit" class="btn btn-sm btn-danger delete-promotions"> --}}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-x me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </td>

                            </tr>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No existen registros!</td>
                            </tr>
                        @endforelse
                    </tbody>

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
    <script src="assets/js/sweetAlert/promocionesAlerts/delete-promotionAlerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        });
    </script>
@endsection
