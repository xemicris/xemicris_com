<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Security-Policy" content="script-src 'self'; object-src 'self'">
		<meta name="description" content="Juego de piedra, papel o tijera">
		<link rel="prefetch" href="<?php echo CSS. "normalice.css"; ?>"  type="text/css">
		<link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet" crossorigin="anonymous" fetchpriority="low">
		<link rel="stylesheet" type="text/css" href="<?php echo CSS. "piedrapapeltijera.css"; ?>" crossorigin="anonymous" fetchpriority="low">
		<link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
		<title><?php echo isset($datos['titulo']) ? $datos['titulo'] : 'xemicris.com | Piedra, papel, tijera' ?></title>
	</head>
	<body>
		<header class="titulo__contenedor">
			<img class="titulo__imagen" src="<?php echo IMAGENES . "piedrapapeltijera/titulo.svg"; ?>" alt="imagen titulo">
			<h1 class="titulo">Piedra-Papel-Tijera</h1>
		</header>
		<div class="casa__contenedor">
			<a href="<?php echo RUTABASE . "trabajos"; ?>" aria-label="volver a xemicris">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
				</svg>
			</a>
		</div>
		<div class="contenedor">
			<fieldset class="formulario">
				<legend>Datos del jugador</legend>
				<div>
					<label for="nombre">Introduce el nombre del jugador</label>
					<input class="entrada" type="text" id="nombre">
				</div>
				<div class="segundo__label">
					<label for="partidas">¿Cuántas partidas quieres jugar?</label>
					<input class="entrada" type="number" id="partidas" value="0">
				</div>
				<div class="boton__contenedor">
					<button class="boton">CARGAR DATOS DEL JUGADOR</button>
				</div>
			</fieldset>
			<div class="imagenes">
				<h2 class="partidas">Jugando la partida <span id="actual">0</span> de <span id="total">0</span>.</h2>
				<div id="jugador">
					<img class="seleccionado ima" src="<?php echo IMAGENES . "piedrapapeltijera/defecto1.svg"; ?>" alt="imagen inicial de la piedra">
					<img class="noSeleccionado ima" src="<?php echo IMAGENES . "piedrapapeltijera/defecto1.svg"; ?>" alt="imagen inicial del papel">
					<img class="noSeleccionado ima" src="<?php echo IMAGENES . "piedrapapeltijera/defecto1.svg"; ?>" alt="imagen inicial de la tijera">
				</div>
				
				<div id="maquina">
					<img class="defecto__maquina" src="<?php echo IMAGENES . "piedrapapeltijera/robot.svg"; ?>" alt="imagen por defecto de la máquina">
				</div>
			</div>
			<div class="puntuaciones">
				<h2 class="puntuaciones__titulo">Puntuaciones</h2>
				<div class="puntuaciones__script">
					<p class="puntuacion__jugador"></p>
					<p class="puntuacion__maquina"></p>
					<p class="resultado"></p>
				</div>
				
				<button class="boton boton__reiniciar">REINICIAR</button>
			</div>
		</div>
		<script defer type="text/javascript" src="<?php echo JS . "piedrapapeltijera.js"; ?>"></script>
	</body>
</html>