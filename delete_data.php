<?php
require "connection.php";
$id = addslashes(trim($_POST['id']));
if ($id > 0) {
   $sql = "DELETE FROM `contact_details` WHERE contact_id = '$id'";
   $conn->query($sql);
   echo 1;
}
