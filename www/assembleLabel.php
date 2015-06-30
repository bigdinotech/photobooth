<?php
$filename = $_GET["photofilename"];
$labelname = $_GET["labelfilename"];
//TODO: resize only if file sizes seems to big
$command = "mogrify -resize 800x600 image*.jpg";
exec($command);
$command = "montage image*.jpg -tile 2x2 -geometry +5+5 " . $filename; 
exec($command);
$command = "mogrify -resize 1280x720 "  . $filename;
exec($command);
$command = "convert temp_montage2.jpg +append " $labelfilename . " -append " . $filename;
exec($command);
?>