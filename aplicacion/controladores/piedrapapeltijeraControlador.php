<?php

class piedrapapeltijeraControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Piedra, papel, tijera',
            'fondo' => 'claro',
        ];

        Vista::renderizar('indice', $datos);

    }

}