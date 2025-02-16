

{{-- ESTO ES DE PROMOCIONES --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/managerImagen.css') }}">

<body>
    <div class="overlay" id="overlay">

    </div>
    <div id="ImagenManager">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 bg-one">
                <div class="m-3 list-folders">
                    <span class="text-secondary col-12" for="folder"><i class="fas fa-chevron-down"></i><strong> CARPETAS</strong></span>
                    <button type="button" class="btn btn-format folder-btn" name="autores"> <i class="fas fa-folder"></i><span class="text">autores</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="banners"> <i class="fas fa-folder"></i><span class="text">banners</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="completas"> <i class="fas fa-folder"></i><span class="text">completas</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="documentos"> <i class="fas fa-folder"></i><span class="text">documentos</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="galerias"> <i class="fas fa-folder"></i><span class="text">galerias</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="gifts"> <i class="fas fa-folder"></i><span class="text">gifts</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="guias"> <i class="fas fa-folder"></i><span class="text">guias</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="home"> <i class="fas fa-folder"></i><span class="text">home</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="mini"> <i class="fas fa-folder"></i><span class="text">mini</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="noticias"> <i class="fas fa-folder"></i><span class="text">noticias</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="noticiashome"> <i class="fas fa-folder"></i><span class="text">noticiashome</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="ogimagen"> <i class="fas fa-folder"></i><span class="text">ogimagen</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="post"> <i class="fas fa-folder"></i><span class="text">post</span></button>
                    <button type="button" class="btn btn-format folder-btn" name="promociones"> <i class="fas fa-folder"></i><span class="ml-1 text">promociones</span></button>

                </div>

            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 bg-two">
                <div class="images">
                    <div id="location">
                        <i class="fa-folder fa-solid fa-folder-open"></i>
                        <p class="d-inline text" id="nameFolder">autores</p>
                    </div>
                    <div id="list-images" class="list-images d-flex flex-wrap gap-2">
                    <!-- Se enlistan todas las imagenes que tenga la carpeta que se elija-->
                    </div>

                    <div class="p-2 d-flex justify-content-end align-items-end " >
                        <button type="button" class="btn btn-sm mx-2 px-5 btn-secondary" id="closeModal">Cancelar</button>
                        <button type="button" class="btn btn-sm px-5 mx-4 btn-secondary" id="AddImagen" disabled>Abrir</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<!-- *************************** -->
 <!-- PASO 5: COPIA LA FUNCION showImages DENTRO DE ArticleController.php Y PEGALA AL CONTROLER DE LA VISTA  -->