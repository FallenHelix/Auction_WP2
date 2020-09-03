<?php 

	if(isset($_POST['submit'])){

		//cookie for gender
        setcookie('gender', $_POST['gender'], time() + 86400 * 2); 
        setcookie('name', $_POST['name'], time() + 86400*2);
        // There are 8640 seconds in 1 day
        header('Location: index.php');
	}

?>

<!DOCTYPE html>


<html>
    
<?php include('templates/header.php'); ?>



<section class="container grey-text">
	<h4 class="center">Add a new Auction Item</h4>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

		<label>Name</label>
        <input type="text" name="name" >    
        
        <label for="cars">Choose a car:</label>
        <select name="gender">
			<option value="male">male</option>
			<option value="female">female</option>
        </select>
		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>
