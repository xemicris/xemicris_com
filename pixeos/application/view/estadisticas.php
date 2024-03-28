<?php include_once("header.php"); ?>
<main class="main mt-5 pt-3">
  <div class="contenedor container-fluid">
    <div class="altura row">
      <div class="col-md-12 fw-bold fs-1 mt-5 text-center">
        <h1 class="mt-3"><?php echo $datos['subtitulo'] ?></h1>
      </div>
      <div class="col-md-6 mx-auto mt-5">
        <div class="estadistica-contenedor chart-container mx-auto">
          <!-- estadísticas -->
          <canvas id="estadistica"></canvas>
          <!-- fin estadísticas -->
        </div>
      </div>
    </div>
  </div>
</main>
<footer>
  <?php include_once("footer.php"); ?>