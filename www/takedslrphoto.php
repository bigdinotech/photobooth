<?php
$filename = $_GET["photofilename"];
$thumbFilename = "thumb" . $filename;
//some cleanup
if(file_exists($filename))
{
	$command = "rm " . $filename; //some cleanup
	exec($command);
	sleep(1);
}
if(file_exists($thumbFilename))
{
	$command = "rm " . "thumb" . $filename;
	exec($command);
}
$command = "gphoto2 --capture-image-and-download --force-overwrite --filename " . $filename;

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
