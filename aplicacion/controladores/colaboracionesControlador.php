<?php

class colaboracionesControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Colaboraciones'
        ];

        Vista::renderizar('indice', $datos);

    }
}