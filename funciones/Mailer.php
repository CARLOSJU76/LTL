<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailer extends PHPMailer
{
    // Constructor para configurar el servidor SMTP
    public function __construct()
    {
        // Llamada al constructor de la clase PHPMailer
        parent::__construct(true);

        // Configuración del servidor SMTP
        $this->SMTPDebug=0;
        $this->isSMTP();
        $this->Host = "smtp.gmail.com";
        $this->SMTPAuth = true;
        $this->CharSet = "UTF-8";
        $this->Username = "carlosgminer@gmail.com";
        $this->Password = "shsqqlcssblxjcxc";
        $this->SMTPSecure = 'ssl'; // Cambia a 'tls' si es necesario
        $this->Port = 465;
        $this->setFrom('carlosgminer@gmail.com', 'GestorLTL'); //From address and name
        
   
    }


    // Método para enviar el correo de verificación
    public function sendVerificationMail($to, $token, $usuario)
    {
        $this->addAddress($to, $usuario);
        $this->addReplyTo('carlosgminer@gmail.com', 'GestorLTL');
        $this->isHTML(true);
        $this->Subject = "Completar el registro";
        $this->Body = "
            <html>
            <head>
                <meta charset='utf-8'>
            </head>
                <body style='text-align: center'>
                    <h1>Gracias por registrarte</h1>
                    <p>
                        Cordial saludo, 
                        $usuario, tu cuenta ha sido satisfactoriamente creada. 
                        Para poder continuar utilizando tu cuenta, no olvides
                        confirmar tu dirección de correo en el link inferior.
                    </p>
                        <p>
                        <a id='vinculo_ver_em' href='http://localhost/LTL/index.php?action=verify_email&user1=".$usuario."&token=".$token."'>
                        Verificar Cuenta</a>

                    </p>
                    

                </body>
            </html>
        ";

        $this->AltBody = "
            Su gestor de correo parece algo desactualizado.
            Para ver este correo de forma completa, acceda 
            desde un navegador más reciente.
        ";

        try {
            $this->send(); // Usar el método `send()` heredado de PHPMailer
          
            return true;
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function sendRecoverPassMail($to, $usuario)
    {
        $this->addAddress($to, $usuario);
        $this->addReplyTo('carlosgminer@gmail.com', 'Recuperación de Contraseñas');
        $this->isHTML(true);
        $this->Subject = "Recupera tu contraseña";
        $this->Body = "
            <html>
            <head>
                <meta charset='utf-8'>
            </head>
                <body style='text-align: center'>
                    <h1>Ahora puedes recuperar tu contraseña</h1>
                    <p>
                        Cordial saludo,
                        $usuario, hemos recibido tu solicitud, por ello ahora puedes hacer click en el
                        siguiente vínculo para que  establezcas una nueva contraseña:
                    </p>
                     <p>
                        <a href='http://localhost/ltl/index.php?action=set_pass&email=" . $to. "&user=" .$usuario. "'>Recupera tu contraseña</a>
                    </p>
                    
                </body>
            </html>
        ";

        $this->AltBody = "
            Su gestor de correo parece algo desactualizado.
            Para ver este correo de forma completa, acceda 
            desde un navegador más reciente.
        ";

        try {
            $this->send(); // Usar el método `send()` heredado de PHPMailer
          
            return true;
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>