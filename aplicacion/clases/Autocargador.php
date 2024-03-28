<?php

class Autocargador{
    /**
     * Método que ejecuta de forma estática el autocargador
     * 
     * @return void
     */
    public static function inicio(){
        spl_autoload_register([__CLASS__, 'autocargador']);
    }

    /**
     * Método que hace de autoload
     * 
     */
    private static function autocargador($archivo){
        
        if(is_file(CLASES.$archivo.'.php')){
            $clases = CLASES.$archivo.'.php';
            require_once CLASES.$archivo.'.php';

        }elseif(is_file(CONTROLADORES.$archivo.'.php')){
            $controladores = CONTROLADORES.$archivo.'.php';
            require_once CONTROLADORES.$archivo.'.php';

        }elseif(is_file(MODELOS.$archivo.'.php')){
            require_once MODELOS.$archivo.'.php';

        }

        return;
    }
}