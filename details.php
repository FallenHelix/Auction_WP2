<?php include("templates/header.php"); ?>

<?php


if (isset($_GET['id'])) {
    // get the query result

    // fetch result in array format
    header('Location: index.php');
}
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$description = isset($_SESSION['description']) ? $_SESSION['description'] : "";
$title = isset($_SESSION['title']) ? $_SESSION['title'] : "";
$timestamp  = isset($_SESSION['timestamp']) ? $_SESSION['title'] : "";
$file = $_SESSION['file'] ?? "NOt done" ;
$img = $_SESSION['file'] ? $_SESSION['file'] : "null";
?>


<!DOCTYPE html>
<html>


<div class="container center grey-text">
    <h4><?php echo $title; ?></h4>
    <h4><?php echo $img; ?></h4>
    <p>Created by <?php echo $email; ?></p>
    <p><?php echo $timestamp; ?></p>
    <h5>Description of the Auction:</h5>
    <p><?php echo $description; ?></p>
   
    
    <div class="row">
      <div class="col s2">
      <img src= "<?php echo htmlspecialchars($img) ?>" class=" responsive-img">
          </div>
    </div>




<form action="upload.php" method="POST" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>








<?php include('templates/footer.php'); ?>



</html>