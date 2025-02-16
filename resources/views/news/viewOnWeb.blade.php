<!DOCTYPE html>
<html lang="en">

<style>
    .search-container {
        position: relative;
        display: inline-block;
    }

    .search-input {
        display: none;
        /* Oculto por defecto */
        position: absolute;
        right: 10px;
        top: 10px;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 4px;
        z-index: 10;
    }

    .search-input.show {
        display: block;
    }


    /* ESTILOPARA LA SECCION DE NOTICIAS DESTACANLES */

    .newsImportants {
        margin-left: 200px;
        background-color: transparent;
        /* Ajusta este valor para mover más a la derecha */
        /* max-width: 100rem */
        width: 100%
    }

    .newsTitle {
        position: relative;
        /* Cambiar a absolute o fixed si es necesario */
        left: -50px;
        /* Mueve el elemento 50px hacia la izquierda */
    }

    .contentNews {
        width: 150%;
        position: relative;
        /* Cambiar a absolute o fixed si es necesario */
        left: -50px;
        /* Mueve el elemento 50px hacia la izquierda */
        /* height: 150%; */
    }


    /* estilo para authro */
    .w3-containerNews {
        width: 170%;
        /* Aumenta el ancho del contenedoR*/
        /* El contenedor ocupará el 80% del ancho disponible */
        background-color: rgb(255, 254, 254);
        margin: 0 auto;
        margin-left: -40%;
        /* Mueve el contenedor más a la izquierda */
        /* Centra el contenedor */
        padding: 20px;
        /* Añade relleno dentro del contenedor */
        border: 1px solid #fefefe;
        /* Establece un borde alrededor del contenedor */
        box-shadow: 0 4px 8px rgba(7, 7, 7, 0.5);
        /* Sombra inicial */
        margin-top: 50px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Transiciones suaves */
    }

    .w3-containerNews:hover {
        transform: translateY(-6px);
        /* Movimiento hacia arriba */
        box-shadow: 0 12px 24px rgba(7, 7, 7, 0.3);
        /* Sombra más grande para el efecto de flotación */
    }



    .styleTitle {
        font-size: 38px;
        color: rgba(15, 13, 13, 0.849);
        /* El tamaño del texto será de 38 píxeles */
        /* width: 130%;  El contenedor ocupará el 130% del ancho disponible */
        /* background-color: white; */
        background: linear-gradient(to top left, #d1d5db, #6b7280, #374151);
        margin: 0 auto;
        /* Centra el contenedor horizontalmente */
        padding: 20px;
        /* Añade relleno dentro del contenedor */
        border: 1px solid #fefefea0;
        /* Establece un borde alrededor del contenedor */
        text-align: center;
        /* Centra el texto dentro del contenedor */
        font-family: fantasy;
        /* font-family:cursive, sans-serif; */

    }


    /* ESTILO PARA EL BOTON DE CERRAR */
    /* Estilo para el botón cuando está estático */
    .button-close .btn {
        background-color: red;
        /* Rojo */
        color: white;
        /* Texto blanco */
        border: none;
        /* Sin borde */
        padding: 10px 20px;
        /* Espaciado interno */
        font-size: 16px;
        /* Tamaño de fuente */
        cursor: pointer;
        /* Cambia el cursor a puntero */
        transition: background-color 0.3s ease;
        /* Transición suave */
    }

    /* Estilo para el botón cuando pasas el mouse sobre él */
    .button-close .btn:hover {
        background-color: gray;
        /* Gris cuando pasa el mouse */
    }
</style>

{{-- ESTILO PARA EL BOTON DE BUSCAR --}}
<style>
    .bodySearch {
        margin: 0;
        padding: 0;
        background: #19161c;
        height: 100vh;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        flex-direction: column;
        align-content: center;
    }

    .boxSearchNotice {
        position: relative;
    }

    .input {
        padding: 10px;
        width: 80px;
        height: 80px;
        background: none;
        /* border: 4px solid #a7913a; */
        border: 2.5px solid #fbf9f9;
        /*COLOR DEL BORDE EL ICONO DE BUSCAR*/
        border-radius: 50px;
        box-sizing: border-box;
        font-family: Comic Sans MS;
        font-size: 26px;
        /* color: #ffd52d; Color de las letras al buscark */
        color: #000000;
        /*Color de las letras al buscar*/
        outline: none;
        transition: .5s;
    }

    .boxSearchNotice:hover input {
        width: 350px;
        /* background: #3b3640; */
        background: #ffffff;
        /*color de fondo del buscador*/
        border-radius: 10px;
    }

    .boxSearchNotice i {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translate(-50%, -50%);
        font-size: 26px;
        /* color: #ffd52d; */
        /* color: #7f0404; COLOR DE LA LUPAK */
        color: transparent;
        /*COLOR DE LA LUPA*/
        transition: .2s;
    }

    .boxSearchNotice:hover i {
        opacity: 0;
        z-index: -1;
    }


    /* ESTILO PARA EL TITULO */


    .containerTitle {
        max-width: 1450px;
        min-height: 80px;
        color: rgb(10, 8, 8);
        margin: 40px auto;
        /* background-color: #feffffc7; */
        background-color: #f4f3f5;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(7, 7, 7, 0.5);
        /* Sombra inicial */
        margin-top: 50px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Transiciones suaves */
    }

    .containerTitle:hover {
        transform: translateY(-12px);
        /*EFECTO DE SALTO DEL TITULO*/
        /* Movimiento hacia arriba */
        box-shadow: 0 12px 24px rgba(7, 7, 7, 0.3);
        /* Sombra más grande para el efecto de flotación */
    }

    /* estilo para authro */
    .containerAtuhor {
        max-width: 1450px;
        min-height: 80px;
        color: rgb(10, 8, 8);
        margin: 40px auto;
        background-color: #f4f3f5;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(7, 7, 7, 0.5);
        /* Sombra inicial */
        margin-top: 50px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Transiciones suaves */
    }

    .containerAtuhor:hover {
        transform: translateY(-50px);
        /* Movimiento hacia arriba */
        box-shadow: 0 12px 24px rgba(7, 7, 7, 0.3);
        /* Sombra más grande para el efecto de flotación */
    }

    /* INICIA ESTILO PARA CERRAR BOTON */
    .button-close {
        text-align: center;
        display: flex;
        justify-content: flex-start;
        /* Alinea el botón a la izquierda */
        align-items: center;
        /* Centra verticalmente */
    }

    .btn-danger {
        background-color: #dc3545;
        /* Color de fondo del botón */
        color: #fff;
        /* Color del texto */
        border: 2px solid transparent;
        /* Para evitar bordes duros */
        border-radius: 15px;
        /* Redondear los bordes */
        padding: 12px 30px;
        /* Espaciado dentro del botón */
        font-size: 16px;
        /* Tamaño de la fuente */
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        /* Transición suave en todos los cambios */
        /* clip-path: polygon(0 0, 100% 0, 100% 80%, 50% 100%, 0% 80%); Forma de flecha */
    }

    .btn-danger:hover {
        background-color: #c82333;
        /* Cambio de color al pasar el mouse */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del botón */
    }

    .btn-danger:focus {
        outline: none;
        /* Elimina el borde de enfoque */
    }

    .glow-on-hover {
        position: relative;
        overflow: hidden;
        transition: color 0.3s ease, background-color 0.3s ease;
        z-index: 1;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 10px;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    @keyframes glowing {
        0% {
            background-position: 0 0;
        }

        50% {
            background-position: 400% 0;
        }

        100% {
            background-position: 0 0;
        }
    }

    /* INICIA ESTILO PARA imagenes IMAGES DEL TITULO */
</style>

<head>

    <meta charset="UTF-8">
    {{-- <title>Noticias Publicadas</title> --}}
    <title>{{ $newsNotice->title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Typenote — W3.CSS: Jane Bloglife">
    <meta name="keywords" content="typenote, w3css, templates, jane, bloglife">
    <meta name="author" content="Gurov Dmitriy">
    <meta name="robots" content="noindex, follow">

    <link rel="preload" href="font/woff2/Oswald-VariableFont_wght.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="font/woff2/OpenSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="font/woff2/OpenSans-Bold.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="preload" href="https://www.w3schools.com/w3css/4/w3.css" as="style">
    <link rel="preload" href="css/style.css" as="style">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- Metadata -->
    @if (!empty($metadata))
        @foreach ($metadata as $key => $value)
            <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
    @endif

    <!-- OG Data -->
    @if (!empty($ogdata))
        @foreach ($ogdata as $key => $value)
            <meta property="og:{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
        @if ($newsNotice->images)
            <meta property="og:image" content="{{ asset('storage/' . $newsNotice->images) }}">
        @endif
    @endif

    <!-- Microdata -->
    @if (!empty($microdata))
        @foreach ($microdata as $key => $value)
            <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
    @endif




    <script>
        document.createElement("picture");
    </script>

    <script src="js/webp.js" async></script>
    <script src="js/picturefill.js" async></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!--   <script src="js/lazysizes.js" async></script> -->

</head>



{{-- <body style=" background: linear-gradient(to bottom left, #e0f7fa, #64b5f6, #5c6bc0);"> --}}

<body style="background: linear-gradient(to bottom left, #5c6bc0, #64b5f6, #e0f7fa);">




    <header>
        <nav style="background-color: #19161C;">
            <br>

            <h5 class="visually-hidden">.</h5>

        </nav>





        <div class="w3-content">

        </div>
        <div class="containerTitle">
            <div class="w3-display-container banner-container">
                <picture>
                    <source type="image/webp" srcset="{{ asset($newsNotice->principal_Image) }}">
                    <img class="w3-image banner-image" src="{{ asset($newsNotice->principal_Image) }}" loading="lazy"
                        alt="">
                </picture>
                <div class="w3-display-middle w3-center banner-caption">
                    <p class="w3-xxlarge w3-wide" style="text-align: center;">{{ $newsNotice->title }}</p>
                </div>
            </div>

            <style>
                .banner-container {
                    position: relative;
                    width: 100%;
                    height: 350px;
                    /* Esto es ajustable, puedes probar con 50vh o una proporción */
                    overflow: hidden;
                }

                .banner-image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    /* Mantiene la imagen bien ajustada al contenedor */
                }

                .banner-caption {
                    color: white;
                    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.7);
                    padding: 20px;
                }

                .banner-caption p {
                    margin: 0;
                }

                /* Media Query para pantallas más pequeñas */
                @media (max-width: 768px) {
                    .banner-container {
                        height: 250px;
                        /* Ajusta la altura para pantallas más pequeñas */
                    }

                    .banner-caption p {
                        font-size: 1.5em;
                        /* Ajusta el tamaño de texto en pantallas pequeñas */
                    }
                }

                @media (max-width: 480px) {
                    .banner-container {
                        height: 200px;
                        /* Ajusta aún más para móviles */
                    }

                    .banner-caption p {
                        font-size: 1.2em;
                        /* Ajusta el tamaño del texto en pantallas aún más pequeñas */
                    }
                }
            </style>






    </header>

    <main class="w3-content" id="main">

        <div class="w3-row w3-padding-64">

            <div class="w3-col l8 w3-container">


                <article class="w3-white w3-margin-bottom">

                    <div class="w3-containerNews">
                        {{-- <header class="w3-padding-16 w3-center">
                            <small>
                                <i class="fas fa-calendar-alt" aria-hidden="true" style="margin-right: 5px;"></i>
                                Fecha Publicacion:
                                {{ \Carbon\Carbon::parse($newsNotice->publish_date)->format('d/m/Y') }}

                            </small>
                            <br> 
                            <small>
                                <i class="fas fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
                                Por:{{ $newsNotice->author->first_name }} {{ $newsNotice->author->last_name }}
                                {{ $newsNotice->author->middle_name }}
                            </small>
                        </header> --}}

                        <hr>
                        <p>ESTE ES EL CONTENIDO DE LA NOTICIA{!! $newsNotice->content !!}</p>


                        <!-- Mostrar el contenido del formulario (decodificado de JSON) -->
                        <div class="contentArticlee">
                            @if ($formContent)
                                <div class="text-containerr">
                                    @foreach ($formContent as $field)
                                        @switch($field['type'])
                                            @case('header')
                                                <h1>{{ $field['label'] }}</h1>
                                            @break

                                            @case('select')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <select class="{{ $field['className'] }}">
                                                        @foreach ($field['values'] as $option)
                                                            <option value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'selected' : '' }}>
                                                                {{ $option['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @break

                                            @case('number')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="number" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('text')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="text" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('textarea')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <textarea class="{{ $field['className'] }}" name="{{ $field['name'] }}"></textarea>
                                                </div>
                                            @break

                                            @case('date')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="date" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('radio-group')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="{{ $field['name'] }}" value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ $option['label'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('checkbox-group')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label><br>
                                                    @foreach ($field['values'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="{{ $field['name'] }}[]" value="{{ $option['value'] }}"
                                                                {{ $option['selected'] ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ $option['label'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @break

                                            @case('file')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="file" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}">
                                                </div>
                                            @break

                                            @case('hidden')
                                                <input type="hidden" class="{{ $field['className'] ?? '' }}"
                                                    name="{{ $field['name'] }}" value="{{ $field['value'] ?? '' }}">
                                            @break

                                            @case('paragraph')
                                                <div class="mb-3">
                                                    <p>{{ $field['label'] }}</p>
                                                </div>
                                            @break

                                            @case('button')
                                                <div class="mb-3">
                                                    <button type="button"
                                                        class="{{ $field['className'] ?? 'btn btn-primary' }}">
                                                        {{ $field['label'] }}
                                                    </button>
                                                </div>
                                            @break

                                            @case('autocomplete')
                                                <div class="mb-3">
                                                    <label>{{ $field['label'] }}</label>
                                                    <input type="text" class="{{ $field['className'] }}"
                                                        name="{{ $field['name'] }}" list="{{ $field['name'] }}-list">
                                                    <datalist id="{{ $field['name'] }}-list">
                                                        @foreach ($field['values'] as $option)
                                                            <option value="{{ $option['value'] }}">
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            @break

                                            @default
                                                <p>Tipo de campo desconocido: {{ $field['type'] }}</p>
                                        @endswitch
                                    @endforeach
                                </div>
                            @else
                                <p>No hay contenido disponible para este formulario.</p>
                            @endif

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            <header class="w3-padding-16 w3-center">
                                <small>
                                    <i class="fas fa-calendar-alt" aria-hidden="true" style="margin-right: 5px;"></i>
                                    Fecha Publicacion:
                                    {{ \Carbon\Carbon::parse($newsNotice->publish_date)->format('d/m/Y') }}

                                </small>
                                <br>
                                <small>
                                    <i class="fas fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
                                    Por:{{ $newsNotice->author->first_name }} {{ $newsNotice->author->last_name }}
                                    {{ $newsNotice->author->middle_name }}
                                </small>
                            </header>

                            {{-- <hr> --}}

                            <div class="usr-repl-modal">
                                <div class="w3-row w3-padding-16 w3-animate-left">

                                    <div class="w3-col m3">
                                        <picture>
                                            <source type="image/webp" srcset="image/avatar_smoke.webp">

                                            {{-- <img class="w3-image usr-avatar" src="image/avatar_smoke.jpg" width="200"
                                            height="223" loading="lazy" alt="Avatar"> --}}
                                        </picture>
                                    </div>
                                </div>
                            </div>

                        </div>

                </article>
                <div class="button-close">
                    <br>
                    <br>
                    <br>
                    <br>
                    <button type="button" class="btn btn-danger me-3 glow-on-hover"
                        onclick="window.history.back();">Cerrar</button>
                </div>



            </div>

            <style>
                /* Estilo para alinear el formulario */
                .contentArticlee {
                    display: flex;
                    justify-content: center;
                    /* Centra el formulario */
                    align-items: flex-start;
                    flex-direction: column;
                    padding: 20px;
                    margin-top: 20px;
                    background-color: rgba(222, 210, 210, 0.909);
                }

                /* Aseguramos que los elementos dentro del formulario no se estiren más de lo necesario */
                .text-containerr {
                    width: 100%;
                    max-width: 800px;
                    /* Limita el ancho del formulario */
                    margin: 0 auto;
                }

                /* Para los campos de entrada (inputs, selects, textareas) */
                .text-containerr input,
                .text-containerr select,
                .text-containerr textarea,
                .text-containerr button {
                    width: 100%;
                    padding: 12px;
                    margin: 10px 0;
                    border-radius: 5px;
                    border: 1px solid #ddd;
                }

                /* Estilo de los labels para que estén bien alineados */
                .text-containerr label {
                    font-weight: bold;
                    display: block;
                    margin-bottom: 5px;
                }

                /* Para los campos de botones, con un estilo más destacado */
                .text-containerr button {
                    width: auto;
                    max-width: 200px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    cursor: pointer;
                    text-align: center;
                }

                /* Para mejorar la presentación de los botones al hacer hover */
                .text-containerr button:hover {
                    background-color: #0056b3;
                }
            </style>



            <aside class="w3-col l4 w3-container">
                <section class="newsImportants">
                    {{-- AQUI INICIA PARA BUSCAR LA NOTICIAS --}}
                    <div class="boxSearchNotice">
                        <form name="searchNotice" id="searchForm" onsubmit="event.preventDefault(); searchNews();">
                            <input type="text" class="input" name="txtSearch" id="txtSearch"
                                placeholder="🔎     Buscar Noticia">
                            <i class="fas fa-search"></i>
                        </form>
                    </div>

                    <div class="searchResultsHeader" id="searchResultsHeader"
                        style="background-color: #19161C; color: white; display: none;">
                        <h3 tabindex="0">Noticias Encontradas</h3>
                    </div><br><br>

                    <div id="resultsSearch"></div>

                    <br>


                    <div class="w3-container" style="background-color: #19161C; color: white; text-align: center;">
                        <h3 tabindex="0"
                            style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                            Perfil Del Autor</h3>
                    </div><br>

                    <div class="containerAuthor"
                        style="background-color: #fefefe; color: rgb(0, 0, 0); padding: 20px; border-radius: 8px; text-align: center; position: relative;">
                        <div class="styleAuthorImg"
                            style="margin: 0 auto; width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
                            <picture>
                                <source type="image/webp"
                                    srcset="{{ $newsNotice->author->photo ?? 'No disponible' }}">
                                {{-- <img src="{{ $author['photo'] ?? 'No disponible' }}" class="img-fluid" --}}
                                <img src="{{ $newsNotice->author->photo ?? 'No disponible' }}" class="img-fluid"
                                    alt="Foto de {{ $newsNotice->author->first_name ?? 'No disponible' }}  {{ $newsNotice->author->last_name ?? 'No disponible' }}">
                            </picture>
                        </div>
                        <div style="margin-top: 20px;">
                            {{-- <h3 style="margin-bottom: 10px;">Hola👋! Conóceme Soy</h3> --}}
                            {{-- <h4>{{ $author['first_name'] ?? 'No disponible' }} {{ $author['middle_name'] ?? '' }} --}}
                            <h4> {{ $newsNotice->author->first_name ?? 'No disponible' }}
                                {{ $newsNotice->author->middle_name ?? 'No disponible' }}
                                {{-- {{ $author['last_name'] ?? 'No disponible' }}</h4> --}}
                                {{ $newsNotice->author->last_name ?? 'No disponible' }}</h4>
                            <p
                                style="text-align: justify; font-family: 'Segoe UI', sans-serif; font-weight: 400; font-style: italic;">
                                {{-- {{ $author['authorContent'] ?? 'No disponible' }} --}}
                                {{ $newsNotice->author->description ?? 'No disponible' }}
                            </p>
                            <hr style="border-color: #fef08a;">
                        </div>


                    </div>

                    <style>
                        .styleAuthorImg {
                            margin: 0 auto;
                            width: 100px;
                            height: 100px;
                            border-radius: 50%;
                            overflow: hidden;
                            border: 3px solid rgb(40, 36, 36);
                            background-color: rgb(255, 255, 255);
                        }

                        .styleAuthorImg img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    </style>

                    <br>
                    <br>

                    <div class="w3-container" style="background-color: #000000; color: rgb(255, 255, 255);">
                        <h3 tabindex="0"
                            style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                            Sígueme En Mis Redes</h3>
                        {{-- </div><br> --}}

                        <div class="w3-bar w3-large"
                            style="background-color: #111010; color: rgb(255, 255, 255); display: flex; justify-content: center; align-items: center; gap: 40px;">
                            {{-- @if (isset($author['twitter'])) --}}
                            @if (isset($newsNotice->author->twitter))
                                {{-- <a class="w3-bar-item w3-button" href="{{ $author['twitter'] }}" target="_blank" --}}
                                <a class="w3-bar-item w3-button" href="{{ $newsNotice->author->twitter }}"
                                    target="_blank"
                                    style="border-radius: 50%; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #ffffff; color: rgb(0, 0, 0);">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @else
                                <span class="w3-bar-item w3-disabled">Twitter: No disponible</span>
                            @endif

                            @if (isset($newsNotice->author->linkedin))
                                {{-- @if (isset($author['linkedin'])) --}}
                                {{-- <a class="w3-bar-item w3-button" href="{{ $author['linkedin'] }}" target="_blank" --}}
                                <a class="w3-bar-item w3-button" href="{{ $newsNotice->author->linkedin }}"
                                    target="_blank"
                                    style="border-radius: 50%; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #ffffff; color: rgb(0, 0, 0);">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @else
                                <span class="w3-bar-item w3-disabled">LinkedIn: No disponible</span>
                            @endif
                        </div><br>

                </section>
                <br>

                <section class="topStoriesNews">
                    <div class="w3-container" style="background-color: #19161C; color: white; padding: 20px;">
                        <h3 tabindex="0" class="section-title">Noticias Destacables</h3>
                    </div><br>

                    @if ($publishedNews->count() > 0)
                        <div class="news-list">
                            @foreach ($publishedNews as $news)
                                <div class="news-item">
                                    <a
                                        href="{{ route('news.showFinalFinal', ['id' => $news->news_id, 'alias' => $news->alias]) }}">
                                        <div class="news-image-container">
                                            <picture>
                                                <source type="image/webp" srcset="{{ $news->banners }}">
                                                <img class="news-image" src="{{ $news->banners }}"
                                                    alt="{{ $news->title }}" loading="lazy">
                                            </picture>
                                        </div>
                                        <div class="newsCoontent">
                                            <h4 class="newsTiitle">{{ $news->title }}</h4>
                                            <p class="news-description">{{ Str::limit($news->description, 100) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="w3-center">No hay noticias destacables por el momento.</p>
                    @endif
                </section>

                <style>
                    .topStoriesNews {
                        margin-left: 200px;
                        background-color: transparent;
                        width: 100%
                    }

                    .section-title {
                        font-size: 24px;
                        font-weight: bold;
                        text-align: center;
                    }

                    .news-list {
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                        gap: 20px;
                        margin-top: 20px;
                    }

                    .news-item {
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        overflow: hidden;
                        transition: transform 0.3s ease;
                    }

                    .news-item:hover {
                        transform: translateY(-5px);
                    }

                    .news-image-container {
                        width: 100%;
                        height: 200px;
                        overflow: hidden;
                    }

                    .news-image {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .newsCoontent {
                        padding: 15px;
                    }

                    .newsTiitle {
                        font-size: 18px;
                        font-weight: bold;
                        margin-bottom: 10px;
                        text-align: justify;
                    }

                    .news-description {
                        font-size: 14px;
                        color: #666666;
                    }
                </style>































































                <br>
                <br>
                <br>
                <br>
                <br>
                {{-- <section class="newsImportants">
                    <div class="w3-container w3-black">
                        <h2 tabindex="0">Categorias</h2>
                    </div>
                    <div class="w3-bar w3-large">
                        @if (isset($author['twitter']))
                            <a class="w3-bar-item w3-button" href="{{ $author['twitter'] }}" target="_blank">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        @else
                            <span class="w3-bar-item w3-disabled">Twitter: No disponible</span>
                        @endif

                        @if (isset($author['linkedin']))
                            <a class="w3-bar-item w3-button" href="{{ $author['linkedin'] }}" target="_blank">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        @else
                            <span class="w3-bar-item w3-disabled">LinkedIn: No disponible</span>
                        @endif
                    </div>

                </section> --}}

            </aside>

        </div>

        <div class="w3-container w3-padding-32">
            <a class="w3-button w3-mobile w3-black" href="#"><span
                    class="fa fa-arrow-up w3-margin-right"></span> Hacia Arriba</a>
        </div>

    </main>

    <footer class="w3-container w3-padding-32 w3-center w3-black">

        <h2 class="visually-hidden">Contactanos</h2>

        <p>Go to <a href="index.html">Main</a></p>

        <p>Create by <a href="https://www.typenote.io">Typenote</a></p>

        <p>Powered by <a href="https://www.w3schools.com/w3css/">W3.CSS</a></p>

    </footer>

    {{-- SCRIPT PARA QUE FUNCIONE EL BUSCADOR DE NOTICIAS --}}
    <script>
        // Función de búsqueda
        function searchNews() {
            const query = document.getElementById("txtSearch").value; // Captura lo que el usuario escribió

            // Verifica si el campo de búsqueda no está vacío
            if (query.trim() !== "") {
                // Muestra el encabezado de resultados (Noticias Encontradas)
                document.getElementById("searchResultsHeader").style.display = "block";

                fetch(`/searchNews?query=${query}`) // Llama a la ruta del backend
                    .then(response => response.json())
                    .then(data => {
                        showResults(data); // Muestra los resultados de las noticias
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                document.getElementById("resultsSearch").innerHTML = "<p>Por favor ingresa un título de noticia.</p>";
                document.getElementById("searchResultsHeader").style.display =
                    "none"; // Oculta los resultados cuando no hay búsqueda
            }
        }

        // Función para mostrar los resultados
        function showResults(results) {
            const containerResults = document.getElementById("resultsSearch");
            containerResults.innerHTML = ""; // Limpia los resultados anteriores

            if (results.length > 0) {
                const ul = document.createElement("ul");
                ul.classList.add("w3-ul", "w3-hoverable");

                results.forEach(result => {
                    const li = document.createElement("li");

                    li.innerHTML = `
                    <a class="w3-block news-card" href="/news/${result.id}/${result.alias}">
                    <picture>
                    <source type="image/webp" srcset="${result.banners}">
                    <img class="news-image" src="${result.banners}" alt="${result.title}" loading="lazy">
                    </picture>
                    <h4>${result.title}</h4>
                     </a>
                    `;


                    ul.appendChild(li);
                });

                containerResults.appendChild(ul);
            } else {
                containerResults.innerHTML = "<p>No se encontraron resultados.</p>";
            }
        }
    </script>
    <style>
        /*ESTILO DE CARD DE BUSCAR NOTICIAS*/
        .news-card {
            background-color: white;
            /* Fondo blanco */
            padding: 10px;
            /* Espaciado interno */
            border-radius: 5px;
            /* Bordes redondeados */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
            display: block;
            text-decoration: none;
            /* Quita subrayado del enlace */
            color: black;
            /* Asegura que el texto sea legible */
        }
    </style>

    {{-- SCRIPT PARA CERRAR LA PAGINA  --}}
    <script>
        document.querySelector(".btn-danger").addEventListener("click", function() {
            window.close(); // Intenta cerrar la ventana/pestaña actual
        });
    </script>

</body>

</html>
