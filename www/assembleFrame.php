<?php
$filename = $_GET["photofilename"];
$logoname = $_GET["logofilename"];

$command = "filename=" . $filename . " logoname=" . $logoname . " ./scripts/assembleframe";
exec($command);
?>
