<?php

/**
 * Modelo para manejar todo lo relacionado con usuarios
 */
class usuarioModelo extends Modelo{

    public $id;

    public $nombre;

    public $nombre_usuario;

    public $correo;

    public $creado_el;

    public $actualizado_el;

    /**
     * Método para agregar un usuario
     * 
     * @return integer
     */
    public function anadir(){

        $sql = 'INSERT INTO usuarios (nombre, nombre_usuario, correo, creado_el) VALUES 
                (:nombre, :nombre_usuario, :correo, :creado_el)';
        
        $usuario = [
            'nombre' => $this->nombre,
            'nombre_usuario' => $this->nombre_usuario,
            'correo' => $this->correo,
            'creado_el' => $this->creado_el,
        ];

        try {
            return ($this->id = parent::consulta($sql, $usuario)) ? $this->id : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para actualizar un registro en la bd
     */
    public function actualizar(){

         $sql = 'UPDATE usuarios SET nombre=:nombre, nombre_usuario=:nombre_usuario, correo=:correo WHERE id=:id';
        
        $usuario = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'nombre_usuario' => $this->nombre_usuario,
            'correo' => $this->correo,
        ];

        try {
            return (parent::consulta($sql, $usuario)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
}