<?php

class opcionesModelo extends Modelo{

    public $id;
    
    public $opcion;

    public $valor;

    public $creado_el;

    public $actualizado_el;

    /**
     * Método para agregar una nueva opción
     * 
     * @return integer
     */
    public function anadir(){
        $sql = 'INSERT INTO opciones (opcion, valor, creado_el) VALUES(:opcion, :valor, :creado_el)';

        //información
        $datos =[
            'opcion' => $this->opcion,
            'valor' => $this->valor,
            'creado_el' => ahora()
        ];

        try {
            return ($this->id = parent::consulta($sql, $datos)) ? $this->id : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener todas las opciones
     * 
     *@return void
     */
    public function todas(){
        $sql = 'SELECT * FROM opciones ORDER BY id DESC';

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Método para obtener una opcion a través de su id
     * 
     * @return void
     */
    public function una(){
        $sql = 'SELECT * FROM opciones WHERE opcion=:opcion LIMIT 1';

        try {
            return ($filas = parent::consulta($sql, ['opcion'=> $this->opcion])) ? $filas[0] : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para actualizar un registro en la BD
     * 
     * return bool
     */
    public function actualizar(){
        $sql = 'UPDATE opciones SET valor=:valor WHERE opcion=:opcion';

        $datos = [
            'valor' => $this->valor,
            'opcion' => $this->opcion
        ];

        try {
            return(parent::consulta($sql, $datos)) ? true:false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para borrar un movimiento de la BD
     * 
     * @return void
     */
    public function borrar(){
        $sql = 'DELETE FROM opciones WHERE opcion=:opcion LIMIT 1';

        try {
            return(parent::consulta($sql, ['opcion' => $this->opcion])) ? true:false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para buscar el valor de una opción 
     * 
     * @param string $opcion
     * @return void
     */
    public static function buscar($opcion){
        $instancia = new self();
        $instancia->opcion = $opcion;
        return ($respuesta = $instancia->una()) ? $respuesta['valor'] : false;
    }

    public static function opcion($nombreOpcion, $valor){

        //Verificar si existe la opción
        $instancia = new self();
        $instancia->opcion = $nombreOpcion;
        $instancia->valor = $valor;

        //Si no existe se guarda
        if(!$opcion = $instancia->una()){
            $instancia->id = $instancia->anadir() ? $instancia->id : false;
            return $instancia;
        }

        //Si existe se actualiza
        return $instancia->actualizar();
    }

}