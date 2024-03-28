<?php

class competicionControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Carrera de coches'
        ];

        Vista::renderizar('indice', $datos);

    }
}