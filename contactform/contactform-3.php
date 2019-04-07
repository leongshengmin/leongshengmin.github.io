<?php
if(isset($_POST['email'])) {
 
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
 
// create email headers
$headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: '. 'leongshengmin@herokuapp.com/' . "\r\n";
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
if (@mail($email_to, $subject, $email_message, $headers)) {
  echo("done sending");
} else {
  echo("error sending message");
}

?>
 
<!-- include your own success html here -->
 
Thank you for contacting me. I will be in touch with you shortly.
 
<?php
 
}
?>