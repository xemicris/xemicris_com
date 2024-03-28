<?php

class despachoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'CR abogados | Portada'
        ];

        Vista::renderizar('home', $datos);

    }

    function nosotros(){
       
        $datos = [
            'titulo' => 'CR abogados | Sobre nosotros'
        ];

        Vista::renderizar('masinfo', $datos);

    }

    function herencias(){
       
        $datos = [
            'titulo' => 'CR abogados | Herencias'
        ];

        Vista::renderizar('herencia', $datos);

    }

    function divorcios(){
       
        $datos = [
            'titulo' => 'CR abogados | Divorcios'
        ];

        Vista::renderizar('divorcio', $datos);

    }

    function mediaciones(){
       
        $datos = [
            'titulo' => 'CR abogados | Mediación familiar'
        ];

        Vista::renderizar('mediacion', $datos);

    }

    function adopciones(){
       
        $datos = [
            'titulo' => 'CR abogados | Adopciones'
        ];

        Vista::renderizar('adopcion', $datos);

    }

    function contacta(){
       
        $datos = [
            'titulo' => 'CR abogados | Contacta'
        ];

        Vista::renderizar('contacto', $datos);

    }
}