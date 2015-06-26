<?php
$filename = $_GET["photofilename"];
$command = "gphoto2 --capture-image-and-download --filename " . $filename;
exec($command);
if(file_exists($filename))
{
  echo "success";
}
else
{
  echo "fail";
}
?>
