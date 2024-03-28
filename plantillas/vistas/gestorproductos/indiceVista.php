<?php require_once INCLUDES . 'home/header.php' ?>

<section class="practicas__contenedor">
    <div class="contenedor_casa">
        <a href="<?php echo RUTABASE . "trabajos"; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </a>
    </div>
    <div class="practicas__contenedor-secundario">
        <video class="practicas__video video-js vjs-16-9 vjs-big-play-centered" data-setup="{}" controls>
            <source src="<?php echo VIDEO . 'gestorProductos.mp4'; ?>" type="video/mp4">
        </video>
    </div>
    <div class="descarga_practicas">
        <a href="<?php echo ARCHIVOS . 'gestorProductos.rar'; ?>"  class="boton boton__descarga" download="gestorProductos.rar">Descargar</a>
    </div>
</section>


<?php require_once INCLUDES . 'home/footer.php' ?>