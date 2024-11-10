<?php

require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                             // Enable SMTP authentication
$mail->Username = 'tyrantchimera391@gmail.com';                 // SMTP username
$mail->Password = 'ijhf ocxd xrsk tvbp';             // SMTP password
$mail->SMTPSecure = true;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$message = "";
$status = "false";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['form_name']) && !empty($_POST['form_email']) && !empty($_POST['form_subject'])) {

        $name = $_POST['form_name'];
        $email = $_POST['form_email'];
        $subject = $_POST['form_subject'];
        $phone = $_POST['form_phone'];
        $message = $_POST['form_message'];

        $subject = isset($subject) ? $subject : 'New Message | Contact Form';

        $botcheck = $_POST['form_botcheck'];

        $toemail = 'wannaqib01@gmail.com'; // Recipient's Email Address
        $toname = 'wanzaf';                // Recipient's Name

        if ($botcheck == '') {

            $mail->SetFrom($email, $name);
            $mail->AddReplyTo($email, $name);
            $mail->AddAddress($toemail, $toname);
            $mail->Subject = $subject;

            $name = isset($name) ? "Name: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $phone = isset($phone) ? "Phone: $phone<br><br>" : '';
            $message = isset($message) ? "Message: $message<br><br>" : '';

            $body = "$name $email $phone $message";

            $mail->MsgHTML($body);
            $sendEmail = $mail->Send();

            if ($sendEmail) {
                $message = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
                $status = "true";
            } else {
                $message = 'Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo;
                $status = "false";
            }
        } else {
            $message = 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
            $status = "false";
        }
    } else {
        $message = 'Please <strong>Fill up</strong> all the Fields and Try Again.';
        $status = "false";
    }
} else {
    $message = 'An <strong>unexpected error</strong> occurred. Please Try Again later.';
    $status = "false";
}

$status_array = array('message' => $message, 'status' => $status);
echo json_encode($status_array);
?>