<?php
require("Mail.php");
require("Mail/mime.php");

$from = "xxx@gmail.com";
$to = $_POST['email'];
$message = "xxxxx";
$subject = "xxxxx";

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
$mime->addAttachment($filename,'image/jpg');

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

/* attempt to send mms via email to most common providers */
$to  = $_POST['cellnum'] . "@mms.att.net";	//ATT
$mail = $smtp->send( $to, $headers, $body );

$to  = $_POST['cellnum'] . "@vzwpix.com";	//Verizon
$mail = $smtp->send( $to, $headers, $body );
	
$to  = $_POST['cellnum'] . "@tmomail.net";	//T-Mobile
$mail = $smtp->send( $to, $headers, $body );
		
$to  = $_POST['cellnum'] . "@messaging.sprintpcs.com";	//Sprint
$mail = $smtp->send( $to, $headers, $body );
			
$to  = $_POST['cellnum'] .  "@msg.fi.google.com"; //Google-Fi
$mail = $smtp->send( $to, $headers, $body );

header('Location: info.html');
exit;
?>