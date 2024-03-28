<?php


/**
 * Clase controladora que permite manejar el panel de administración
 *  @author José Maria Calavia Rivera
 */
class Admin extends ControladorGeneral{
    /**
     * modelo
     * @var object
     */
    private $model;

    /**
     * Constructor que llama al modelo AdminModel
     */
    function __construct(){
        $this->model = $this->model("AdminModel");
    }

    /**
     * Método que redirecciona
     */
    function index(){
        header('location:' . RUTA . 'admin/admin');
    }

    /**
     * Método que gestiona la vista de login por defecto
     */
    function admin(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener datos
        $usuarioSesion = $sesion->getUsuario();
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        //Vista por defecto
            $datos = [
                "titulo" => "Pixeos | Admin",
                "subtitulo" => "Panel de administración",
                'usuario' => $usuario
            ];
            $this->view("admin", $datos);
    }

    /**
     * Método que muestra los usuarios registrados
     */
    function mostrarUsuarios(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener datos
        $listaUsuarios = $this->model->listaUsuarios();

        echo json_encode($listaUsuarios);
    }

    /**
     * Método que muestra el rol
     */
    function selectRol(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idUsuario = $_POST['idUsuario'] ?? "";
            $usuarioSeleccionado = $this->model->obtenerUsuarioPorId($idUsuario);
            if($usuarioSeleccionado){
                echo json_encode($usuarioSeleccionado);
            }
        }

    }

    /**
     * Método que actualiza los datos de los usuarios
     */
    function updateUser(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

         //declarar variables locales
         $datos = [];
         $alertas = [];
    
         if($_SERVER['REQUEST_METHOD'] == "POST"){
  
             //Obtener datos del usuario
              $idUsuario = $_POST['idUsuario'] ?? "";
              $nombre = $_POST['nombre'] ?? "";
              $apellidos =  $_POST['apellidos'] ?? "";
              $correo = $_POST['correo'] ?? "";
              $rol = $_POST['rol'] ?? "";
              $confirmado = $_POST['confirmado'] ?? "";

             $alertas = validarDatosAdmin($nombre, $apellidos, $correo);

             //todo ok
              if(empty($alertas)){
                //rellenar array
                $datos =[
                    "id" => $idUsuario,
                    "nombre" => $nombre,
                    "apellidos" => $apellidos,
                    "correo" => $correo,
                    "rol" => $rol,
                    "confirmado" => $confirmado
                ];

                if(!empty($idUsuario)){
                    $usuarioActualizado = $this->model->actualizarUsuario($datos);
                    if($usuarioActualizado){
                        echo json_encode($usuarioActualizado);
                    }
                }
              }else{
                echo json_encode($alertas);
              }
         }
    }

    /**
     * Método que permite eliminar un usuario
     */
    function eliminateUser(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idUsuario = $_POST['idUsuario'] ?? "";
            if($idUsuario){
                $usuarioEliminado = $this->model->eliminarUsuario($idUsuario);
                if($usuarioEliminado){
                    echo json_encode($usuarioEliminado);
                }
            }
        }
    }

}