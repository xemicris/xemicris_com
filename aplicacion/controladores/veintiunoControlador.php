<?php

class veintiunoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Veintiuno. | Portada'
        ];

        Vista::renderizar('indice', $datos);

    }
}