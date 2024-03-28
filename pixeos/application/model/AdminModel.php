<?php

/**
 * Clase que comunica con la base de datos para manejar la administración de usuarios
 *  @author Jose Maria Calavia Rivera
 */
class AdminModel {
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
     * Método que muestra los usuarios registrados en la base de datos
     * @return array $usuarios con la lista de usuarios y sus datos
     */
    function listaUsuarios(){
        $sql = "SELECT id, nombre, apellidos, correo, confirmado, rol FROM usuarios;";
        $usuarios = $this->bd->multipleQuery($sql);
       return $usuarios;
    }

    /**
     * Método que actualiza los datos de un usuario en la BD
     * @param array $datos con los datos del cliente
     * @return boolean true si se ha modificado con éxito, false en caso contrario
     */
    function actualizarUsuario($datos){
        $result = false;
        $sql = "UPDATE usuarios SET nombre = '".$datos["nombre"]."', apellidos = '".$datos["apellidos"]."', correo = '".$datos['correo']."', rol = ".$datos['rol'].", confirmado = ".$datos['confirmado']." WHERE id= ".$datos["id"];
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que elimina un usuario de la BD
     * @param int $idUsuario id del usuario
     * @return boolean true si se ha eliminado con éxito, false en caso contrario
     */
    function eliminarUsuario($idUsuario){
        $sql= "DELETE FROM usuarios WHERE id=". $idUsuario;

        return $this->bd->noQuerySelect($sql);
    }
}