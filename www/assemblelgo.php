<?php
$filename = $_GET["photofilename"];
//$labelname = $_GET["labelfilename"];
$labelfilename = "label.jpg";
//TODO: resize only if file sizes seems to big
$command = "mogrify -resize 900x600 image*.jpg";
exec($command);
$command = "montage image*.jpg -tile 2x2 -geometry +5+5 " . "temp_montage2.jpg"; 
exec($command);
$command = "mogrify -resize 1280x720 "  . "temp_montage2.jpg";
exec($command);
$command = "convert temp_montage2.jpg " . "-bordercolor white -border 100x0 " . "temp_montage2.jpg";
exec($command);
$command = "convert temp_montage2.jpg +append " . $labelfilename . " -append " . $filename;
exec($command);
?>