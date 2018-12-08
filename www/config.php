<?php
$target_dir = "images/";
$target_file = $target_dir . "logo";
$minilogo = $target_dir . "minilogo.jpg";
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["logofile"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
$imageFileType = strtolower(pathinfo(basename($_FILES["logofile"]["name"]),PATHINFO_EXTENSION));
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

$target_file = $target_file . "." . $imageFileType;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["logofile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["logofile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//copy and resize logo
$command = "cp " . $target_file . " " . $minilogo;
exec($command);
$command = "mogrify -resize 300x200 " . $minilogo;
exec($command);

$eventname = $_POST['eventname'];
$eventmessage = $_POST['eventmessage'];


//overwrite config files
file_put_contents("config/eventname", $eventname);
file_put_contents("config/message_text", $eventmessage);

header('Location: index.html');
exit;
?>