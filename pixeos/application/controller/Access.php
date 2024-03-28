<?php


/**
 * Clase controladora que permite dar de alta usuarios, recupear contraseñas y hacer login
 *  @author José Maria Calavia Rivera
 */
class Access extends ControladorGeneral{
    /**
     * modelo
     * @var object
     */
    private $model;

    /**
     * Constructor que llama al modelo AccessModel
     */
    function __construct(){
        $this->model = $this->model("AccessModel");
    }

    /**
     * Método que redirige
     */
    function index(){
        header('location:' . RUTA . 'access/login');
    }

    /**
     * Método que gestiona la vista de login por defecto
     */
    function login(){
        //Iniciar sesión
        $sesion = new Sesion();

        //declarar variables locales
        $alertas = [];
     
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //obtener datos
            $correo = $_POST["correo"] ?? "";
            $contrasena = $_POST["contrasena"] ?? "";

            //Comprobar datos
            $alertas = validarLogin($correo, $contrasena);

            //Todo Ok
            if(empty($alertas)){
                $usuario = $this->model->obtenerUsuarioPorCorreo($correo);
                if($usuario){
                    //devuelve true o false
                    $usuarioVerificado = validarContrasena($usuario['contrasena'], $contrasena);
                    if($usuarioVerificado){
                        $usuarioActivado = validarActivacion($usuario['confirmado']);
                        if($usuarioActivado){
                            $usuarioRol = $this->model->obtenerRol($usuario['id']);
                            if($usuarioRol['rol'] == '1'){
                                $sesion->almacenarSesion($usuario);
                                header('location:' . RUTA . 'admin/admin');
                            }else if($usuarioRol['rol'] == '2'){
                                $sesion->almacenarSesion($usuario);
                                header('location:' . RUTA . 'panel/panel');
                            }else if($usuarioRol['rol'] == '3'){
                                header('location:' . RUTA . 'tec/tec');
                                $sesion->almacenarSesion($usuario);
                            }
                        //No activado
                        }else{
                            $alertas = [];
                            array_push($alertas, "Debe activar su cuenta. <br>Si no ha recibido un correo puede que su cuenta haya sido suspendida. <br>Contacte con: pixeosweb@gmail.com");
                            $datos = [
                                "titulo" => "Pixeos | Login",
                                "subtitulo" => "Pixeos | Login",
                                "alertas" => $alertas,
                            ];
                            $this->view("login", $datos);
                        }
                        
                    //contraseña incorrecta
                    }else{
                        $alertas = [];
                        array_push($alertas, "Contraseña incorrecta");
                        $datos = [
                            "titulo" => "Pixeos | Login",
                            "subtitulo" => "Pixeos | Login",
                            "alertas" => $alertas,
                        ];
                        $this->view("login", $datos);
                    }
                
                //El usuario no existe
                }else{
                    $alertas = [];
                    array_push($alertas, "El usuario no existe");
                    $datos = [
                        "titulo" => "Pixeos | Login",
                        "subtitulo" => "Pixeos | Login",
                        "alertas" => $alertas,
                    ];
                    $this->view("login", $datos);
                }

            //Datos incorrectos
            }else{
                $datos = [
                    "titulo" => "Pixeos | Login",
                    "subtitulo" => "Pixeos | Login",
                    "alertas" => $alertas,
                ];
                $this->view("login", $datos);
            }

        //Vista por defecto
        }else{
            $datos = [
                "titulo" => "Pixeos | Login",
                "subtitulo" => "Pixeos | Login",
                "menu" => false
            ];
    
            //llamar a la vista y pasarle los datos
            $this->view("login", $datos);
        }
    }


    /**
     * Método que da de alta un usuario en la BD
     */
    function registration(){
        //declarar variables locales
        $alertas = [];
        $usuario = [];
        $usuarioBD = [];

        //envío por post
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Obtener datos
            $nombre = $_POST["nombre"] ?? "";
            $apellidos = $_POST["apellidos"] ?? "";
            $correo = $_POST["correo"] ?? "";
            $profesion = $_POST["profesion"] ?? "";
            $imagen = $_POST["imagen"] ?? "";
            $contrasena = $_POST["contrasena"] ?? "";
            $contrasenaVerificar = $_POST["contrasenaVerificar"] ?? "";
            $privacidad = $_POST["privacidad"] ?? "" ;

            //Comprobar datos
            $alertas = validarCuentaNueva($nombre, $apellidos, $correo, $profesion, $contrasena, $contrasenaVerificar, $privacidad);

            if(captcha() == false){
                array_push($alertas, 'Captcha incorrecto, inténtalo de nuevo');
            }

            $usuario = [
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "correo" => $correo,
                "profesion" => $profesion,
                "imagen" => $imagen,
                "contrasena" => $contrasena
            ];

            //Todo Ok
            if(empty($alertas)){

                $resultado = $this->model->addUser($usuario);

                //Si se ha insertado correctamente
                if($resultado){
                   
                    //obtener usuario según su correo
                    $usuarioBD = $this->model->obtenerUsuarioPorCorreo($correo);

                    //Enviar email de confirmación
                    $email = new Email($usuarioBD['correo'], $usuarioBD['nombre'], $usuarioBD['token']);
                    $email->enviarConfirmacion();

                    $datos = [
                        "titulo" => "Pixeos | Bienvenido",
                        "subtitulo" => "Bienvenido a Pixeos",
                        "alertas" => [],
                        "usuario" => $usuario,
                        "texto" => "Gracias por registrarte. Hemos enviado las instrucciones a 
                                    tu correo para que puedas activar tu cuenta ",
                        "color" => "alert-success",
                        "url" => "",
                        "colorBoton" => "btn-success",
                        "textoBoton" => "Volver",
                        
                    ];
                    $this->view("messages", $datos);

                //No se ha insertado el registro
                }else{
                    $datos = [
                        "titulo" => "Pixeos | Registro",
                        "subtitulo" => "Pixeos | Registro", 
                        "alertas" => $alertas,
                        "usuario" => $usuario,
                        "texto" => "Ya existe una cuenta con este correo ",
                        "color" => "alert-danger",
                        "url" => "",
                        "colorBoton" => "btn-danger",
                        "textoBoton" => "Regresar"
                    ];
                    $this->view("messages", $datos);
                }

            //Hay alertas en el formulario
            }else{
                
                $datos = [
                    "titulo" => "Pixeos | Registro",
                    "subtitulo" => "Pixeos | Registro",
                    "alertas" => $alertas,
                    "usuario" => $usuario
                ];
        
                $this->view("registrationUser", $datos);
            }
        //vista por defecto registro
        }else{
                
            $datos = [
                "titulo" => "Pixeos | Registro",
                "subtitulo" => "Pixeos | Registro"
            ];
    
            $this->view("registrationUser", $datos);

        }
    }

    /**
     * Método que muestra la vista de la política de privacidad
     */
    function privacy(){

        $datos = [
            "titulo" => "Pixeos | Política de privacidad",
            "subtitulo" => "Pixeos | Política de privacidad",
            "menu" => false
        ];

        //llamar a la vista y pasarle los datos
        $this->view("privacyPolicies", $datos);
    }

    /**legal warning
     * Método que muestra el aviso legal
     */
    function legal(){

        $datos = [
            "titulo" => "Pixeos | Aviso legal",
            "subtitulo" => "Pixeos | Aviso legal",
            "menu" => false
        ];

        //llamar a la vista y pasarle los datos
        $this->view("legalDisclaimer", $datos);
    }

    /**
     * Método que muestra la vista de política de cookies
     */
    function cookies(){

        $datos = [
            "titulo" => "Pixeos | Política de cookies",
            "subtitulo" => "Pixeos | Política de cookies",
            "menu" => false
        ];

        //llamar a la vista y pasarle los datos
        $this->view("cookiePolicy", $datos);
    }

    /**
     * Método que permite activar la cuenta del usuario
     * @param string $parametros con el token de la url
     */
    function activar($parametros){
        //declarar variables locales
        $usuario = [];
        $alertas = [];
        $tokenConfirmado = "";
        $tokenUrl = "";

        //obtener token
        $tokenUrl = $parametros;
        $tokensBD = $this->model->obtenerTokens();
        foreach($tokensBD as $tokenBD){
            if(in_array($tokenUrl, $tokenBD)){
                $tokenConfirmado = $tokenBD['token'];
            }
        }

        //obtener usuario
        $usuario = $this->model->obtenerUsuarioPorToken($tokenConfirmado);
                
        //activar usuario
        if($usuario['token']){
            //devuelve true/false
            $usuarioActivado = $this->model->activarUsuario($usuario['id']);

            if($usuarioActivado){
                $datos = [
                    "titulo" => "Pixeos | Activación",
                    "subtitulo" => "Pixeos | Activación", 
                    "alertas" => [],
                    "usuario" => $usuario,
                    "texto" => "Usuario activado correctamente. Puede iniciar sesión ",
                    "color" => "alert-success",
                    "url" => "",
                    "colorBoton" => "btn-success",
                    "textoBoton" => "Login"
                ];
                $this->view("messages", $datos);
            }

        //Usuario no existe o está activado
        }else{
            array_push($alertas, 'El usuario no existe o ya ha sido activado');
            $datos = [
                "titulo" => "Pixeos | Activación",
                "subtitulo" => "Pixeos | Activación", 
                "alertas" => $alertas,
                "usuario" => [],
                "texto" => "",
                "color" => "alert-danger",
                "url" => "",
                "colorBoton" => "btn-danger",
                "textoBoton" => "Login"
            ];
            $this->view("messages", $datos);
        }
    }


    /**
     * Método que envía un email para poder cambiar la clave de acceso
     */
    function recover(){
        //declarar variables locales
        $alertas = [];
        $usuarioBD = [];
        $correo = "";

        //envío por POST
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //obtener datos
            $correo = $_POST["correo"] ?? "";
            
            
            //validar dato
            $alertas = validarEnvioCorreo($correo);
            
            //todo Ok
            if(empty($alertas)){

                $usuarioBD = $this->model->obtenerUsuarioPorCorreo($correo);

                //El correo  existe en la BD
                if($usuarioBD){
                    $token = $this->model->insertarToken($usuarioBD['id']);
                    $usuarioBD = $this->model->obtenerUsuarioPorCorreo($correo);
                    //token insertado
                    if($token){
                        $email = new Email($usuarioBD['correo'], $usuarioBD['nombre'], $usuarioBD['token']);
                        $email->enviarInstrucciones();
                    
                        
                    $datos = [
                        "titulo" => "Pixeos | Cambio contraseña",
                        "subtitulo" => "Pixeos | Cambio contraseña",
                        "alertas" => [],
                        "usuario" => $usuarioBD,
                        "texto" => "Hemos enviado las instrucciones a tu correo para que 
                            puedas modificar tu contraseña",
                        "color" => "alert-success",
                        "url" => "",
                        "colorBoton" => "btn-success",
                        "textoBoton" => "Volver",
                        
                    ];
                    $this->view("messages", $datos);
                    
                }
                    
                //El correo no existe en la BD
                }else{
                    $alertas =[];
                    array_push($alertas, 'Usuario no registrado');
                    $datos = [
                        "titulo" => "Pixeos | Cambiar contraseña",
                        "subtitulo" => "Pixeos | Cambiar contraseña", 
                        "alertas" => $alertas,
                        "texto" => "Por favor, regístrese para acceder a todo nuestro contenido ",
                        "color" => "alert-danger",
                        "url" => "access/registration",
                        "colorBoton" => "btn-danger",
                        "textoBoton" => "Regresar"
                    ];
                    $this->view("messages", $datos);
                }

            //Hay alertas
            }else{
                $datos = [
                    "titulo" => "Pixeos | Cambiar contraseña",
                    "subtitulo" => "Pixeos | Cambiar contraseña",
                    "alertas" => $alertas,
                    "usuario" => $usuarioBD
                ];
        
                $this->view("recover", $datos);
            }

        //vista inicial
        }else{
            $datos = [
                "titulo" => "Pixeos | Cambiar contraseña",
                "subtitulo" => "Pixeos | Cambiar contraseña"
            ];
    
            $this->view("recover", $datos);
        }
    }

    /**
     * Método que comprueba que el token de la url del email coincide con el almacenado en la BD
     * @param string $parametros con el token de la url
     */
    function verificarCambio($parametros = ''){
         //declarar variables locales
         $usuario = [];
         $tokenConfirmado = "";
         $tokenUrl = "";
 
         //obtener token
         $tokenUrl = $parametros;
 
         //se puede cambiar la contraseña
         if(!empty($tokenUrl)){
             $tokensBD = $this->model->obtenerTokens();
             foreach($tokensBD as $tokenBD){
                 if(in_array($tokenUrl, $tokenBD)){
                     $tokenConfirmado = $tokenBD['token'];
                 }
             }

         //no hay token -> redirecciona al index
         }else{
            header('location:' . RUTA . 'access/login');
         }
 
         if($tokenConfirmado){
             //obtener usuario, almcenarlo en una cookie y redireccionar para el cambio
             $usuario = $this->model->obtenerUsuarioPorToken($tokenConfirmado);
             setcookie("usuario", json_encode($usuario), time()+3600, RUTA);
             header('location:' . RUTA . '/access/cambiar/');
 
         //Token alterado
         }else{
            header('location:' . RUTA . 'access/login');
         }
    }

    /**
     * Método que cambia la contraseña de acceso
     */
    function cambiar(){

        //Obtención del usuario
        if(isset($_COOKIE["usuario"])){
            $usuario = json_decode($_COOKIE['usuario'], true);
        }else{
            header('location:' . RUTA . 'access/login');
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //nuevas contraseñas
            $contrasena = $_POST["contrasena"] ?? "";
            $contrasenaVerificar = $_POST["contrasenaVerificar"] ?? "";
    
            //Comprobar datos
            $alertas = validarContrasenas($contrasena, $contrasenaVerificar);
    
            //todo Ok
            if(empty($alertas)){
                $usuarioContrasenaCambiada = $this->model->cambiarContrasena($usuario,$contrasena);
                if($usuarioContrasenaCambiada){
                    $datos = [
                        "titulo" => "Pixeos | Cambio Contraseña",
                        "subtitulo" => "Pixeos | Cambio contraseña", 
                        "alertas" => [],
                        "usuario" => $usuario,
                        "texto" => "Contraseña modificada correctamente. Puede iniciar sesión ",
                        "color" => "alert-success",
                        "url" => "/",
                        "colorBoton" => "btn-success",
                        "textoBoton" => "Login"
                    ];
                    $this->view("messages", $datos);
                        
                //No se ha podido cambiar la contraseña
                }else{
                    $alertas =[];
                    array_push($alertas, 'No se ha podido modificar la contraseña');
                    $datos = [
                        "titulo" => "Pixeos | Cambio contraseña",
                        "subtitulo" => "Pixeos | Cambio contraseñas", 
                        "alertas" => $alertas,
                        "usuario" => $usuario,
                        "texto" => "",
                        "color" => "alert-danger",
                        "url" => "access/recover/",
                        "colorBoton" => "btn-danger",
                        "textoBoton" => "Regresar"
                    ];
                    $this->view("messages", $datos);
                }
    
            //hay alertas
            }else{
    
                $datos = [
                    "titulo" => "Pixeos | Cambiar contraseña",
                    "subtitulo" => "Pixeos | Cambiar contraseña",
                    "alertas" => $alertas,
                    "usuario" => $usuario
                ];
            
                $this->view("changePass", $datos);
            }
                
                //vista por defecto
        }else{
            $datos = [
                "titulo" => "Pixeos | Cambio contraseña",
                "subtitulo" => "Pixeos | Cambio contraseña"
            ];
            
            $this->view("changePass", $datos);
        }
    }

}