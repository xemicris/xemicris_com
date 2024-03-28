<?php include_once ("header.php"); ?>
<main class='container-xl d-flex flex-column justify-content-center'>
<?php include_once ("alerts.php"); ?>
    <h2 class="text-center"><?php echo $datos['subtitulo'] ?></h2>
    <div class="text-center">
        <h4><?php echo $datos['texto']." ".(isset($datos["usuario"]["nombre"]) ? $datos["usuario"]["nombre"] : " ") . " " . (isset($datos["usuario"]["apellidos"]) ? $datos["usuario"]["apellidos"] : " "); ?></h4>
    </div>
    <a href="<?php echo RUTA . $datos['url'] ?>" class="btn <?php echo $datos['colorBoton'] ?> mx-auto">
        <?php echo $datos['textoBoton'] ?>
    </a>
</main>
<footer>
    <?php include_once ("footer.php"); ?>