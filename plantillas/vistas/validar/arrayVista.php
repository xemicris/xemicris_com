<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Security-Policy" content="script-src 'self'; object-src 'self'">
        <meta name="description" content="Página para jugar guardando números">
        <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
        <title><?php echo $datos['titulo']; ?></title>
        <link href="<?php echo CSS . 'validar-numeros.css'; ?>" rel="stylesheet" type="text/css" fetchpriority="low">
    </head>
    <body>
        <div id="campos">
            <input type="text" id="entrada" placeholder="Números enteros">
            <button type="button" id="guarda">Guardar</button>
            <button type="button" style="display:none;" id="reinicio">Reiniciar</button>
            <button type="button" id="muestra">Mostrar</button>
            <label for="arr">Números introducidos</label>
            <input type="text" id="arr">
            <label for="ordenados">Números ordenados</label>
            <input type="text" id="ordenados">
            <label for="pares">Números pares</label>
            <input type="text" id="pares">
            <label for="impares">Números impares</label> 
            <input type="text" id="impares"><br>
            <p id="nombre" style="display:none;">¡Reinicia!</p>
        </div>
        <script src="<?php echo JS . "validar-numeros.js"; ?>" language="javascript" type="text/javascript"></script>
    </body>
</html>