<?php
$filename = $_GET["photofilename"];
$command = "raspistill -w 900 -h 600 -q 100 -o " . $filename;
exec($command);
if(file_exists($filename))
{
  //resize
  $command = "mogrify -resize 900x600 " . $filename;
  exec($command);
  //create thumbnail
  $thumbFilename = "thumb" . $filename;
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
