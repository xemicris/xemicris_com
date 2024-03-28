<?php

class errorControlador extends Controlador{

    function __construct(){
        
    }
    function indice(){
        $datos = [
            'titulo' => 'Página no encontrada'
        ];

        Vista::renderizar('404', $datos);
    }
}