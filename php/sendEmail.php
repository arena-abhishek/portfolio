<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name'] ?? '');
  $firstName = htmlspecialchars($_POST['firstName'] ?? '');
  $lastName = htmlspecialchars($_POST['lastName'] ?? '');
  $email = htmlspecialchars($_POST['email'] ?? '');
  $subject = htmlspecialchars($_POST['subject'] ?? 'No Subject');
  $message = htmlspecialchars($_POST['comments'] ?? $_POST['message'] ?? '');

  $mail = new PHPMailer(true);
  try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'apdesign0001@gmail.com'; // Replace with your Gmail address
    $mail->Password = 'uznkmnicrxhrtzv'; // Replace with your Gmail password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('apdesign0001@gmail.com', 'Contact Form');
    $mail->addAddress('abhi.parashar8860@gmail.com'); // Replace with your Gmail address

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Form Submission: " . $subject;
    $mail->Body = "Name: " . $name . "<br>" .
      "First Name: " . $firstName . "<br>" .
      "Last Name: " . $lastName . "<br>" .
      "Email: " . $email . "<br>" .
      "Subject: " . $subject . "<br>" .
      "Message: " . $message . "<br>";

    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>