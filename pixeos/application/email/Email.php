<?php
require __DIR__ . '/phpmailer/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


/**
 * Clase que se encarga de enviar correos electrónicos
 * @author José Maria Calavia Rivera
 */
class Email
{

    /**
     * Email del usuario donde se va a enviar
     * @var string
     */
    protected $email;
    /**
     * Nombre del usuario al que se le envía el correo
     * @var string 
     */
    protected $nombre;
    /**
     * Token que controla la activación del usuario y el cambio de contraseña
     * @var string
     */
    protected $token;
    /**
     * Mensaje que envía el usuario
     * @var array
     */
    protected $mensaje;
    /**
     * Descripción que envía el usuario
     * @var string 
     */
    protected $descripcion;
    /**
     * Mensaje que envía el usuario
     * @var string 
     */
    protected $enlace;

    /**
     * Constructor
     */
    public function __construct($email, $nombre, $token = '', $mensaje = '', $descripcion = '')
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->mensaje = $mensaje;
        $this->descripcion = $descripcion;
    }

    private function enlace()
    {
        $enlace = '';
        $host = host();
        if ($host === '' || $host === "") {
            $enlace = '';
        } else if ($host === '') {
            $enlace = '';
        }
        return $enlace;
    }

    /**
     * Método que envía un correo que permite activar la cuenta al usuario
     */
    public function enviarConfirmacion()
    {
        $enlace = $this->enlace();
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'STARTTLS';
        $email->Port = 587;

        //Configuración
        $email->setFrom('', '');
        $email->addAddress($this->email);
        $email->Subject = 'Confirma tu cuenta';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->Encoding = 'base64';
        $email->DKIM_domain = '';
        $email->DKIM_private =  dirname(__FILE__) . '';
        $email->DKIM_selector = '';
        $email->DKIM_passphrase = '';
        $email->DKIM_identity = $email->From;
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta
        en Pixeos, debes confirmarla en el siguiente enlace</p>";
        $contenido .= "<p>Enlace: <a href='$enlace/activar/" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no has creado esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $email->send();
    }

    /**
     * Método que envía un correo para modificar la contraseña del usuario
     */
    public function enviarInstrucciones()
    {
        $enlace = $this->enlace();
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'TLS';
        $email->Port = 587;

        //Configuración
        $email->setFrom('', '');
        $email->addAddress($this->email);
        $email->Subject = 'Cambiar contraseña';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Parece que has olvidado
        tu contraseña, sigue el siguiente enlace para cambiarla</p>";
        $contenido .= "<p>Enlace: <a href='$enlace/verificarCambio/" . $this->token . "'>Cambiar Contraseña</a></p>";
        $contenido .= "<p>Si no has creado esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $email->send();
    }


    /**
     * Método que envía correo al administrador con el mensaje del usuario escrito en el formulario de contacto
     * @return boolean true si se ha enviado el correo, false en caso contrario
     */
    public function contactoAdmin($incidencia = '')
    {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'TLS';
        $email->Port = 587;

        //Configuración
        $email->setFrom('', '');
        ($incidencia == '') ? $email->addAddress('') : $email->addAddress('');
        $email->Subject = 'Formulario de contacto';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>" . $incidencia . "</strong></p>
        <p><strong>El usuario " . $this->nombre . "</strong> te ha enviado el siguiente mensaje: </p>";
        $contenido .= "<p>" . $this->mensaje . "</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $correo = $email->send();

        return $correo;
    }

    /**
     * Método que envía un correo al usuario que ha utilizado el formulario de contacto
     * @return boolean $confirmar true si se ha enviado, false si no se ha enviado
     */
    public function contactoUsuario()
    {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'TLS';
        $email->Port = 587;

        //Configuración
        $email->setFrom('', '');
        $email->addAddress($this->email);
        $email->Subject = 'Formulario de contacto';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> tu mensaje ha sido enviado exitosamente,
        en un plazo de 24/48h el equipo de Pixeos se pondrá en contacto contigo a través de este correo electrónico. Recibe un cordial saludo del equipo de Pixeos</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $confirmar = $email->send();
        return $confirmar;
    }

    /**
     * Método que envía un correo notificando una tarea
     */
    public function notificacionTarea($fecha)
    {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'TLS';
        $email->Port = 587;

        //Configuración
        $email->setFrom('', '');
        $email->addAddress($this->email);
        $email->Subject = 'Aviso de tarea';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>, este es un recordatorio de una tarea que has programado en Pixeos para el día " . $fecha . ".</p>";
        $contenido .= "<p><u>Tarea</u>: " . $this->mensaje . "</p>";
        $contenido .= "<p><u>Descripción</u>: " . $this->descripcion . "</p>";
        $contenido .= "</html>";

        $email->Body = $contenido;

        //Enviar el email
        $email->send();
    }

    /**
     * Método que envía un correo que permite activar la cuenta al usuario
     */
    public function enviarNota()
    {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp-mail.outlook.com';
        $email->SMTPAuth = true;
        $email->Username = '';
        $email->Password = '';
        $email->SMTPSecure = 'STARTTLS';
        $email->Port = 587;
        $email->CharSet = 'UTF-8';

        //Configuración
        $email->setFrom('', '');
        $email->addAddress($this->email);
        $email->Subject = '';
        //para que envíe el contenido en html
        $email->isHTML(TRUE);
        $email->Encoding = 'base64';
        $email->DKIM_domain = '';
        $email->DKIM_private =  dirname(__FILE__) . '';
        $email->DKIM_selector = '';
        $email->DKIM_passphrase = '';
        $email->DKIM_identity = $email->From;
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, esta es una copia de la nota que has solicitado:</p>";
        $contenido .= "<table style='background: #d5d7da'>";
        $contenido .= "<thead>";
        $contenido .= "<tr>";
        $contenido .= "<th colspan='3' style='border: 1px solid #000;'>" . $this->mensaje[0]['nombreProyecto'] . "</th>";
        $contenido .= "</tr>";
        $contenido .= "<tr>";
        $contenido .= "<th style='border: 1px solid #000;'>Nombre</th><th style='border: 1px solid #000;'>Descripción</th><th style='border: 1px solid #000;'>Fecha</th>";
        $contenido .= "</tr>";
        $contenido .= "</thead>";
        $contenido .= "<tbody>";
        $contenido .= "<tr>";
        $contenido .= "<td style='border: 1px solid #000;'>";
        $contenido .= "<ol>";
        foreach ($this->mensaje as $m) {
            $contenido .= "<li>" . $m['nombreTarea'] . "</li>";
        }
        $contenido .= "</ol>";
        $contenido .= "</td>";
        $contenido .= "<td style='border: 1px solid #000;'>";
        $contenido .= "<ol>";
        foreach ($this->mensaje as $m) {
            $contenido .= "<li>" . $m['descripcionTarea'] . "</li>";
        }
        $contenido .= "</ol>";
        $contenido .= "</td>";
        $contenido .= "<td style='border: 1px solid #000;'>";
        $contenido .= "<ol>";
        foreach ($this->mensaje as $m) {
            $contenido .= "<li>" . $m['fecha'] . "</li>";
        }
        $contenido .= "</ol>";
        $contenido .= "</td>";
        $contenido .= "<tr>";
        $contenido .= " </tbody>";
        $contenido .= "</table>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        //Enviar el email
        $enviado = $email->send();
        return $enviado;
    }
}
