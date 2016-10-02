<?php
$filename = $_GET["photofilename"];

//do some cleanup
$command = "rm " . $filename;
exec($command);

//assemble image
$command = "montage image*.jpg logo.jpg -tile 2x2 -geometry +5+5 " . $filename;
exec($command);
?>
