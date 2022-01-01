<?php
require "connection.php";
$id = addslashes(trim($_POST['id']));
if ($id > 0) {
   $sql_old = "SELECT imgname FROM `contact_details` WHERE contact_id = '$id'";
   $result = $conn->query($sql_old);
   $imgname = $result->fetch_assoc();
   if ($imgname['imgname'] != "") {
      @unlink("uploaded/$imgname");
   }
   $sql = "DELETE FROM `contact_details` WHERE contact_id = '$id'";
   $conn->query($sql);
   echo 1;
}
