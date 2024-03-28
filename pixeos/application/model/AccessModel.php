<?php
/**
 * Clase que comunica con la base de datos para hacer funciones de login y alta
 *  @author Jose Maria Calavia Rivera
 */
class AccessModel {
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
     * Método que busca si existe un usuario en la BD y de ser así lo devuelve
     * @param string $correo correo introducido por el usuario
     * @return array $usuario con los datos del usuario
     */
    function obtenerUsuarioPorCorreo($correo){
        $sql = "SELECT * FROM usuarios WHERE correo = '".$correo."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }

    /**
     * Método que devuelve el rol que tiene asignado cada usuario
     * @param int $id con el id del usuario
     * @return array $rol con el rol del usuario
     */
    function obtenerRol($id){
        $sql = "SELECT rol FROM usuarios WHERE id = ".$id.";";
        $rol = $this->bd->oneQuery($sql);
        return $rol;
    }

    /**
     * Método que inserta un usuario en la BD
     * @param array $usuario con los datos del usuario
     * @return bool $result true o false
     */
    function addUser($usuario){
        $result = false;

        if($this->validarCorreo($usuario['correo'])){
            $contrasena = hashPassword($usuario['contrasena']);
            $token = createToken();
            //valores iniciales por defecto
            $confirmado = 0;
            $fondo = 0;
            $rol = 2;

            $sql = "INSERT INTO usuarios VALUES (0,";
            $sql.= "'".$usuario["nombre"]."', ";
            $sql.= "'".$usuario["apellidos"]."', ";
            $sql.= "'".$usuario["correo"]."', ";
            $sql.= "'".$usuario["profesion"]."', ";
            $sql.= "'".$usuario["imagen"]."', ";
            $sql.= "'".$contrasena."', ";
            $sql.= "".$rol.", ";
            $sql.= "'".$token."', ";
            $sql.= "".$confirmado.", ";
            $sql.= "".$fondo.")";

            $result = $this->bd->noQuerySelect($sql);
        }

        return $result;
    }

     /**
     * método que busca el correo en la base de datos
     * @param string $correo con el correo del usuario
     * @return bool true o false
     */
    function validarCorreo($correo){
        $sql = "SELECT * FROM usuarios WHERE correo = '".$correo."';";
        $correo = $this->bd->oneQuery($sql);
        return (count($correo) == 0) ? true:false;
    }

   /**
     * Método que devuelve los tokens almacenados en la BD
     * @return array $tokes con los tokens de todos los usuarios
     */
    function obtenerTokens(){
        $sql = "SELECT token FROM usuarios;";
        $tokens = $this->bd->multipleQuery($sql);
        return $tokens;
    }
    
    /**
     * Método que obtiene un usuario de la BD a través de su token
     * @param string $token con el token a buscar 
     * @return array $usuario con los datos del usuario
     */
    function obtenerUsuarioPorToken($token){
        $sql = "SELECT * FROM usuarios WHERE token = '".$token."';";
        $usuario = $this->bd->oneQuery($sql);
       return $usuario;
    }

    /**
     * Método que activa el usuario
     * @param int $id con el id del usuario
     * @return bool true o false
     */
    function activarUsuario($id){
        $result = false;
        $sql = "UPDATE usuarios SET token = '', confirmado = '1' WHERE id= '".$id."';";
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que inserta un token en un usuario
     * @param int $id con el id del usuario
     * @return bool true o false
     */
    function insertarToken($id){
        $result = false;
        $token = createToken();
        $sql = "UPDATE usuarios SET token = '".$token."' WHERE id= '".$id."';";
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

    /**
     * Método que modifica la contraseña
     * @param array $usuario con los datos del usuario
     * @param string $contrasena con la nueva contraseña
     * @return bool true o false
     */
    function cambiarContrasena($usuario, $contrasena){
        $result = false;
        $contrasena = hashPassword($contrasena);
        $id = $usuario['id'];

        $sql = "UPDATE usuarios SET ";                  
         $sql.= "contrasena='".$contrasena."', ";              
         $sql.= "token='' ";          
         $sql.= "WHERE id=".$id;
        $result = $this->bd->noQuerySelect($sql);

        return $result;
    }

}