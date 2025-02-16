@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endsection



<style>
    /* INICIA ESTILOS PARA EL BOTON DE PUBLICADO */
    /* ////////////////////////////////////////////////////////////////////////////// */
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
        /* background-color: #ccc; */
        background-color: transparent;
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
        /* background-color: rgb(255, 255, 255); */
        background-color: #4a4f48;
        /*ICONO INTERIOR DE COLOR NEGRO*/
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.switch-toggle-slider {
        background-color: #2196F3;
    }

    input:checked+.switch-toggle-slider:before {
        transform: translateX(26px);
    }

    .switch-on,
    .switch-off {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        /* color: rgb(153, 34, 34);COLOR DE LETRA POR DENTRO */
        color: transparent;
        /*COLOR DE LETRA POR DENTRO*/
        font-weight: bold;
        transition: 0.4s;
    }

    .switch-on {
        left: 8px;
    }

    .switch-off {
        right: 8px;
    }

    input:checked+.switch-toggle-slider .switch-on {
        opacity: 1;
    }

    input:not(:checked)+.switch-toggle-slider .switch-off {
        opacity: 1;
    }

    input:checked+.switch-toggle-slider .switch-off {
        opacity: 0;
    }

   
</style>




@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">

            <!-- Mostrar mensaje de error si existe -->
            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                       

                        <h5 class="mb-0">Nuevo Cliente</h5>
                        <small class="text-muted float-end">Clientes</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.saveCustomer') }}" method="post">

                            @csrf


                            {{-- <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="business_name">Razón Social</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="business_name" name="business_name"
                                        placeholder="Ingresa el título de la promocions "
                                        value="{{ isset($clientCreate) ? $clientCreate->business_name : '' }}">
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="business_name">Razón Social</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="business_name" name="business_name"
                                        placeholder="Ingresa la Razón Social"
                                        value="{{ old('business_name', $clientCreate->business_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="trade_name">Nombre Comercial</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="trade_name" name="trade_name"
                                        placeholder="Ingresa el Nombre Comercial"
                                        value="{{ old('trade_name', $clientCreate->trade_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="rfc">RFC</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rfc" name="rfc"
                                        placeholder="Ingresa el RFC"
                                        value="{{ old('rfc', $clientCreate->rfc ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="address">Dirección</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="address" name="address" placeholder="Ingresa la Dirección">{{ old('address', $clientCreate->address ?? '') }}</textarea>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_first_name">Nombre del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_first_name" name="manager_first_name"
                                        placeholder="Nombre del Encargado"
                                        value="{{ old('manager_first_name', $clientCreate->manager_first_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_last_name">Apellido del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_last_name" name="manager_last_name"
                                        placeholder="Apellido del Encargado"
                                        value="{{ old('manager_last_name', $clientCreate->manager_last_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_email">Email del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="manager_email" name="manager_email"
                                        placeholder="Correo electrónico"
                                        value="{{ old('manager_email', $clientCreate->manager_email ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_phone">Teléfono del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_phone" name="manager_phone"
                                        placeholder="Teléfono del Encargado"
                                        value="{{ old('manager_phone', $clientCreate->manager_phone ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="company_phone">Teléfono de la Empresa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_phone" name="company_phone"
                                        placeholder="Teléfono de la Empresa"
                                        value="{{ old('company_phone', $clientCreate->company_phone ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="url">URL</label>
                                <div class="col-sm-10">
                                    {{-- <input type="url" class="form-control" id="url" name="url" --}}
                                    <input type="text" class="form-control" id="url" name="url"
                                        placeholder="Ingresa la URL del sitio web"
                                        value="{{ old('url', $clientCreate->url ?? '') }}">
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="password">Contraseña</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Crea Tu Contraseña"
                                        value="{{ old('password', $clientCreate->password ?? '') }}">
                                </div>
                            </div> --}}
                            






                          

                            



                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger me-3"
                                    onclick="window.location.href='{{ route('clients.index') }}'">
                                    Cancelar
                                </button>
                                    {{-- @if (isset($clientCreate))
                                        <button class="btn btn-success" type="submit">Editar Articulo</button>
                                    @else
                                        <button class="btn btn-success" type="submit">Agregar Articulo</button>
                                        @endif --}}
                                        <button class="btn btn-success" type="submit">Registrar Cliente</button>
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
