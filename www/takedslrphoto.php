<?php
$filename = $_GET["photofilename"];
$command = "gphoto2 --capture-image-and-download --force-overwrite --filename " . $filename;
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
