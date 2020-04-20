<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $to = "info@diplocover.at";
  $subject = "Nachricht von ". $_POST["fmail"];
  $sube= "Nachricht | DiploCover";
  $message = nl2br($_POST["fmsg"])."<br>Tel: ".$_POST["fmphone"];

  if ( empty($_POST["fmname"]) OR empty($_POST["fmsg"]) OR !filter_var($_POST["fmail"], FILTER_VALIDATE_EMAIL)) {
           // Set a 400 (bad request) response code and exit.
           http_response_code(400);
           echo "Oops! There was a problem with your submission. Please complete the form and try again.";
           exit;
       }


  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  $headers .= 'From: <'.$_POST['fmail'].'>' . "\r\n";
  //$headers .= 'Cc: myboss@example.com' . "\r\n";


  // Send the email.
  if (mail($to,$subject,$message,$headers)) {
      // Set a 200 (okay) response code.
      http_response_code(200);
      echo "Thank You! Your message has been sent.";
  } else {
      // Set a 500 (internal server error) response code.
      http_response_code(500);
      echo "Oops! Something went wrong and we couldn't send your message.";
  }

  $headerb = "MIME-Version: 1.0" . "\r\n";
  $headerb .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $msgb = nl2br("Guten Tag,
  vielen Dank für Ihre E-Mail und Ihre Anfrage, die wir hiermit bestätigen.
  Wir werden uns so rasch wie möglich um Ihre Frage kümmern und uns unter der verwendeten E-Mail-Adresse an Sie wenden.
  Mit freundlichen Grüßen das DiploCover-Team.");

  // More headers
  $headerb .= 'From: < info@diplocover.at>' . "\r\n";

  mail($_POST['fmail'],$sube,$msgb,$headerb);

} else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }


  /*$previous = "javascript:history.go(-1)";
  if(isset($_SERVER['HTTP_REFERER'])) {
      $previous = $_SERVER['HTTP_REFERER'];
  }

  header("Location: ".$previous, true, 301);
  exit();*/
?>
