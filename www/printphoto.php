<?php
if($_COOKIE["mode"] == "gif")
{
	$filename = "montage.gif";
}
else
{
	$filename = "montage.jpg";
}

$printer_file = fopen("config/printername", "r") or die("Unable to open file!");
$printername = fread($printer_file, filesize("config/printername"));
$printername = preg_replace('/[[:cntrl:]]/', '', $printername);
fclose($printer_file);

$command = "lp -d " . $printername . " " . $filename;
exec($command);
//cleanup
$command = "rm image*.jpg";
exec($command);
$command = "rm thumbimage*.jpg";
exec($command);
?>
