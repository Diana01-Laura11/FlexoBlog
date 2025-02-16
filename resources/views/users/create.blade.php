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
                /* estilo de boton del modal de imagenes */
                /* Ajustes para los botones en el modal */
                .modal-body {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                    /* Ajusta el valor según lo que necesites */
                }

                .modal-footer {
                    display: flex;
                    justify-content: flex-end;
                    /* Alinea el botón de cerrar a la derecha */
                }

                .selectImage,
                .submitImage {
                    width: auto;
                    /* Ajusta el tamaño de los botones */
                }

                .form-control {
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                }
            </style>



            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h5 class="mb-0">Registro Nuevo Usuario</h5>

                        <small class="text-muted float-end">Usuario Registro</small>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('users.saveUser') }}" method="post">

                            @csrf
                            @if (isset($users))
                                @method('PUT')
                            @endif





                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre De Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input id="name" type="text" name="name" class="form-control"
                                        placeholder="Ingresa Nombre Y Apellidos" required autofocus autocomplete="name">
                                </div>
                                <div class="text-danger mt-1">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input id="email" type="email" name="email" class="form-control"
                                        value="{{ old('email') }}" required autocomplete="username">
                                </div>
                                <div class="text-danger mt-1">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <!-- Asignar Rol rol role -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Asignar Rol</label>
                                {{-- <div class="col-sm-10"> --}}
                                <div class="form-group">
                                    <select name="role_id" id="role_id" class="form-control transparent-select" required>
                                        <option value="">-- Selecciona un rol --</option>
                                        @foreach ($rolesAdd as $roleSelect)
                                            <option value="{{ $roleSelect->id }}">
                                                {{ $roleSelect->name }} : {{ $roleSelect->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- </div> --}}
                            </div>
                            {{-- <!-- Asignar cliente Clientes client-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Asignar Cliente</label>
                                <div class="form-group">
                                    <select name="customer_id" id="customer_id" class="form-control transparent-select" required>
                                        <option value="">-- Selecciona un cliente existente --</option>
                                        @foreach ($clientsAdd as $clientSelect)
                                            <option value="{{ $clientSelect->id }}">
                                                {{ $clientSelect->manager_first_name }} : {{ $clientSelect->manager_last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> --}}

                            <hr>
                            <h3 class="custom-label ">" Asignar Clientes "</h3>
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Clientes Activos</label>
                                <div class="form-group">
                                    @foreach ($clientsAdd as $clientSelect)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="customer_id[]"
                                                value="{{ $clientSelect->id }}" id="customer_{{ $clientSelect->id }}">
                                            <label class="form-check-label" for="customer_{{ $clientSelect->id }}">
                                                {{ $clientSelect->manager_first_name }} 
                                                {{ $clientSelect->manager_last_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('customer_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <!-- asignar usuario creado-->
                            {{-- <hr>
                            <h3 class="custom-label ">" Quien Crea Usuario "</h3>
                            <div class="mb-3">
                                <label for="id" class="form-label">administradores Activos</label>
                                <div class="form-group">
                                    @foreach ($createUsr as $userSelect)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="id"
                                                value="{{ $userSelect->id }}" id="customer_{{ $userSelect->id }}">
                                            <label class="form-check-label" for="customer_{{ $userSelect->id }}">
                                                {{ $userSelect->name }} 
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <hr> --}}


                            <h3 class="custom-label ">" Asignar Responsable"</h3>

                            <div class="mb-3">
                                <label for="email" class="form-label">Quien Crea Usuario</label>
                                <div class="form-group">
                                    <select name="created_by" id="created_by" class="form-control transparent-select" required>
                                        <option value="">-- Selecciona un responsable --</option>
                                        @foreach ($assignAdministrator as $adminSelect)
                                            <option value="{{ $adminSelect->id }}">
                                                {{ $adminSelect->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            



                            <br>

                            <style>
                                .custom-label {
                                    font-family: Georgia, 'Times New Roman', Times, serif;
                                    /* font-size: 16px; */
                                    /* Ajusta el tamaño de letra */
                                    color: rgb(237, 231, 234);
                                }

                                .transparent-select {
                                    background-color: #25293C;
                                    color: #fff;
                                    border: 1px solid #555;
                                }

                                .transparent-select option {
                                    background-color: #25293C;
                                    color: #fff;
                                }
                            </style>






                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" type="password" name="password" class="form-control" required
                                        autocomplete="new-password">
                                </div>
                                <div class="text-danger mt-1">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        class="form-control" required autocomplete="new-password">
                                </div>
                                <div class="text-danger mt-1">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>




                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    {{-- <button type="button" class="btn btn-danger me-3"
                                        onclick="window.history.back();">Cancelar</button> --}}
                                    <!--En caso de que el usuario no quiera lo regrese al index-->
                                    <button type="button" class="btn btn-danger me-3"
                                        onclick="window.location.href='{{ route('users.index') }}'">
                                        Cancelar
                                    </button>


                                    <button class="btn btn-success" type="submit">Registrar Usuario</button>

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
