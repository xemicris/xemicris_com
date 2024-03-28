<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $datos['titulo']; ?></title>
        <link href="<?php echo CSS . 'validar-array1.css'; ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section>
            <!-- cabecera de la página -->
            <header>
                <h1>Validar formulario</h1>
                <hr/>
            </header>
             <!-- párrafos donde se mostrarán los errores -->
             <div class="errores">
                <p id="errorNombre"></p>
                <p id="errorContrasena"></p>
             </div>
             <div class="contenedor_casa">
                <a href="<?php echo RUTABASE . "trabajos"; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </div>
             <!--formulario-->
            <form id="formulario" action="" onsubmit="return validar()">
                <fieldset>
                    <legend>Datos de identificación</legend>
                    <!-- campo usuario -->
                    <div id="dusu">
                        <label for="nombre" class="etiqueta">Usuario</label>
                        <input type="text" id="usuario">
                    </div>
                    <!-- campo contraseña -->
                    <div id="dcon">
                        <label for="password" id="etiqueta1">Contraseña</label>
                        <input class="contrasena" type="password" id="contra">
                        <img class="input__icono  ojo__contrasena" src="<?php echo IMAGENES . "validar/ojo-tachado.svg"; ?>" alt="icono ojo tachado">
                    </div>
                    <input type="submit" value="Enviar" id="envia">
                </fieldset>
            </form>
        </section>
        <!-- pie de página -->
        <footer>
            <div id="pie">
                <hr>
                <h3>Instrucciones:</h3>
                <p class="instrucciones">usuario: letras en minúscula y entre 3 y 12 caracteres</p>
                <p class="instrucciones ultimo">contraseña: 1 letra mayúscula + (./,/-) + 6 números y/o letras(minúsucula)</p>
            </div>
            <script src="<?php echo JS . "validar-array1.js"; ?>" language="javascript" type="text/javascript"></script>
        </footer>
    </body>
</html>