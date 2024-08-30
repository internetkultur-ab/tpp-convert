<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";
$env = parse_ini_file('.env');

if (!isset($_FILES["file"])) {
  echo "Du laddade inte upp något";
  die();
}
$target_dir = $env["TARGET_DIR"];
$newname =
  date("ymd_Gi_") .
  md5(rand(10000, 99999) . basename($_FILES["file"]["name"])) .
  "." .
  pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . $newname;
$ffmpeg =
  "ffmpeg -i " .
  $_FILES["file"]["tmp_name"] .
  " -ac 1 -ar 8000 -map_metadata -1 " .
  $target_file .
  " -y </dev/null >/dev/null 2>>/var/log/ffmpeg.log ";
if ($env["DEBUG"] == true) {
    echo $ffmpeg;
}

echo shell_exec($ffmpeg);
if (
  array_key_exists("email", $_POST) &&
  PHPMailer::validateAddress($_POST["email"])
) {
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
    $mail->addAttachment("uploads/" . $newname);
    $mail->setFrom($env["FROM_MAIL"], $env["FROM_NAME"]);
    $mail->addAddress($_POST["email"]);
    $mail->addBcc($env["FROM_MAIL"], $env["FROM_NAME"]);
    $mail->isHTML(true); 
    $mail->Subject = "Din ljudfil till Touchpoint Plus, " . $newname;
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
  } catch (Exception $e) {
    
  }
}

echo '<p><audio controls><source src="uploads/' .
  $newname .
  '" type="audio/wav" /></audio></p>';
echo '<p><a href="uploads/' . $newname . '">Ladda ner</a></p>';

?>
