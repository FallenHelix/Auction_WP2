<?php

  $conn = mysqli_connect('localhost', 'bharat', 'bharat@26', 'auction_ninja');

  if(!$conn){
  echo 'Connection error: ' . mysqli_connect_error();
  }

  $sql = 'SELECT id, title FROM items';

  $result = mysqli_query($conn, $sql);

//  $items = mysqli_fetch_all($result);

//  print_r($items);

  while($row = mysqli_fetch_array($result)) {
    echo "id: " . $row["id"]. " - Title: " . $row["title"]."<br>";
  }

  mysqli_free_result($result);

  mysqli_close($conn);

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <<?php include('templates/header.php') ?>

  <<?php include('templates/footer.php') ?>
</html>
