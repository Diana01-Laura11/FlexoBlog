<style>
    .index-page {
        /* background-color: rgb(3, 13, 37); */

        background: linear-gradient(to bottom left, #e0f7fa, #64b5f6, #5c6bc0);

        /* background: linear-gradient(to bottom right, #1f2937, #1d4ed8, #111827); */



    }


    .containerTitle {
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

    .containerTitle:hover {
        transform: translateY(-50px);
        /* Movimiento hacia arriba */
        box-shadow: 0 12px 24px rgba(7, 7, 7, 0.3);
        /* Sombra más grande para el efecto de flotación */
    }




    .promotionsRelations {
        background-color: #ffffff;
        background-color: #ffffff;
        position: relative;
        width: 35%;
        max-width: 2000px;
        left: -15px;
        border: 0.5px solid #ffffff;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;

    }

    .promotionsRelations:hover {
        background-color: #ffffff;


        transform: translateY(-10px);

        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);

    }



    /* titulo de promociones relacionadas */
    .relationContainer {

        background-color: #000000;
        font-family: Verdana, Geneva, Tahoma, sans-serif;

        color: #f4f3f5d8;
        height: 9%;

        width: 100%;



    }


    .container {
        position: relative;
        left: 40px;
        max-width: 850px;
        min-height: 700px;
        background-color: #f4f3f5;
        border: 1px solid #fafafa;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;

    }

    .container:hover {
        /* transform: translateY(-50px); */
        transform: translateY(-10px);

        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);

    }

    .containerFooter {
        /* background-color: #000000; */
        background-color: #f5f5f3;
        color: black;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        text-align: center;
        max-width: 2000px;
        min-height: 150px;
        font-size: 16px;
    }


    /* .main-content {
    display: flex;
    background-color: red;
    justify-content: space-between;
} */

    /* ESTILO PARA EL BOTON DE CERRAR: */
    /* Estilos para el botón con el efecto hover */
    /* body {
  font-family: "Lato", sans-serif;
} */

    .wrapper {
        position: fixed;
        bottom: 20px;
        /* Mantén el botón 20px desde la parte inferior */
        left: 50%;
        transform: translateX(-50%);
        /* Centra el botón horizontalmente */
        z-index: 9999;
        /* Asegura que esté por encima de otros elementos */
    }


    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
    }



    .link_wrapper {
        position: relative;
    }

    /* estilo para el boton */
    button {
        display: block;
        width: 250px;
        height: 50px;
        line-height: 50px;
        font-weight: bold;
        text-decoration: none;
        background: #dc3545;
        /* Rojo (btn-danger) */
        text-align: center;
        /* Alienas el texto dentro del boton */
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 3px solid #dc3545;
        transition: all 0.35s;
        position: relative;
        margin: 0 auto;
        /* Centra el botón */
    }

    .icon {
        width: 50px;
        height: 50px;
        border: 3px solid transparent;
        position: absolute;
        transform: rotate(45deg);
        right: 0;
        top: 0;
        z-index: -1;
        transition: all 0.35s;
    }

    .icon svg {
        width: 30px;
        position: absolute;
        top: calc(50% - 15px);
        left: calc(50% - 15px);
        transform: rotate(-45deg);
        fill: #2ecc71;
        /* Color verde */
        transition: all 0.35s;
    }

    button:hover {
        width: 200px;
        border: 3px solid #b01f11;
        /* Verde en hover */
        background: transparent;
        color: #cc2e2e;
        /*color de la letra del boton*/
    }

    button:hover+.icon {
        border: 3px solid #2ecc71;
        right: -25%;
    }
</style>
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{ asset('assets/img/imgs/titleShowFinalWeb2.png') }}" type="image/x-icon">
    <title class="fa fa-user">Promoción Publicada: {{ $previewFinalWeb->title }} </title>
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
        @if ($previewFinalWeb->images)
            <meta property="og:image" content="{{ asset('storage/' . $previewFinalWeb->images) }}">
        @endif
    @endif

    <!-- Microdata -->
    @if (!empty($microdata))
        @foreach ($microdata as $key => $value)
            <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
        @endforeach
    @endif


    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">




<body class="index-page">
    <div class="content">
        <main class="main">
            <div class="post-content" data-aos="fade-up">


                {{-- ORIGINAL NO BORRAR <div class="containerTitle">
                    <div class="kode-silder">
                        <figure>
                            <img src="/images/banner-servicios-legal-digital-mx.webp" class="img-responsive"
                                alt="" width="1400px" height="200px">
                            <figcaption>
                                <div class="kode-inner-page-bnr-capion">
                                    <h1 style="text-align: center;">Promociones Legal & Digital</h1>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div> --}}




                {{-- VERSIONW22 FUNCIONAL

                <div class="containerTitle">
                    <div class="kode-silder">
                        <figure>
                            <img src="{{ asset($previewFinalWeb->banners) }}" class="img-responsive" alt=""
                                style="width: 100%; height: auto; object-fit: cover;">
                            <figcaption>
                                <div class="kode-inner-page-bnr-capion">
                                    <h1 style="text-align: center;">Promociones Legal & Digital</h1>
                                    <h1 style="text-align: center;">{{ $previewFinalWeb->title }}</h1>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div> --}}




                <div class="containerTitlee" style="padding: 20px;">
                    <div class="kode-silder">
                        <figure>
                            <figcaption
                                style="background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                                <div class="kode-inner-page-bnr-capion">
                                    <h1 style="text-align: center; font-size: 24px; font-weight: normal;">
                                        {{ $previewFinalWeb->title }}</h1>
                                </div>
                            </figcaption>
                            <img src="{{ asset($previewFinalWeb->banners) }}" class="img-responsive" alt=""
                                style="width: 100%; height: auto; object-fit: cover; background-color:red;">
                            <figcaption
                                style="background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                                <div class="kode-inner-page-bnr-capion">
                                    {{-- <h1 style="text-align: center; font-size: 28px;">Promociones Legal & Digital</h1> --}}
                                    <h1 style="text-align: center; font-size: 24px; font-weight: normal;">
                                        {{ $previewFinalWeb->subtitle }}</h1>

                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>







                <div class="main-content" style="display: flex; justify-content: space-between;">
                    <!-- Contenedor principal de contenido -->
                    {{-- <div class="container" style="width: 70%;"> --}}
                    <div class="container">
                        <h1 style="text-align: center;">{{ $previewFinalWeb->title }}</h1>
                        <div style="text-align: justify;">{!! $previewFinalWeb->content !!}</div>
                        <small style="text-align: justify;">Publicado por: {{ $previewFinalWeb->promotion_id }}</small>
                        <small style="text-align: justify;">Publicado el:
                            {{ \Carbon\Carbon::parse($previewFinalWeb->start_date)->format('d/m/Y') }}</small>
                    </div>

                    <!-- Sección de promociones relacionadas -->
                    <section class="promotionsRelations">

                        <div class="ag-courses_item">
                            <a href="{{ json_decode($previewFinalWeb->link)->link }}" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg" style="background-color:#3697c1;">
                                </div>
                                <div class="ag-courses-item_title">
                                    <!-- Coloca el nombre dentro del <a> para que sea clickeable -->
                                    <small> {{ json_decode($previewFinalWeb->link)->name }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="ag-courses_item">
                            <a href="#" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg" style="background-color: #3697c1;">
                                </div>
                                <div class="ag-courses-item_title">
                                    <!-- Coloca el nombre dentro del <a> para que sea clickeable -->
                                    <small> {{ $previewFinalWeb->terms }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="ag-courses_item">
                            <a href="#" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg" style=" background-color: #3697c1;">
                                </div>
                                <div class="ag-courses-item_title">
                                    <!-- Coloca el nombre dentro del <a> para que sea clickeable -->
                                    <small>{{ json_decode($previewFinalWeb->extras)->extras }}</small>
                                </div>
                            </a>
                        </div>

                    

                    </section>
                </div>
                

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                {{-- <div class="containerFooter">
                   
                    <div class="ag-format-container">
                        <h1>Promociones Destacadas</h1>
                        <div class="ag-courses_box">
                        
                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        UI/Web&amp;Graph design for teenagers 11-17&#160;years old
                                    </div>

                                    <div class="ag-courses-item_date-box">
                                        Start:
                                        <span class="ag-courses-item_date">
                                            04.11.2022
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        Herramienta&#160;+ en promoción:{{ json_decode($previewFinalWeb->link)->name }}
                                    </div>

                                    <div class="ag-courses-item_date-box">
                                        Start:
                                        <span class="ag-courses-item_date">
                                            04.11.2022
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        Annual package "Product+UX/UI+Graph designer&#160;2022"
                                    </div>

                                    <div class="ag-courses-item_date-box">
                                        Start:
                                        <span class="ag-courses-item_date">
                                            04.11.2022
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        Graphic Design
                                    </div>

                                    <div class="ag-courses-item_date-box">
                                        Start:
                                        <span class="ag-courses-item_date">
                                            04.11.2022
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        Motion Design
                                    </div>

                                    <div class="ag-courses-item_date-box">
                                        Start:
                                        <span class="ag-courses-item_date">
                                            30.11.2022
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        Front-end development&#160;+ jQuery&#160;+ CMS
                                    </div>
                                </a>
                            </div>

                            <div class="ag-courses_item">
                                <a href="#" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg">
                                    </div>
                                    <div class="ag-courses-item_title">
                                        Digital Marketing
                                    </div>
                                </a>
                            </div>



                        </div>
                    </div>
                </div> --}}
                <div class="containerFooter">
                    <div class="ag-format-container">
                        <h1>Promociones Destacadas</h1>
                        <div class="ag-courses_box">
                            @foreach($publishedPromotions as $promotion)
                                <div class="ag-courses_item">
                                    {{-- <a href="{{ route('promotions.previewFinalWeb', $promotion->alias) }}" class="ag-courses-item_link"> --}}
                                        <a href="{{ route('promotions.previewFinalWeb', ['promotion_id' => $promotion->promotion_id, 'alias' => $promotion->alias]) }}" class="ag-courses-item_link">

                                        <div class="ag-courses-item_bg"></div>
                
                                        <div class="ag-courses-item_title">
                                            {{ $promotion->title }}
                                        </div>
                
                                        <div class="ag-courses-item_date-box">
                                            Start:
                                            <span class="ag-courses-item_date">
                                                {{ \Carbon\Carbon::parse($promotion->created_at)->format('d.m.Y') }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                


            </div>
            <style>
                .ag-format-container {
                    width: 1142px;
                    margin: 0 auto;
                }


                body {
                    background-color: #000;
                }

                .ag-courses_box {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-align: start;
                    -ms-flex-align: start;
                    align-items: flex-start;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;

                    padding: 50px 0;
                }

                .ag-courses_item {
                    -ms-flex-preferred-size: calc(33.33333% - 30px);
                    flex-basis: calc(33.33333% - 30px);

                    margin: 0 15px 30px;

                    overflow: hidden;

                    border-radius: 28px;
                }

                .ag-courses-item_link {
                    display: block;
                    padding: 30px 20px;
                    background-color: #121212;

                    overflow: hidden;

                    position: relative;
                }

                .ag-courses-item_link:hover,
                .ag-courses-item_link:hover .ag-courses-item_date {
                    text-decoration: none;
                    color: #FFF;
                }

                .ag-courses-item_link:hover .ag-courses-item_bg {
                    -webkit-transform: scale(10);
                    -ms-transform: scale(10);
                    transform: scale(10);
                }

                .ag-courses-item_title {
                    min-height: 87px;
                    margin: 0 0 25px;

                    overflow: hidden;

                    font-weight: bold;
                    font-size: 30px;
                    color: #FFF;

                    z-index: 2;
                    position: relative;
                }

                .ag-courses-item_date-box {
                    font-size: 18px;
                    color: #FFF;

                    z-index: 2;
                    position: relative;
                }

                .ag-courses-item_date {
                    font-weight: bold;
                    color: #f9b234;

                    -webkit-transition: color .5s ease;
                    -o-transition: color .5s ease;
                    transition: color .5s ease
                }

                .ag-courses-item_bg {
                    height: 128px;
                    width: 128px;
                    background-color: #f9b234;

                    z-index: 1;
                    position: absolute;
                    top: -75px;
                    right: -75px;

                    border-radius: 50%;

                    -webkit-transition: all .5s ease;
                    -o-transition: all .5s ease;
                    transition: all .5s ease;
                }

                .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
                    background-color: #3ecd5e;
                }

                .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
                    background-color: #e44002;
                }

                .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
                    background-color: #952aff;
                }

                .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
                    background-color: #cd3e94;
                }

                .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
                    background-color: #4c49ea;
                }



                @media only screen and (max-width: 979px) {
                    .ag-courses_item {
                        -ms-flex-preferred-size: calc(50% - 30px);
                        flex-basis: calc(50% - 30px);
                    }

                    .ag-courses-item_title {
                        font-size: 24px;
                    }
                }

                @media only screen and (max-width: 767px) {
                    .ag-format-container {
                        width: 96%;
                    }

                }

                @media only screen and (max-width: 639px) {
                    .ag-courses_item {
                        -ms-flex-preferred-size: 100%;
                        flex-basis: 100%;
                    }

                    .ag-courses-item_title {
                        min-height: 72px;
                        line-height: 1;

                        font-size: 24px;
                    }

                    .ag-courses-item_link {
                        padding: 22px 40px;
                    }

                    .ag-courses-item_date-box {
                        font-size: 16px;
                    }
                }
            </style>




            <br>
            <br>
            {{-- NUEVO --}}
                <div class="CardProx" style="background-color: #ffffffd2; padding: 40px 20px; height: auto;">
                    <h1 style="color: rgb(0, 0, 0); text-align: center;">Próximamente</h1>

                <article class="card">
                    {{-- <img class="card__background" src="https://i.imgur.com/QYWAcXk.jpeg" --}}
                    <img class="card__background" src="{{ asset($previewFinalWeb->mini_Image) }}" alt="Banner"
                        alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                        width="1920" height="2193" />
                    <div class="card__content | flow">
                        <div class="card__content--container | flow">
                            <h2 class="card__title">{{ $previewFinalWeb->title }}</h2>
                            <p class="card__description">
                                {{ $previewFinalWeb->subtitle }}
                            </p>
                        </div>
                        <button class="card__button">Read more</button>
                    </div>
                </article>
            </div>
        

            <style>
                @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@700&display=swap");
            
                :root {
                    /* Colors */
                    --brand-color: hsl(46, 100%, 50%);
                    --black: hsl(0, 0%, 0%);
                    --white: hsl(0, 0%, 100%);
                    /* Fonts */
                    --font-title: "Montserrat", sans-serif;
                    --font-text: "Lato", sans-serif;
                }
            
                /* RESET */
            
                /* Box sizing rules */
                *,
                *::before,
                *::after {
                    box-sizing: border-box;
                }
            
                /* Remove default margin */
                body,
                h2,
                p {
                    margin: 0;
                }
            
                /* GLOBAL STYLES */
                body {
                    display: grid;
                    place-items: center;
                    height: 100vh;
                }
            
                h2 {
                    font-size: 2.25rem;
                    font-family: var(--font-title);
                    color: var(--white);
                    line-height: 1.1;
                }
            
                p {
                    font-family: var(--font-text);
                    font-size: 1rem;
                    line-height: 1.5;
                    color: var(--white);
                }
            
                .flow>*+* {
                    margin-top: var(--flow-space, 1em);
                }
            
                /* CARD COMPONENT */
            
                .card {
                    display: grid;
                    place-items: center;
                    width: 60vw; /* Ajusta el ancho de la tarjeta al 60% del ancho de la ventana */
                    max-width: 15rem; /* Ancho máximo de la tarjeta */
                    height: 20rem; /* Ajusta la altura de la tarjeta */
                    overflow: hidden;
                    border-radius: 0.625rem;
                    box-shadow: 0.25rem 0.25rem 0.5rem rgba(0, 0, 0, 0.25);
                }
            
                .card>* {
                    grid-column: 1 / 2;
                    grid-row: 1 / 2;
                }
            
                .card__background {
                    object-fit: cover;
                    max-width: 100%;
                    height: 100%;
                }
            
                .card__content {
                    --flow-space: 0.9375rem;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    align-self: flex-end;
                    height: 55%;
                    padding: 5% 1rem 1.875rem; /* Reducido el padding */
                    background: linear-gradient(180deg,
                            hsla(0, 0%, 0%, 0) 0%,
                            hsla(0, 0%, 0%, 0.3) 10%,
                            hsl(0, 0%, 0%) 100%);
                }
            
                .card__content--container {
                    --flow-space: 1.25rem;
                }
            
                .card__title {
                    font-size: 1.5rem; /* Reducido el tamaño del título */
                    position: relative;
                    width: fit-content;
                    width: -moz-fit-content;
                }
            
                .card__title::after {
                    content: "";
                    position: absolute;
                    height: 0.3125rem;
                    width: calc(100% + 1.25rem);
                    bottom: calc((1.25rem - 0.5rem) * -1);
                    left: -1.25rem;
                    background-color: var(--brand-color);
                }
            
                .card__description {
                    font-size: 0.875rem; /* Reducido el tamaño de la descripción */
                }
            
                .card__button {
                    padding: 0.75em 1.6em;
                    width: fit-content;
                    width: -moz-fit-content;
                    font-variant: small-caps;
                    font-weight: bold;
                    border-radius: 0.45em;
                    border: none;
                    background-color: var(--brand-color);
                    font-family: var(--font-title);
                    font-size: 1.125rem;
                    color: var(--black);
                }
            
                .card__button:focus {
                    outline: 2px solid black;
                    outline-offset: -5px;
                }
            
                @media (any-hover: hover) and (any-pointer: fine) {
                    .card__content {
                        transform: translateY(62%);
                        transition: transform 500ms ease-out;
                        transition-delay: 500ms;
                    }
            
                    .card__title::after {
                        opacity: 0;
                        transform: scaleX(0);
                        transition: opacity 1000ms ease-in, transform 500ms ease-out;
                        transition-delay: 500ms;
                        transform-origin: right;
                    }
            
                    .card__background {
                        transition: transform 500ms ease-in;
                    }
            
                    .card__content--container> :not(.card__title),
                    .card__button {
                        opacity: 0;
                        transition: transform 500ms ease-out, opacity 500ms ease-out;
                    }
            
                    .card:hover,
                    .card:focus-within {
                        transform: scale(1.05);
                        transition: transform 500ms ease-in;
                    }
            
                    .card:hover .card__content,
                    .card:focus-within .card__content {
                        transform: translateY(0);
                        transition: transform 500ms ease-in;
                    }
            
                    .card:focus-within .card__content {
                        transition-duration: 0ms;
                    }
            
                    .card:hover .card__background,
                    .card:focus-within .card__background {
                        transform: scale(1.3);
                    }
            
                    .card:hover .card__content--container> :not(.card__title),
                    .card:hover .card__button,
                    .card:focus-within .card__content--container> :not(.card__title),
                    .card:focus-within .card__button {
                        opacity: 1;
                        transition: opacity 500ms ease-in;
                        transition-delay: 1000ms;
                    }
            
                    .card:hover .card__title::after,
                    .card:focus-within .card__title::after {
                        opacity: 1;
                        transform: scaleX(1);
                        transform-origin: left;
                        transition: opacity 500ms ease-in, transform 500ms ease-in;
                        transition-delay: 500ms;
                    }
                }
            </style>
            

































































            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="containerFooter">
                <h1>Contactanos</h1>
                <p>Visita nuestra página principal en <a href="index.html">Inicio</a></p>
                <p>Creado por <a href="https://www.typenote.io">Typenote</a></p>
                <p>Powered by <a href="https://www.w3schools.com/w3css/">W3.CSS</a></p>
            </div>


    </div>
    </main>

    </div>



    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/swiper/swiper-bundle.min.js') }}"></script>

    {{-- SCRIPT PARA CERRAR LA PAGINA --}}
    <script>
        document.querySelector(".btn-danger").addEventListener("click", function() {
            window.close(); // Intenta cerrar la ventana/pestaña actual
        });
    </script>
</body>
