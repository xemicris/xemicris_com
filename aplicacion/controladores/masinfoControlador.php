<?php

class masinfoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Más info'
        ];

        Vista::renderizar('masinfo', $datos);

    }
}