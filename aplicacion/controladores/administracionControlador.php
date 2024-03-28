<?php

class administracionControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'eAdministración | Portada'
        ];

        Vista::renderizar('indice', $datos);

    }
}