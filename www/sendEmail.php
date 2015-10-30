<?php
require("Mail.php");
require("Mail/mime.php");

$from = "xxx@gmail.com";
$to = $_POST['email'];
$message = "Photobooth photos attached";
$subject = "NSD Photobooth District Family Fun Day";

$host = "smtp.gmail.com";
$username = "xxx";
$password = "xxx";

$filename = "montage.jpg";

$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);

$mime = new Mail_mime();
$mime->setTXTBody($message);
$mime->setHTMLBody(nl2br($message));
$mime->addAttachment($filename,'application/octet-stream');

$body = $mime->get();
$headers = $mime->headers($headers);

$smtp = Mail::factory( 'smtp', array('host' => $host,
          'auth' => true,
          'username' => $username,
          'password' => $password ) );

$mail = $smtp->send( $to, $headers, $body );

if ( PEAR::isError($mail) ) {
echo( "<p>" . $mail->getMessage() . "</p>" );
} else {
echo( "<p>Message successfully sent!</p>" );
}

header('Location: info.html');
exit;
?>