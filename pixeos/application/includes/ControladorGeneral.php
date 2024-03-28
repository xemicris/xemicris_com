<?php
/**
 * Clase controladora general
 *  @author José Maria Calavia Rivera
 */
class ControladorGeneral{
    
     /**
     * Método que devuelve una instancia del modelo para poder usarlo
     * @param string modelo que se quiere llamar
     * @return object modelo que se invoca 
     */
    public function model($model){
        if(isset($_SERVER['REMOTE_ADDR'])){
            require_once("../application/model/" . $model . ".php");
            return new $model();
        }else{
            if($_SERVER['OS'] == "Windows_NT"){
                require_once("C:/MAMP/htdocs/xemicris_com/pixeos/application/model/AvisoModel.php");
                return new $model();
            }else{
                require_once("/var/www/xemicris_com/pixeos/application/model/AvisoModel.php");
                return new $model();
            }
           
        }
        
    }

    /**
     * Método que manda llamar una vista 
     * @param string $view vista que se llama
     * @param array $datos con los datos que se pasan a la vista
     */
    public function view($view, $datos=[]){
        if(file_exists("../application/view/".$view.".php")){
            require_once("../application/view/".$view.".php");
        }else{
            die("
            <html>
                <body>
                    <h1>Página no encontrada</h1>
                </body>
            </html>
            ");
        }
    }
}