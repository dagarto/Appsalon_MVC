<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        //Create new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '6315162241518b';
        $mail->Password = 'b95e070ff3f4f5';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
        $mail->Subject = 'Confirma tu cuenta';

        //SET HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre ."</strong> Has creado tu cuenta en appsalon solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el correo
        $mail->send();

    }

    public function enviarInstrucciones() {
        //Create new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '6315162241518b';
        $mail->Password = 'b95e070ff3f4f5';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
        $mail->Subject = 'Reestablece tu Password';

        //SET HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre ."</strong> Has solicitado reestablecer tu password</p>";
        $contenido .= "<p>Presiona aqui <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el correo
        $mail->send();
    }
}