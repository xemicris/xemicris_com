<?php
/**
 * Clase que comunica con la base de datos para manejar la funcionalidad del panel principal de la aplicación
 *  @author Jose Maria Calavia Rivera
 */
class PanelModel {
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
     * Método que obtiene un usuario de la base de datos a través de su id
     * @param int $id del usuario
     * @return array $usuario datos del usuario
     */
    function obtenerUsuarioPorId($id){
        $sql = "SELECT * FROM usuarios WHERE id = '".$id."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }

    /**
     * Método que obtiene un usuario de la base de datos a través de su correo
     * @param string $correo del usuario
     * @return array $usuario datos del usuario
     */
    function obtenerUsuarioPorCorreo($correo){
        $sql = "SELECT * FROM usuarios WHERE correo = '".$correo."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }

    /**
     * Método que obtiene los proyectos de un usuario de la base de datos a través de su id de Usuario
     * @param int $id id del usuario
     * @return array $proyectos del usuario
     */
    function obtenerProyectosPorIdUsuario($id){
        $sql = "SELECT * FROM proyecto WHERE idUsuario = '".$id."';";
        $proyectos = $this->bd->multipleQuery($sql);
       return $proyectos;
    }
    /**
     * Método que obtiene los proyectos de un usuario de la base de datos a través de su id de Usuario
     * @param int $id id del usuario
     * @return array $proyectos del usuario
     */
    function obtenerProyectosCompartidosPorId($idUsuario){
        $sql = "SELECT * FROM proyecto WHERE id IN (SELECT proyectoId FROM compartir WHERE idUsuario = " . $idUsuario . ") ;";
        $proyectos = $this->bd->multipleQuery($sql);
        return $proyectos;
    }

    /**
     * Método que obtiene los proyectos de un usuario de la base de datos a través de su id de Usuario
     * @param int $id id del usuario
     * @return array $proyectos del usuario
     */
    function obtenernombreUsuarioComparte($idUsuario){
        $sql = "SELECT nombre FROM usuarios WHERE id =" . $idUsuario . ";";
        $nombre = $this->bd->oneQuery($sql);
        return $nombre;
       
    }

    /**
     * Método que obtiene las tareas de un usuario de la base de datos a través del id del proyecto
     * @param int $proyectoId id del proyecto
     * @return array $tareas que pertenecen a ese proyecto
     */
    function obtenerTareasporIdProyecto($proyectoId){
        $sql = "SELECT * FROM tareas WHERE proyectoId = '".$proyectoId."';";
        $tareas = $this->bd->multipleQuery($sql);
       return $tareas;
    }

    /**
     * Método que obtiene la nota y sus tareas a través del id del proyecto
     * @param int $proyectoId id del proyecto
     * @return array $tareas que pertenecen a ese proyecto
     */
    function obtenerNotaYTareasporIdProyecto($proyectoId){
        $sql = "SELECT u.nombre, u.apellidos, p.nombreProyecto, p.completado, p.idUsuario, t.nombreTarea, t.fecha, t.descripcionTarea, t.estado ";
        $sql .= "FROM usuarios u JOIN proyecto p "; 
        $sql .= "ON u.id = p.idUsuario "; 
        $sql .= "JOIN tareas t "; 
        $sql .= "ON p.id = t.proyectoId "; 
        $sql .= "WHERE proyectoId = " . $proyectoId; 
        $nota = $this->bd->multipleQuery($sql);
       return $nota;
    }

/**
     * Método que obtiene el color del último proyecto creado por el usuario
     * @param int $idUsuario id del usuario al que pertenece el proyecto
     * @return array color color del último proyecto
     */
    function obtenerColorUltimoProyecto($idUsuario){
        $sql = "SELECT colorProyecto FROM proyecto WHERE idUsuario = '".$idUsuario."' 
        AND id = (SELECT MAX(id) from proyecto WHERE idUsuario = '".$idUsuario."');";
        $color = $this->bd->oneQuery($sql);
       return $color;
    }


    /**
     * Método que inserta un proyecto en la base de datos
     * @param array $datos con los datos del proyecto
     * @return boolean $result true si se ha insertado o false en caso contrario
     */
    function crearProyecto($datos){
        $result = false;

        if($datos){
            $sql = "INSERT INTO proyecto VALUES (0,";
            $sql.= "'".$datos["nombreProyecto"]['nombre']."', ";
            $sql.= "'".$datos["colorProyecto"]."', ";
            $sql.= "'".$datos["urlProyecto"]."', ";
            $sql.= "".$datos["completado"].", ";
            $sql.= "".$datos["idUsuario"].", ";
            $sql.= "".$datos["compartida"].") ;";

            $result = $this->bd->noQuerySelect($sql);
        }

        return $result;
    }

    /**
     * Método que permite actualizar el nombre de un proyecto en la base de datos
     * @param array $datos del proyecto a editar
     * @return boolean true si se ha actualizado, false si no.
     */
    function actualizarProyecto($datos){
        $result = false;

        $sql = "UPDATE proyecto SET nombreProyecto = '".$datos["nombreProyecto"]["nombre"]."' WHERE id= ".$datos["idProyecto"] . ";";
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que permite eliminar un proyecto de la base de datos
     * @param int $idProyecto id del proyecto
     * @param int $idUsuario id del usuario
     * @return boolean true si se ha eliminado, false en caso contrario.
     */
    function eliminarProyecto($idProyecto, $idUsuario){
        $sql= "DELETE FROM proyecto WHERE id=". $idProyecto . ";";

        return $this->bd->noQuerySelect($sql);
    }

    /**
     * Método que obtiene un proyecto a través del nombre del mismo
     * @param string $nombre nombre del proyecto
     * @param int $idUsuario id del usuario 
     */
    function obtenerProyectoPorNombre($nombre, $idUsuario){
        $sql = "SELECT * FROM proyecto WHERE nombreProyecto LIKE '%".$nombre."%' AND idUsuario = ".$idUsuario;
        $proyecto = $this->bd->multipleQuery($sql);
       return $proyecto;
    }

    /**
     * Método que obtiene los proyectos de un usuario de la base de datos a través de su id de Usuario
     * @param int $idUsuario id del usuario
     * @return string urls de los proyectos de un usuario
     */
    function obtenerUrlsProyectosUsuario($idUsuario){
        $sql = "SELECT urlProyecto FROM proyecto WHERE idUsuario = '".$idUsuario."';";
        $urlsBD = $this->bd->multipleQuery($sql);
       return $urlsBD;
    }

    /**
     * Método que obtiene los proyectos compartidos de un usuario de la base de datos a través de su id de Usuario
     * @param int $idUsuario id del usuario
     * @return string urls de los proyectos compartidos de un usuario
     */
    function obtenerUrlsProyectosCompartidosUsuario($idUsuario){
        $sql = "SELECT urlProyecto FROM proyecto WHERE id IN (SELECT proyectoId FROM compartir WHERE idUsuario = " . $idUsuario . ") ;";
        $urlsBD = $this->bd->multipleQuery($sql);

       return $urlsBD;
    }

    /**
     * Método que obtiene el proyecto de un usuario de la base de datos a través de su url
     * @param string $url del proyecto
     * @return array $datosProyecto datos del proyecto
     */
    function obtenerProyectoUrl($url){
        $sql = "SELECT * FROM proyecto WHERE urlProyecto = '".$url."';";
        $datosProyecto = $this->bd->multipleQuery($sql);
       return $datosProyecto;
    }

    /**
     * Método que inserta una tarea en la base de datos
     * @param array $datos datos de la tarea
     * @return boolean $result true o false
     */
    function crearTarea($datos){
        $result = false;

        if($datos){
            $sql = "INSERT INTO tareas VALUES (0,";
            $sql.= "'".$datos["nombreTarea"]."', ";
            $sql.= "'".$datos["descripcionTarea"]."', ";
            $sql.= "".$datos["fecha"].", ";
            $sql.= "".$datos["estado"].", ";
            $sql.= "".$datos["proyectoId"].", ";
            $sql.= "'".$datos["notificacion"]."')";

            $result = $this->bd->noQuerySelectId($sql);
        }
        return $result;
    }

    /**
     * Método que devuelve una tarea de la base de datos según su id
     * @param int $idTareaCreada id de la tarea
     * @return array $tarea datos de la tarea
     */
    function obtenerTareaporIdTarea($idTareaCreada){
        $sql = "SELECT * FROM tareas WHERE id = '".$idTareaCreada."';";
        $tarea = $this->bd->oneQuery($sql);
       return $tarea;
    }

    /**
     * Método que actualiza los datos de una tarea
     * @param array $datos de la tarea a actualizar
     * @return boolean true si se actualiza, false en caso contrario
     */
    function actualizarTarea($datos){
        $result = false;

        $sql = "UPDATE tareas SET nombreTarea = '".$datos["nombreTarea"]."', descripcionTarea = '".$datos["descripcionTarea"]."', fecha = ".$datos["fecha"].", notificacion = '".$datos["notificacion"]."' WHERE id= ".$datos["idTarea"];
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que modifica el estado de una tarea entre 1 (completada) y 0 (no completada)
     * @param array $datos con los datos de la tarea
     * @return boolean true si se ha modificado el estado o false en caso contrario
     */
    function tareaEstado($datos){
        $result = false;

        $sql = "UPDATE tareas SET estado = '".$datos["estado"]."' WHERE id= ".$datos["idTarea"];
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

        /**
     * Método que modifica el estado de todas las tareas entre 1 (completada) y 0 (no completada)
     * @param array $datos con los datos de la tarea
     * @return boolean true si se ha modificado el estado o false en caso contrario
     */
    function tareasEstado($datos){
        $result = false;
        $sql = "UPDATE tareas SET estado = '".$datos["estado"]."' WHERE proyectoId= ".$datos["idProyecto"];
        $result = $this->bd->noQuerySelect($sql);
        return $result;
    }

    /**
     * Método que permite eliminar una tarea
     * @param int $tareaId id de la tarea a eliminar
     * @param int $proyectoId id del proyecto al que pertenece la tarea
     * @return boolean true si se ha eliminado, false en caso contrario
     */
    function eliminarTarea($tareaId, $proyectoId){
        $sql= "DELETE FROM tareas WHERE id=". $tareaId . " AND proyectoId=" . $proyectoId;
        return $this->bd->noQuerySelect($sql);
    }

    /**
     * Método que permite eliminar todas las tareas de una nota
     * @param int $proyectoId id del proyecto al que pertenece la tarea
     * @return boolean true si se ha eliminado, false en caso contrario
     */
    function eliminarTareas($proyectoId){
        $sql= "DELETE FROM tareas WHERE proyectoId=" . $proyectoId;
        return $this->bd->noQuerySelect($sql);
    }

    /**
     * Método que obtiene el número de tareas de un proyecto
     * @param int $proyectoId id del proyecto
     * @return array $tareas número de tareas
     */
    function numeroTareasUnProyecto($proyectoId){
        $sql = "SELECT COUNT(nombreTarea) FROM tareas WHERE proyectoId = '".$proyectoId."';";
        $tareas = $this->bd->oneQuery($sql);
       return $tareas;
    }

    /**
     * Método que pone como completado un proyecto
     * @param array $datos del proyecto
     * @return boolean true si se ha actualizado correctamente y false en caso contrario
     */
    function proyectoCompletado($datos){
        $result = false;
        $sql = "UPDATE proyecto SET completado = 1 WHERE id= ".$datos["idProyecto"]. ";";
        $result = $this->bd->noQuerySelect($sql);
        return $result;
    }

    /**
     * Método que pone como no completado un proyecto
     * @param array $datos del proyecto
     * @return boolean true si se ha actualizado correctamente y false en caso contrario
     */
    function proyectoNoCompletado($datos){
        $result = false;
        $sql = "UPDATE proyecto SET completado = 0 WHERE id= ".$datos["idProyecto"].";";
        $result = $this->bd->noQuerySelect($sql);
        return $result;
    }

    /**
     * Método que cuenta el número de proyectos que tiene un usuario
     * @param int $idUsuario id del usuario
     * @return array $proyectos que tiene el usuario
     */
    function numeroProyectosPorUsuario($idUsuario){
        $sql = "SELECT COUNT(id) FROM proyecto WHERE idUsuario = '".$idUsuario."';";
        $proyectos = $this->bd->multipleQuery($sql);
       return $proyectos;
    }

    /**
     * Método que cuenta el número de proyectos completados que tiene un usuario
     * @param int $idUsuario id del usuario
     * @return array $proyectos completados que tiene el usuario
     */
    function numeroProyectosCompletadosPorUsuario($idUsuario){
        $sql = "SELECT COUNT(completado) FROM proyecto WHERE completado = 1 AND idUsuario = '".$idUsuario."';";
        $proyectosCompletados = $this->bd->multipleQuery($sql);
       return $proyectosCompletados;
    }

    /**
     * Método que actualiza los datos del perfil
     * @param array $datos con los datos del perfil actualizados
     * @return boolean true si los datos se han actualizado y false si no lo han hecho
     */
    function actualizarPerfil($datos){
        $result = false;

        $sql = "UPDATE usuarios SET nombre = '".$datos["nombre"]."',
         apellidos = '".$datos["apellidos"]."', profesion = '".$datos["profesion"]."',
          imagen = '".$datos["imagen"]."' WHERE id= '".$datos["id"]."';";
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }


    /**
     * Método que inserta una incidencia en la base de datos
     * @param array $datos datos de la incidencia
     * @return boolean $result true o false
     */
    function incidencia($datos){
        $result = false;

        if($datos){
            $sql = "INSERT INTO incidencias VALUES (0,";
            $sql.= "'".$datos['fecha']."', ";
            $sql.= "'".$datos["comentario"]."', ";
            $sql.= "".$datos["estado"].", ";
            $sql.= "".$datos["usuarioId"].")";

            $result = $this->bd->noQuerySelectId($sql);
        }
        return $result;
    }


    /**
     * Método que obtiene el fondo que tiene el usuario en la base de datos
     * @param int $idUsuario id del usuario
     * @return array $fondo con el fondo del usuario
     */
    function obtenerFondo($idUsuario){
        $sql = "SELECT fondo FROM usuarios WHERE id = '".$idUsuario."';";
        $fondo = $this->bd->oneQuery($sql);
        return $fondo;
        
    }

    /**
     * Método que cambia el fondo del usuario en la BD
     * @param array $datos con los datos del fondo y el usuario
     * @return boolean true si se ha cambiado y false en caso contrario
     */
    function cambiarFondo($datos){
        $result = false;
        $sql = "UPDATE usuarios SET fondo = ".$datos['fondo']." WHERE id= ".$datos['idUsuario'].";";
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que elimina la cuenta del usuario de la BD
     * @param int $idUsuario id del usuario
     * @return boolean true si se ha eliminado y false en caso contrario
     */
    function eliminarUsuario($idUsuario){
            $sql= "DELETE FROM usuarios WHERE id=" . $idUsuario;
            return $this->bd->noQuerySelect($sql);
    }

    /**
     * Método que obtiene datos de las tareas para el calendario
     * @param int $idUsuario id del usuario
     * @return array $tareas del usuario
     */
    function datosTareas($idUsuario){
        $sql = "SELECT id, fecha, nombreTarea, descripcionTarea, estado FROM tareas WHERE proyectoId = ANY(SELECT id from proyecto WHERE idUsuario=".$idUsuario.") ORDER BY id;";
        $datosTareas = $this->bd->multipleQuery($sql);
       return $datosTareas;
    }

     /**
     * Método que obtiene los id de las tareas según fecha y usuario
     * @param int $idUsuario id del usuario
     * @return array $tareas del usuario
     */
    function obtenerIdTareas($fecha, $idUsuario){
        $sql = "SELECT id FROM tareas WHERE fecha = '".$fecha."' AND proyectoId = ANY(SELECT id from proyecto WHERE idUsuario=".$idUsuario.") ORDER BY id;";
        $idsTareas = $this->bd->multipleQuery($sql);
       return $idsTareas;
    }
    

     /**
     * Método que obtiene la url de la nota
     * @param int $idUsuario id del usuario
     * @param int $idProyecto id de la nota
     * @return array url de la nota
     */
    function obtenerUrlProyectoSegunTarea($idUsuario, $idTarea){
        $sql = "SELECT urlProyecto FROM proyecto WHERE idUsuario = ".$idUsuario." AND id = (SELECT proyectoId FROM tareas WHERE id=".$idTarea.");";
        $urlProyecto = $this->bd->oneQuery($sql);
        return $urlProyecto;
        
    }

    /**
     * Método que devuelve si una nota está ya compartida con un usuario
     * @param int $idUsuario id del usuario
     * @param int $idProyecto id de la nota
     * @return array datos de la nota compartida y el usuario si los hay
     */
    function obtenerCompartidos($datos){
        $sql = "SELECT * FROM compartir WHERE idUsuario = ".$datos["idUsuario"]." AND proyectoId = " .$datos["idNota"] . ";";
        $datosCompartidos = $this->bd->oneQuery($sql);
       return $datosCompartidos;
    }
    

    /**
     * Método que inserta una nota compartida
     * @param array $datos con los datos de la nota
     * @return boolean $result true si se ha insertado o false en caso contrario
     */
    function compartirNota($datos){
        $resultado = false;

        if($datos){
            $sql = "INSERT compartir VALUES (";
            $sql.= "".$datos["idUsuario"].", ";
            $sql.= "".$datos["idNota"]."";
            $sql.= ")";

            $resultado = $this->bd->noQuerySelect($sql);
        }

        if($resultado){
            $sql = "UPDATE proyecto SET compartida  = compartida + 1 WHERE id =" . $datos['idNota'] . ";";
            $resultado = $this->bd->noQuerySelect($sql);
        }

        return $resultado;
    }

     /**
     * Método que elimina una nota compartida
     * @param int $idUsuario id del usuario
     * @return boolean true si se ha eliminado y false en caso contrario
     */
    function eliminarNotaCompartida($datos){
        $resultado = false;

        if($datos){
            $sql= "DELETE FROM compartir WHERE idUsuario =" . $datos["idUsuario"] . " AND proyectoId = " . $datos["idNota"] . ";" ;
            $resultado = $this->bd->noQuerySelect($sql);
        }

        if($resultado){
            $sql = "UPDATE proyecto SET compartida  = compartida -1 WHERE id =" . $datos['idNota'] . ";";
            $resultado = $this->bd->noQuerySelect($sql);
        }

        return $resultado;
       
    }

    function buscarUsuariosCompartenNota($idNota){
        $sql = "SELECT * FROM usuarios WHERE id IN (SELECT idUsuario FROM compartir WHERE proyectoId = ".$idNota.");";
        $datosProyecto = $this->bd->multipleQuery($sql);
       return $datosProyecto;
    }
}



