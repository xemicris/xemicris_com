<?php

class gestorproductosControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Gestor de productos'
        ];

        Vista::renderizar('indice', $datos);

    }
}