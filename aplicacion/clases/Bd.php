<?php

class Bd{

    private $conexion;

    private $motor;

    private $servidor;

    private $bd;

    private $usuario;

    private $contra;

    private $codificacion;

    /**
     * Constructor
     */
    public function __construct(){
        $datos = datosBD();
        $this->motor = BD_MOTOR;
        $this->servidor = BD_SERVIDOR;
        $this->bd = $datos['bd'];
        $this->usuario = $datos['usuario'];
        $this->contra = $datos['contra'];
        $this->codificacion = BD_CODIFICACION; 
        return $this;
    }

    /**
     * Método para conectar a la BD
     */
    private function conectar(){
        try {

           $this->conexion = new PDO($this->motor . ':host=' . $this->servidor . ';dbname=' . $this->bd . ';charset=' . $this->codificacion, $this->usuario, $this->contra);

           return $this->conexion;

        } catch (PDOException $e) {
            
            die(sprintf('No hay conexión a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    /**
     * Método para hacer consultas a la BD
     * 
     * @param string $sql
     * @param array $parametros
     * @return void
     */
    public static function consulta($sql, $parametros = []){

        //conectar
        $bd = new self();
        $conexion = $bd->conectar();

        //inicia una transacción
        $conexion->beginTransaction();

        //preparar la consulta -> se usan placeholder por eso se prepara
        $consulta = $conexion->prepare($sql);

        //Manejar errores de consulta
        if(!$consulta->execute($parametros)){
            $conexion->rollBack();
            //devuelve un array de 3 valores
            $error = $consulta->errorInfo();
            throw new Exception($error[2]);
        }

        //Detectar que tipo de consulta se está realizando y ejecutarla
        if(strpos($sql, 'SELECT') !== false){

            return $consulta->rowCount() > 0 ? $consulta->fetchAll() : false;

        }elseif(strpos($sql, 'INSERT') !== false){

            $id = $conexion->lastInsertId();
            $conexion->commit();
            return $id;

        }elseif(strpos($sql, 'UPDATE') !== false){

            $conexion->commit();
            return true;

        }elseif(strpos($sql, 'DELETE') !== false){
            
            if($consulta->rowCount() > 0){

                $conexion->commit();
                return true;

            }

            //no se ha borrado nada
            $conexion->rollBack();
            return false;

        }else{
            //ALTER/DROP TABLE...
            $conexion->commit();
            return true;
        }
    }

}
