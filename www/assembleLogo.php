<?php
$filename = $_GET["photofilename"];
//$logoname = $_GET["logofilename"];
$logoname = "./images/logo.jpg";

$command = "filename=" . $filename . " logoname=" . $logoname . " ./scripts/assemblelogo";
exec($command);
?>
