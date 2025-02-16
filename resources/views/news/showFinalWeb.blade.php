<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{ asset('assets/img/imgs/titleShowFinalWeb2.png') }}" type="image/x-icon">
    <title class="fa fa-user">Noticia Publicada:  {{ $newsNotice->title }} </title>
 <!-- Metadata -->
 @if(!empty($metadata))
 @foreach ($metadata as $key => $value)
 <meta name="{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
 @endforeach
@endif

<!-- OG Data -->
@if(!empty($ogdata))
 @foreach ($ogdata as $key => $value)
  <meta property="og:{{ $key }}" content="{{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}">
 @endforeach
 @if ($newsNotice->images)
 <meta property="og:image" content="{{ asset('storage/' . $newsNotice->images) }}">
 @endif
@endif

<!-- Microdata -->
@if(!empty($microdata))
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/css/finalWeb.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/assetsShowFinalWeb/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/assetsShowFinalWeb/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/assetsShowFinalWeb/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/assetsShowFinalWeb/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/assetsShowFinalWeb/css/main.css') }}" rel="stylesheet">

    <style>
        body {
            line-height: 1.6;
        }
        .index-page {
            background-color: rgb(3, 13, 37);
        }

        /* Contenido de la noticia */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fffffffe;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }

        .post-meta li {
            display: inline;
            margin-right: 15px;
            color: #6c757d;
        }

        .post-meta strong {
            color: #007bff;
        }

        small {
            display: block;
            margin-top: 15px;
            color: #6c757d;
        }

        /* Estilos del waves */
        .custom-shape-divider-top-1731907248 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1731907248 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .custom-shape-divider-top-1731907248 .shape-fill {
            fill: #FFFFFF;
        }

        /* Estilos para el botón con el efecto hover */
        /* body {
  font-family: "Lato", sans-serif;
} */

.wrapper {
  position: fixed;
  bottom: 20px; /* Mantén el botón 20px desde la parte inferior */
  left: 50%;
  transform: translateX(-50%); /* Centra el botón horizontalmente */
  z-index: 9999; /* Asegura que esté por encima de otros elementos */
}


body, html {
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
  background: #dc3545; /* Rojo (btn-danger) */
  text-align: center; /* Alienas el texto dentro del boton */
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 3px solid #dc3545;
  transition: all 0.35s;
  position: relative;
  margin: 0 auto; /* Centra el botón */
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
  fill: #2ecc71; /* Color verde */
  transition: all 0.35s;
}

button:hover {
  width: 200px;
  border: 3px solid #b01f11; /* Verde en hover */
  background: transparent;
  color: #cc2e2e; /*color de la letra del boton*/
}

button:hover + .icon {
  border: 3px solid #2ecc71;
  right: -25%;
}


    </style>

</head>

   
<body class="index-page">
    <div class="content">
        <main class="main">
            <div class="post-content" data-aos="fade-up">
                <ul class="post-meta">
                    <li><i class="bi bi-calendar-event"></i> Fecha: <strong>{{ $newsNotice->publish_date }}</strong></li>
                </ul>

                <div class="custom-shape-divider-top-1731907248">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                    </svg>
                </div>

           

                <div class="container">
                    {{-- <h1>{{ $newsNotice->title }}</h1> --}}
                    <div>{!! $newsNotice->content !!}</div>
                    <small>Publicado por: {{ $newsNotice->news_id }}</small>
                    <small>Publicado el: {{ $newsNotice->publish_date }}</small>
                    
                 
                </div>
                   <!-- Agregar el botón con hover  para salir-->
                <div class="button-close">
                    <button type="button" class="btn btn-danger me-3" onclick="window.history.back();">Cerrar</button>
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
</html>
