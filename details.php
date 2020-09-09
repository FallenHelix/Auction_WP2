<?php 
   
 
	if(isset($_GET['id'])){
		// get the query result

		// fetch result in array format
        header('Location: index.php');
    }
    
    function myfnc(){
        header("Location : index.php");
    }

    if(isset($_GET['submit'])){
        myfnc();
    }else{
        echo "not set" ;
    }

?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php');
       $email = $_SESSION['email'] ;
       $description = $_SESSION['description'] ; 
       $title = $_SESSION['title'] ; 
       $timestamp  = $_SESSION['timestamp'];
    ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

	<div class="container center grey-text">
			<h4><?php echo $title; ?></h4>
			<p>Created by <?php echo $email; ?></p>
			<p><?php echo $timestamp; ?></p>
			<h5>Description of the Auction:</h5>
			<p><?php echo $description; ?></p>	
    </div>
		<input type="submit" name="submit" value="submit">
        </form>


   


  

    <?php include('templates/footer.php'); ?>
    
  

</html>