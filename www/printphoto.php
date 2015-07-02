<?php
$command = "cupsenable Canon_CP900";
exec($command);
$filename = $_GET["photofilename"];
$command = "lp -d Canon_CP900 " . $filename;
exec($command);
//cleanup
$command = "rm image*.jpg";
exec($command);
$command = "rm thumbimage*.jpg";
exec($command);
?>
