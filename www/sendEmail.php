<?php
require("Mail.php");
require("Mail/mime.php");

$from = "xxx@gmail.com";
$to = $_POST['email'];
$message = "*****";
$subject = "*****";

$host = "smtp.gmail.com";
$username = $_COOKIE["credentialusername"];
$password = $_COOKIE["credentialpass"];

//read counter value and increment by 1
$countvalue = intval(file_get_contents('counter'));
$newcountvalue = intval($countvalue) + 1;
file_put_contents("counter", $newcountvalue);

//make a copy of the montagefile to be sent
$origfilename = "";
if($_COOKIE["mode"] == "gif")
{
	$origfilename = "montage.gif";
}
else
{
	$origfilename = "montage.jpg";
}
$ext = pathinfo($origfilename, PATHINFO_EXTENSION);
$filename = "montage" .  intval($countvalue) . "." .$ext;
copy($origfilename, $filename);

//send Email with attached photo
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

if($_COOKIE["email"] == "y")
{
	if(filter_var($to, FILTER_VALIDATE_EMAIL)) 
	{
		$mail = $smtp->send( $to, $headers, $body );
		
		if ( PEAR::isError($mail) ) {
		echo( "<p>" . $mail->getMessage() . "</p>" );
		} else {
		echo( "<p>Message successfully sent!</p>" );
		}
	}
}
/* attempt to send mms via email to most common providers */
if($_COOKIE["mms"] == "y")
{
	$to  = $_POST['cellnum'] . "@mms.att.net";	//ATT
	$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
	$mime = new Mail_mime();
	$mime->setTXTBody($message);
	$mime->setHTMLBody(nl2br($message));
	$mime->addAttachment($filename,'image/jpg');
	$body = $mime->get();
	$headers = $mime->headers($headers);
	$mail = $smtp->send( $to, $headers, $body );

	$to  = $_POST['cellnum'] . "@vzwpix.com";	//Verizon
	$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
	$mime = new Mail_mime();
	$mime->setTXTBody($message);
	$mime->setHTMLBody(nl2br($message));
	$mime->addAttachment($filename,'image/jpg');
	$body = $mime->get();
	$headers = $mime->headers($headers);
	$mail = $smtp->send( $to, $headers, $body );
		
	$to  = $_POST['cellnum'] . "@tmomail.net";	//T-Mobile
	$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
	$mime = new Mail_mime();
	$mime->setTXTBody($message);
	$mime->setHTMLBody(nl2br($message));
	$mime->addAttachment($filename,'image/jpg');
	$body = $mime->get();
	$headers = $mime->headers($headers);
	$mail = $smtp->send( $to, $headers, $body );
			
	$to  = $_POST['cellnum'] . "@messaging.sprintpcs.com";	//Sprint
	$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
	$mime = new Mail_mime();
	$mime->setTXTBody($message);
	$mime->setHTMLBody(nl2br($message));
	$mime->addAttachment($filename,'image/jpg');
	$body = $mime->get();
	$headers = $mime->headers($headers);
	$mail = $smtp->send( $to, $headers, $body );
				
	$to  = $_POST['cellnum'] .  "@msg.fi.google.com"; //Google-Fi
	$headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
	$mime = new Mail_mime();
	$mime->setTXTBody($message);
	$mime->setHTMLBody(nl2br($message));
	$mime->addAttachment($filename,'image/jpg');
	$body = $mime->get();
	$headers = $mime->headers($headers);
	$mail = $smtp->send( $to, $headers, $body );
}
//upload to dropbox
$command = "./scripts/dropbox_uploader.sh upload " . $filename . " " . $filename;
exec($command);

//copy montage into montage dir
$command =  "mv " . $filename . " ./montages/" . $filename;
exec($command);

header('Location: info.html');
exit;
?>