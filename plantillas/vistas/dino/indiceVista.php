<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrera de dinosaurio</title>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS. "dino.css"; ?>">
</head>
<body>
    <div class="zonaJuego">
        <div class="casa__contenedor">
			<a href="<?php echo RUTABASE . 'trabajos'; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
				</svg>
			</a>
		</div>
        <div class="dino"></div>
        <!-- Estructura del juego -->
        <div class="contenedor">
            <div id="finJuego"></div>
            <div class="suelo"></div>
            <div class="dinosaurio dinosaurio_salto"></div>
            <div id="puntuacionFinal"></div>
            <div class="puntuacion">0</div>
        </div>
        <!-- Fin estructura del juego -->
        <div class="botones">
            <div class="botones_arrancar"><button class="arrancar">Iniciar Juego</button></div>
            <div class="botones_parar"><button class="reiniciar">Parar Juego</button></div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo JS . "dino.js"; ?>"></script>
</body>
</html>