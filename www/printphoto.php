<?php
$filename = $_GET["photofilename"];
$command = "lp -d Canon_CP900 " . $filename;
exec($command);
?>
