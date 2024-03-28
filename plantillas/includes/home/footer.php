<footer class="text-center copyright">
    <p>©  <?php echo obtenerTitulo() . ' ' . date('Y'); ?></p>
</footer>

<!--scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!--bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!--js-->
    <script src="<?php echo JS . 'video.min.js'  ?>"></script>
    <script src="<?php echo JS . 'menu.js'  ?>"></script>
    <?php
        if(uriJavascript() === 'contacto'): ?> 
            <!--toastr-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <!--waitme-->
            <script src="<?php echo PLUGINS . 'waitme/waitMe.min.js' ?>"></script>
            <script src='<?php echo JS . 'contacta.js'  ?>'></script> 
        <?php endif;?>
    
</body>
</html>