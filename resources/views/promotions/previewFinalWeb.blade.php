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

    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3697c1;
            --accent: #e74c3c;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --radius: 12px;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Base Styles */
        body.index-page {
            min-height: 100vh;
            background: var(--light);
            font-family: 'Segoe UI', system-ui, sans-serif;
            line-height: 1.6;
            color: var(--dark);
        }

        .content {
            max-width: 1440px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Banner Section */
        .kode-silder figure {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .kode-silder figcaption {
            padding: 2rem;
            background: white;
            margin: 1rem 0;
            border-radius: var(--radius);
        }

        .kode-silder img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
        }

        /* Main Content Layout */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2.5rem;
            margin: 3rem 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        /* Promotions Section */
        .promotionsRelations {
            display: grid;
            gap: 1.5rem;
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .ag-courses_item {
            /*color de las tarjetas de tterminos y condiciones*/
            background: rgb(255, 255, 255);
            border-radius: var(--radius);
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .ag-courses-item_link {
            display: block;
            padding: 1.5rem;
            color: var(--dark);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .ag-courses-item_bg {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: var(--secondary);
            opacity: 0.1;
            transform: rotate(45deg);
            transition: var(--transition);
        }

        .ag-courses-item_title {
            position: relative;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .ag-courses_item:hover {
            transform: translateY(-5px);
        }

        /* Form Styles */
        .contentArticlee .mb-3 {
            margin-bottom: 1.5rem;
        }

        .contentArticlee label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--primary);
        }

        .contentArticlee input,
        .contentArticlee select,
        .contentArticlee textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            transition: var(--transition);
        }

        .contentArticlee input:focus,
        .contentArticlee select:focus,
        .contentArticlee textarea:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(54, 151, 193, 0.2);
        }

        /* Featured Promotions */
        .product_section2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .box_main {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .box_main:hover {
            transform: translateY(-5px);
        }

        /* Upcoming Card */
        .card {
            position: relative;
            isolation: isolate;
            border-radius: var(--radius);
            overflow: hidden;
            max-width: 800px;
            margin: 2rem auto;
        }

        .card__background {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .card__content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            color: white;
        }

        /* Footer */
        .containerFooter {
            text-align: center;
            padding: 3rem 0;
            margin-top: 4rem;
            border-top: 1px solid #e2e8f0;
        }

        .containerFooter a {
            color: var(--secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .containerFooter a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .promotionsRelations {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }

            .kode-silder img {
                height: 300px;
            }

            .product_section2 {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        [data-aos="fade-up"] {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .shadow {
            box-shadow: var(--shadow);
        }

        .rounded {
            border-radius: var(--radius);
        }
    </style>

<body class="index-page">
    <div class="content">
        <main class="main">
            <div class="post-content" data-aos="fade-up">
                <div class="containerTitlee" style="padding: 20px;">
                    <div class="kode-silder">
                        <figure>
                            <figcaption
                                style="background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                                <div class="kode-inner-page-bnr-capion">
                                    <h1
                                        style="text-align: center; font-size: 24px; font-weight: normal; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">
                                        {{ $previewFinalWeb->title }}</h1>
                                </div>
                            </figcaption>
                            <img src="{{ asset($previewFinalWeb->banners) }}" class="img-responsive" alt=""
                                style="width: 100%; height: auto; object-fit: cover; background-color:red;">
                            <figcaption
                                style="background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                                <div class="kode-inner-page-bnr-capion">
                                    <h1 style="text-align: center; font-size: 24px; font-weight: normal;">
                                        {{ $previewFinalWeb->subtitle }}</h1>

                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <style>
                    /* Scroll Horizontal Modificado */
                    .promotionsRelations {
                        display: grid;
                        grid-auto-flow: column;
                        gap: 2rem;
                        overflow-x: auto;
                        padding: 2rem 0;
                        scroll-snap-type: x mandatory;
                    }

                    .ag-courses_item {
                        scroll-snap-align: start;
                        min-width: min(400px, 80vw);
                        background: #fff;
                        border-radius: var(--radius);
                        box-shadow: var(--shadow);
                        transition: var(--transition);
                        position: relative;
                        overflow: hidden;
                    }

                    .ag-courses-item_link {
                        display: block;
                        padding: 2rem;
                        color: var(--dark);
                        /* Color normal negro */
                        text-decoration: none;
                        position: relative;
                    }

                    .ag-courses-item_bg {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: var(--secondary);
                        opacity: 0;
                        transition: opacity 0.4s ease;
                        z-index: 1;
                    }

                    .ag-courses-item_title {
                        position: relative;
                        z-index: 2;
                        /* Asegura que el texto esté encima del fondo */
                        transition: color 0.3s ease;
                    }

                    /* Efecto Hover */
                    .ag-courses_item:hover {
                        transform: translateY(-5px);
                    }

                    .ag-courses_item:hover .ag-courses-item_bg {
                        opacity: 0.1;
                        /* Fondo sutil al hacer hover */
                    }

                    .ag-courses_item:hover .ag-courses-item_title {
                        color: var(--secondary);
                        /* Color azul al hacer hover */
                    }

                    /* Borde dinámico mejorado */
                    .ag-courses_item::after {
                        content: '';
                        position: absolute;
                        inset: 0;
                        border-radius: var(--radius);
                        border: 2px solid transparent;
                        transition: border-color 0.3s ease;
                    }

                    .ag-courses_item:hover::after {
                        border-color: rgba(54, 151, 193, 0.3);
                    }

                    /* Scrollbar */
                    .promotionsRelations::-webkit-scrollbar {
                        height: 6px;
                    }

                    .promotionsRelations::-webkit-scrollbar-thumb {
                        background: var(--secondary);
                        border-radius: 4px;
                    }

                    /* Responsive */
                    @media (max-width: 768px) {
                        .ag-courses-item_link {
                            padding: 1.5rem;
                        }

                        .ag-courses_item {
                            min-width: 280px;
                        }
                    }
                </style>




                {{-- <div class="client_section layout_padding">
                    <div class="container">
                        <div class="promotion_section2 layout_padding">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <!-- <div class="miller_text_Promotion">
                                        <span class="quote_icon_Promotion">
                                            <img src="{{ asset($previewFinalWeb->banners) }}" alt="Banner"
                                                class="img-fluid">
                                        </span>
                                    </div> -->
                                    <br>
                                    <br>
                                    <h3 class="choose_textDateTime">
                                        Inicio:
                                        {{ \Carbon\Carbon::parse($previewFinalWeb->start_date)->format('d-m-Y') }}
                                        &nbsp;
                                        Finalización:
                                        {{ \Carbon\Carbon::parse($previewFinalWeb->end_date)->format('d-m-Y') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <style>
                    .contentArticlee {
                        background: #ffffff;
                        border-radius: var(--radius);
                        box-shadow: var(--shadow);
                        margin: 3rem 0;
                        overflow: hidden;
                        position: relative;
                        transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                    }

                    .contentArticlee::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 4px;
                        height: 100%;
                        background: linear-gradient(180deg,
                                var(--secondary) 0%,
                                var(--primary) 100%);
                        z-index: 2;
                        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
                    }

                    /* Efecto de brillo en el borde */
                    .contentArticlee:hover::before {
                        filter: brightness(1.2);
                        box-shadow: 0 0 15px rgba(54, 151, 193, 0.4);
                    }

                    /* Mejora de la transición */
                    .contentArticlee:hover {
                        transform: translateY(-3px);
                    }

                    /* Añade estas reglas */
                    .text-containerr {
                        padding: 3rem;
                        position: relative;
                        overflow: hidden;
                    }

                    /* Efecto de iluminación al hacer hover */
                    .contentArticlee::after {
                        content: '';
                        position: absolute;
                        top: -50%;
                        left: -50%;
                        width: 200%;
                        height: 200%;
                        background: radial-gradient(circle at 50% 50%,
                                rgba(54, 151, 193, 0.1) 0%,
                                rgba(255, 255, 255, 0) 70%);
                        pointer-events: none;
                        transition: opacity 0.6s ease;
                        opacity: 0;
                    }

                    .contentArticlee:hover::after {
                        opacity: 1;
                    }

                    /* Animación de entrada */
                    @keyframes articleEntrance {
                        from {
                            opacity: 0;
                            transform: translateY(30px) rotateX(15deg);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0) rotateX(0);
                        }
                    }

                    .contentArticlee {
                        animation: articleEntrance 0.8s cubic-bezier(0.23, 1, 0.32, 1) both;
                        transform-origin: center top;
                    }
                </style>

                <div class="contentArticlee">
                    <div class="text-containerr">
                        <!-- Mostrar el contenido del artículo -->
                        <p class="lorem_textss">{!! $previewFinalWeb->content !!}</p>

                        <hr>
                        <!-- Mostrar el contenido del formulario (decodificado de JSON) -->
                        @if ($formContent)
                            <div class="">
                                <!-- <h3>Contenido del formulario: </h3> -->
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

                                        @case('button')
                                            <div class="mb-3">
                                                <button type="button"
                                                    class="{{ $field['className'] ?? 'btn btn-primary' }}">
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


                <h2 style="text-align: center;">Terminos y condiciones</h2>
                <div class="main-content">
                    <!-- Sección de promociones relacionadas -->
                    <section class="promotionsRelations">
                        <!-- Tarjeta 1 -->
                        <div class="ag-courses_item">
                            <a href="{{ json_decode($previewFinalWeb->link)->link }}" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">
                                    <small>{{ json_decode($previewFinalWeb->link)->name }}</small>
                                </div>
                                <!-- Agrega más contenido si es necesario -->
                            </a>
                        </div>

                        <!-- Tarjeta 2 -->
                        <div class="ag-courses_item">
                            <a href="#" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">
                                    <small>{{ $previewFinalWeb->terms }}</small>
                                </div>
                            </a>
                        </div>

                        <!-- Tarjeta 3 -->
                        <div class="ag-courses_item">
                            <a href="#" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">
                                    <small>{{ json_decode($previewFinalWeb->extras)->extras }}</small>
                                </div>
                            </a>
                        </div>
                    </section>
                </div>


                <div class="product_section layout_padding">
                    <div class="container">
                        <h1 class="choose_text">Promociones Destacables</h1>

                        <div class="containerFooter">
                            <div class="ag-format-container">
                                <h1>Promociones Destacadas</h1>
                                <div class="ag-courses_box">
                                    @foreach ($publishedPromotions as $promotion)
                                        <div class="ag-courses_item">
                                            <a href="{{ route('promotions.previewFinalWeb', ['promotion_id' => $promotion->promotion_id, 'alias' => $promotion->alias]) }}"
                                                class="ag-courses-item_link">

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


                    <br>
                    <br>
                    <div class="CardProx" style="background-color: #ffffffd2; padding: 40px 20px; height: auto;">
                        <h1 style="color: rgb(0, 0, 0); text-align: center;">Próximamente</h1>

                        <article class="card">
                            <img class="card__background" src="{{ asset($previewFinalWeb->mini_Image) }}"
                                alt="Banner"
                                alt="Photo of Cartagena's cathedral at the background and some colonial style houses"
                                width="1920" height="2193" />
                            <div class="card__content | flow">
                                <div class="card__content--container | flow">
                                    <h2 class="card__title">{{ $previewFinalWeb->title }}</h2>
                                    <p class="card__description">
                                        {{ $previewFinalWeb->subtitle }}
                                    </p>
                                </div>
                                <button class="card__button"></button>
                            </div>
                        </article>
                    </div>


                    <style>
                        .containerFoo {
                            background: var(--dark);
                            color: var(--light);
                            padding: 4rem 2rem;
                            text-align: center;
                            position: relative;
                            overflow: hidden;
                            margin-top: 6rem;
                        }

                        .containerFoo::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 4px;
                            background: linear-gradient(90deg, var(--secondary), var(--primary));
                            animation: borderFlow 6s infinite linear;
                        }

                        @keyframes borderFlow {
                            0% {
                                background-position: 0% 50%;
                            }

                            50% {
                                background-position: 100% 50%;
                            }

                            100% {
                                background-position: 0% 50%;
                            }
                        }

                        .containerFoo h1 {
                            font-size: 2.5rem;
                            margin-bottom: 1.5rem;
                            background: linear-gradient(45deg, var(--secondary), var(--primary));
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            letter-spacing: 1px;
                            position: relative;
                            display: inline-block;
                            padding: 0 1rem;
                        }

                        .containerFoo p {
                            font-size: 1.1rem;
                            margin: 1rem 0;
                            color: rgba(255, 255, 255, 0.9);
                            line-height: 1.8;
                        }

                        .containerFoo a {
                            color: var(--light);
                            text-decoration: none;
                            position: relative;
                            transition: var(--transition);
                            font-weight: 600;
                        }

                        .containerFoo a::after {
                            content: '';
                            position: absolute;
                            bottom: -2px;
                            left: 0;
                            width: 0;
                            height: 2px;
                            background: var(--secondary);
                            transition: width 0.3s ease;
                        }

                        .containerFoo a:hover::after {
                            width: 100%;
                        }

                        /* Efecto de partículas */
                        .containerFoo::after {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-image: radial-gradient(circle at 50% 50%,
                                    rgba(255, 255, 255, 0.1) 1px,
                                    transparent 1px);
                            background-size: 20px 20px;
                            opacity: 0.3;
                            pointer-events: none;
                        }

                        /* Social Icons (opcional) */
                        .social-links {
                            display: flex;
                            justify-content: center;
                            gap: 1.5rem;
                            margin: 2rem 0;
                        }

                        .social-links a {
                            font-size: 1.5rem;
                            padding: 0.5rem;
                            border-radius: 50%;
                            width: 40px;
                            height: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: rgba(255, 255, 255, 0.1);
                            transition: var(--transition);
                        }

                        .social-links a:hover {
                            background: var(--secondary);
                            transform: translateY(-3px);
                        }

                        /* Responsive */
                        @media (max-width: 768px) {
                            .containerFoo {
                                padding: 3rem 1rem;
                            }

                            .containerFoo h1 {
                                font-size: 2rem;
                            }

                            .social-links {
                                gap: 1rem;
                            }
                        }

                        /* Legal Info */
                        .legal-info {
                            margin-top: 2rem;
                            font-size: 0.9rem;
                            color: rgba(255, 255, 255, 0.6);
                        }

                        .legal-info a {
                            color: rgba(255, 255, 255, 0.8);
                        }
                    </style>
                    <div class="containerFoo">
                        <h1>Contáctanos</h1>

                        <!-- Social Icons (opcional) -->
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="far fa-envelope"></i></a>
                        </div>

                        <p>Visita nuestra página principal</p>
                        <p>Creado por nubeMx</p>

                        <!-- Legal Info -->
                        <div class="legal-info">
                            <p>© 2024 Todos los derechos reservados</p>
                            <p><a href="#">Términos de servicio</a> | <a href="#">Política de
                                    privacidad</a></p>
                        </div>
                    </div>


                </div>
        </main>

    </div>


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/assetsShowFinalWeb/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- SCRIPT PARA CERRAR LA PAGINA -->

    <script>
        document.querySelector(".btn-danger").addEventListener("click", function() {
            window.close(); // Intenta cerrar la ventana/pestaña actual
        });
    </script>
</body>
