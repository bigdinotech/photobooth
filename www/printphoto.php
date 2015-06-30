<?php
$filename = $_GET["photofilename"];
$command = "cupsenable Canon_CP900";
exec($command);
$command = "lp -d Canon_CP900 " . $filename;
exec($command);
?>
