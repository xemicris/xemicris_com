<?php

class homeControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
        write_visita ();
        $datos = [
            'titulo' => 'xemicris.com | Portafolio'
        ];

        Vista::renderizar('indice', $datos);

    }
}