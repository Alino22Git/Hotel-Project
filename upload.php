<?php

function createDBentry($path, $paththumb, $title, $comment)
{

  require('dbaccess.php');
  $db_obj = new mysqli($host, $user, $password, $database);
  $sql = "INSERT INTO `news` (`path`, `paththumb`, `title`, `comment`)
VALUES (?, ?, ?, ?)";
  $stmt = $db_obj->prepare($sql);
  $stmt->bind_param("ssss", $path, $paththumb, $title, $comment);
  if ($stmt->execute()) {

  }
  $stmt->close();
  $db_obj->close();
}
//

if (isset($_POST["submit"])) {
  if (isset($_POST["comment"]) && !empty($_POST["comment"])) {
    $comment = $_POST["comment"];
  } else {
    $comment = NULL;
  }
  if (isset($_POST["title"]) && !empty($_POST["title"])) {
    $title = $_POST["title"];
  } else {
    $title = NULL;
  }
  if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"])) {



    $d = time();
    $newname = date("Y-m-d-H-i-s", $d);
    if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

      $oldname = basename($_FILES["fileToUpload"]["name"]);
      $target_dir = "uploads/";
      $target_dir_thumb = "thumbs/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $paththumb = $target_dir_thumb . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


      $target_file = $target_dir . "$newname." . $imageFileType;
      $paththumb = $target_dir_thumb . "$newname." . $imageFileType;

      $uploadOk = 1;




      // Check if image file is a actual image or fake image

      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        $msg = "File is not an image, your file was not uploaded.";
        $uploadOk = 0;
      }


      // Allow certain file formats
      if ($imageFileType != "jpeg") {
        $msg = "Sorry, only JPEG files are allowed, your file was not uploaded.";
        $uploadOk = 0;
      }

      // Check if file already exists
      if (file_exists($target_file)) {
        $msg = "Sorry, file already exists, your file was not uploaded.";
        echo "$newname";
        $uploadOk = 0;
      }

      // Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/



      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 1) {


        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

          //in db laden

          createDBentry($target_file, $paththumb, $title, $comment);



          $msg = " The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

          include "thumb.php";


        } else {
          $msg = "Sorry, there was an error uploading your file.";
        }
      }


      echo "<h5> $msg <h5/>";

    }

    echo "<h5> Der Beitrag wurde veröffentlicht! <h5/>";

  }
  else{
    createDBentry(NULL, NULL, $title, $comment);

  }
}

?>