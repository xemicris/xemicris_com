<?php

class bibliotecaModelo extends Modelo{

    public $id;
    
    public $titulo;

    public $f_publicacion;

    public $id_autor;

    

    /**
     * Método para obtener todos los libros
     * 
     *@return
     */
    public function todosLibros(){
        $sql = 'SELECT id, titulo FROM libro ORDER BY id DESC';

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener todos los autores
     * 
     *@return 
     */
    public function todosAutores(){
        $sql = 'SELECT id, nombre, apellidos FROM autor';

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener todos los libros
     * 
     *@return
     */
    public function datos_libro($id){
        $sql = "SELECT l.id, l.titulo, l.f_publicacion, l.id_autor, a.nombre, a.apellidos FROM libro l INNER JOIN autor a ON (l.id_autor = a.id) WHERE l.id = '$id'";

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener todos los autores
     * 
     *@return 
     */
    public function datos_autor($id){
        $sql = "SELECT a.id, a.nombre, a.apellidos, a.nacionalidad, l.titulo, l.id_autor  FROM autor a INNER JOIN libro l ON (a.id = l.id_autor) WHERE a.id = '$id'";

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener los libros de un autor
     * 
     *@return 
     */
    public function datos_libros_autor($id){
        $sql = "SELECT * FROM libro where id_autor = '$id'";

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener el id del libro cuyo título se pase
     * 
     *@return 
     */
    public function obtener_ids_libros($titulo){
        $sql = "SELECT id FROM libro WHERE titulo ='" . $titulo . "'";

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Método para obtener el id del autor cuyo nombre se pase
     * 
     *@return 
     */
    public function obtener_ids_autores($nombre){
        $sql = "SELECT id FROM autor WHERE nombre ='" . $nombre . "'";

        try {
            return ($filas = parent::consulta($sql)) ? $filas : false;
        } catch (Exception $e) {
            throw $e;
        }
    }



}