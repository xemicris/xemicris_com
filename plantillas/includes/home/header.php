<!DOCTYPE html>
<html lang="es">

<head>
  <!--Agregar rutabase para definir a partir de donde se deben generar los enlaces y carga de archivos-->
  <base href="<?php echo RUTABASE; ?>">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self'; object-src 'self'">
  <meta name="theme-color" content="#FF9BE1">
  <meta name="description" content="Portafolio xemicris.com">
  <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
  <title>
    <?php echo isset($datos['titulo']) ? $datos['titulo'] : "xemicris.com"; ?>
  </title>
  <!--ENLACES-->
  <?php
  if (uriJavascript() === 'contacto') { ?>
    <!--toastr-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--waitme-->
    <link rel="stylesheet" href="<?php echo PLUGINS . 'waitme/waitMe.min.css' ?>">
  <?php
  } else if (uriJavascript() === 'gestorProductos' || uriJavascript() === 'juegoMemoria') { ?>
    <!-- video.css -->
    <link href="<?php echo CSS . 'video-js.min.css'; ?>" rel="stylesheet" type="text/css" fetchpriority="low">
  <?php } else if (uriJavascript() === 'trabajos') { ?>
    <!--remixicons - trabajo -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" fetchpriority="low">
    <!-- slider - trabajos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" fetchpriority="low" />
  <?php } else if (uriJavascript() === 'masinfo') { ?>
    <!--remixicons - perfil-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" fetchpriority="low">
  <?php } ?>
  <!--css-->
  <link async href="<?php echo CSS . 'home.css'; ?>" rel="stylesheet preload prefetch" as="style" type="text/css" fetchpriority="low" media="screen">
  <!--FIN ENLACES-->
</head>

<body>
  <header>
    <div class="barra">
      <div class="logo"><a href="<?php echo RUTABASE . ''; ?>">Desarrollador Web</a></div>
      <ul class="enlaces">
        <li><a href="<?php echo RUTABASE . "masinfo"; ?>">+ Info</a></li>
        <li><a href="<?php echo RUTABASE . "trabajos"; ?>">Trabajos</a></li>
        <li><a href="<?php echo RUTABASE . "contacto"; ?>">Contacto</a></li>

        <?php
          $url = isset($_GET['uri']) ? $_GET['uri'] : '';
          if ($url == 'juegoMemoria' || $url == 'gestorProductos') {
            echo "<li><a href='" . RUTABASE . "trabajos'>Volver</a></li>";
          }
        ?>
      </ul>
      <a href="<?php echo RUTABASE . "resumenPixeos"; ?>" class="boton">Pixeos</a>
      <div class="boton_movil">
        <img src="<?php echo IMAGENES . "home/menu_cerrado.svg"; ?>" alt="menu cerrado" class="menu_cerrado" width="35" height="35">
      </div>
      <img src="<?php echo IMAGENES . "home/menu_abierto.svg"; ?>" alt="menu abierto" class="menu_abierto menu_uso" width="45" height="45" loading="lazy">
    </div>
    </div>
    </div>
    <ul class="menu">
      <li><a href="<?php echo RUTABASE . "masinfo"; ?>">+ Info</a></li>
      <li><a href="<?php echo RUTABASE . "trabajos"; ?>">Trabajos</a></li>
      <li><a href="<?php echo RUTABASE . "contacto"; ?>">Contacto</a></li>
      <?php
        $url = isset($_GET['uri']) ? $_GET['uri'] : '';
        if ($url == 'juegoMemoria' || $url == 'gestorProductos') {
          echo "<li><a href='" . RUTABASE . "trabajos'>Volver</a></li>";
        }
      ?>
      <li><a href="<?php echo RUTABASE . "resumenPixeos"; ?>" class="boton">Pixeos</a></li>
      </ul>
  </header>