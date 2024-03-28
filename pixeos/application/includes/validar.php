<?php

/**
 * Función que valida que verifica que la contraseña introducida por el usuario coincida con la que está 
 * almacenada en la BD
 * @param $contrasenaBD String contraseña BD
 * @param $contrasenaInput String contraseña introducida por el usuario
 * @return true si ambas coinciden o false si no es así
 */
function validarContrasena($contrasenaBD, $contrasenaInput){
    $hash = substr( $contrasenaBD, 0, 60 );
    if(password_verify($contrasenaInput, $hash)){
        return true;
    }
    return false;
}

/**
 * Función que valida que el usuario ha activado su cuenta
 * @param $confirmado String 1 si está confirmado, 0 si no lo está
 * @return true si la ha confirmado, false en caso contrario
 */
function validarActivacion($confirmado){
    return ($confirmado == '1') ? true:false;

}

/**
 * Función que valida los datos introducidos por el usuario en el registro
 * @param string $nombre nombre del usuario 
 * @param string $apellidos apellidos del usuario
 * @param string $correo correo del usuario
 * @param string $profesion profesión del usuario
 * @param string $contrasena contraseña del usuario
 * @param string $contrasenaVerificar contraseña de verificación del usuario
 * @return array $alertas si hay algún error en la introducción de los datos
 */
function validarCuentaNueva($nombre, $apellidos, $correo, $profesion, $contrasena, $contrasenaVerificar,
 $privacidad){
    $alertas = [];
    $expresionCorreo = "/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/";
    $expresionNombreApellidoProfesion = "/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/";
    $expresionContrasena = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}/";

    if(empty($nombre)){
        array_push($alertas, "Nombre requerido");
    }else if(!preg_match($expresionNombreApellidoProfesion, $nombre)){
        array_push($alertas, "Nombre no válido");
    }
    if(empty($apellidos)){
        array_push($alertas, "Apellidos requeridos");
    }else if(!preg_match($expresionNombreApellidoProfesion, $apellidos)){
        array_push($alertas, "Apellidos no válidos");
    }
    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else if(!preg_match($expresionCorreo, $correo)){
            array_push($alertas, "El correo electrónico no es válido");
    }
    if(!empty($profesion)){
        array_push($alertas, "La profesión no puede contener números ni carácteres especiales");
    }
    if(empty($contrasena)){
        array_push($alertas, "Contraseña requerida");
    }else if( !preg_match($expresionContrasena, $contrasena)){
        array_push($alertas, "La contraseña debe incluir entre 8 y 15 caracteres, una letra en mayúscula, 
        una en minúscula, un dígito, un caracter especial y sin espacios en blanco");
    }
    if(empty($contrasenaVerificar)){
        array_push($alertas, "Contraseña de verificación requerida");
    }
    if($contrasena != $contrasenaVerificar){
        array_push($alertas, "Las contraseñas no coinciden");
    }
    if($privacidad != "marcado"){
        array_push($alertas, "Debe aceptar nuestra política de privacidad");
    }

    return $alertas;
}

/**
 * Función que comprueba que se ha introducido un correo y se ajusta al formato deseado
 * @param string $correo con el correo introducido por el usuario
 * @return array $alertas con las alertas si las hay
 */
function validarEnvioCorreo($correo){
    $alertas = [];
    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else{
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            array_push($alertas, "El correo electrónico no es válido");
        }
    }
    
    return $alertas;
}

/**
 * Función que valida las nuevas contraseñas
 * @param string $contrasena introducida por el usuario
 * @param string $contrasenaVerificar introducida por el usuario
 * @return array $alertas
 */
function validarContrasenas($contrasena, $contrasenaVerificar){
    $alertas = [];

    if(empty($contrasena)){
        array_push($alertas, "Contraseña requerida");
    }
    if(empty($contrasenaVerificar)){
        array_push($alertas, "Contraseña de verificación requerida");
    }
    if($contrasena != $contrasenaVerificar){
        array_push($alertas, "Las contraseñas no coinciden");
    }

    return $alertas;
}

/**
 * Función que valida que se envían datos en el login y tienen el formato que se espera
 * @param $correo String correo usuario
 * @param $contrasena String contraseña usuario
 * @return array $alertas si hay alertas
 */
function validarLogin($correo, $contrasena){
    $alertas = [];

    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else{
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            array_push($alertas, "El correo electrónico no es válido");
        }
    }
    if(empty($contrasena)){
        array_push($alertas, "Contraseña requerida");
    }

    return $alertas;
}

/**
 * Función que valida los datos introducidos por el usuario en el formulario de contacto
 * @param string $nombre nombre del usuario 
 * @param string $apellidos apellidos del usuario
 * @param string $correo correo del usuario
 * @param string $consulta con el mensaje del usuario
 * @return array $alertas si hay algún error en la introducción de los datos
 */
function validarContacto($nombre, $apellidos, $correo, $consulta){
    //Variables
    $alertas = [];
    $expresionCorreo = "/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/";
    $expresionNombreApellidoProfesion = "/^([a-zA-Záéíóú]+)(\s[a-zA-Záéíóú]+)*$/";

    if(empty($nombre)){
        array_push($alertas, "Nombre requerido");
    }else if(!preg_match($expresionNombreApellidoProfesion, $nombre)){
        array_push($alertas, "Nombre no válido");
    }

    if(empty($apellidos)){
        array_push($alertas, "Apellidos requeridos");
    }else if(!preg_match($expresionNombreApellidoProfesion, $apellidos)){
        array_push($alertas, "Apellidos no válidos");
    }

    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else{
        if(!preg_match($expresionCorreo, $correo)){
            array_push($alertas, "El correo electrónico no es válido");
        }
    }
    if($consulta != "1" && $consulta !=2){
        array_push($alertas, "Debe seleccionar un motivo de su consulta");
    }
    return $alertas;
}


/**
 * Función que valida que los datos introducidos sean los esperados
 * @param string $nombre nombre del usuario
 * @param string $apellidos apellidos del usuario
 * @param string $correo correo del usuario
 * @return array $alertas con las alertas si las hay
 */
function validarDatosAdmin($nombre, $apellidos, $correo){
    $alertas = [];

    if(empty($nombre)){
        array_push($alertas, "Nombre requerido");
    }
    if(!es_texto($nombre)){
        array_push($alertas, 'Nombre incorrecto');
      }
    if(empty($apellidos)){
        array_push($alertas, "Apellidos requeridos");
    }
    if(!es_texto($apellidos)){
        array_push($alertas, 'Apellidos incorrectos');
      }
    if(empty($correo)){
        array_push($alertas, "Correo requerido");
    }else{
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            array_push($alertas, "El correo electrónico no es válido");
        }
    }
      return $alertas;
}

/**
 * Función que valida que la cadena que se pasa cumple un patrón
 * @param string $cadena cadena que se quiere comprobar
 * @return true  1 si la cadena cumple con el patrón, 0 si no lo cumple y false si hay algún error
 */
function es_texto($cadena){
    $patron = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s¿?¡!,.0-9]+$/';
    return (preg_match($patron, $cadena));
}


function captcha(){
   $host = host();
   $data = array(
            'secret' => "",
            'response' => $_POST['h-captcha-response']
    );
   $verify = curl_init();
   curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
   curl_setopt($verify, CURLOPT_POST, true);
   if($host == "" || $host == "") curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
   curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
   $response = curl_exec($verify);
   // var_dump($response);
   $responseData = json_decode($response);
   if($responseData->success) {
     // your success code goes here
     return true;
   }else {
    // return error to user; they did not pass
    return false;
   }
}


/**
 * Función que valida el correo que se comparte
 * @param string $correo introducido por el usuario
 * @return array $alertas
 */
function validarAntesCompartir($usuario, $usuarioSesion = ''){
    $alertas = [];

    if(empty($usuario)){
        array_push($alertas, "Este usuario no se encuentra disponible");
    }else if($usuario['rol'] == 1 || $usuario['rol'] == 3){
        array_push($alertas, "Este usuario no se encuentra disponible");
    }else if($usuario['nombre'] == $usuarioSesion){
        array_push($alertas, "No es posible compartir una nota con uno mismo");
    }

    return $alertas;
}
