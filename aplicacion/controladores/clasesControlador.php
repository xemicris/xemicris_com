<?php

class clasesControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Clases particulares | Portada'
        ];

        Vista::renderizar('indice', $datos);

    }
}