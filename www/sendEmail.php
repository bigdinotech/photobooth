<?php
require("Mail.php");
require("Mail/mime.php");

$to = $_POST['email'];
$message = "Thank you for coming";
$subject = "Photobooth photos";

//read subject and message from file
$subject_file = fopen("config/subject_text", "r") or die("Unable to open file!");
$subject = fread($subject_file, filesize("config/subject_text"));
fclose($subject_file);

$message_file = fopen("config/message_text", "r") or die("Unable to open file!");
$message = fread($message_file, filesize("config/message_text"));
fclose($message_file);

$event_file = fopen("config/eventname", "r") or die("Unable to open file!");
$eventname = fread($event_file, filesize("config/eventname"));
fclose($event_file);

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
$filename = $eventname .  intval($countvalue) . "." .$ext;
copy($origfilename, $filename);

//write filename, email, and cellnum to a file
$logfile = fopen("emaillog.xls", "a") or die("Unable to open file!");
fwrite($logfile, ($filename . ", " . $to . ", " . $_POST['cellnum'] . "\r\n"));
fclose($logfile);

//send email via script
if($_COOKIE["email"] == "y")
{
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
}
if($_COOKIE["mms"] == "y")
{
	$to  = $_POST['cellnum'] . "@mms.att.net";	//ATT
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
	$to  = $_POST['cellnum'] . "@vzwpix.com";	//Verizon
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
	$to  = $_POST['cellnum'] . "@tmomail.net";	//T-Mobile
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
	$to  = $_POST['cellnum'] . "@messaging.sprintpcs.com";	//Sprint
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
	$to  = $_POST['cellnum'] .  "@msg.fi.google.com"; //Google-Fi
	$command = "mpack -s \"Photobooth Photos\" -d ./config/message_text " . $filename . " " . $to . "> /dev/null &";
	exec($command);
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