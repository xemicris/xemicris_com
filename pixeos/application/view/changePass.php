<?php include_once ("header.php"); ?>
    <main class='container-xl d-flex flex-column justify-content-center'>
    <?php include_once ("alerts.php"); ?>
    <div class="card p-4 bg-light sombra-formulario">
        <!-- subtítulo -->
        <h2 class="fw-bold text-center mb-5"><?php echo $datos['subtitulo'] ?></h2>

        <form action="<?php echo htmlentities(RUTA . 'access/cambiar/');?>" method="POST"">

            <!-- contraseña1 -->
            <div class="form-group text-left mb-2">
                <label for="contrasena">Contraseña: </label>
                <div class="input-group">
                    <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña">
                    <img class="input-group-text ojo-contrasena" src="<?php echo (RUTA .'/images/ojo-tachado.svg');?>" alt="icono ojo tachado">
                </div>
            </div>

            <!-- contraseña2 -->
            <div class="form-group text-left">
                <label for="contrasenaVerificar">Repetir Contraseña: </label>
                <div class="input-group">
                    <input type="password" id="contrasenaVerificar" name="contrasenaVerificar" class="form-control" placeholder="Repetir Contraseña">
                    <img class="input-group-text ojo-contrasena" src="<?php echo (RUTA .'/images/ojo-tachado.svg');?>" alt="icono ojo tachado">
                </div>
            </div>

            <!-- Botón -->
            <div class="form-group d-flex justify-content-between mt-4">
                <a href="<?php echo RUTA;?>" class="btn btn-danger">Regresar</a>
                <input type="submit" value="Cambiar contraseña" class="btn btn-success" role="button" />
            </div>

        </form>
    </div>
</main>
<footer>
    <?php include_once ("footer.php"); ?>