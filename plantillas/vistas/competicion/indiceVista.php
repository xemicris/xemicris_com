<!DOCTYPE html>
<html lang="es">
<!-- cabecera del documento -->
<head>
  <!-- etiqueta que indica la codificación del documento -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://code.jquery.com/jquery-3.7.1.min.js; object-src 'self'">
  <meta name="description" content="Juego de carreras de coches">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
  <title><?php echo $datos['titulo']; ?></title>
  <!-- enlace a la hoja de estilo CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo CSS . "competicion.css"; ?>" fetchpriority="low">
</head>
<!-- cuerpo del documento -->
<body>
  <video src="<?php echo VIDEO . "comp.mp4"; ?>" autoplay muted></video>
   <!-- cabecera -->
   <header class="fondo__titulo">
    <div class="texto">
      <span>C</span>
      <span>O</span>
      <span>M</span>
      <span>P</span>
      <span>E</span>
      <span>T</span>
      <span>I</span>
      <span>C</span>
      <span>I</span>
      <span>Ó</span>
      <span>N</span>
    </div>
   </header>
   
  <div class="contenedor">
    <!-- lista desplegable -->
    <fieldset class="borde">
      <div class="casa__contenedor">
        <a href="<?php echo RUTABASE . "trabajos"; ?>" aria-label="volver a xemicris">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
        </a>
      </div>
      <div id class="seleccionar">
        <label for="elegir">Selecciona:</label>
        <select name="coches" id="elegir">
          <option value="0">Coches</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <div class="apuesta">
        <div>
          <label for="apostar">Elige el ganador:</label>
          <select name="apuesta" id="apostar">
            <option value="0">Ganador</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="dinero">¿Qué cantidad quieres apostar?:</label>
          <input type="number" name="dinero" id="dinero">
        </div>
        <p>Saldo disponible: <span id="saldo"></span></p>
      </div>
      <!-- participantes seleccionados -->
      <div id="participantes"></div>
      <div class="botones">
        <!-- botón de inicio de la cocherera y para reiniciarla -->
        <button type="submit" id="iniciar">Iniciar</button>
        <button type="submit" id="reiniciar">Reiniciar</button>
      </div>
    </fieldset>
    <!-- imágenes de los coches -->
    <div class="pista1">
      <div class="coche1">
        <img src="<?php echo IMAGENES . "competicion/coche1.avif"; ?>" loading="lazy"  width="200px" height="93px" alt="Car 1" id="coche1" class="coche"><br>
        <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche11" class="ruedaCoche"><br>
        <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche12" class="ruedaCoche"><br>
      </div>
    </div>
    <div class="pista2">
      <div class="coche2">
          <img src="<?php echo IMAGENES . "competicion/coche2.avif"; ?>" loading="lazy"  width="200px" height="100px" alt="Car 2" id="coche2" class="coche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche21" class="ruedaCoche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche22" class="ruedaCoche"><br>
      </div>
    </div>
      <!-- resultado de la cocherera -->
        <div id="ganador"></div>
      <div class="pista3">
        <div class="coche3">
          <img src="<?php echo IMAGENES . "competicion/coche3.avif"; ?>" loading="lazy" width="200px" height="49px" alt="Car 3" id="coche3" class="coche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche31" class="ruedaCoche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche32" class="ruedaCoche"><br>
        </div>
      </div>
      <div class="pista4">
        <div class="coche4">
          <img src="<?php echo IMAGENES . "competicion/coche4.avif"; ?>" loading="lazy" width="200px" height="100px" alt="Car 4" id="coche4" class="coche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche41" class="ruedaCoche"><br>
          <img src="<?php echo IMAGENES . "competicion/ruedaCoche.avif"; ?>" loading="lazy" width="36px" height="36px" alt="rueda" id="ruedaCoche42" class="ruedaCoche"><br>
        </div>
      </div>
    
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" defer></script>
   <!-- enlace a mi script javascript -->
   <script src="<?php echo JS . 'competicion.js'; ?>" defer></script>
</body>
</html>