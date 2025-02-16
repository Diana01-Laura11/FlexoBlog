@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endsection

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



            <!-- Mostrar mensaje de error si existe, Importamos el modal quemostrara el mensje -->
            @include('messageAlerts.messageAlerts')


            <div class="col-xxl">
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ isset($customerEdit) ? 'Editar Cliente' : 'Nuevo Cliente' }}</h5>
                        <small class="text-muted float-end">Clientes</small>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($customerEdit) ? route('clients.update', $customerEdit->id) : '#' }}"
                            method="POST" id="contentForm" enctype="multipart/form-data">

                            @csrf
                            @if (isset($customerEdit))
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="business_name">Razón Social</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="business_name" name="business_name"
                                        placeholder="Ingresa la Razón Social"
                                        value="{{ old('business_name', $customerEdit->business_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="trade_name">Nombre Comercial</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="trade_name" name="trade_name"
                                        placeholder="Ingresa el Nombre Comercial"
                                        value="{{ old('trade_name', $customerEdit->trade_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="rfc">RFC</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rfc" name="rfc"
                                        placeholder="Ingresa el RFC"
                                        value="{{ old('rfc', $customerEdit->rfc ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="address">Dirección</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="address" name="address" placeholder="Ingresa la Dirección">{{ old('address', $customerEdit->address ?? '') }}</textarea>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_first_name">Nombre del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_first_name" name="manager_first_name"
                                        placeholder="Nombre del Encargado"
                                        value="{{ old('manager_first_name', $customerEdit->manager_first_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_last_name">Apellido del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_last_name" name="manager_last_name"
                                        placeholder="Apellido del Encargado"
                                        value="{{ old('manager_last_name', $customerEdit->manager_last_name ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_email">Email del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="manager_email" name="manager_email"
                                        placeholder="Correo electrónico"
                                        value="{{ old('manager_email', $customerEdit->manager_email ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manager_phone">Teléfono del Encargado</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="manager_phone" name="manager_phone"
                                        placeholder="Teléfono del Encargado"
                                        value="{{ old('manager_phone', $customerEdit->manager_phone ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="company_phone">Teléfono de la Empresa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_phone" name="company_phone"
                                        placeholder="Teléfono de la Empresa"
                                        value="{{ old('company_phone', $customerEdit->company_phone ?? '') }}">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="url">URL</label>
                                <div class="col-sm-10">
                                    {{-- <input type="url" class="form-control" id="url" name="url" --}}
                                    <input type="text" class="form-control" id="url" name="url"
                                        placeholder="Ingresa la URL del sitio web"
                                        value="{{ old('url', $customerEdit->url ?? '') }}">
                                </div>
                            </div>







                            <div class="row justify-content-center">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger me-3"
                                    onclick="window.location.href='{{ route('clients.index') }}'">Cancelar
                                    
                                    <button type="submit" class="btn btn-success">Editar Cliente</button>
                                </div>
                            </div>
                        </form>

                     

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
                        <script src="{{ asset('assets/js/sweetAlert/promocionesAlerts/editAlertPromotion.js') }}"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                       

                       
                    @endsection
