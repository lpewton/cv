<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'liampewton99@gmail.com';               //SMTP username
    $mail->Password   = 'suhb jwim uryh fzxm ';                 //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_REQUEST['email']);
    $mail->addAddress('liampewton99@gmail.com');
     
    $mail->addReplyTo($_REQUEST['email'], $_REQUEST['name']); //Add a recipient
    
    //Content
    $mail->Subject = $_REQUEST['subject'];
    $mail->Body    = $_REQUEST['message'] . "\n\n" . $_REQUEST['name'];

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}