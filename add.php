<?php
$email = $title = $description = '';
$errors = array('email' => '', 'title' => '', 'description' => '', 'date' =>'');
if (isset($_POST['submit'])) {

	// check email
	if (empty($_POST['email'])) {
		$errors['email'] = 'An email is required';
	} else {
		$email = $_POST['email'];
		if (!filter_var($email,)) {
			$errors['email'] = 'Email must be a valid email address';
		} else {

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
		} else {
			$_SESSION['title'] = $title;
		}
	}

	//Parse date

	if(!empty($_POST['date'])){
	$date = date('Y-m-d' ,strtotime($_POST['date']));
	$curr_date = date('Y-m-d');
	 
	if($date < $curr_date){
		$errors['date'] = 'End Date is Invalid!!' ; 
	}
	echo "Selected Date ".$date."\n"; 
	echo "Current Date : ".$curr_date."\n" ; 
}


	if (empty($_POST['description'])) {
		$errors['description'] = 'A Description is required';
	}
	if (array_filter($errors)) {
		echo "errors in the form!!";
	} else {
		$_SESSION["description"] = $_POST['description'];
		$date =  $_POST['date'];
		$timestamp = date('Y-m-d H:i:s', strtotime($date));
		$_SESSION['timestamp'] = $timestamp;
		echo "Form is Valid !! ";
		header('Location: details.php');
	}
} // end POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>



<section class="container grey-text">
	<h4 class="center">Add a new Auction Item</h4>
	<h1 class="blueW" > This Should be in blue!!! </h1>

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
		<input type="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
		<div class="red-text"><?php echo $errors['date']; ?></div>
		<p>
			<label>
				<input class="with-gap" type="radio" name="group1" value="Electroinc" checked />
				<span>Electroinc</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="group1" type="radio" value="Computer Hardware" />
				<span>Computer Hardware</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="group1" type="radio" value="Mechanical" />
				<span>Mechanical</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="group1" type="radio" value="Others" />
				<span>Others</span>
			</label>
		</p>
		<!--                         TEMP -->
		

		<p>
			<label>
				<input class="with-gap" type="checkbox" name="cat[]" value="Electroinc" checked />
				<span>Electroinc</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Computer Hardware" />
				<span>Computer Hardware</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Mechanical" />
				<span>Mechanical</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Others" />
				<span>Others</span>
			</label>
		</p>
		<div class="container center grey-text">
    <p><input type="file" name="file"/> <span>File</span>
    <p><input type="submit" name="Upload" /> <span>Upload file</span>



		<div class="center">
			<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>