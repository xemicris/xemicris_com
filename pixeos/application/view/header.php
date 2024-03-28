<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" link rel="preload" as="style">
    <script src="https://kit.fontawesome.com/d7d3a2cbd3.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Raleway:wght@400;700;900&display=swap" rel="stylesheet" link rel="preload" as="style">
    <link rel="stylesheet" href="<?php echo RUTA ?>public\css\bootstrap.min.css" link rel="preload" as="style">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" link rel="preload" as="style"></script>
    <link rel="shortcut icon" href="<?php echo RUTA . 'public/images/logo-movil.ico'; ?>">
    <link rel="stylesheet" href="<?php echo RUTA ?>css/style.css">
    <title><?php echo $datos['titulo'] ?></title>
    <meta name="theme-color" content="#F5BC51">
</head>

<body class="body">
    <!-- Contenedor general -->
    <!-- Panel -->
    <?php
    $urlActual = $_SERVER["REQUEST_URI"];
    $url = encabezado(($urlActual));
    if (
        $url == 'panel' || $url == 'viewStatistics' || $url == 'profile' || $url == 'project' ||
        $url == 'contact' || $url == 'calendar'
    ) {
    ?>
        <!-- Menú superior -->
        <nav id="barraSuperior" class="navbar navbar-expand-lg bg-light fixed-top">
            <div class="container-fluid">
                <!-- botón desplegar barraLateral -->
                <button id="biz" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBarraLateral" aria-controls="offcanvasBarraLateral">
                    <span id="boton-izquierdo" class="navbar-toggler-icon"></span>
                </button>

                <a class="color-logo navbar-brand fw-bold " href="<?php echo RUTA . 'panel/panel' ?>">
                    <img id="logo" src="<?php echo RUTA . 'public/images/logo-claro.avif'; ?>" alt="logo">
                </a>

                <button id="dde" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="boton-derecho" class="navbar-toggler-icon"></span>
                </button>

                <div class="menu-superior collapse navbar-collapse d-lg-flex justify-content-between" id="navbarSupportedContent">
                    <div class="logo-superior-contenedor mt-3">
                        <p id="logo-superior" class="navbar-brand fw-bold">¡Hola de nuevo <?php echo $datos['usuario']['nombre'] ?>!</p>
                    </div>
                    <div>
                        <ul class="navbar-nav mb-2 mb-lg-0 me-lg-4">
                            <li class="nav-item dropdown">
                                <a id="flecha-desplegable" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if (isset($datos['usuario']['imagen']) && !empty($datos['usuario']['imagen'])) { ?>
                                        <img class="perfil-pequeno" src="<?php echo RUTA . "images/" . $datos['usuario']['imagen'] ?>">
                                    <?php } else { ?>
                                        <i class="bi bi-person fs-2"></i>
                                    <?php } ?>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo RUTA . 'panel/profile' ?>">Perfil</a></li>
                                    <li><a id="fondo" class="dropdown-item" href="#">Modo oscuro</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo RUTA . 'panel/closeSesion';  ?>">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!--Fin menú superior -->

        <aside>
            <!-- Barra lateral -->
            <div class="offcanvas offcanvas-start sidebar-nav barra-lateral" tabindex="-1" id="offcanvasBarraLateral" aria-labelledby="offcanvasBarraLateral">
                <!-- aspa -->
                <div class="cerrar-barra-lateral d-flex justify-content-end"><i class="bi bi-x fs-2 me-3 mt-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBarraLateral"></i></div>
                <div class="offcanvas-body p-0 d-flex flex-column align-items-center">
                    <div class="fs-3 text-center">
                        <?php
                        $urlActual = $_SERVER["REQUEST_URI"];
                        $url = encabezado(($urlActual));
                        if ($url == 'project') {

                            foreach ($datos['proyecto'] as $dato) : ?>
                                <p class="proyecto <?php echo $dato['colorProyecto'] ?>"><?php echo $dato['nombreProyecto'] ?></p>
                        <?php endforeach;
                        }
                        ?>
                    </div>
                    <nav id="texto-navegacion-izquierda" class="navbar-light">
                        <ul class="navbar-nav mt-5">
                            <li id="activarInicio"></li>
                            <?php
                            $urlActual = $_SERVER["REQUEST_URI"];
                            $url = encabezado(($urlActual));
                            if ($url != 'panel') { ?>
                                <li class="barra-color">
                                    <a href="<?php echo RUTA . 'panel/panel' ?>" class="cambio-color nav-link px-3 active mb-3">
                                        <span class="me-1"><i class="bi bi-diagram-3"></i></span>
                                        <span class="titulo-notas">Notas</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            $urlActual = $_SERVER["REQUEST_URI"];
                            $url = encabezado(($urlActual));
                            if ($url == 'panel') {
                            ?>
                                <li class="barra-color">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal1" class="crear cambio-color nav-link px-3 active mb-3">
                                        <span class="me-1"><i class="bi bi-folder-plus"></i></span>
                                        <span>Crear Nota</span>
                                    </a>
                                </li>
                            <?php }
                            if ($url == 'panel' || $url == 'contact' || $url == 'project'  || $url == 'profile' || $url == 'calendar') { ?>
                                <li class="barra-color">
                                    <a href="<?php echo RUTA . 'panel/viewStatistics' ?>" id="estadisticas" class="cambio-color nav-link px-3 active mb-3">
                                        <span class="me-1"><i class="bi bi-bar-chart"></i></span>
                                        <span>Estadísticas</span>
                                    </a>
                                </li>
                            <?php }
                            if ($url != 'calendar') { ?>
                                <li class="barra-color">
                                    <a href="<?php echo RUTA . 'panel/calendar' ?>" class="cambio-color nav-link px-3 active mb-3">
                                        <span class="me-1"><i class="bi bi-calendar3"></i></span>
                                        <span>Calendario</span>
                                    </a>
                                </li>

                            <?php }
                            if ($url != 'contact') { ?>
                                <li class="barra-color">
                                    <a href="<?php echo RUTA . 'panel/contact' ?>" class="cambio-color nav-link px-3 active mb-3">
                                        <span class="me-1"><i class="bi bi-envelope"></i></span>
                                        <span>Contacto</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="barra-color">
                                <a href="<?php echo XEMICRIS . 'resumenPixeos'; ?>" class="cambio-color nav-link px-3 active mb-3">
                                    <span class="me-1"><img id="iconoXemicris" src="<?php echo RUTA . 'public/images/xemicris.svg'; ?>" alt="Icono para ir a xemicris"></span>
                                    <span>Ir a xemicris</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div><!-- fin Barra lateral -->
        </aside>
    <?php
    } else if ($url == 'admin' || $url == 'tec') { ?>
        <!-- Menú superior -->
        <nav class="navbar navbar-expand-lg bg-dark fixed-top barraSuperiorOscura">
            <div class="container-fluid">

                <a class="color-logo navbar-brand fw-bold " href="<?php echo RUTA . 'admin/admin' ?>">
                    <img id="logo" src="<?php echo RUTA ?>public/images/logo-oscuro.png" alt="logo">
                </a>
                <button id="dde" class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="boton-derecho" class="navbar-toggler-icon navbar-dark"></span>
                </button>

                <div class="collapse navbar-collapse d-lg-flex justify-content-between" id="navbarSupportedContent">
                    <div class="mt-3 ms-5">
                        <p id="logo-superior" class="navbar-brand fw-bold text-white">¡Hola de nuevo <?php echo $datos['usuario']['nombre'] ?>!</p>
                    </div>
                    <div>
                        <ul class="navbar-nav mb-2 mb-lg-0 me-lg-5">
                            <li class="nav-item dropdown">
                                <a id="flecha-desplegable" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person fs-2 text-white"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo RUTA . 'panel/closeSesion';  ?>">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!--Fin menú superior -->
    <?php } ?>