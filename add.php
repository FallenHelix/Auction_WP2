<?php
$email = $title = $description = '';
$errors = array('email' => '', 'title' => '', 'description' => '');
if (isset($_POST['submit'])) {

	// check email
	if (empty($_POST['email'])) {
		$errors['email'] = 'An email is required';
	} else {
		$email = $_POST['email'];
		if (!filter_var($email,)) {
			$errors['email'] = 'Email must be a valid email address';
		}
		else{
			$_SESSION['email'] = $email;
		}
	}
	// check title
	if (empty($_POST['title'])) {
		$errors['title'] = 'A title is required';
	} else {
		$title = $_POST['title'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
			$errors['title'] = 'Title must be letters and spaces only';
		}else{
			$_SESSION['title'] = $title ; 
		}
	}

	if (empty($_POST['description'])) {
		$errors['description'] = 'A Description is required';
	}
	if(array_filter($errors)){
		echo "errors in the form!!";
	}else{
		$_SESSION["description"] = $_POST['description'] ;

		$date =  $_POST['date'];
		$timestamp = date('Y-m-d H:i:s', strtotime($date));  
		$_SESSION['timestamp'] = $timestamp ; 
		echo "Form is Valid !! "  ; 
        header('Location: details.php');
	}
} // end POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>



<section class="container grey-text">
	<h4 class="center">Add a new Auction Item</h4>

	<form class="white" action="add.php" method="POST">
		<label>Your Email</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Auction Title</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Description of the Autction Item </label>

		<input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
		<div class="red-text"><?php echo $errors['description']; ?></div>
		<label>Enter The Duration of Auction : </label>
		<input type="number" name="days" value="<?php echo htmlspecialchars($days) ?>" >	
		<div class="center">
		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>