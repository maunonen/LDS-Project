<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendNotification($subject = "" , $name= "" , $address = "", $body = "" , $altBody ="") {

  $mail = new PHPMailer(true);
  try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
      
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = MAIL_SERVER_HOST;                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = MAIL_SERVER_USERNAME;                     // SMTP username
      $mail->Password   = MAIL_SERVER_TOKEN;                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = MAIL_SERVER_PORT;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('lds@ldsproject.com', 'LDS Project');
      $mail->addAddress($address, $name);     
      
      // Attachments
      
      // Content
      // Set email format to HTML
      $mail->isHTML(true);                                  
      $mail->Subject = $subject;
      $mail->Body    = $body;
      $mail->AltBody = $altBody;

      $mail->send();
      return true;
  } catch (Exception $e) {
      return false ;
      //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}



