<?php

class resumenpixeosControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Pixeos'
        ];

        Vista::renderizar('indice', $datos);

    }
}