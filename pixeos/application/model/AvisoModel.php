<?php
/**
 * 
 *  @author Jose Maria Calavia Rivera
 */
class AvisoModel {
    /**
     * @var object $bd representa la conexión con la base de datos
     */
    private $bd;

    /**
     * Constructor que inicializa la conexión con la base de datos
     */
    function __construct(){
        $this->bd = new BaseDatos();
    }
    function obtenerFechas(){
        $sql = "SELECT fecha FROM tareas;";
        $fechasTareas = $this->bd->multipleQuery($sql);
        return $fechasTareas;
    }
    function obtenerDatos($fecha){
        $sql = "SELECT u.nombre, u.apellidos, u.correo, p.nombreProyecto, p.urlProyecto, t.id, t.nombreTarea, t.descripcionTarea, t.fecha, t.notificacion 
                FROM usuarios u 
                INNER JOIN proyecto p ON (u.id = p.idUsuario) 
                INNER JOIN tareas t ON (p.id = t.proyectoId)
                WHERE t.fecha = '".$fecha."';";

        $tareas = $this->bd->multipleQuery($sql);
        return $tareas;
    }

    /**
     * Método que actualiza la fecha de una tarea
     * @return boolean true si se actualiza, false en caso contrario
     */
    function modificarFechaNotificacion($idTarea, $nuevaFecha){
        $result = false;
        $sql = "UPDATE tareas SET fecha = '".$nuevaFecha."' WHERE id= ".$idTarea;
        $result = $this->bd->noQuerySelect($sql);
        return $result;
    }
}



