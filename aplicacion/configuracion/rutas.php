<?php
include_once 'obtenerDatos.php';
//configuraciones que permita configurar el sistema, actualizarlo o adapatarlo a otro
//constantes (rutas, passwords, información bd, credenciales, salt del sitio)

//saber si estamos trabajando de forma local o remota -> para no tener que estar cambiando las credenciales de BD
define('ES_LOCAL', in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1', '::1']));

//definir el uso horario (timezone) del sistema
date_default_timezone_set("Europe/Madrid");

//lenguaje
define('LENG', 'es');

//ruta base del proyecto -> local carga el primero y en producción el segundo
define("RUTABASE", ES_LOCAL ? '/xemicris_com/' : '/');

//seguridad 
define('AUT_SAL', '');

//Puerto y url del sitio
define('PUERTO', '');
define('URL', ES_LOCAL ? 'http://127.0.0.1:'. PUERTO . RUTABASE : 'https://xemicris.com');


//separador (\)
define('SD', DIRECTORY_SEPARATOR);

//Rutas de directorios y archivos
define('RAIZ', getcwd() . SD);

define('APP', RAIZ . '' . SD);
define('CLASES', APP . '' . SD);
define('CONFIG', APP . '' . SD);
define('CONTROLADORES', APP . '' . SD);
define('CORREO', APP . '' . SD);
define('FUNCIONES', APP . '' .SD);
define('MODELOS', APP . '' .SD);



define('PLANTILLAS', RAIZ . '' . SD);
define('INCLUDES', PLANTILLAS . '' . SD);
define('MODULOS', PLANTILLAS . '' . SD);
define('VISTAS', PLANTILLAS . '' . SD);

//Rutas de archivos con base URL
define('PUBLICO', RUTABASE . '' . SD);
define('ACTUALIZACIONES', PUBLICO . '' . SD);
define('ARCHIVOS', PUBLICO . '' . SD);
define('AUDIO', PUBLICO . '' . SD);
define('CSS', PUBLICO . '' . SD);
define('DESCARGAS', PUBLICO . '' . SD);
define('FAVICON', PUBLICO . '' . SD);
define('FUENTES', PUBLICO . '' . SD);
define('IMAGENES', PUBLICO . '' . SD);
define('JS', PUBLICO . '' . SD);
define('PDF', PUBLICO . '' . SD);
define('PLUGINS', PUBLICO . '' . SD);
define('VIDEO', PUBLICO . '' .SD);    

//Credenciales BD
define('BD_MOTOR', 'mysql');
define('BD_SERVIDOR', 'localhost');
define('BD_CODIFICACION', 'utf8');


//Controlador y método por defecto
define('CONTROLADOR_DEFECTO', '');
define('CONTROLADOR_ERROR', '');
define('METODO_DEFECTO', '');
