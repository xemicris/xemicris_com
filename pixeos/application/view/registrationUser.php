<?php include_once("header.php"); ?>
<main class='h-100 container-xl'>
    <?php include_once("alerts.php"); ?>
    <div class="card p-3 mt-5 bg-light sombra-formulario mb-4">
        <!-- subtitulo -->
        <h2 class="fw-bold text-center registro__contenedor"><?php echo $datos['subtitulo'] ?></h2>
        <form action="<?php echo htmlentities(RUTA . 'access/registration'); ?>" method="POST"">

            <!-- nombre -->
            <div class=" form-group text-left mb-2">
            <label for="nombre">Nombre (*)</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" value='<?php isset($datos["usuario"]["nombre"]) ?
                                                                                                                print $datos["usuario"]["nombre"] : ""; ?>' />
    </div>

    <!-- apellidos -->
    <div class="form-group text-left mb-2">
        <label for="apellidos">Apellidos (*)</label>
        <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" value='<?php isset($datos["usuario"]["apellidos"]) ? print $datos["usuario"]["apellidos"] : ""; ?>' />
    </div>

    <!-- email -->
    <div class="form-group text-left mb-2">
        <label for="correo">Correo Electrónico (*) </label>
        <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Electrónico" value='<?php isset($datos["usuario"]["correo"]) ? print $datos["usuario"]["correo"] : ""; ?>' />
    </div>

    <!-- profesión -->
    <div class="form-group text-left mb-2">
        <label for="profesion">Profesión </label>
        <input type="text" id="profesion" name="profesion" class="form-control" placeholder="Indica a qué te dedicas" value='<?php isset($datos["usuario"]["profesion"]) ? print $datos["usuario"]["profesion"] : ""; ?>' />
    </div>



    <!-- contraseña1 -->
    <div class="form-group text-left mb-2">
        <label for="contrasena">Contraseña (*) </label>
        <div class="input-group">
            <input type="password" id="contrasena" name="contrasena" class="form-control contrasena" placeholder="Contraseña">
            <img class="input-group-text ojo-contrasena" src="<?php echo (RUTA . '/images/ojo-tachado.svg'); ?>" alt="icono ojo tachado">
        </div>
    </div>

    <!-- contraseña2 -->
    <div class="form-group text-left">
        <label for="contrasenaVerificar">Repetir Contraseña (*) </label>
        <div class="input-group">
            <input type="password" id="contrasenaVerificar" name="contrasenaVerificar" class="form-control contrasena" placeholder="Repetir Contraseña">
            <img class="input-group-text ojo-contrasena" src="<?php echo (RUTA . '/images/ojo-tachado.svg'); ?>" alt="icono ojo tachado">
        </div>
    </div>

    <!-- política de privacidad -->
    <div class="registro__politica form-group mt-3">
        <input type="checkbox" class="form-check-input" id="privacidad" name="privacidad" value="marcado">
        <label class="form-check-label registro__privacidad-texto" for="privacidad">Al marcar la casilla aceptas nuestra política de privacidad. Haz clic <a href="<?php echo (RUTA . '/access/privacy'); ?>">AQUÍ</a> para revisarla</label><br>
        
    </div>
    <div class="registro__obligatorio">
        <span class="registro__obligatorio--asterisco">(*)</span><p>Campos obligatorios</p>
    </div>
    <!-- Botón -->
    <div class="form-group d-flex gap-4 justify-content-between mt-4">
        <a href="<?php echo RUTA ?>access/login" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i> Regresar</a>
        <button type="submit" class="btn btn-success" role="button"><i class="bi bi-plus-circle-fill"></i> Registrarse</button>
    </div>

    <div class="botones_r my-3 d-flex justify-content-between">
        <a href="<?php echo RUTA ?>">Iniciar sesión</a>
        <a class="text-end" href="<?php echo RUTA ?>access/recover">Recuperar contraseña</a>
    </div>
    <div class="registro__captcha my-3 d-flex justify-content-center">
        <div class="h-captcha" data-sitekey="56217dbb-da60-4d2d-bb4b-1f5a01b1115a"></div>
    </div>
    </form>
    </div>
</main>
<footer>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
    <script src='<?php echo RUTA . 'js/registro.js' ?>' async defer></script>
    <?php include_once("footer.php"); ?>