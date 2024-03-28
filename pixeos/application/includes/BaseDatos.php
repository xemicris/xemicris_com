<?php

/**
 * Clase que conecta con la base de datos y ejecuta las consultas
 *  @author José Maria Calavia Rivera
 */
class BaseDatos{
    /**
     * Servidor al que conectarse
     * @var string
     */
    private $server = "";

    /**
     * Usuario de la base de datos
     * @var string
     */
    private $user = '';

    /**
     * Contraseña de la base de datos
     * @var string
     */
    private $clave = '';

    /**
     * Nombre de la base de datos
     * @var string
     */
    private $bd = "";
    
    /**
     * Conexión con la base de datos
     * @var mysqli 
     */
    private $connection;

    /**
     * Constructor que establece la conexión
     */
    function __construct(){
        $this->connection = new mysqli(
            $this->server, 
            $this->user, 
            $this->clave, 
            $this->bd);

        $this->connection->set_charset("utf8");

        if($this->connection->connect_errno){
            printf("Error en la conexión a la base de datos %s, ",
            $this->connection->connect_error);
            die();
        }else{
            //printf("Conexión establecida con éxito");
        }

        $charset = $this->connection->character_set_name();
        //print ("El conjunto de caracteres es: " . $charset);
        
    }

    /**
     * Método que devuelve un registro de la BD
     * @param string con la sentencia sql a la base de datos
     * @return array $datos con los datos devueltos
     */
    function oneQuery($sql){
        $datos = [];
        $result = $this->connection->query($sql);
        if($result){
            if($result->num_rows > 0){
                $datos = $result->fetch_assoc();
            }
        }
        return $datos;
    }

     /**
     * Método que devuelve múltiples registros de la BD
     * @param string con la sentencia sql a la base de datos
     * @return array $datos con los datos devueltos
     */
    function multipleQuery($sql){
        $datos = array();
        $result = $this->connection->query($sql);
        //Si devuelve datos
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                //regresa un array asociativo
                array_push($datos, $row);
            }
        }
        return $datos;
    }

    /**
     * Método que hace una consulta no select a la BD 
     * @param string con la sentencia sql a la base de datos
     * @return boolean true si se ha ejecutado con éxito y false en caso contrario
     */
    function noQuerySelect($sql){
        $respuesta = $this->connection->query($sql);
        return $respuesta;
    }

     /**
     * Método que hace una consulta no select a la BD 
     * @param string con la sentencia sql a la base de datos
     * @return string con el id autogenerado usado en la última consulta
     */
    function noQuerySelectId($sql){
        $this->connection->query($sql);
        //insert_id devuelve el id autogenerado usado en la última consulta
        $respuesta = $this->connection->insert_id;
        return $respuesta;
    }

    /**
     * Método que cierra la conexión con la BD
     */
    function cerrar(){
        $this->connection->close();
    }
}

