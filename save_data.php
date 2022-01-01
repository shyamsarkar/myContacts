<?php
require "connection.php";
if (isset($_POST['contact_id'])) {
   $contact_id = addslashes(trim($_POST['contact_id']));
   $username = addslashes(trim($_POST['username']));
   $mobile = addslashes(trim($_POST['mobile']));
   $imgname = $_FILES['imgname'];

   $target_dir = "uploaded/";
   $target_file = $target_dir . basename($imgname["name"]);
   $createdate = date('Y-m-d H:i:s');
   $imageRealName = microtime(true);
   if ($username != "" && $mobile != "") {

      if ($contact_id == 0) {
         $sql = "INSERT INTO `contact_details`(`username`, `mobile`, `imgname`, `created_at`) VALUES ('$username','$mobile','','$createdate')";
         $conn->query($sql);
         $lastid = $conn->insert_id;
         if ($imgname['tmp_name'] != "") {
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
               $nameofimage = $imageRealName . "." . $imageFileType;
               if (move_uploaded_file($imgname["tmp_name"], $target_dir . $nameofimage)) {
                  $sql_image = "UPDATE `contact_details` SET `imgname`='$nameofimage' WHERE  contact_id='$lastid'";
                  $conn->query($sql_image);
               }
            }
         }
         echo 1;
      } else {
         echo 2;
      }
   } else {
      echo 3;
   }
}
