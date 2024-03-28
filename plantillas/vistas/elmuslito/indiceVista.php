<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $datos['titulo']; ?></title>
        <!-- etiqueta que vincula el documento HTML con la hoja de estilos CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo CSS . 'elmuslito.css'; ?>">
    </head>
    <body>
        <!-- Cabecera con: logo, título y gif -->
        <header id="cabecera">
            <img src="<?php echo IMAGENES . 'elmuslito/logo_final.jpg'; ?>" alt="logo" id="logo">
            <div class="contenedor__titulo">
                <h1><a class="titulo" href="<?php echo RUTABASE . 'elmuslito'; ?>">El muslito</a></h1>
            </div>
            <img src="<?php echo IMAGENES . 'elmuslito/animacion.gif'; ?>" id="gif">
        </header>
            <!-- menú de navegación lateral (formado por una lista desordenada)-->
            <nav class="barra">
               <div class="casa__contenedor">
                    <a href="<?php echo RUTABASE . "trabajos"; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>
                </div>
                <ul>
                    <li><a href="#">Recetas</a></li>
                    <li><a href="#">Reservas</a></li>
                    <li><a href="#">Horario</a></li>
                    <li><a href="<?php echo RUTABASE . 'trabajos'; ?>">Volver</a></li>
                </ul>
            </nav>
            <!-- parte central de la web -->
            <article id="articulo">
                <header><h2>Pollo al chilindr&oacute;n</h2></header>
                <!-- apartado ingredientes (formado por una lista desordenada)-->
                <section>
                    <h3>Ingredientes</h3>
                    <ul id="ingr">
                        <li class="ingredientes">6 muslos de pollo</li>
                        <li class="ingredientes">5 tomates peque&ntilde;os</li>
                        <li class="ingredientes">1 cebolla </li>
                        <li class="ingredientes">3 dientes de ajo</li>
                        <li class="ingredientes">200 ml de vino blanco</li>
                        <li class="ingredientes">200 ml de agua</li>
                        <li class="ingredientes">75 ml de aceite de oliva</li>
                        <li class="ingredientes">100 g de jam&oacute;n serrano</li>
                        <li class="ingredientes">1 pimiento rojo seco</li> 
                    </ul>
                    <!-- etiqueta que hace la imágen responsive. Va reduciendo el tamaño de la imagen en función 
                    de la resolución de la pantalla -->
                    <picture>
                        <source media="(max-width: 964px)" srcset="<?php echo IMAGENES . 'elmuslito/pollo_300px.jpg'; ?>">
                        <source media="(max-width: 1110px)" srcset="<?php echo IMAGENES . 'elmuslito/pollo_400px.jpg'; ?>">
                        <source media="(max-width: 1396px)" srcset="<?php echo IMAGENES . 'elmuslito/pollo_500px.jpg'; ?>">
                        <img src="<?php echo IMAGENES . 'elmuslito/pollo_original.jpg'; ?>" alt="pollo" id="pollo">
                    </picture>
                 <!-- apartado elaboración -->
                </section>
                <section id="elaborar">
                    <h3>Elaboraci&oacute;n</h3>
                    <p>1. Pelar y picar la cebolla y los tres ajos.</p>
                    <p>2. Picar el tomate y pasarlo por un colador para quitar impurezas.</p>
                    <p>3. Echar un chorrito de aceite en una sart&eacute;n, verter los tomates, tapar y freir a fuego lento.</p>
                    <p>4. Vertir 75ml de aceite en una sart&eacute;n y dorar la cebolla/ajos.</p>
                    <p>5. Usar ese mismo aceite con el pollo. Dejarlo hasta que se dore. A&ntilde;adir sal al gusto.</p>
                    <!-- etiqueta para insertar un video -->
                    <video src="<?php echo VIDEO . 'elmuslito.mp4'; ?>" controls id="video" width="500px" height="300px"></video>
                    <p>6. Con el pollo dorado a&ntilde;adir el jam&oacute;n serrano, el agua, el vino blanco y las cebollas previamente doradas.</p>
                    <p>7. Limpiar el pimiento rojo de pepitas y a&ntilde;adir a la sart&eacute;n.</p>
                    <p>8. Dejarlo al fuego hasta que se consuma el l&iacute;quido.</p>
                    <p>9. Echar el tomate que se ha cocinado a fuego lento.</p>
                    <p>10. Remover bien y dejar que hierva por un breve periodo de tiempo.</p>
                    <!-- etiqueta audio para insertar archivos de audio y source para poder poner varios formatos
                    del mismo archivo y asegurar una mayor compatibilidad -->
                    <audio controls>
                        <source src="<?php echo AUDIO . 'elmuslito.mp3'; ?>" type="audio/mp3">
                        <source srcset="<?php echo AUDIO . 'elmuslito.ogg'; ?>" type="audio/ogg">
                    </audio>
                </section>
            </article>
            <!-- pie de página de la web -->
        <footer>
            <p id="autor">P&aacute;gina elaborada por: Jos&eacute; Maria Calavia Rivera</p>
            <div id="a_img">Autor imagen pollo al Chilindr&oacute;n: Jorgehdezalonso Licencia: CC
                            Procedencia: <a 
                            href="https://commons.wikimedia.org/wiki/File:Pollo_al_chilindr%C3%B3n_aragones._Chef_Koketo.jpg" 
                            target="blank">aquí</a></div>
        </footer>
    </div>
    </body>
</html>