<?php

class Cargador{
    //propiedades
    private $nombreFramework = "xemicris";

    private $version = "1.0.0";

    //uri que se pasa al navegador
    private $uri = [];

    private $controladorActual;

    //función principal que se ejecuta al instanciar la clase
    function __construct(){
        $this->inicio();
    }

    /**
     * método que se llama y ejecuta el resto
     * @return void
     */
    private function inicio(){
        //todos los métodos que se quieren ejecutar consecutivamente
        $this->cargar_config();
        $this->cargar_funciones();
        $this->carga_archivos();
        $this->csrf();
        $this->controladorGeneral();
    }

    /**
     * Cargar archivo de configuración
     * 
     * @return void
     */
    private function cargar_config(){
        $archivo = 'rutas.php';
        if(!is_file('aplicacion/configuracion/' . $archivo)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione', $archivo, $this->nombreFramework));
        }

        //Cargando el archivo de configuración
        require_once 'aplicacion/configuracion/' . $archivo;
    }

    /**
     * Método para cargarlas funciones del sistema y usuario
     * 
     * @return void
     */
    private function cargar_funciones(){
        $archivo = 'funcPrincipal.php';
        if(!is_file(FUNCIONES . $archivo)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione', $archivo, $this->nombreFramework));
        }

        //Cargando el archivo de funciones del sistema
        require_once FUNCIONES . $archivo;

        $archivo = 'funcPersonalizadas.php';
        if(!is_file(FUNCIONES . $archivo)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione', $archivo, $this->nombreFramework));
        }

        //Cargando el archivo de funciones personalizadas
        require_once FUNCIONES . $archivo;

        return;
    }

    /**
     * Método para cargar los archivos de forma automática
     * 
     * @return void
     */
    private function carga_archivos(){
        require_once CLASES . 'Autocargador.php';
        Autocargador::inicio();
        //require_once CLASES . 'Bd.php';
        //require_once CLASES . 'Modelo.php';
        //require_once CLASES . 'Vista.php';
        //require_once CLASES . 'Controlador.php';
        //require_once CONTROLADORES . CONTROLADOR_DEFECTO . 'Controlador.php';
        //require_once CONTROLADORES . CONTROLADOR_ERROR . 'Controlador.php';
    }


    /**
     * Método para crear un nuevo token de la sesión del usuario
     * 
     * @return void
     */
    private function csrf(){
        $token = new Csrf();
        define('TOKEN_CSRF', $token->generarToken());
    }

    /**
     * Método para filtrar, descomponer los elementos de la url y retornarlos
     * 
     * @return array
     */
    private function filtrar_url(){
        if(isset($_GET['uri'])){
            $this->uri = $_GET['uri'];
            //quitar /
            $this->uri = rtrim($this->uri, '/');
            //limpia caracteres dañinos que se quieran pasar a la url
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            //crear array y cada valor será a partir de la /
            $this->uri = explode('/', strtolower($this->uri));
            return $this->uri;
        }
    }

    /**
     * Método  para cargar y ejecutar de forma automática el controlador solicitado
     * 
     * @return array
     */
    private function controladorGeneral(){
        //filtrar url y separar la uri
        $this->filtrar_url();

        //Que controlador cargar
        if(isset($this->uri[0])){
            $controladorIntroducido = $this->uri[0];
            unset($this->uri[0]);
        }else{
            $controladorIntroducido = CONTROLADOR_DEFECTO;
        }

        //Verificar si existe la clase controladora solicitada
        $controlador = $controladorIntroducido . 'Controlador';

        if(!class_exists($controlador)){
            $controladorIntroducido = CONTROLADOR_ERROR;
            $controlador = CONTROLADOR_ERROR . 'Controlador'; //error
        }

        //Qué método cargar
        if(isset($this->uri[1])){
            $metodoIntroducido = str_replace('-','_', $this->uri[1]);

            //validar si existe el método (controlador)
            if(!method_exists($controlador, $metodoIntroducido)){
                $controlador = CONTROLADOR_ERROR . 'Controlador';
                $metodo = METODO_DEFECTO; //index
                $controladorIntroducido = CONTROLADOR_ERROR;
            }else{
                $metodo = $metodoIntroducido;
            }
            unset($this->uri[1]);
        }else{
            $metodo = METODO_DEFECTO;
        }

        //Constantes controlador/método para reutilizarlas
        define('CONTROLADOR', $controladorIntroducido);
        define('METODO', $metodo);

        //Llamada al controlador
        $controlador = new $controlador;
        
        //Obteniendo los parámetros de la uri -> se usa array_values para reiniciar el array desde 0
        $parametros = array_values(empty($this->uri) ? [] : $this->uri);

        //Llamada al método
        $llamada = array($controlador, $metodo);
        if(empty($parametros)){
            call_user_func($llamada);
        }else{
            call_user_func_array($llamada, $parametros);
        }
    }

    
    /**
    * Método que ejecuta el Framework
    *
    * @return void
    */
    public static function ejecutarFramework(){
        $framework = new self();
        return;
    }
}