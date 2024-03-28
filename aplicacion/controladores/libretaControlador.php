<?php

class libretaControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Aplicación movimientos',
            'fondo' => 'claro',
        ];

        Vista::renderizar('indice', $datos);

    }

}