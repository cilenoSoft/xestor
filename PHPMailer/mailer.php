<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
require 'vendor/autoload.php';

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

	$mail->SMTPSecure = "ssl"; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	$mail->Port = 465; // TCP port to connect to

	//Recipients
	$mail->setFrom('dvr.coremain@gmail.com', 'Mailer');
	$mail->addAddress('diego250791@hotmail.com'); // Add a recipient
	$mail->addReplyTo('dvr.coremain@gmail.com');

	// Content
	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = 'Here is the subject';
	$mail->Body = 'This is the HTML message body';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
	echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>