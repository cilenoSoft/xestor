<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
require '../../PHPMailer/vendor/autoload.php';

function enviaCorreoReseteoPassword($email, $contraseñaNueva)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'dvr.coremain@gmail.com'; // SMTP username
        $mail->Password = '677099418.Gma'; // SMTP password
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );

        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465; // TCP port to connect to
        //Recipients
        $mail->setFrom('dvr.coremain@gmail.com', 'Xestor');
        $mail->addAddress($email); // Add a recipient
        $mail->addReplyTo('dvr.coremain@gmail.com', 'Xestor');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'XestorGal';
        $mail->Body = 'O seu novo contrasinal é: '.$contraseñaNueva;
        $mail->AltBody = 'O seu novo contrasinal é: '.$contraseñaNueva;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return "Non se puido enviar o correo. Mailer Error: {$mail->ErrorInfo}";
    }
}

function enviaCorreoContacto($email, $login, $asunto, $contido)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'dvr.coremain@gmail.com'; // SMTP username
        $mail->Password = '677099418.Gma'; // SMTP password
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );

        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465; // TCP port to connect to
        //Recipients
        $mail->setFrom('dvr.coremain@gmail.com', $login);
        $mail->addAddress($email); // Add a recipient
        $mail->addReplyTo($email, $login);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body = '<h2>From : '.$login."</h2><p>".$contido."</p>";
        $mail->AltBody = 'From : '.$login."\n".$contido;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return "Non se puido enviar o correo. Mailer Error: {$mail->ErrorInfo}";
    }
}
