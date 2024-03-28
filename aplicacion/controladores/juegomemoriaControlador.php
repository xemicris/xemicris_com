<?php

class juegomemoriaControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Encuentra la pareja'
        ];

        Vista::renderizar('indice', $datos);

    }
}