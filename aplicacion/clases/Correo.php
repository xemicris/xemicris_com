<?php

require CORREO . 'phpmailer/Exception.php';
require CORREO . 'phpmailer/PHPMailer.php';
require CORREO . 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

class Correo {

    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $mensaje;

    public function __construct($nombre, $apellidos, $correo, $mensaje, $telefono = '')
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
    }

    public function enviarMensaje(){

        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = '';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'TLS';
        $email->Port = 587;
        
        //Configuración
        $email->setFrom('', '');
        $email->addAddress('');
        $email->Subject = '';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->Encoding = 'base64';
        $email->DKIM_domain = '';
        $email->DKIM_private =  dirname(__FILE__).'';
        $email->DKIM_selector = '';
        $email->DKIM_passphrase = '';
        $email->DKIM_identity=$email->From;
        
        $contenido = '<html>';
        $contenido .= "<p>De: " . $this->nombre . " " . $this->apellidos . "</p>";
        $contenido .= "<p>Correo: " . $this->correo . "</p>";
        $contenido .= "<p>Tel&eacute;fono: " . $this->telefono . "</p>";
        $contenido .= "<p>Mensaje: " . $this->mensaje . "</p>";
        $contenido .= '</html>';
        
        $email->Body = $contenido;
                
        //Enviar el email
        $envio = $email->send();
                
        return $envio;
                
    }
}
?>