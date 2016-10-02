<?php
$filename = $_GET["photofilename"];
$command = "montage image*.jpg logo.jpg -tile 2x2 -geometry +5+5 " . $filename;
exec($command);
?>
