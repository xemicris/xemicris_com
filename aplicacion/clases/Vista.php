<?php

class Vista{
    /**
     * Método que renderiza la vista
     */
    public static function renderizar($nombreVista, $datos =[]){

        //Convertir el array asociativo en objeto
        $datosObjeto = aObjeto($datos);
        
        //vistas/controladora/separacióndirectorio/nombre vista/Vista.php
        if(!is_file(VISTAS.CONTROLADOR.SD.$nombreVista.'Vista.php')){
           die(sprintf('No existe la vista %s en la carpeta %s', $nombreVista, CONTROLADOR));
        }else{
            require_once VISTAS.CONTROLADOR.SD.$nombreVista.'Vista.php';
            exit();
        }
    }
}