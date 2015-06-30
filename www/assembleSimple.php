<?php
$filename = $_GET["photofilename"];
//TODO: resize only if file sizes seems to big
$command = "mogrify -resize 800x600 image*.jpg";
exec($command);
$command = "montage image*.jpg -tile 2x2 -geometry +5+5 " . $filename;
exec($command);
?>