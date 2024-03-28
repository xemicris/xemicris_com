<?php
//Limpiar caracteres no permitidos en una URL
        $url = filter_var($url, FILTER_SANITIZE_URL);

        //Divide un string en varios dentro de un array (separador, string)
        $url = explode("/", $url);

        if(isset($url[2])){
            $url = $url[2];
        }