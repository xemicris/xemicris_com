<?php

class contadorControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Contador Digital'
        ];

        Vista::renderizar('indice', $datos);

    }
}