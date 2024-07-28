<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";
$env = parse_ini_file('.env');

$mail = new PHPMailer(true);
try {
  $mail->isSMTP(); 
  $mail->Host = $env["SMTP_SERVER"]; 
  $mail->SMTPAuth = true; 
  $mail->Username = $env["SMTP_USERNAME"]; 
  $mail->Password = $env["SMTP_PASSWORD"]; 
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
  $mail->Port = 465;
  $mail->CharSet = "UTF-8";
  $mail->setFrom($env["FROM_MAIL"], $env["FROM_NAME"]);
  $mail->addAddress($env["FROM_MAIL"]);
  $mail->addBcc($env["FROM_MAIL"], $env["FROM_NAME"]);
  $mail->isHTML(true); 
  $mail->Subject = "Din ljudfil till Touchpoint Plus, " . date("o-m-d G:i");
  $mail->Body = '<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css" style="display:none;"> P {margin-top:0;margin-bottom:0;} </style>
  </head>
  <body dir="ltr">
  <div class="elementToProof" style="font-family: Aptos, Aptos_EmbeddedFont, Aptos_MSFontService, Calibri, Helvetica, sans-serif; font-size: 12pt; color: rgb(0, 0, 0);">
  Hej, <br>
  här kommer ljudfilen du laddade upp. Nu i rätt format för Telia Touchpoint Plus!
  <br>Hälsar Alex</div><br><br><em>PS. Behöver du hjälp? Du kan hyra in mig! DS.</em>
  </div>
  <div id="Signature">
  <p><span style="font-family: Arial, sans-serif; font-size: 10pt;">&nbsp;</span></p>
  <p><span style="font-family: Arial, sans-serif; font-size: 10pt;">&nbsp;</span></p>
  <p><span style="font-family: &quot;Segoe UI Emoji&quot;, sans-serif; font-size: 22pt;">&#129489;&#8205;&#128187;</span></p>
  <p><span style="font-family: Arial, sans-serif; font-size: 10pt;"><b>Alex Nilsson</b><br>
  Internetkultur AB</span></p>
  </div>
  </body>
  </html>
';
  $mail->AltBody =
    "Hej, här kommer ljudfilen du laddade upp. Nu i rätt format för Telia Touchpoint Plus! Hälsar Alex";

  $mail->send();
  echo "Message has been sent";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
