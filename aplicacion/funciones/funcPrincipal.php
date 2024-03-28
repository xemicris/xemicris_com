<?php
//funciones del proyecto

/**
 * Función que convierte un array en un objeto
 */
function aObjeto($array){
    return json_decode(json_encode($array));
    
}

function obtenerTitulo(){
    return 'xemicris.com';
}

function ahora(){
    return date('Y-m-d H:i:s');
}

//Crear JSON
function jsonSalida($json, $die = true){
    //cabecera para que no haya restricciones en el acceso
    header('Access-Control-Allow-Origin: *');
    //decirle al navegador que la info es un json
    header('Content-type: application/json;charset=utf-8');

    if(is_array($json)){
        $json = json_encode($json);
    }

    //va con las cabeceras
    echo $json;
    /*si está seteado $die con true el código se muere y sino devuelve true para seguir
    ejecutando funciones*/
    if($die){
        die;
    }
    return true;
}

//Construir un objeto json
function jsonConstruir($estatus = 200, $datos = null, $mensaje = ''){

    if(empty($mensaje) || $mensaje == ''){
        switch($estatus){
            case 200:
                $mensaje = 'OK';
                break;
            case 201:
                $mensaje = 'Creado';
                break;
            case 400:
                $mensaje = 'Petición no válida';
                break;
            case 403:
                $mensaje = 'Acceso denegado';
                break;
            case 404:
                $mensaje = 'No encontrado';
                break;
            case 500:
                $mensaje = 'Error del servidor';
                break;
            case 550:
                $mensaje = 'Permiso denegado';
                break;
            default:
                break;
        }
    }
    
    http_response_code($estatus);

    $json = [
        'estatus' => $estatus,
        'error' => false,
        'mensaje' => $mensaje,
        'datos' => $datos
    ];

    $codigosError = [400,403,404,405,500];

    if(in_array($estatus, $codigosError)){
        $json['error'] = true;
    }


    return json_encode($json);
}

function obtenerPlantillaHtml($vista, $datos = []){

    $archivoAIncluir = MODULOS . $vista . 'Modulo.php';
    $salida = '';

    //por si se quiere trabajar con un objeto
    $objeto = aObjeto($datos);

    if(!is_file($archivoAIncluir)){
        return false;
    }

    ob_start();
    
    require_once $archivoAIncluir;

    $salida = ob_get_clean();

    return $salida;
}

function moneda($cantidad, $simbolo = '€'){
    return number_format($cantidad, 2, ',', '.') . $simbolo;
}

function obtenerOpcion($opcion){
    return opcionesModelo::buscar($opcion);
}

function validarString($datos){
    $expresion = "/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/";

    if(!preg_match($expresion, $datos)){
        return false;
    }else{
        return $datos;
    }
}

function validarNumero($datos = []){
    $expresion = "/^[0-9.,]+$/";

    if(!preg_match($expresion, $datos['cantidad'])){
        return false;
    }else{
        return $datos['cantidad'];
   
    }
}
function validarImpuesto($datos){
    $expresion = "/^[0-9.,]+$/";

    if(!preg_match($expresion, $datos)){
        return false;
    }else{
        return $datos;
    }
}


function iniciar_sesion(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
}
