<?php
// If you are using Composer
require '../vendor/autoload.php';

// EDIT THE 2 LINES BELOW AS REQUIRED
  $email_to = "e0235265@u.nus.edu";

  $name = $_POST['name']; // required
  $email_from = $_POST['email']; // required
  $subject = $_POST['subject']; // not required
  $message = $_POST['message']; // required

  
  $email_message = "Form details below.\n\n";

    
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }

  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Subject: ".clean_string($subject)."\n";
  $email_message .= "Message: ".clean_string($message)."\n";

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

$email = new \SendGrid\Mail\Mail();
$email->setFrom($email_from, $name);
$email->setSubject($subject);
$email->addTo($email_to, "Receiver");
$email->addContent(
    "text/plain", $email_message
);
// $from = new SendGrid\Email(null, $email_from);
// $subject = $subject;
// $to = new SendGrid\Email(null, $email_to);
// $content = new SendGrid\Content("text/plain",$email_message);
// $mail = new SendGrid\Mail($from, $subject, $to, $content);

$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>