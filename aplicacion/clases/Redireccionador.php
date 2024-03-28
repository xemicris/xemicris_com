<?php

class Redireccionador{

    //a donde dirigir al usuario
    private $localizacion;

    /**
     * Método para redirigir al usuario a una seccion determinada
     * 
     * @param string $localizacion
     * @return void
     */
    public static function a($localizacion){

        $instancia = new self();
        $instancia->localizacion = $localizacion;

        //Si las cabeceras ya han sido enviadas
        if(headers_sent()){
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . URL . $instancia->localizacion . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content=0; url' . URL . $instancia->localizacion . '" />';
            echo '</noscript>';
            die(); 
        }

        //Detecta si se ha pasado http y se quita la URL
        if(strpos($instancia->localizacion, 'http') !== false){
            header('Location: ' . $instancia->localizacion);
            die();
        }

        //Redirigir a otra sección
        header('Location: ' . URL . $instancia->localizacion);
        die();
    }
}