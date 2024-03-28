<?php

class calculadoraControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Calculadora'
        ];

        Vista::renderizar('indice', $datos);

    }
}