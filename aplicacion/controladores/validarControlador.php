<?php

class validarControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'Practica | Validar formulario'
        ];

        Vista::renderizar('indice', $datos);

    }

    function array(){
       
        $datos = [
            'titulo' => 'Practica | Array'
        ];

        Vista::renderizar('array', $datos);

    }
}