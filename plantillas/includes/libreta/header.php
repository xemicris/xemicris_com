<!DOCTYPE html>
<html lang="es">
<head>
    <!--Agregar rutabase para definir a partir de donde se deben generar los enlaces y carga de archivos-->
    <base href="<?php echo RUTABASE; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://code.jquery.com/jquery-3.7.1.min.js https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js https://www.hCaptcha.com/1/api.js https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js; object-src 'self'">
    <meta name="description" content="Libreta donde insertar ingresos y gastos">
    <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
    <title><?php echo isset($datosObjeto->titulo) ? obtenerTitulo() . ' | ' . 
        $datosObjeto->titulo : obtenerTitulo() . ' | Portafolio'; ?></title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" fetchpriority="low">
    <!--toastr-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" fetchpriority="low">
    <!--waitme-->
    <link rel="stylesheet" href="<?php echo PLUGINS . 'waitme/waitMe.min.css' ?>" fetchpriority="low">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" fetchpriority="low">
    <!--css-->
    <link href="<?php echo CSS . 'libreta.css'; ?>" rel="stylesheet" fetchpriority="low">
    <!--<link rel="stylesheet" type="text/css" href="/frameworkProyecto/publico/css/formulario-app-mov.css">-->
</head>
<body class="<?php echo isset($datosObjeto->fondo) && $datosObjeto->fondo === 'oscuro'
    ? 'bg-dark' : 'bg-light' ?>" style="<?php echo 'padding: ' . (isset($datosObjeto->padding)
    ? $datosObjeto->padding : '0px 0px'); ?>")>