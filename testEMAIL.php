<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/inc/phpmailer/Exception.php';
require 'assets/inc/phpmailer/PHPMailer.php';
require 'assets/inc/phpmailer/SMTP.php';
include 'testPDF.php';


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
    $mail->setFrom('tyrantchimera391@gmail.com', 'eTEMPAHAN');
    $mail->addAddress($_SESSION["form-email"], implode(' ', array_slice(explode(' ', $_SESSION['cust_name']), 0, 2)));     //Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addStringAttachment($pdfContent, 'invoicePenginapanINSKET.pdf', 'base64', 'application/pdf');
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Tempahan penginapan anda berjaya. Nombor tempahan ialah ' . $_SESSION['booking_number'];
    $mail->Body    =    'Kehadapan ' . explode(' ', $_SESSION['cust_name'])[0] . ',<br><br>Salam sejahtera dari LKTN!<br><br>Terima kasih kerana menempah dengan kami.<br><br>
                        Dilampirkan invoice tempahan anda untuk rujukan. Kami harap anda menikmati penginapan anda di sini.<br><br>Salam mesra,<br><br>Team LKTN';
    $mail->AltBody = 'Thank you for your service';

    $mail->send();
    ob_end_flush();
    header("Location: success.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}