<?php

class Alertas{
    
    //tipos válidos de notificaciones
    private $tiposAlertas = ['success', 'danger', 'warning', 'info'];

    private $tipoAlertaDefecto = 'info';

    private $alerta = '';

    private $mensaje;

    /**
     * Método para crear una notificación Flash
     * 
     * @param array $mensaje
     * @param string $Alerta
     * 
     * @return void
     */
    public static function crearNotificacion($mensaje, $Alerta = null){

        $instancia = new self();

        //Setear el tipo de notificación por defecto
        if($Alerta == null){
            $instancia->alerta = $instancia->tipoAlertaDefecto;
        }


        $instancia->alerta = in_array($Alerta, $instancia->tiposAlertas) ? $Alerta : $instancia->tipoAlertaDefecto;
        

        //Guardar la notificación en un array de sesión
        if(is_array($mensaje)){
            foreach ($mensaje as $men) {

                $_SESSION[$instancia->alerta][] = $men;
            }

            return true;
        }
        $_SESSION[$instancia->alerta][] = $mensaje;

        return true;
    }

    /**
     * Muestra las notificaciones al usuario
     * 
     * @return void
     */
    public static function mostrarNotificacion(){
        $instancia = new self();

        $salida = '';

        foreach ($instancia->tiposAlertas as $tipo) {
            if(isset($_SESSION[$tipo]) && !empty($_SESSION[$tipo])){
                foreach ($_SESSION[$tipo] as $mens) {
                    $salida .= '<div class="alert alert-'.$tipo.' alert-dismissible fade show role="alert">';
                    $salida .= $mens;
                    $salida .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    $salida .= '</div>';
                }
                
                //borrar sesión una vez mostrada
                unset($_SESSION[$tipo]);
            }
        }

        return $salida;
    }
}