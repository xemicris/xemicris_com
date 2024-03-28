<?php

/**
 * Clase que comunica con la base de datos para manejar la administración de incidencias
 *  @author Jose Maria Calavia Rivera
 */
class TecModel {
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

    /**
     * Método que obtiene un usuario de la BD a través de su id
     * @param int $id id del usuario
     * @return array $usuario con los datos del usuario
     */
    function obtenerUsuarioPorId($id){
        $sql = "SELECT * FROM usuarios WHERE id = '".$id."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }

    /**
     * Método que muestra las incidencias registradas en la Base de datos
     * @return array $incidencias con la lista de usuarios y sus datos
     */
    function listaIncidencias(){
        $sql = "SELECT id, fecha, comentario, estado, usuarioId FROM incidencias;";
        $incidencias = $this->bd->multipleQuery($sql);
       return $incidencias;
    }

    /**
     * Método que obtiene una incidencia de la BD a través de su id
     * @param int $id id de la incidencia
     * @return array $incidencia con los datos de la incidencia
     */
    function obtenerIncidenciaId($id){
        $sql = "SELECT * FROM incidencias WHERE id = '".$id."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }


    /**
     * Método que modifica el estado de una incidencia en la BD
     * @param array $datos con el id y estado de la incidencia
     * @return boolean true si se ha modificado con éxito, false en caso contrario
     */
    function editarIncidencia($datos){
        $result = false;
        $sql = "UPDATE incidencias SET estado = ".$datos['estado']." WHERE id= ".$datos["idIncidencia"];
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }
}