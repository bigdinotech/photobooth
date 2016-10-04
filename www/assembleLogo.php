<?php
$filename = $_GET["photofilename"];
$logoname = "./images/logo.jpg";

//do some cleanup
$command = "rm " . $filename;
exec($command);

//assemble image
$command = "mogrify -resize 900x600 image*.jpg";
exec($command);
$command = "montage image*.jpg " . $logoname . " -tile 2x2 -geometry +5+5 " . $filename;
exec($command);
?>
