<?php

class trabajosControlador extends Controlador
{
    function __construct()
    {
    }

    function indice()
    {

        $datos = [
            'titulo' => 'xemicris.com | Trabajos'
        ];

        Vista::renderizar('trabajos', $datos);
    }
}
