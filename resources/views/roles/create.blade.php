@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <!-- Incluir Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <style>
                #style-title {
                    /* color: #FFD700;*/
                    color: #ffffffd2;
                    Color font-size: 2em;
                    /* Tamaño de fuente más grande */
                    font-weight: bold;
                    /* Negrita */
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    animation-duration: 15s;
                    /* Duración extendida de la animación */
                    text-align: center;
                }

                .container {
                    /* background: white; */
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                label {
                    font-weight: bold;
                    display: block;
                    margin-bottom: 5px;
                }

                select {
                    width: 100%;
                    padding: 8px;
                    /* border: 1px solid #ccc; */
                    border: #25293C;
                    ;
                    border-radius: 5px;
                    color: rgb(252, 252, 252);
                    /* background-color: white; */
                    background-color: #25293C;
                    cursor: pointer;
                }
            </style>



            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h5 class="mb-0">Nuevo Rol</h5>

                        <small class="text-muted float-end">Roles</small>
                    </div>


                    <div class="card-body">
                        {{-- <form action="{{ route('categories.store') }}" method="post"> --}}
                        <form action="{{ route('roles.saveRol') }}" method="post">

                            @csrf
                            @if (isset($rolCreate))
                                @method('PUT')
                            @endif

                            <hr>
                            <br>


                            <h2 id="style-title" class="animate__animated animate__bounceIn">Asignar Permiso a Rol</h2>

                            <div class="container">
                                <label for="role">Selecciona un rol:</label>
                                <select name="name" id="role">
                                    <option value="admin">Administrador</option>
                                    <option value="editor">Editor</option>
                                    <option value="sales">Ventas</option>
                                    <option value="user">Usuario</option>
                                </select>

                                <label for="permission">Selecciona un permiso:</label>
                                <select name="description" id="permission">
                                    <option value="Acceso completo al sistema. Gestiona usuarios, roles, permisos y todo el contenido.">Administrador (admin) - Acceso completo al sistema. Gestiona
                                        usuarios, roles, permisos y todo el contenido. </option>
                                    {{-- <option value="admin">Administrador (admin) - Acceso completo al sistema. Gestiona
                                        usuarios, roles, permisos y todo el contenido. </option> --}}
                                    {{-- <option value="editor"> Editor (editor) - Puede crear, editar y publicar contenido
                                        (artículos, noticias, galerías, descargables). No gestiona usuarios ni roles.
                                    </option> --}}
                                    <option value="Puede crear, editar y publicar contenido (artículos, noticias, autores, formularios, imagenes, categorias, promociones, galerías, descargables). No gestiona usuarios ni roles."> Editor (editor) - Puede crear, editar y publicar contenido (artículos, noticias, autores, formularios, imagenes, categorias, promociones, galerías, descargables). No gestiona usuarios ni roles.
                                    </option>
                                    {{-- <option value="sales">Ventas (sales) - Gestiona promociones y ve contactos. No gestiona
                                        contenido de blog ni usuarios.</option> --}}
                                    <option value="Ventas (sales) - Gestiona promociones y  contactos(clientes). No gestiona contenido de blog ni usuarios.">Ventas (sales) - Gestiona promociones y ve contactos(clientes). No gestiona contenido de blog ni usuarios.</option>
                                    {{-- <option value="user">Usuario (user) - Rol básico. Puede ver contenido público y enviar
                                        formularios.</option> --}}
                                    <option value="Rol básico. Puede ver contenido público y enviar formularios.">Usuario (user) - Rol básico. Puede ver contenido público y enviar
                                        formularios.</option>
                                </select>
                                {{-- /*Usuario (user) - Rol básico. Puede ver contenido público y enviar formularios.*/ --}}
                                {{-- /*Ventas (sales) - Gestiona promociones y ve contactos. No gestiona contenido de blog ni usuarios.*/ --}}

                                {{-- /* Editor (editor) - Puede crear, editar y publicar contenido (artículos, noticias, galerías, descargables). No gestiona usuarios ni roles.*/ --}}
                                {{-- /*Administrador (admin) - Acceso completo al sistema. Gestiona usuarios, roles, permisos y todo el contenido. */ --}}


                            </div>
                            <br>
                            <hr>
                            <br>
                            <br>
                            <br>

                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                        <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('roles.index') }}'">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-success" type="submit">Agregar Rol</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    @endsection
