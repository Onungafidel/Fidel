<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'Pluggins/PHPMailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fidel.onunga@strathmore.edu';                     //SMTP username
    $mail->Password   = 'recs rbkx voul uoir';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('fidel.onunga@strathmore.edu', 'Fidel');
    $mail->addAddress('onungafidel374@gmail.com', 'Onunga');     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Welcome to our BBIT 2.2! Account Verification';
    $mail->Body    = "<h1>Welcome, Fidel!</h1><p>You requested an account on BBIT 2.2. We're excited to have you on board!</p>";;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// ...existing code...

function sendWelcomeEmail($userEmail, $userName) {
     $mail = new PHPMailer(true);
     try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_OFF;
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'fidel.onunga@strathmore.edu';
          $mail->Password   = 'recs rbkx voul uoir';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
          $mail->Port       = 465;

          //Recipients
          $mail->setFrom('fidel.onunga@strathmore.edu', 'Fidel');
          $mail->addAddress($userEmail, $userName);

          //Content
          $mail->isHTML(true);
          $mail->Subject = 'Welcome to our BBIT Server';
          $mail->Body    = "<h1>Welcome, $userName!</h1><p>Thank you for joining our application. We're excited to have you on board!</p>";

          $mail->send();
          return true;
     } catch (Exception $e) {
          error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
          return false;
     }
}