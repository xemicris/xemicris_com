<?php


/**
 * Clase controladora que permite manejar el panel de incidencias
 *  @author José Maria Calavia Rivera
 */
class Tec extends ControladorGeneral{
    /**
     * modelo
     * @var object
     */
    private $model;

    /**
     * Constructor que llama al modelo AdminModel
     */
    function __construct(){
        $this->model = $this->model("TecModel");
    }

    /**
     * Método que redirecciona
     */
    function index(){
        header('location:' . RUTA . 'tec/tec');
    }

    /**
     * Método que gestiona la vista del panel de incidencias
     */
    function tec(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener datos
        $usuarioSesion = $sesion->getUsuario();
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        //Vista por defecto
            $datos = [
                "titulo" => "Pixeos | Panel Incidencias",
                "subtitulo" => "Panel de incidencias",
                'usuario' => $usuario
            ];
            $this->view("panelTec", $datos);
    }

    /**
     * Método que muestra las inicidencias registradas
     */
    function MostrarIncidencias(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //Declarar variables
        $incidencias = [];

        $incidencias = $this->model->listaIncidencias();
        for($i = 0; $i<sizeof($incidencias); $i++) {
            $incidencias[$i]['usuario'] = $this->model->obtenerUsuarioPorId($incidencias[$i]['usuarioId']);
            
        }
        echo json_encode($incidencias);

    }

    /**
     * Método que permite saber en que estado está una incidencia
     */
    function selectEstado(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //Declaración de variables
        $incidenciaSeleccionada = [];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idIncidencia = $_POST['idIncidencia'] ?? "";
            $incidenciaSeleccionada = $this->model->obtenerIncidenciaId($idIncidencia);
            if($incidenciaSeleccionada){
                echo json_encode($incidenciaSeleccionada);
            }
        }
    }

    /**
     * Método que permite modificar el estado de una incidencia
     */
    function modificarEstadoIncidencia(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //declaración de variables
        $incidenciaEditada = false;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idIncidencia = $_POST['idIncidencia'] ?? "";
            $estado = $_POST['estado'] ?? "";

            $datos = [
                'idIncidencia' => $idIncidencia,
                'estado' => $estado
            ];

            $incidenciaEditada = $this->model->editarIncidencia($datos);

            if($incidenciaEditada){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }

        }

    }

}