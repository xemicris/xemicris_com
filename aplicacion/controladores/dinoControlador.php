<?php

class dinoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Carrera T-Rex'
        ];

        Vista::renderizar('indice', $datos);

    }
}