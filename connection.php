<?php
$serverName = "localhost";
$userName = "root";
$password = "123";
$databaseName = "my_contact";
$conn = new mysqli($serverName, $userName, $password, $databaseName);

if ($conn->connect_error) {
   echo "Failed to connect to MySQL: " . $conn->connect_error;
   exit();
}
