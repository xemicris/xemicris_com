<?php

class contactoControlador extends Controlador{
    function __construct(){
        
    }

    function indice(){
       
        $datos = [
            'titulo' => 'xemicris.com | Contacta'
        ];

        Vista::renderizar('indice', $datos);

    }

    function contacta(){

        $nombre = strip_tags(htmlentities($_POST['nombre'] ?? ''));
        $apellidos = strip_tags(htmlentities($_POST['apellidos'] ?? ''));
        $correo = strip_tags(htmlentities($_POST['correo'] ?? ''));
        $telefono = strip_tags(htmlentities($_POST['telefono'] ?? ''));
        $mensaje = strip_tags(htmlentities($_POST['mensaje'] ?? ''));

        try{

            if(empty($alertas = validarContacto(html_entity_decode($nombre), html_entity_decode($apellidos), html_entity_decode($correo), html_entity_decode($telefono), html_entity_decode($mensaje)))){
                $correo = new Correo($nombre, $apellidos, $correo, $telefono, $mensaje);
                if($correo->enviarMensaje()){
                    jsonSalida(jsonConstruir(200, null, 'Correo enviado exitosamente'));
                }else{
                    jsonSalida(jsonConstruir(400, null, 'Hubo un error al enviar su correo'));
                }
            }else{
                jsonSalida(jsonConstruir(400, null, 'Los datos introducidos no son correctos'));
            }
        }catch(Exception $e){
            jsonSalida(jsonConstruir(400, null, $e->getMessage()));
        }
        
        
    }
}