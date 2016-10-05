<?php
$filename = $_GET["photofilename"];
//$labelname = $_GET["labelfilename"];
$labelfilename = "./images/label.jpg";

$command = "filename=" . $filename . " labelfilename=" . $labelfilename . " ./scripts/assemblebanner";
exec($command);
?>