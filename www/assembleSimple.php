<?php
$filename = $_GET["photofilename"];
$command = "filename=" . $filename . " ./scripts/assemblesimple";
exec($command);
?>
