<!DOCTYPE html>
<html lang="es">

<head>
  <!--Agregar rutabase para definir a partir de donde se deben generar los enlaces y carga de archivos-->
  <base href="<?php echo RUTABASE; ?>">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js; object-src 'self'">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" fetchpriority="low">
    <!--waitme-->
    <link rel="stylesheet" href="<?php echo PLUGINS . 'waitme/waitMe.min.css' ?>" crossorigin="anonymous" fetchpriority="low">
  <?php
  } else if (uriJavascript() === 'gestorProductos' || uriJavascript() === 'juegoMemoria') { ?>
    <!-- video.css -->
    <link href="<?php echo CSS . 'video-js.min.css'; ?>" rel="stylesheet" type="text/css" crossorigin="anonymous" fetchpriority="low">
  <?php } else if (uriJavascript() === 'trabajos') { ?>
    <!-- slider - trabajos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" crossorigin="anonymous" fetchpriority="low" />
  <?php } ?>
  <!--css-->
  <link async href="<?php echo CSS . 'home.css'; ?>" rel="stylesheet" type="text/css" fetchpriority="low">
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
        <img src="<?php echo IMAGENES . "home/menu_cerrado.svg"; ?>" alt="menu cerrado" class="menu_cerrado" width="35" height="35" loading="lazy">
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