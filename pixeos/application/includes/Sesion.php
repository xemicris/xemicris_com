<?php

    /**
     * Clase que maneja la sesión
     *  @author Jose Maria Calavia Rivera
     */
    class Sesion{
        /**
         * @var array $usuario con los datos del usuario
         */
        private $usuario;
    
        /**
         * Constructor que inicia la sesión
         */
        function __construct(){
            //inicia la sesión
            session_start();
        }

        /**
         * Método que almacena el usuario en sesión
         * @param array $usuario con los datos del usuario
         */
        public function almacenarSesion($usuario){
            //Si existe usuario
            if($usuario){
                $this->usuario = $_SESSION["usuario"] = $usuario;
            }

        }

        /**
         * Método que comprueba que existe la sesión del usuario.
         */
        public function comprobarSesion(){
            $urlActual = $_SERVER["REQUEST_URI"];
            $url = encabezado(($urlActual));

            //Si existe la sesión usuario 
            if(isset($_SESSION["usuario"])){
                //se asigna 
                $this->usuario = $_SESSION["usuario"];
                if($this->usuario['rol'] == "2"){
                    if ($url == 'admin' || $url == 'tec') {
                        header('location:' . RUTA . 'panel/index');
                    }
                }else if($this->usuario['rol'] == "1"){
                    if($url == 'profile' || $url == 'contact' || $url == 'viewStatistics'|| $url == 'contact/' 
                    || $url == 'panel' || $url == 'tec'){
                        header('location:' . RUTA . 'admin/admin');
                    }
                }else if($this->usuario['rol'] == "3"){
                    if($url == 'profile' || $url == 'contact' || $url == 'viewStatistics'|| $url == 'contact/' 
                    || $url == 'panel' || $url == 'admin'){
                        header('location:' . RUTA . 'tec/tec');

                    }
                }
    
            }else{
                //si no está definido se elimina
                unset($this->usuario);

                header('location:' . RUTA . 'access/login');
            }
        }

        /**
         * Método que actualiza algunos datos de la sesión del usuario
         */
        public function actualizarDatosSesion($datosActualizados){
            if(isset($_SESSION["usuario"])){
                $_SESSION["usuario"]["nombre"] = $datosActualizados["nombre"]; 
                $_SESSION["usuario"]["apellidos"] = $datosActualizados["apellidos"]; 
                $_SESSION["usuario"]["profesion"] = $datosActualizados["profesion"]; 
            }
        }
    
        /**
         * Método que finaliza la sesión
         */
        public function finalizarLogin(){
            //eliminar sesión
            unset($_SESSION["usuario"]);
            //eliminar atributo usuario
            unset($this->usuario);
            //destruir la sesión
            session_destroy();
            header('location:' . RUTA . 'access/login');
        }
    
    
        /**
         * Getter
         */
        public function getUsuario(){
            return $this->usuario;
        }
}