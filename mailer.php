<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
require '../PHPMailer/vendor/autoload.php';

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
        $mail->Subject = 'RESTEO PASSWORD XESTOR';
        $mail->Body = 'Su nueva contraseña es: '.$contraseñaNueva;
        $mail->AltBody = 'Su nueva contraseña es: '.$contraseñaNueva;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
