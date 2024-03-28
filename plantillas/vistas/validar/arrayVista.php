<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $datos['titulo']; ?></title>
        <link href="<?php echo CSS . 'validar-array2.css'; ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="campos">
            <input type="text" id="entrada" placeholder="Números enteros">
            <button type="button" id="guarda" onclick="guardarArray();">Guardar</button>
            <button type="button" style="display:none;" id="reinicio" 
            onclick="reiniciar();">Reiniciar</button>
            <button type="button" id="muestra" onclick="mostrar();">Mostrar</button>
            <p>Números introducidos</p>
            <input type="text" id="arr">
            <p>Números ordenados</p>
            <input type="text" id="ordenados">
            <p>Números pares</p>
            <input type="text" id="pares">
            <p>Números impares</p> 
            <input type="text" id="impares"><br>
            <p id="nombre" style="display:none;">¡Reinicia!</p>
        </div>
        <script src="<?php echo JS . "validar-array2.js"; ?>" language="javascript" type="text/javascript"></script>
    </body>
</html>