<?php include_once 'header.php' ?>
    <?php
        $urlActual = $_SERVER["REQUEST_URI"];
        $url = encabezado(($urlActual));
        if ($url == 'login') {
            echo "<main class='container-xl d-flex flex-column justify-content-center'>";
        }else{
            echo "<main class='container-xl d-flex flex-column justify-content-center'>";
        }
    ?>

<?php include_once ("alerts.php"); ?>
        <!-- 1 fila -->
        <div class="sombra-formulario row m-1 align-items-stretch">

            <!-- columna 1-->
            <div class="col img rounded-start d-none d-md-block shadow">
                <!-- imagen -->
            </div>

            <!-- columna 2 -->
            <div class="bordes col bg-white p-3 rounded shadow">
                <div class="d-flex justify-content-center"><div class="img-p img-fluid d-block d-md-none"></div></div>
            
                <!-- subtítulo -->
                <h2 class="logo__movil fw-bold text-center mb-4"><?php echo $datos['subtitulo'] ?></h2>
                <!-- Login -->
                <form action="<?php echo htmlentities(RUTA . 'access/login/');?>" method="POST">
                    <!-- correo -->
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" >
                    </div>

                    <!-- contraseña -->
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control contrasena" id="contrasena" name="contrasena">
                            <img class="input-group-text ojo-contrasena" src="<?php echo (RUTA .'/images/ojo-tachado.svg');?>" alt="icono ojo tachado">
                        </div>
                    </div>

                    <div class="d-grid justify-content-md-center">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>

                    <div class="botones_r my-3">
                        <a href="<?php echo RUTA ?>access/registration">Registrarse</a>
                        <a href="<?php echo RUTA ?>access/recover">Recuperar contraseña</a>
                    </div>
                </form><!--fin formulario-->
            </div>
        </div>
    </main>
   
    <footer>
        <?php include_once 'footer.php'?>