<?php
/**
 * Clase que toma la url, la divide y obtiene el controlador, método y parámetros
 *  @author Jose Maria Calavia Rivera
 */
class Router{
    /**
     * @var string $controlador atributo que almacena el controlador y se le asigna uno por defecto
     */
    protected $controller = "Access";

    /**
     * @var string $metodo atributo que almacena el método y se le asigna uno por defecto
     */
    protected $method = "index";

    /**
     * @var array $parametros atributo que almacena los parámetros
     */
    protected $param = [];

    /**
     * Constructor que obtiene el controlador, método y parámetros de la url ya
     * separada
     */
    public function __construct(){

        // $bd = new BaseDatos();

        $urlSeparada = $this->separarUrl();

        $this->Routing($urlSeparada);
    }

    /**
     * Método que devuelve de la url el controlador, método y parámetros
     * @return array $urlSeparada con el controlador, método y parámetros 
     */
    public function separarUrl(){
        $url = "";
        $urlSeparada = "";

        if(isset($_GET["url"])){

            $url = $_GET["url"];
            $url = rtrim($url, "/");
            $url = rtrim($url, "\\");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $urlSeparada = explode("/", $url);
        }

        return $urlSeparada;
    }

    /**
     * Método que llama al controlador y método que se pasa por la url
     * @param array $urlSeparada con la url separada
     */
    public function Routing($urlSeparada){
        if(isset($urlSeparada)){
            if(!empty($urlSeparada)){
                $controlador = $urlSeparada[0];
                if(file_exists("../application/controller/".ucwords($controlador) . ".php")){
                    //obtener el controlador
                    $this->controller = ucwords($controlador);
                    unset($urlSeparada[0]);
                }
            }

            //cargar el controlador (si no se ha pasado uno se carga el asignado por defecto)
            include_once("../application/controller/".ucwords($this->controller).".php");

            //Instanciar el controlador
            $this->controller = new $this->controller;

            //obtener el método (si existe)
            if(isset($urlSeparada[1])){
                $metodo = $urlSeparada[1];
                if(method_exists($this->controller, $metodo)){
                    $this->method = $metodo;
                    unset($urlSeparada[1]);
                    }
                }

            //obtener los parámetros
            $this->param = $urlSeparada ? array_values($urlSeparada) : [];


            //Llamada al método correspondiente con sus parámetros
            call_user_func_array(
                [
                    $this->controller,
                    $this->method
                ],
                $this->param
            );

            //Reseteo de parámetros
            $this->param = []; 
        }
    
    }
}