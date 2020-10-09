<?php

$username = "bharat";
$password = "bharat@26";
$server = "localhost";
$database = "auction_ninja";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}

 ?>
