<?php
$filename = $_GET["photofilename"];
$command = "rm " . $filename; //some cleanup
$command = "gphoto2 --capture-image-and-download --force-overwrite --filename " . $filename;
$thumbFilename = "thumb" . $filename;
exec($command);
if(file_exists($filename))
{
  //resize
  $command = "mogrify -resize 900x600 " . $filename;
  exec($command);
  //create thumbnail
  $command = "cp " . $filename . " " . $thumbFilename;
  exec($command);
  $command = "mogrify -resize 300x200 " . $thumbFilename;
  exec($command);
  echo "success";
}
else
{
  echo "fail";
}
?>
