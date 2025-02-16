<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{ asset('assets/img/imgs/titleShowFinalWeb2.png') }}" type="image/x-icon">
    <title class="fa fa-user">Articulo Publicado: {{ $viewFinalWeb->title }} </title>
    <!-- Metadata -->
    @if (!empty($metadata))
        @foreach ($metadata as $key => $value)
            <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
    @endif


    @if (!empty($ogdata))
        @foreach ($ogdata as $key => $value)
            <meta property="og:{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
        @if ($viewFinalWeb->images)
            <meta property="og:image" content="{{ asset('storage/' . $viewFinalWeb->images) }}">
        @endif
    @endif

    <!-- Microdata -->
    @if (!empty($microdata))
        @foreach ($microdata as $key => $value)
            <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
    @endif





    <!-- bootstrap css -->

    {{-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assetsPromotions/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assetsPromotions/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assetsPromotions/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assetsPromotions/css/responsive.css') }}">
    <link rel="icon" href="{{ asset('assets/assetsPromotions/images/fevicon.png') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('assets/assetsPromotions/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/assetsPromotions/css/owl.carousel.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/assetsPromotions/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">

    {{-- <link rel="stylesheet" href="assets/assetsPromotions/css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css"> --}}


</head>

<style>
    /**
 * Owl Carousel v2.3.3
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
    .owl-carousel,
    .owl-carousel .owl-item {
        -webkit-tap-highlight-color: transparent;
        position: relative
    }

    .owl-carousel {
        display: none;
        width: 100%;
        z-index: 1
    }

    .owl-carousel .owl-stage {
        position: relative;
        -ms-touch-action: pan-Y;
        touch-action: manipulation;
        -moz-backface-visibility: hidden
    }

    .owl-carousel .owl-stage:after {
        content: ".";
        display: block;
        clear: both;
        visibility: hidden;
        line-height: 0;
        height: 0
    }

    .owl-carousel .owl-stage-outer {
        position: relative;
        overflow: hidden;
        -webkit-transform: translate3d(0, 0, 0)
    }

    .owl-carousel .owl-item,
    .owl-carousel .owl-wrapper {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0)
    }

    .owl-carousel .owl-item {
        min-height: 1px;
        float: left;
        -webkit-backface-visibility: hidden;
        -webkit-touch-callout: none
    }

    .owl-carousel .owl-item img {
        display: block;
        width: 100%
    }

    .owl-carousel .owl-dots.disabled,
    .owl-carousel .owl-nav.disabled {
        display: none
    }

    .no-js .owl-carousel,
    .owl-carousel.owl-loaded {
        display: block
    }

    .owl-carousel .owl-dot,
    .owl-carousel .owl-nav .owl-next,
    .owl-carousel .owl-nav .owl-prev {
        cursor: pointer;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }

    .owl-carousel .owl-nav button.owl-next,
    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel button.owl-dot {
        background: 0 0;
        color: inherit;
        border: none;
        padding: 0 !important;
        font: inherit
    }

    .owl-carousel.owl-loading {
        opacity: 0;
        display: block
    }

    .owl-carousel.owl-hidden {
        opacity: 0
    }

    .owl-carousel.owl-refresh .owl-item {
        visibility: hidden
    }

    .owl-carousel.owl-drag .owl-item {
        -ms-touch-action: none;
        touch-action: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }

    .owl-carousel.owl-grab {
        cursor: move;
        cursor: grab
    }

    .owl-carousel.owl-rtl {
        direction: rtl
    }

    .owl-carousel.owl-rtl .owl-item {
        float: right
    }

    .owl-carousel .animated {
        animation-duration: 1s;
        animation-fill-mode: both
    }

    .owl-carousel .owl-animated-in {
        z-index: 0
    }

    .owl-carousel .owl-animated-out {
        z-index: 1
    }

    .owl-carousel .fadeOut {
        animation-name: fadeOut
    }

    @keyframes fadeOut {
        0% {
            opacity: 1
        }

        100% {
            opacity: 0
        }
    }

    .owl-height {
        transition: height .5s ease-in-out
    }

    .owl-carousel .owl-item .owl-lazy {
        opacity: 0;
        transition: opacity .4s ease
    }

    .owl-carousel .owl-item img.owl-lazy {
        transform-style: preserve-3d
    }

    .owl-carousel .owl-video-wrapper {
        position: relative;
        height: 100%;
        background: #000
    }

    .owl-carousel .owl-video-play-icon {
        position: absolute;
        height: 80px;
        width: 80px;
        left: 50%;
        top: 50%;
        margin-left: -40px;
        margin-top: -40px;
        background: url(owl.video.play.png) no-repeat;
        cursor: pointer;
        z-index: 1;
        -webkit-backface-visibility: hidden;
        transition: transform .1s ease
    }

    .owl-carousel .owl-video-play-icon:hover {
        -ms-transform: scale(1.3, 1.3);
        transform: scale(1.3, 1.3)
    }

    .owl-carousel .owl-video-playing .owl-video-play-icon,
    .owl-carousel .owl-video-playing .owl-video-tn {
        display: none
    }

    .owl-carousel .owl-video-tn {
        opacity: 0;
        height: 100%;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: contain;
        transition: opacity .4s ease
    }

    .owl-carousel .owl-video-frame {
        position: relative;
        z-index: 1;
        height: 100%;
        width: 100%
    }
</style>




<body>
    <!-- header section start -->

    <div class="header_section">
        <div class="container-fluid" style="background-color: rgb(51, 134, 207);">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                {{-- <div class="logo"><a href="index.html"><img
                            src="{{ asset('assets/assetsPromotions/images/offer3.png') }}"></a></div> --}}

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


            </nav>
        </div>
        <!-- header section end -->
        <!-- banner section start -->
        <div class="banner_section layout_padding" style="background-color: rgb(51, 134, 207);">
            <div class="container">
                <div id="main_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="Shows_text">{{ $viewFinalWeb->title }}</h5>
                                    {{-- <p class="there_text">{{ $viewFinalWeb->subtitle }}</p> --}}
                                    {{-- <div class="start_bt"><a href="#">Start Now</a></div>
                                    <div class="read_bt"><a href="#">Read More</a></div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="images_1"><img {{-- src="{{ asset('assets/assetsPromotions/images/promoImg.png') }}"></div> --}}
                                            src="{{ asset($viewFinalWeb->banners) }}" alt="Banner" class="img-fluid">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="Shows_text">{{ $viewFinalWeb->title }}</h5>
                                    {{-- <p class="there_text">{{ $viewFinalWeb->subtitle }}</p> --}}

                                    {{-- <div class="start_bt"><a href="#">Conocer Promocion</a></div> --}}
                                    {{-- <div class="read_bt"><a href="#">Read More</a></div> --}}
                                    {{-- <div class="start_bt"><a href="#">Start Now</a></div>
                                    <div class="read_bt"><a href="#">Read More</a></div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="images_1"><img {{-- src="{{ asset('assets/assetsPromotions/images/promoImg.png') }}"></div> --}}
                                            src="{{ asset($viewFinalWeb->banners) }}" alt="Banner" class="img-fluid">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="Shows_text">{{ $viewFinalWeb->title }}</h5>
                                    {{-- <div class="start_bt"><a href="#">Start Now</a></div>
                                    <div class="read_bt"><a href="#">Read More</a></div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="images_1"><img {{-- src="{{ asset('assets/assetsPromotions/images/promoImg.png') }}"></div> --}}
                                            src="{{ asset($viewFinalWeb->banners) }}" alt="Banner" class="img-fluid">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="Shows_text">{{ $viewFinalWeb->title }}</h5>
                                    {{-- <div class="start_bt"><a href="#">Start Now</a></div>
                                    <div class="read_bt"><a href="#">Read More</a></div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="images_1"><img {{-- src="{{ asset('assets/assetsPromotions/images/promoImg.png') }}"></div> --}}
                                            src="{{ asset($viewFinalWeb->banners) }}" alt="Banner"
                                            class="img-fluid"></div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                        {{-- <i class="fa-arrow-left"><img src="images/left-arrow.png"></i> --}}
                        <i class="fa-arrow-left"><img
                                src="{{ asset('assets/assetsPromotions/images/left-arrow.png') }}"></i>
                    </a>
                    <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                        {{-- <i class="fa-angle-right"><img src="images/right-arrow.png"></i> --}}
                        <i class="fa-angle-right"><img
                                src="{{ asset('assets/assetsPromotions/images/right-arrow.png') }}"></i>
                    </a>
                </div>
                <br>
                <br>
                <br>

                <div class="banner_section_2">
                    <div class="row">
                        {{-- <div class="col-lg-4 col-sm-12">
                            <div class="box_main">
                                <div class="internet_icon"></div>
                                <h4 class="broadband_text">Condiciones</h4>
                                <p class="many_text activeExtras">{{ $viewFinalWeb->terms }}</p>
                            </div>
                        </div> --}}
                        {{-- <div class="col-lg-4 col-sm-12">
                            <div class="box_main">
                                <div class="internet_icon2"></div>
                                <h4 class="broadband_text">Herramientas</h4>
                                <p class="many_text activeExtras"
                                    onclick="window.location='{{ json_decode($viewFinalWeb->link)->link }}'">
                                    {{ json_decode($viewFinalWeb->link)->name }}</p>

                            </div>
                        </div> --}}
                        {{-- <div class="col-lg-4 col-sm-12">
                            <div class="box_main">
                                <div class="internet_icon"></div>
                                <h4 class="broadband_text">Extras</h4>
                                <p class="many_text activeExtras">{{ json_decode($viewFinalWeb->extras)->extras }}
                                </p>
                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>
        <!-- banner section end -->
    </div>




    <div class="client_section layout_padding">
        <div class="container">
            <div class="promotion_section2 layout_padding">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="miller_text_Promotion">
                            <span class="quote_icon_Promotion">
                                {{-- <img src="{{ asset($viewFinalWeb->banners) }}" alt="Banner" class="img-fluid"> --}}
                            </span>
                        </div>
                        <br>
                        <br>
                        <h1 class="choose_textDateTime">
                            Inicio: {{ \Carbon\Carbon::parse($viewFinalWeb->start_date)->format('d-m-Y') }} &nbsp;
                            Finalización: {{ \Carbon\Carbon::parse($viewFinalWeb->end_date)->format('d-m-Y') }}
                        </h1>


                        {{-- <div class="contentArticle">
                            <p class="lorem_text">{!! $viewFinalWeb->content !!}</p>

                        </div> --}}




                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="contentArticlee">
        <div class="text-containerr">
            <p class="lorem_textss">{!! $viewFinalWeb->content !!}</p>
        </div>
    </div>

    <style>
        .contentArticlee {
            max-width: 1200px;
            /* Aumentar el ancho del contenedor */
            margin: 0 auto;
            /* Centra el contenedor */
            padding: 20px;
            /* Espaciado interno */
            /* Fondo suave */
            background-color: #f9f9f9;
            /* background-color: #57a19d; Fondo suave */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra suave */
            width: 100%;
            /* Hace que el contenedor ocupe el 100% de la pantalla */
        }

        .text-containerr {
            padding: 10px 20px;
            /* Ajusta el espaciado interno */
        }

        .lorem_textss {
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
            color: #333;
            margin-bottom: 15px;
        }
    </style> --}}






    <div class="contentArticlee">
        <div class="text-containerr">
            <!-- Mostrar el contenido del artículo -->
            <p class="lorem_textss">{!! $viewFinalWeb->content !!}</p>

            <hr>




            <!-- Mostrar el contenido del formulario (decodificado de JSON) -->
            @if ($formContent)
                <div class="floating-form-container">
                    {{-- <h3>Contenido del formulario: </h3> --}}
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
                                    <input type="number" class="{{ $field['className'] }}" name="{{ $field['name'] }}">
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

                            @case('text')
                                <div class="mb-3">
                                    <label>{{ $field['label'] }}</label>
                                    <input type="text" class="{{ $field['className'] }}" name="{{ $field['name'] }}">
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
                                    <input type="date" class="{{ $field['className'] }}" name="{{ $field['name'] }}">
                                </div>
                            @break

                            @case('radio-group')
                                <div class="mb-3">
                                    <label>{{ $field['label'] }}</label><br>
                                    @foreach ($field['values'] as $option)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="{{ $field['name'] }}"
                                                value="{{ $option['value'] }}" {{ $option['selected'] ? 'checked' : '' }}>
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
                                            <input class="form-check-input" type="checkbox" name="{{ $field['name'] }}[]"
                                                value="{{ $option['value'] }}" {{ $option['selected'] ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $option['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @break

                            @case('file')
                                <div class="mb-3">
                                    <label>{{ $field['label'] }}</label>
                                    <input type="file" class="{{ $field['className'] }}" name="{{ $field['name'] }}">
                                </div>
                            @break

                            @case('hidden')
                                <input type="hidden" class="{{ $field['className'] ?? '' }}" name="{{ $field['name'] }}"
                                    value="{{ $field['value'] ?? '' }}">
                            @break

                            @case('paragraph')
                                <div class="mb-3">
                                    <p>{{ $field['label'] }}</p>
                                </div>
                            @break

                            @case('button')
                                <div class="mb-3">
                                    <button type="button" class="{{ $field['className'] ?? 'btn btn-primary' }}">
                                        {{ $field['label'] }}
                                    </button>
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

            <!--ESTE ES EL BUENO-->
        </div>

    </div>

    <style>
        .contentArticlee {
            max-width: 1200px;
            /* Aumentar el ancho del contenedor */
            margin: 0 auto;
            /* Centra el contenedor */
            padding: 20px;
            /* Espaciado interno */
            /* Fondo suave */
            background-color: #f9f9f9;
            /* background-color: #57a19d; Fondo suave */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra suave */
            width: 100%;
            /* Hace que el contenedor ocupe el 100% de la pantalla */
        }

        .text-containerr {
            padding: 10px 20px;
            /* Ajusta el espaciado interno */
        }

        .lorem_textss {
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
            color: #333;
            margin-bottom: 15px;
        }





        /* Estilo del contenedor flotante */
        /* .floating-form-container {
            position: fixed;
            top: 20px;
            right: 20px;
            /* background-color: rgba(0, 0, 0, 0.7);
            background-color: rgba(123, 2, 2, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 350px;
            z-index: 1000;
            width: 100%;
            box-sizing: border-box;
            overflow-y: auto;
            /* Si el contenido excede, agrega scroll
            max-height: 80vh;
            /* Limitar altura a 80% de la vista
        } */
        .floating-form-container {
            /* Fija el formulario en la parte inferior y derecha de la pantalla */
            /* position: fixed; */
            bottom: 20px;
            /* Manténlo 20px desde la parte inferior */
            right: 20px;
            /* Manténlo 20px desde el borde derecho */
            background-color: rgba(123, 2, 2, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            /* Asegura que el formulario esté por encima de otros elementos */
            width: auto;
            /* Ajusta el ancho al contenido */
            min-width: 250px;
            /* Define un ancho mínimo para evitar que el formulario sea demasiado pequeño */
            max-width: 350px;
            /* Puedes ajustar el ancho máximo para evitar que sea demasiado grande */
            box-sizing: border-box;
            overflow: hidden;
            /* Elimina las barras de desplazamiento */
            height: auto;
            /* Deja que el formulario crezca en altura según el contenido */
        }



        /* Estilo general de los inputs y campos */
        .floating-form-container input,
        .floating-form-container select,
        .floating-form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
        }

        /* Estilo de los botones */
        .floating-form-container button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .floating-form-container button:hover {
            background-color: #0056b3;
        }

        /* Estilo para los labels */
        .floating-form-container label {
            font-weight: bold;
            color: #fff;
            /*COLOR DE LAS LETRAS DE FONDO*/
        }

        /* Estilo para los párrafos */
        .floating-form-container p {
            color: #fff;
        }

        .floating-form-container h1 {
            color: #fff;
            /* Establecer color blanco para los títulos DEL ENCABEZADO DEL FORMULARIO */
        }
    </style>
    {{-- <style>
        .contentArticlee {
            max-width: 1200px;
            /* Aumentar el ancho del contenedor */
            margin: 0 auto;
            /* Centra el contenedor */
            padding: 20px;
            /* Espaciado interno */
            /* Fondo suave */
            background-color: #f9f9f9;
            /* background-color: #57a19d; Fondo suave */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra suave */
            width: 100%;
            /* Hace que el contenedor ocupe el 100% de la pantalla */
        }

        .text-containerr {
            padding: 10px 20px;
            /* Ajusta el espaciado interno */
        }

        .lorem_textss {
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
            color: #333;
            margin-bottom: 15px;
        }EL BUENO
    </style> --}}
    {{-- <style>
        /* Contenedor principal */
.contentArticlee {
    display: flex;
    flex-direction: column;
    padding: 20px;
    max-width: 100%;
    background-color: #f4f4f9;
    margin: auto;
}

/* Estilo del formulario dentro del artículo */
.text-containerr {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}

/* Estilo de cada campo del formulario */
.mb-3 {
    margin-bottom: 15px;
}

/* Títulos de los campos */
label {
    font-weight: bold;
    margin-bottom: 5px;
    display: inline-block;
}

/* Input de texto y número */
input[type="text"], input[type="number"], input[type="date"], select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

/* Estilo de los botones */
button {
    padding: 10px 15px;
    border: none;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Estilo de los campos tipo checkbox, radio y select */
input[type="checkbox"], input[type="radio"] {
    margin-right: 10px;
}

select {
    width: auto;
    display: inline-block;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Formulario tipo chat */
textarea {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    resize: none;
    min-height: 100px;
}

/* Hacerlo responsive con media queries */
@media (max-width: 768px) {
    .contentArticlee {
        padding: 10px;
    }

    .text-containerr {
        padding: 10px;
    }

    label {
        font-size: 14px;
    }

    input[type="text"], input[type="number"], input[type="date"], select, textarea {
        font-size: 14px;
    }

    button {
        font-size: 14px;
    }
}

/* Estilo tipo chat box */
.chat-box {
    display: flex;
    flex-direction: column;
    background: #f1f1f1;
    padding: 10px;
    max-height: 500px;
    overflow-y: auto;
    border-radius: 8px;
}

.chat-box .message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    background: #e1e1e1;
    max-width: 70%;
}

.chat-box .message.user {
    background: #cce5ff;
    align-self: flex-end;
}

.chat-box .message.bot {
    background: #f8d7da;
    align-self: flex-start;
}

.chat-box .input-area {
    display: flex;
    margin-top: 10px;
    justify-content: space-between;
}

.chat-box .input-area input {
    width: 80%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.chat-box .input-area button {
    width: 18%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

    </style> --}}













    <!-- about section start -->
    <div class="about_section layout_padding">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image_2">
                        <h1 class="client_taital"></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="live_text">
                        <h1 class="client_taital"></h1>
                    </h1>
                    <p class="lorem_text"></p>
                </div>
            </div>
        </div>
    </div>






    {{-- <div class="product_section layout_padding">
        <div class="container">
            <h1 class="choose_text">Articulos Destacables</h1>
            <div class="product_section2">
                <div class="row">
    @foreach ($publishedArticles as $viewFinalWeb)
    <div class="col-lg-4 col-sm-12">
        <div class="box_main">
            <picture>
            </picture>
            <h4 class="broadband_text">{{ $viewFinalWeb->title }}</h4>
            <div class="seemore_main">
                <div class="see_more">
                    <a href="{{ route('articles.viewOnWeb', ['id_post' => $viewFinalWeb->id_post, 'alias' => $viewFinalWeb->alias]) }}">
                        Mostrar
                    </a>
                </div>
            </div>
        </div>
    </div>
               
@endforeach

</div>
</div>
</div>
</div> --}}
    <div class="product_section layout_padding">
        <div class="container">
            <h1 class="choose_text">Artículos Destacables</h1>
            <div class="product_section2">
                <div class="row">
                    @foreach ($publishedArticles as $viewFinalWeb)
                        <div class="col-lg-4 col-sm-12">
                            <div class="box_main">
                                <picture>
                                </picture>
                                <h4 class="broadband_text">{{ $viewFinalWeb->title }}</h4>
                                <div class="seemore_main">
                                    <div class="see_more">
                                        <a
                                            href="{{ route('articles.viewOnWeb', ['id_post' => $viewFinalWeb->id_post, 'alias' => $viewFinalWeb->alias]) }}">
                                            Mostrar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>





















    {{-- PRUEBAS PARA BUSCADOR DE PROMOCIONES --}}
    {{-- <div class="contact_section layout_paddingaa">
        <div class="containesr">
            <h1 class="check_text">BUSCADOR DE PROMOCIONES</h1>
            <div class="contact_section2">
                <div class="addres_maian">
                    <div class="input_bga">
                        <h3 class="fact_texta">Busca Tus Promociones Aquí</h3>
                        <form id="searchForm" onsubmit="event.preventDefault(); searchArticle();">
                            <input type="text" class="address_text" placeholder="Introduce El Titulo De La Promocion A Buscar" name="query" id="txtSearch">
                            <button type="submit" class="get_bt">BUSCAR</button>
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
       
        
    </div>
    <div class="searchResultsHeader" id="searchResultsHeader" style="background-color: #6e38a4; color: white; display: none;">
        <h3 tabindex="0">Promociones Encontradas</h3>
    </div>
    <div id="resultsSearch"></div> --}}


    {{-- <div class="contentArticle">
        <p class="lorem_text">{!! $viewFinalWeb->content !!}</p>
    
        <!-- Si existe un formulario, mostrarlo -->
        @if ($form)
            {{-- <form action="{{ route('form.submit', $form->form_id) }}" method="POST"> 
                @csrf
                <!-- Suponiendo que el formulario tiene un campo JSON con las preguntas -->
                @foreach (json_decode($form->content, true) as $field)
                    <div class="form-group">
                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        @else
            <p>No hay formulario disponible.</p>
        @endif
    </div> --}}






    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="contact_section layout_padding">
        <div class="container">
            <h1 class="check_text">BUSCADOR DE ARTICULOS</h1>
            <div class="contact_section2">
                <div class="addres_main">
                    <div class="input_bg">
                        <h3 class="fact_text">Busca Tus Articulos Aquí</h3>
                        <form id="searchForm" onsubmit="event.preventDefault(); searchArticle();">
                            <input type="text" class="address_text"
                                placeholder="Introduce El Titulo Del Articulo A Buscar" name="query"
                                id="txtSearch" onfocus="refreshSearch()">
                        </form>
                    </div>
                </div>
            </div>

         

            <div class="searchResultsHeaderAGREGADO" id="searchResultsHeader"
                style="background-color:transparent; color: rgb(159, 34, 34); display: none;">
                <h3 tabindex="0">Articulos Encontrados</h3>
            </div><br><br>

            <div id="resultsSearch" class="results-containerAGREGADO">
                <!-- Aquí se agregarán las tarjetas dinámicamente -->
            </div>

        </div>
    </div>

    <style>
        .results-containerAGREGADO {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card {
            width: 250px;
            background-color: #ffffffb2;
            /* background: linear-gradient(to bottom, #3b82f6, #06b6d4, #14b8a6); */
            /* background:  #3386CF; */

            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(171, 28, 28, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .card h4 {
            color: #4133a8;
            /* color: #eeeeee; */
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .card p {
            color: #229e58;
            /* color: #ffffff; */
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card .btn {
            /*COLOR DEL BOTON SIN PASAR EL MOUSE*/
            background-color: #4568D8;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
            width: 100%;
            margin-top: auto;
            /* Para que el botón esté al final de la tarjeta */
        }

        .card .btn:hover {
            /*COLOR DESPUES DE PASAR EL MOUSE*/
            background-color: #728ce3
        }
    </style>


    <script>
        // Función para simular un "F5" sin resetear el formulario
        function refreshSearch() {
            searchArticle(); // Llamar a la función de búsqueda directamente
        }

        // Función de búsqueda
        function searchArticle() {
            const query = document.getElementById("txtSearch").value; // Captura lo que el usuario escribió

            // Verifica si el campo de búsqueda no está vacío
            if (query.trim() !== "") {
                // Muestra el encabezado de resultados (Promociones Encontradas)
                document.getElementById("searchResultsHeader").style.display = "block";
                document.getElementById("resultsSearch").innerHTML = ""; // Limpia los resultados previos

                fetch(`/searchArticle?query=${query}`) // Llama a la ruta del backend
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la búsqueda');
                        }
                        return response.json();
                    })
                    .then(data => {
                        showResults(data); // Muestra los resultados de las promociones
                    })
                    .catch(error => {
                        document.getElementById("resultsSearch").innerHTML = `<p>${error.message}</p>`;
                        document.getElementById("searchResultsHeader").style.display = "none";
                    });
            } else {
                document.getElementById("resultsSearch").innerHTML = "<p>Por favor ingresa un título de promoción.</p>";
                document.getElementById("searchResultsHeader").style.display =
                    "none"; // Oculta los resultados cuando no hay búsqueda
            }
        }

        // Función para mostrar los resultados
        function showResults(results) {
            const containerResults = document.getElementById("resultsSearch");

            if (results.length > 0) {
                // Limpia el contenedor antes de mostrar los nuevos resultados
                containerResults.innerHTML = "";

                results.forEach(result => {
                    const card = document.createElement("div");
                    card.classList.add("card");

                    card.innerHTML = `
                <img src="${result.mini_Image}" alt="Imagen de promoción" class="card-img">
                <h4>${result.title}</h4>
               
                <a href="/articles/${result.id}/${result.alias}" class="btn">Ver más</a>
            `;

                    containerResults.appendChild(card);
                });
            } else {
                containerResults.innerHTML = "<p>No se encontraron resultados.</p>";
            }
        }
    </script>

    {{--     
<br> <p>${result.subtitle}</p>
<br>
<br>
<br>
<br>
{{-- <div class="product_section layout_padding"> 
    <br>
    <br>
    <div class="container">
        <br>
        <br>
        <br>
        <h1 class="choose_textt" style="color: #000">Buscar Por Categorias</h1>
        <div class="product_section2">
            <div class="row">
                @foreach ($publishedArticles as $viewFinalWeb)
                    <div class="col-lg-4 col-sm-12">
                        <div class="box_main">
                            <picture>
                            </picture>
                            <h4 class="broadband_text">{{ $viewFinalWeb->title }}</h4>
                            <div class="seemore_main">
                                <div class="see_more">
                                    <a href="{{ route('articles.viewOnWeb', ['id_post' => $viewFinalWeb->id_post, 'alias' => $viewFinalWeb->alias]) }}">
                                        Mostrar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
{{-- </div> 
<br>
<br>
<br>
<br>
<br> --}}




    <!--  clsubscribe section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="fooer_logo"><img src="images/footer-logo.png"></div>
                    <h1 class="customer_text">CUSTOMER SERVICE</h1>
                    <p class="footer_lorem_text">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by </p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="customer_text">LET US HELP YOU</h1>
                    <p class="footer_lorem_text">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by </p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="customer_text">INFORMATION</h1>
                    <p class="footer_lorem_text1">About Us<br>
                        Careers<br>
                        Sell on shopee<br>
                        Press & News<br>
                        Competitions<br>
                        Terms & Conditions</p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="customer_text">OUR SHOP</h1>
                    <p class="footer_lorem_text">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by </p>
                    <div class="social_icon">
                        <ul>
                            <li><a href="#"><img src="images/fb-icon.png"></a></li>
                            <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                            <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                            <li><a href="#"><img src="images/linkedin-icon.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <div class="border"></div>
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html
                    Templates</a></p>
        </div>
    </div>

    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{ asset('assets/assetsPromotions/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/custom.js') }}"></script>
    <script src="{{ asset('assets/assetsPromotions/js/owl.carousel.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


</body>

</html>
