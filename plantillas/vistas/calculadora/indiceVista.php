<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($datos['titulo']) ? $datos['titulo'] : 'xemicris.com | Calculadora' ; ?></title>
    <link rel="stylesheet" href="<?php echo CSS . 'calculadora.css'; ?>" type="text/css">
</head>
<body>
    <div class="boton__fondo">
        <strong>🌞</strong>
        <strong>🌙</strong>
    </div>
    <div class="boton__casa">
        <a href="<?php echo RUTABASE . 'trabajos'; ?>">🏠</a>
    </div>
    <div class="contenedor">
        <form name="calculadora" class="calculadora">
            <input type="text" class="pantalla" readonly name="texto">
            <span class="numero limpiar" value=' '><i>C</i></span>
            <span class="numero" value="/"><i>/</i></span>
            <span class="numero por" value="*"><i>*</i></span>
            <span class="numero" value="7"><i>7</i></span>
            <span class="numero" value="8"><i>8</i></span>
            <span class="numero" value="9"><i>9</i></span>
            <span class="numero" value="-"><i>-</i></span>
            <span class="numero" value="4"><i>4</i></span>
            <span class="numero" value="5"><i>5</i></span>
            <span class="numero" value="6"><i>6</i></span>
            <span class="numero mas" value="+"><i>+</i></span>
            <span class="numero" value="1"><i>1</i></span>
            <span class="numero" value="2"><i>2</i></span>
            <span class="numero" value="3"><i>3</i></span>
            <span class="numero" value="0"><i>0</i></span>
            <span class="borrar"><i><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-backspace" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5z" />
                <path d="M12 10l4 4m0 -4l-4 4" />
              </svg></i></span>
            <span class="numero" value="."><i>.</i></span>

            <span class="igual">
                <i>=</i>
            </span>
        </form>
    </div>
    <script src="<?php echo JS . 'calculadora.js'; ?>"></script>
</body>
</html>