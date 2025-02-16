<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @yield('css')
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <style>
                    .switch {
                        position: relative;
                        display: inline-block;
                        width: 60px;
                        height: 34px;
                    }

                    .switch input {
                        opacity: 0;
                        width: 0;
                        height: 0;
                    }

                    .switch-toggle-slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #ccc;
                        transition: .4s;
                        border-radius: 34px;
                    }

                    .switch-toggle-slider:before {
                        position: absolute;
                        content: "";
                        height: 26px;
                        width: 26px;
                        left: 4px;
                        bottom: 4px;
                        background-color: white;
                        transition: .4s;
                        border-radius: 50%;
                    }

                    input:checked+.switch-toggle-slider {
                        background-color: #2196F3;
                    }

                    input:checked+.switch-toggle-slider:before {
                        transform: translateX(26px);
                    }

                    .switch-on {
                        display: none;
                    }

                    input:checked+.switch-toggle-slider .switch-on {
                        display: block;
                    }

                    input:checked+.switch-toggle-slider .switch-off {
                        display: none;
                    }

                    .form-control {
                        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                    }
                </style>

                @include('messageAlerts.messageAlerts')

                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($userEdit) ? 'Editar Rol De Usuario' : 'Nuevo Rol De Usuario' }}
                            </h5>
                            <small class="text-muted float-end">Usuarios</small>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($userEdit) ? route('users.updateUser', $userEdit->id) : '#' }}"
                                method="POST" id="contentForm" enctype="multipart/form-data">
                                @csrf
                                @if (isset($userEdit))
                                    @method('PUT')
                                @endif

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="name">Nombre De Usuario</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nombre del usuario"
                                            value="{{ isset($userEdit) ? $userEdit->name : '' }}">
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="email">Correo Asociado</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Correo Asociado"
                                            value="{{ isset($userEdit) ? $userEdit->email : '' }}">
                                    </div>
                                </div>

                                <!--roles rol Roles-->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id">Asignar Rol</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select name="role_id" id="role_id" class="form-control transparent-select"
                                                required>
                                                <option value="">-- Selecciona un rol --</option>
                                                @foreach ($rolesEdit as $roleSelect)
                                                    <option value="{{ $roleSelect->id }}"
                                                        {{ old('role_id', $userEdit->role_id) == $roleSelect->id ? 'selected' : '' }}>
                                                        {{ $roleSelect->name }} : {{ $roleSelect->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id">Asignar Responsable</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                           <div class="form-group">
                                        {{-- <select name="created_by" id="created_by" class="form-control transparent-select" required>
                                            <option value="">-- Selecciona un responsable --</option>
                                            @foreach ($assignAdministrator as $adminSelect)
                                                <option value="{{ $adminSelect->id }}">
                                                    {{ $adminSelect->name }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                        <select name="created_by" id="created_by" class="form-control transparent-select" required>
                                            <option value="">-- Selecciona un responsable --</option>
                                            @foreach ($assignAdministrator as $adminSelect)
                                                <option value="{{ $adminSelect->id }}" 
                                                    {{ old('created_by', $userEdit->created_by ?? '') == $adminSelect->id ? 'selected' : '' }}>
                                                    {{ $adminSelect->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <h3 class="custom-label ">" Asignar Responsable"</h3>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id">Asignar Rol</label>

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
                                </div> --}}
                                <br>

                                <hr>
                                {{-- <div class="mb-3">
                                    <label for="customer_id" class="form-label">Asignar Clientes</label>
                                    <div class="form-group">
                                        @foreach ($clientEdit as $clientSelect)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="customer_id[]" value="{{ $clientSelect->id }}" id="customer_{{ $clientSelect->id }}"
                                                @if(in_array($clientSelect->id, old('customer_id', $userEdit->customers->pluck('id')->toArray()))) checked @endif>
                                                <label class="form-check-label" for="customer_{{ $clientSelect->id }}">
                                                    {{ $clientSelect->manager_first_name }} : {{ $clientSelect->manager_last_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('customer_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}
                                <h3 class="custom-label ">Clientes Asociados</h3>

                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">¿ Actualizar Clientes ?</label>
                                    <div class="form-group">
                                        @foreach ($clientEdit as $client)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="customer_id[]" value="{{ $client->id }}" id="customer_{{ $client->id }}"
                                                @if(in_array($client->id, $userEdit->customers->pluck('id')->toArray())) checked @endif>
                                                <label class="form-check-label" for="customer_{{ $client->id }}">
                                                    {{ $client->manager_first_name }}  {{ $client->manager_last_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('customer_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <hr>
                                
                            <hr>

                                <style>
                                      .custom-label {
                                        font-family: Georgia, 'Times New Roman', Times, serif;                                    /* font-size: 16px; */
                                    /* Ajusta el tamaño de letra */
                                    color: rgb(233, 193, 215);
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



                                {{-- <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="password">Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="password" name="password"
                                            placeholder="Cambio De Contraseña"
                                            value="{{ isset($userEdit) ? $userEdit->password : '' }}" disabled>
                                    </div>
                                </div> --}}


{{-- 
                                <div class="mb-3">
                                    <label for="email" class="form-label">" Quien Crea Usuario " </label>
                                    <div class="form-group">
                                        <!-- Este bloque ya no es necesario -->
                                        <!-- 
                                        <select name="role_id" id="role_id" class="form-control transparent-select" required>
                                            <option value="">-- Selecciona un responsable --</option>
                                            @foreach ($userAuth as $userSelect)
                                                <option value="{{ $userSelect->id }}">
                                                    {{ $roleSelect->id }} {{ $roleSelect->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        -->
                                    </div>
                                </div> --}}


                              




                                <div class="row justify-content-center">
                                    <div class="col-sm-12 d-flex justify-content-center">
                                        {{-- <button type="button" class="btn btn-danger me-3"
                                            onclick="window.history.back();">Cancelar</button> --}}
                                        <!--En caso de que el usuario no quiera lo regrese al index-->

                                        <button type="button" class="btn btn-danger me-3"
                                            onclick="window.location.href='{{ route('users.index') }}'">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-success">Editar Usuario</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
                <script src="{{ asset('assets/js/sweetAlert/promocionesAlerts/editAlertPromotion.js') }}"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </div>
        </div>
    @endsection
</body>

</html>
