<?php

class buscagifControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Buscador de Gifs'
        ];

        Vista::renderizar('indice', $datos);

    }
}