<?php

function encabezado(){
    if(isset($_GET['uri'])){
        $ruta = $_SERVER['HTTP_HOST'];

        /*eliminamos las diagonales (algunos navegadores usan diagonal
        invertida)*/
        $url = rtrim($_GET['uri'], "/");
        $url = rtrim($_GET['uri'], "\\");

        //Limpiar caracteres no permitidos en una URL
        $url = filter_var($url, FILTER_SANITIZE_URL);

        //Divide un string en varios dentro de un array (separador, string)
        $url = explode("/", $url);

        if(isset($url[0])){
            $url = $url[0];
        }

        $encabezado = [
            'ruta' => $ruta,
            'url' => $url
        ];
        return $encabezado;
    }
}

function datosBD(){
    $encabezado = encabezado();

    if($encabezado['ruta'] === '' || $encabezado['ruta'] === ''){
        if($encabezado['url'] == ""){
            $datos = [
                'bd' => '',
                'usuario' => '', 
                'contra' => ''
            ];
        }else  if($encabezado['url'] == '' || $encabezado['url'] == ''){
            $datos = [
                'bd' => '',
                'usuario' => '', 
                'contra' => ''
            ];
        }
    }else{
        if($encabezado['url'] == ""){
            $datos = [
                'bd' => '',
                'usuario' => '', 
                'contra' => ''
            ];
        } else if($encabezado['url'] == '' || $encabezado['url'] == ''){
            $datos = [
                'bd' => '',
                'usuario' => '', 
                'contra' => ''
            ];
        }else{
            $datos = [
                'bd' => '',
                'usuario' => '', 
                'contra' => ''
            ];
        }
    }
    return $datos;
}

function detectarDominioBiblioteca(){
    $encabezado = encabezado();
    if($encabezado['ruta'] === '' || $encabezado['ruta'] === ''){
        return '';
    }else if($encabezado['ruta'] === 'xemicris.com'){
        return 'https://xemicris.com/';
    }

}