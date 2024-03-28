<?php

class movimientosModelo extends Modelo{

    public $id;
    
    public $tipo;

    public $descripcion;

    public $cantidad;

    public $creado_el;

    public $actualizado_el;

    /**
     * Método para agregar un nuevo movimiento
     * 
     * @return integer
     */
    public function anadir(){
        $sql = 'INSERT INTO movimientos(tipo, descripcion, cantidad, creado_el) VALUES
                    (:tipo, :descripcion, :cantidad, :creado_el)';

        //información
        $datos =[
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'cantidad' => (float) $this->cantidad,
            'creado_el' => $this->creado_el
        ];

        try {
            $this->id = parent::consulta($sql, $datos);
            return $this->id;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener todos los movimientos de la BD
     * 
     *@return void
     */
    public function todos(){
        $sql = 'SELECT *,
        (SELECT COUNT(id) FROM movimientos) AS total,
        (SELECT SUM(cantidad) FROM movimientos WHERE tipo ="ingresos") AS ingresos_totales,
        (SELECT SUM(cantidad) FROM movimientos WHERE tipo ="gastos") AS gastos_totales
        FROM movimientos
        ORDER BY id DESC';

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * 
     */
    public function todosPorFecha($fecha = null){

        $fecha = $fecha === null ? ahora():$fecha;

        //centra la consulta por el mes actual
        $sql = 'SELECT *,
        (SELECT COUNT(id) FROM movimientos WHERE
         DAY(creado_el) = DAY(:current_date) AND
         MONTH(creado_el) = MONTH(:current_date) AND
         YEAR(creado_el) = YEAR(:current_date)) AS total,
        (SELECT SUM(cantidad) FROM movimientos WHERE
         tipo ="ingresos" AND
         DAY(creado_el) = DAY(:current_date) AND 
         MONTH(creado_el) = MONTH(:current_date) AND 
         YEAR(creado_el) = YEAR(:current_date)) AS ingresos_totales,
        (SELECT SUM(cantidad) FROM movimientos WHERE 
        tipo ="gastos" AND 
        DAY(creado_el) = DAY(:current_date) AND 
        MONTH(creado_el) = MONTH(:current_date) AND 
        YEAR(creado_el) = YEAR(:current_date)) AS gastos_totales
        FROM movimientos
        WHERE DAY(creado_el) = DAY(:current_date) AND MONTH(creado_el) = MONTH(:current_date) AND YEAR(creado_el) = YEAR(:current_date)
        ORDER BY id DESC';

        try {
            $filas = parent::consulta($sql, ['current_date' => $fecha]);
            return $filas;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener un movimiento a través de su id
     * 
     * @return void
     */
    public function uno(){
        $sql = 'SELECT * FROM movimientos WHERE id=:id LIMIT 1';

        try {
            return ($filas = parent::consulta($sql, ['id'=> $this->id])) ? $filas[0] : false;
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
        $sql = 'UPDATE movimientos SET tipo=:tipo, descripcion=:descripcion, cantidad=:cantidad, creado_el=:creado_el WHERE id=:id';

        $datos = [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'cantidad'=>$this->cantidad,
            'creado_el' => $this->creado_el
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
        $sql = 'DELETE FROM movimientos WHERE id=:id LIMIT 1';

        $datos = [
            'id' => $this->id
        ];

        try {
            return(parent::consulta($sql, $datos)) ? true:false;
        } catch (Exception $e) {
            throw $e;
        }
    }

}