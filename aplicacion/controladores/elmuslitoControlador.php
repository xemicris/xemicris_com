<?php

class elmuslitoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'El muslito | Portada'
        ];

        Vista::renderizar('indice', $datos);

    }
}