{{-- 
ORIGINAL
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="container">
        <div class="d-grid px-2 pt-2 pb-1">
            <!-- Botón de Logout -->
            <a class="btn btn-sm btn-danger d-flex align-items-center justify-content-between"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt styleBotonIcon"></i>
                <span class="styleBoton"></span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <h1 class="styleTitle">
            Clientes Asignados A {{ auth()->check() ? auth()->user()->name : 'Sin cliente aún' }}
        </h1>
        <br><br><br>

        <div class="row justify-content-center">
            @forelse ($clients as $client)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-border-top"></div>
                        <div class="img"></div>
                        <span>{{ $client->business_name }}</span>
                        <span>{{ $client->trade_name }}</span>
                        <p class="job">Nombre De Encargado:</p>
                        <p class="job">{{ $client->manager_first_name }} {{ $client->manager_last_name }}</p>
                        <button onclick="window.location.href='{{ route('dashboard') }}'">Seleccionar</button>
                    </div>
                </div>
            @empty
                <p class="text-center">No tienes clientes asignados.</p>
            @endforelse
        </div>
    </div>
</body>

<style>
    .styleBotonIcon{
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        /* Blanco */
        font-size: 1.2rem;
        /* Ajusta el tamaño */
        padding: 10px 20px;
        /* Añade espacio dentro del botón */
        border-radius: 5px;
        /* Bordes redondeados */
        text-align: center;
        /* Alinea el texto */
        display: inline-block;
        /* Asegura que el botón ocupe solo el espacio necesario */
    }
    .styleBoton {
        
        background-color:transparent;
        color: rgb(0, 0, 0);
        /* Blanco */
        font-size: 1.0rem;
        /* Ajusta el tamaño */
        padding: 10px 20px;
        /* Añade espacio dentro del botón */
        border-radius: 5px;
        /* Bordes redondeados */
        text-align: center;
        /* Alinea el texto */
        display: inline-block;
        /* Asegura que el botón ocupe solo el espacio necesario */
    }

    .d-grid {
        display: flex;
        justify-content: flex-end;
        /* Alinea el botón al final (derecha) */
    }

    .styleTitle {
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: whitesmoke;
        text-align: center;
    }

    /* Fuente moderna */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #1D2A3D;
    }

    .container {
        padding: 50px 0;
    }

    /* Fila centrada con flexbox */
    .row {
        display: flex;
        justify-content: center;
        /* Centra las tarjetas */
        flex-wrap: wrap;
        /* Permite que las tarjetas se ajusten en múltiples líneas si es necesario */
        gap: 20px;
        /* Espaciado entre tarjetas */
    }

    .col-md-4 {
        flex: 0 0 auto;
        /* Las tarjetas no se estiran */
        margin-bottom: 20px;
        /* Espaciado vertical entre las tarjetas */
    }

    .card {
        width: 250px;
        height: 320px;
        background: #f0ecf3;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
        overflow: hidden;
        position: relative;
        padding: 20px;
        color: rgb(0, 0, 0);
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card-border-top {
        width: 60%;
        height: 4px;
        background: #6b64f3;
        margin: 0 auto;
        border-radius: 2px;
        margin-bottom: 20px;
    }

    .card span {
        font-weight: 600;
        color: rgb(0, 0, 0);
        text-align: center;
        display: block;
        padding-top: 10px;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .card .job {
        font-weight: 400;
        color: rgb(0, 0, 0);
        display: block;
        text-align: center;
        padding-top: 5px;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .card .img {
        width: 80px;
        height: 80px;
        background: #6b64f3;
        border-radius: 50%;
        margin: auto;
        margin-top: 25px;
    }

    .card button {
        padding: 12px 35px;
        display: block;
        margin: auto;
        border-radius: 8px;
        border: none;
        margin-top: 20px;
        background: #6b64f3;
        color: rgb(0, 0, 0);
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .card button:hover {
        background: #534bf3;
    }

    /* Agregar estilo a las alertas vacías */
    .text-center {
        font-size: 18px;
        font-weight: bold;
        color: #555;
    }
</style>
 --}}


<!--DEPURADOR PARA VER QUE CLIENTES LE LLEGAN-->
{{-- <pre>{{ print_r($clients->toArray(), true) }}</pre> --}}




<!-- ESTILOS DE  Animación con tailwind css en las tarjetas: Se levantan, giran ligeramente y aumentan su tamaño al hacer hover.
🚀 Glow dinámico: Añadí un efecto de neón en los bordes del botón de cerrar sesión.
💎 Efecto de sombra elegante: MODO premium.
🎭 Animación en el nombre del usuario: animate-pulse para un efecto sutil.
🎯 Hover en los botones: Resaltan con brillo y sombra azulada.-->
   
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Asignados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: white;
            font-family: 'Orbitron', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .glass:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.6);
        }
        .neon-text {
            text-shadow: 0 0 10px #ff0099, 0 0 20px #ff0099, 0 0 30px #ff0099;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-5 relative overflow-hidden">
    
    <!-- Efectos de neón en el fondo -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 bg-pink-500 opacity-30 blur-3xl rounded-full top-10 left-20 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-blue-500 opacity-30 blur-3xl rounded-full bottom-10 right-20 animate-pulse"></div>
    </div>

    <!-- Botón de Logout Cyberpunk -->
    <div class="w-full flex justify-end p-4">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold shadow-lg
                   hover:shadow-pink-500/50 transition-all duration-300 transform hover:-translate-y-1 active:scale-95
                   border-2 border-transparent hover:border-pink-400">
            <i class="fas fa-power-off text-xl"></i> Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
    
    <!-- Título Cyberpunk -->
    <h1 class="text-4xl font-bold mb-8 text-center neon-text uppercase tracking-wider animate__animated animate__fadeIn">
        Clientes Asignados A <span class="text-neon-blue">{{ auth()->check() ? auth()->user()->name : 'Sin cliente aún' }}</span>
    </h1>

    <!-- Contenedor de Tarjetas Estilo Glassmorphism -->
    <div class="max-w-6xl w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center">
            @forelse ($clients as $client)
                <div class="glass rounded-lg p-6 text-center w-72 relative border border-gray-500 transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <div class="absolute top-2 right-2 text-sm text-gray-400">#{{ $client->id }}</div>
                    <div class="w-12 h-1 bg-neon-blue rounded mx-auto mb-4"></div>
                    <div class="w-20 h-20 flex items-center justify-center text-3xl font-bold text-white bg-neon-pink rounded-full mx-auto shadow-lg">
                        {{ strtoupper(substr($client->business_name, 0, 1)) }}
                    </div>
                    <h2 class="text-lg font-semibold mt-4 text-neon-yellow">{{ $client->business_name }}</h2>
                    <p class="text-sm text-gray-300 mt-2"><strong>Nombre De Encargado:</strong></p>
                    <p class="text-gray-200">{{ $client->manager_first_name }} {{ $client->manager_last_name }}</p>
                    <button onclick="window.location.href='{{ route('dashboard') }}'"
                        class="mt-4 bg-neon-blue hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-all shadow-lg">
                        Seleccionar
                    </button>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-300">Aún no tienes clientes ni permisos. Espera la aprobación del administrador.</p>
            @endforelse
        </div>
    </div>
</body>
</html>





