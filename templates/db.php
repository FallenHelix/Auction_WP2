<?php


$username = "admin";
$password = "admin";
$server = "localhost";
$database = "auction";


$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}

 ?>
