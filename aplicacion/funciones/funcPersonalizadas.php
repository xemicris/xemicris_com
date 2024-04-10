<?php
//funciones del sistema

function obtenerMonedas()
{
  return ['EUR', 'USD', 'BRL', 'MXN', 'CAD'];
}

function captcha()
{
  $data = array(
    'secret' => "",
    'response' => $_POST['h-captcha-response']
  );
  $verify = curl_init();
  curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
  curl_setopt($verify, CURLOPT_POST, true);
  curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($verify);
  // var_dump($response);
  $responseData = json_decode($response);
  if ($responseData->success) {
    // your success code goes here
    return true;
  } else {
    // return error to user; they did not pass
    return false;
  }
}


/***********FUNCIONES LIBRERÍA************/
function obtenerContenidoCurl($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function obtenerUri()
{
  if (isset($_GET["uri"])) {
    /*eliminamos las diagonales (algunos navegadores usan diagonal
      invertida)*/
    $url = rtrim($_GET["uri"], "/");
    $url = rtrim($_GET["uri"], "\\");



    //Limpiar caracteres no permitidos en una URL
    $url = filter_var($url, FILTER_SANITIZE_URL);

    //Divide un string en varios dentro de un array (separador, string)
    $url = explode("/", $url);

    if (isset($url[1])) {
      if ($url[1] == "autores") {
        $input = '<div class="buscador">
                      <form id="formularioAutores" method="POST" action="#">
                        <input type="text" id="texto" class="mostrar_sugerencias_autores"><br>
                      </form>
                    </div>
                    ';
      } else {
        $input = false;
      }
    } else {
      $input = '<div class="buscador">
                    <form id="formularioLibros" method="POST" action="#">
                      <input type="text" id="texto" class="mostrar_sugerencias_libros"><br>
                    </form>
                  </div>
                  ';
    }
    return $input;
  }
}

/**
 * Retorna el resultado de comparar una expresión regular con una cadena
 *  
 * @param string cadena que se va a comparar
 * @return array $info_libros con todos los libros
 * @return int 1 si se encuentra una coincidencia, 0 si no se encuentran coincidencias 
 * y falso si se produce un error
 */
function es_texto($cadena)
{
  $patron = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s,]+$/';
  return (preg_match($patron, $cadena));
}

/******FUNCIONES CONTACTO ********* */

function validarContacto($nombre, $apellidos, $correo, $telefono, $mensaje){
    $alertas = [];
    $expresionCorreo = "/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/";
    $expresionNombreApellidos = "/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/";
    $expresionTelefono = "/^(\+34|0034|34)?[9|8|6|7][0-9]{8}$/";

    if(empty($nombre)){
        array_push($alertas, "Nombre requerido");
    }else if(!preg_match($expresionNombreApellidos, $nombre)){
        array_push($alertas, "Nombre no válido");
    }
    if(empty($apellidos)){
        array_push($alertas, "Apellidos requeridos");
    }else if(!preg_match($expresionNombreApellidos, $apellidos)){
        array_push($alertas, "Apellidos no válidos");
    }
    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else{
        if(!preg_match($expresionCorreo, $correo)){
            array_push($alertas, "El correo electrónico no es válido");
        }
    }
    if(!empty($telefono)){
        if(!preg_match($expresionTelefono, $telefono)){
        array_push($alertas, "El formato del teléfono no es correcto");
        }
    }
    if(empty($mensaje)){
        array_push($alertas, "Escriba un mensaje");
    }
    return $alertas;
}

function uriJavascript(){
  if (isset($_GET["uri"])) {
    /*eliminamos las diagonales (algunos navegadores usan diagonal
      invertida)*/
    $url = rtrim($_GET["uri"], "/");
    $url = rtrim($_GET["uri"], "\\");



    //Limpiar caracteres no permitidos en una URL
    $url = filter_var($url, FILTER_SANITIZE_URL);

    //Divide un string en varios dentro de un array (separador, string)
    $url = explode("/", $url);

    return $url[0];

  }
}

function getRemoteFile($url, $timeout = 10) {
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $file_contents = curl_exec($ch);
  curl_close($ch);
  return ($file_contents) ? $file_contents : FALSE;
}


