<footer class="text-center copyright">
    <p>©  <?php echo obtenerTitulo() . ' ' . date('Y'); ?></p>
</footer>

<!--scripts-->
<script src="<?php echo JS . 'menu.js'  ?>"></script>
<?php
    if(uriJavascript() === 'contacto'){ ?> 
        <!--jQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!--toastr-->
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!--waitme-->
        <script defer src="<?php echo PLUGINS . 'waitme/waitMe.min.js' ?>"></script>

        <script defer src='<?php echo JS . 'contacta.js'  ?>'></script> 
<?php 
    }else if(uriJavascript() === 'gestorProductos' || uriJavascript() === 'juegoMemoria'){?>
        <script src="<?php echo JS . 'video.min.js'  ?>"></script>
<?php } ?>

</body>
</html>