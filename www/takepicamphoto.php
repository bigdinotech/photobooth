<?php
$filename = $_GET["photofilename"];
$command = "raspistill -w 848 -h 480 -q 100 -o " . $filename;
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
