<footer class="text-center copyright">
    <p>©  <?php echo obtenerTitulo() . ' ' . date('Y'); ?></p>
</footer>

<!--scripts-->
    <!--bootstrap-->
    <!--js-->
    <script src="<?php echo JS . 'menu.js'  ?>"></script>
    <?php
        if(uriJavascript() === 'contacto'){ ?> 
            <!--toastr-->
                <!--jQuery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <!--waitme-->
            <script src="<?php echo PLUGINS . 'waitme/waitMe.min.js' ?>"></script>
            <script src='<?php echo JS . 'contacta.js'  ?>'></script> 
    <?php 
        }else if(uriJavascript() === 'gestorProductos' || uriJavascript() === 'juegoMemoria'){?>
            <script src="<?php echo JS . 'video.min.js'  ?>"></script>
    <?php } ?>
    
</body>
</html>