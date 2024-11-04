<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                             //Enable verbose debug output
    $mail->isSMTP();                                                  //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                            //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
    $mail->Username   = 'tyrantchimera391@gmail.com';              //SMTP username
    $mail->Password   = 'ijhfocxdxrsktvbp';                       //SMTP password
    $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tyrantchimera391@gmail.com', 'TEST');
    $mail->addAddress('wannaqib01@gmail.com', 'Joe User');     //Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');    //If reply
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Tempahan penginapan anda berjaya. Nombor tempahan ialah .......';
    $mail->Body    =    'Kehadapan Pax,<br><br>Salam sejahtera dari LKTN!<br><br>Terima kasih kerana menempah dengan kami.<br><br>
                        Dilampirkan invoice tempahan anda untuk rujukan. Kami doakan anda selesa dan selamat<br><br>Salam mesra,<br><br>Team LKTN';
    $mail->AltBody = 'Thank you for your service';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}