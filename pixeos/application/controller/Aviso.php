<?php
 if(!isset($_SERVER['REMOTE_ADDR'])){
    if($_SERVER['OS'] == "Windows_NT"){
        require('C:/MAMP/htdocs/xemicris_com/pixeos/application/iniciador.php');
    }else{
        require_once("/var/www/xemicris_com/pixeos/application/iniciador.php");
    }
}

// if(!empty($_GET)){
//   header('location:' . RUTA . 'panel/index');
//    exit();
// }

/**
 * Clase controladora que permite enviar correos de aviso al llegar la fecha
 *  @author José Maria Calavia Rivera
 */
class Aviso extends ControladorGeneral{
    /**
     * modelo
     * @var object
     */
    private $model;

    /**
     * Constructor que llama al modelo AdminModel
     */
    function __construct(){
        $this->model = $this->model("AvisoModel");
    }

    /**
     * Función que convierte una fecha en string a una fecha de tipo DateTime
     * @param string | Datetime $fecha =>fecha a convertir
     * @return dateTime $fecha =>fecha convertida
     */
    function fechaStrAFechaHora($fecha){
        return is_string($fecha) ? new DateTime($fecha) : $fecha;
    }

    /**
     * Función que comprueba si la fecha1 es menor que la fecha2
     * @param string $fecha1 => fecha inicial
     * @param dateTime $fecha2 => fecha actual
     * @return boolean true => si la fecha inicial es menor que la actual y false en caso contrario
     */
    function compararFechas($fechaAlmacenada){
        $fechaActual = new DateTime();
        $fechaActualFormateada = $fechaActual->format('Y-m-d');
        if($fechaAlmacenada == $fechaActualFormateada){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 
     */
    function obtenerFechaTareaHoy(){
    $tareaHoy = '';
    $fechasAlmacenadas = $this->model->obtenerFechas();
    foreach($fechasAlmacenadas as $fechaAlmacenada){
        $fechaComprobar = $this->compararFechas($fechaAlmacenada['fecha']);
        if($fechaComprobar == true){
            $tareaHoy = $fechaAlmacenada['fecha'];
        }
    }
        return $tareaHoy;
    }

    function obtenerDatosEmail(){
        $fechaTareas = $this->obtenerFechaTareaHoy();
        if($fechaTareas !== ""){
            $tareas = $this->model->obtenerDatos($fechaTareas);
            return $tareas;
        }
    }

    function enviarEmail(){
        //Varibales
        $correo = '';
        $nombre = '';
        $mensaje = '';

        $tareas = $this->obtenerDatosEmail();
        if($tareas && $tareas != []){
            $fechaActual = new DateTime();
            $fechaActualFormateada = $fechaActual->format('d-m-Y');
            foreach($tareas as $tarea){
                if($tarea['notificacion'] != ""){
                    $correo = $tarea['correo'];
                    $nombre = $tarea['nombre'];
                    $mensaje = $tarea['nombreTarea'];
                    $descripcion = $tarea['descripcionTarea'];
                    $email = new Email($correo, $nombre, '', $mensaje, $descripcion);
                    $correo = $email->notificacionTarea($fechaActualFormateada);
                    if($tarea['notificacion'] != 'unica') $this->nuevaFecha($tarea['id'], $tarea['notificacion']);
                }
            }
        }
    }

    function nuevaFecha($idTarea, $notificacion){
        $fechaActual = date('d-m-Y');
        $fechaSiguiente = $this->calcularFechaSiguiente($notificacion, $fechaActual);
        $this->model->modificarFechaNotificacion($idTarea, $fechaSiguiente);
    }

    function calcularFechaSiguiente($notificacion, $fechaActual){
        $fechaNueva = "";
        switch ($notificacion) {
            case 'diaria':
                $fechaNueva = date('Y-m-d', strtotime($fechaActual . "+ 1 day"));
                break;
            case 'semanal':
                $fechaNueva = date('Y-m-d', strtotime($fechaActual . "+ 1 week"));
                break;
            case 'mensual':
                $fechaNueva = date('Y-m-d', strtotime($fechaActual . "+ 1 month"));
                break;
        }
        return $fechaNueva;
    }
}


$avisa = new Aviso();
$avisa->enviarEmail();


