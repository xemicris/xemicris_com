<?php include_once ("header.php"); ?>
    <main class='container-xl d-flex flex-column justify-content-center'>
    <?php include_once ("alerts.php"); ?>
    <div class="card p-4 bg-light sombra-formulario">
        <!-- subtitulo -->
        <h2 class="fw-bold text-center mb-4"><?php echo $datos['subtitulo'] ?></h2>
        <form action="<?php echo RUTA;?>access/recover" method="POST">
            <!-- email -->
            <div class="form-group text-left correo__recuperar mb-2">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" class="form-control"
                    placeholder="Correo Electrónico"/>
            </div>
            <!-- Botón -->
            <div class="botones__recuperar form-group d-flex gap-2 justify-content-between mt-4">
                <a href="<?php echo RUTA;?>" class="btn btn-danger botones_recuperar_tamano"><i class="bi bi-arrow-return-left"></i> Regresar</a>
                <button type="submit" class="btn btn-success botones_recuperar_tamano" role="button"><i class="bi bi-send"></i> Enviar Correo</button>  
            </div>
        </form>
    </div>
</main>
</body>
<footer>
    <?php include_once ("footer.php"); ?>