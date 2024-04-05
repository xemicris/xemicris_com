<!DOCTYPE html>
<html lang="es">

<head>
  <!--Agregar rutabase para definir a partir de donde se deben generar los enlaces y carga de archivos-->
  <base href="<?php echo RUTABASE; ?>">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#FF9BE1">
  <title>
    <?php echo isset($datos['titulo']) ? $datos['titulo'] : "xemicris.com"; ?>
  </title>

  <!--ENLACES-->
  <!--bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!--font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--remixicons - perfil-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <!-- slider - trabajos-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- video.css -->
  <link href="<?php echo CSS . 'video-js.min.css'; ?>" rel="stylesheet" type="text/css">
  <!--css-->
  <link href="<?php echo CSS . 'home.css'; ?>" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
  <?php
  if (uriJavascript() === 'contacto') : ?>
    <!--toastr-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--waitme-->
    <link rel="stylesheet" href="<?php echo PLUGINS . 'waitme/waitMe.min.css' ?>">
  <?php endif; ?>

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
        <i class="fa-sharp fa-solid fa-bars"></i>
      </div>
    </div>
    <div class="menu">
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
    </div>
  </header>