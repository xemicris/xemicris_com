<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js; object-src 'self'">
    <meta name="description" content="Catalogo de libros">
    <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
    <title><?php echo $datos['titulo']; ?></title>
    <link href="<?php echo CSS . 'biblioteca.css'; ?>" rel="stylesheet" type="text/css"  fetchpriority="low">
</head>
<body>
    <header id="imagen_principal">
        <div id="contenido_imagen_principal">
            <a href="<?php echo RUTABASE . "biblioteca"; ?>"><h1 id="titulo">Catálogo de libros</h1></a>
        </div>
    </header>
    <main>
        <div class="casa__contenedor">
            <a href="<?php echo RUTABASE . "trabajos"; ?>" aria-label="Volver a xemicris">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </a>
        </div>
        <div class="bloque__busqueda">
            <div id="busqueda">
                <div><a href="<?php echo RUTABASE . "biblioteca";?>" alt="Lista de libros">Títulos</a></div>
                <div><a href="<?php echo RUTABASE . "biblioteca/autores"; ?>" alt="Lista de autores">Autores</a></div>
            </div>
            <?php 
                echo(buscadorBiblioteca()); 
            ?>
        </div>
        <section id="cuerpo_principal">