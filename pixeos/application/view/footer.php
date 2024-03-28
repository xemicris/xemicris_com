            <script src="<?php echo RUTA ?>js/bootstrap.bundle.min.js"></script>
            <script type="module" src="<?php echo RUTA ?>js/getProjectRoutes.js"></script>
            <script type="module" src="<?php echo RUTA ?>js/password.js"></script>

            <?php
                $urlActual = $_SERVER["REQUEST_URI"];
                $url = encabezado(($urlActual));
                if ($url == 'login' || $url == 'registration' || $url == 'recover') {
            ?>
                <div class="container-md" >
                    <div class="card sombra-formulario">
                        <ul class="politicas gap-3 m-2">
                            <li><a href="<?php echo RUTA . '/access/legal';?>">Aviso Legal</a></li>
                            <li><a href="<?php echo RUTA . '/access/privacy';?>">Política de Privacidad</a></li>
                            <li><a href="<?php echo RUTA . '/access/cookies';?>">Política de Cookies</a></li>
                            <li><a href="<?php echo XEMICRIS . 'resumenPixeos';?>">Ir a xemicris</a></li>
                        </ul>
                    </div>
                </div>
            <?php }else if ($url === 'panel' || $url === 'profile' || $url === 'project' || $url === 'viewStatistics' || $url === 'contact' || $url === 'calendar') {?>
                <script type="module" src="<?php echo RUTA ?>js/oscuro.js"></script>
                <script type="module" src="<?php echo RUTA ?>js/ocultarPanelSuperior.js"></script>
            <?php } ?>

            <?php
                $urlActual = $_SERVER["REQUEST_URI"];
                $url = encabezado(($urlActual));
                if ($url == 'panel') {
            ?>
                <script type="module" src="<?php echo RUTA ?>js/notes.js"></script> 
                <script type="module" src="<?php echo RUTA ?>js/searchNotes.js"></script> 

            <?php }else if($url == 'profile'){ ?>

                <script src="<?php echo RUTA ?>js/perfil.js"></script>  

            <?php }else if($url == 'project'){ ?>

                <script type="module" src="<?php echo RUTA ?>js/tasks.js"></script> 

            <?php }else if($url == 'viewStatistics'){ ?>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
                <script type="module" src="<?php echo RUTA ?>js/statistics.js"></script>  

            <?php }else if($url == 'admin'){ ?>

                <script type="module" src="<?php echo RUTA ?>js/admin.js"></script>

            <?php } else if($url == 'tec'){ ?>

                <script type="module" src="<?php echo RUTA ?>js/incidencias.js"></script>

            <?php } else if ($url == 'calendar'){ ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
                <!--toastr-->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                <script type="module" src="<?php echo RUTA ?>js/calendar.js"></script>
            <?php } ?>
        </footer>
    </body>
</html>