{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}



<!--version2 funcional-->
{{-- 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /*Fondo morado*/
            /* background-color: #25293C; */
            /* background-image: linear-gradient(to bottom left, #e0c3fc, #9e4fe2, #4f6cb4); */
            /* background-image: linear-gradient(to bottom left, #e0c3fc, #9e4fe2, #4f6cb4); */
            background-image: linear-gradient(to top, #2d3748, #2b6cb0, #1a202c);
            /* background-image: linear-gradient(to bottom left, #e0c3fc, #9e4fe2, #4f6cb4); */
            color: white;
            /* Texto blanco */
        }

        .card {
            background: rgba(255, 255, 255, 0.922);
            /* background: #1D2C41;  */
            /* background: #25293c5f;  */
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            color: #000000;
            /* color: #ffffff; */
        }
        .text-darkH{
            /* color: rgb(255, 255, 255); */
            color: rgb(0, 0, 0);
        }
    </style>
</head>

<body class="d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-6">
                        {{-- <a href="index.html" class="app-brand-link">
                  <span class="app-brand-text demo text-heading fw-bold">Flex Blaaog</span>
                </a>
                    </div>
                    <h2 class="text-center mb-4 text-darkH">¡Registro En Flexo Blog!</h2>
                    <p class="mb-6 text-center text-darkH">Por Favor Inicia Tu Registro</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name --
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" name="name" class="form-control"
                                value="{{ old('name') }}" required autofocus autocomplete="name">
                            <div class="text-danger mt-1">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- Email Address --
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" name="email" class="form-control"
                                value="{{ old('email') }}" required autocomplete="username">
                            <div class="text-danger mt-1">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- Password --
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" name="password" class="form-control" required
                                autocomplete="new-password">
                            <div class="text-danger mt-1">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password --
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" required autocomplete="new-password">
                            <div class="text-danger mt-1">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-primary">¿Ya tienes
                                cuenta? Inicia Sesion</a>
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}













<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Raleway, sans-serif;
    }

    body {
        /* background: linear-gradient(90deg, #C7C5F4, #776BCC); */
        background: linear-gradient(to right, #e9d5ff, #a78bfa, #4f46e5);

    }

    /*Estolo para el boton de ya tines una cuenta que redirecciona al login*/
    .textLogin {
        font-family: 'Raleway', sans-serif;
        /* Usa la fuente del diseño original */
        margin-top: 20%;
        font-size: 1em;
        color: #5D54A4 !important;
        padding: 8px 16px;
        border-radius: 20px;
        transition: all 0.3s ease;
        background: rgb(255, 251, 251);
        /* Fondo semi-transparente */
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .textLogin:hover {
        background: rgba(202, 192, 223, 0.925);
        box-shadow: 0px 2px 8px rgba(92, 86, 150, 0.3);
        transform: translateY(-1px);
    }



    
    .card {
        background: linear-gradient(90deg, #5D54A4, #7C78B8);
        border: none;
        border-radius: 20px;
        box-shadow: 0px 0px 24px #d9d9e0;
        overflow: hidden;
        position: relative;
    }

    .screen__background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-clip-path: inset(0 0 0 0);
        clip-path: inset(0 0 0 0);
    }

    .screen__background__shape {
        transform: rotate(45deg);
        position: absolute;
    }

    .screen__background__shape1 {
        height: 520px;
        width: 520px;
        background: #FFF;
        top: -50px;
        right: 120px;
        border-radius: 0 72px 0 0;
    }

    .screen__background__shape2 {
        height: 220px;
        width: 220px;
        background: #6C63AC;
        top: -172px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape3 {
        height: 540px;
        width: 190px;
        background: linear-gradient(270deg, #5D54A4, #6A679E);
        top: -24px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape4 {
        height: 400px;
        width: 200px;
        background: #7E7BB9;
        top: 420px;
        right: 50px;
        border-radius: 60px;
    }

    .card-body {
        z-index: 1;
        position: relative;
    }

    .input-group-text {
        background: none;
        border: none;
        color: #7875B5;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #D1D1D4;
        background: none;
        padding: 10px;
        font-weight: 700;
        width: 100%;
        transition: .2s;
    }

    .form-control:focus {
        outline: none;
        border-bottom-color: #6A679E;
    }

    .btn-primary {
        background: #fff;
        color: #4C489D;
        border: 1px solid #D4D3E8;
        font-weight: 700;
        box-shadow: 0px 2px 2px #5C5696;
        transition: .2s;
    }

    .btn-primary:hover {
        border-color: #6A679E;
    }

    .button__icon {
        font-size: 18px;
        margin-left: 10px;
    }
</style>

</head>


<body class="d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card position-relative">
                    <!-- Fondos decorativos -->
                    <div class="screen__background">
                        <span class="screen__background__shape screen__background__shape4"></span>
                        <span class="screen__background__shape screen__background__shape3"></span>
                        <span class="screen__background__shape screen__background__shape2"></span>
                        <span class="screen__background__shape screen__background__shape1"></span>
                    </div>

                    <!-- Contenido del formulario -->
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 text-darkH">¡Registro En Flexo Blog!</h2>
                        <p class="mb-4 text-center text-darkH">Por Favor Inicia Tu Registro</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input id="name" type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" required autofocus autocomplete="name">
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

                            <!-- Botón de registro y enlace de inicio de sesión -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}" class="text-decoration-none textLogin">Inicia Sesión</a>
                                {{-- <a href="{{ route('login') }}" class="text-decoration-none text-primary">¿Ya tienes
                                    cuenta? Inicia Sesión</a> --}}
                                <button type="submit" class="btn btn-primary">
                                    <span class="button__text">Registrarse</span>
                                    <i class="button__icon fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
{{-- 
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Raleway, sans-serif;
    }

    body {
        /* background: linear-gradient(90deg, #C7C5F4, #776BCC); */
        background: linear-gradient(to right, #e9d5ff, #a78bfa, #4f46e5);

    }

    /*Estolo para el boton de ya tines una cuenta que redirecciona al login*/
    .textLogin {
        font-family: 'Raleway', sans-serif;
        /* Usa la fuente del diseño original */
        margin-top: 20%;
        font-size: 1em;
        color: #5D54A4 !important;
        padding: 8px 16px;
        border-radius: 20px;
        transition: all 0.3s ease;
        background: rgb(255, 251, 251);
        /* Fondo semi-transparente */
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .textLogin:hover {
        background: rgba(202, 192, 223, 0.925);
        box-shadow: 0px 2px 8px rgba(92, 86, 150, 0.3);
        transform: translateY(-1px);
    }



    
    .card {
        background: linear-gradient(90deg, #5D54A4, #7C78B8);
        border: none;
        border-radius: 20px;
        box-shadow: 0px 0px 24px #d9d9e0;
        overflow: hidden;
        position: relative;
    }

    .screen__background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-clip-path: inset(0 0 0 0);
        clip-path: inset(0 0 0 0);
    }

    .screen__background__shape {
        transform: rotate(45deg);
        position: absolute;
    }

    .screen__background__shape1 {
        height: 520px;
        width: 520px;
        background: #FFF;
        top: -50px;
        right: 120px;
        border-radius: 0 72px 0 0;
    }

    .screen__background__shape2 {
        height: 220px;
        width: 220px;
        background: #6C63AC;
        top: -172px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape3 {
        height: 540px;
        width: 190px;
        background: linear-gradient(270deg, #5D54A4, #6A679E);
        top: -24px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape4 {
        height: 400px;
        width: 200px;
        background: #7E7BB9;
        top: 420px;
        right: 50px;
        border-radius: 60px;
    }

    .card-body {
        z-index: 1;
        position: relative;
    }

    .input-group-text {
        background: none;
        border: none;
        color: #7875B5;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #D1D1D4;
        background: none;
        padding: 10px;
        font-weight: 700;
        width: 100%;
        transition: .2s;
    }

    .form-control:focus {
        outline: none;
        border-bottom-color: #6A679E;
    }

    .btn-primary {
        background: #fff;
        color: #4C489D;
        border: 1px solid #D4D3E8;
        font-weight: 700;
        box-shadow: 0px 2px 2px #5C5696;
        transition: .2s;
    }

    .btn-primary:hover {
        border-color: #6A679E;
    }

    .button__icon {
        font-size: 18px;
        margin-left: 10px;
    }
</style> --}}
