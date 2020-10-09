<?php
$email = $title = $description = $enddate = '';
$errors = array('title' => '', 'description' => '', 'enddate' => '');


if (isset($_POST['submit'])) {

	// check title
	if (empty($_POST['title'])) {
		$errors['title'] = 'A title is required';
	} else {
		$title = $_POST['title'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
			$errors['title'] = 'Title must be letters and spaces only';
		}
	}

	if (empty($_POST['description'])) {
		$errors['description'] = 'A Description is required';
	}

	if (empty($_POST['enddate'])) {
		$errors['enddate'] = 'End Date is required';
		$enddate = 'End Date is required';
	}
	if(array_filter($errors)){
		echo "errors in the form!!";
	}else{
		echo "Form is Valid !! "  ;
	}
} // end POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>



<section class="container grey-text">
	<h4 class="center">Add a new Auction Item</h4>
	<form class="white" action="add.php" method="POST">
		<label>Auction Title</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Description of the Auction Item </label>
		<input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
		<div class="red-text"><?php echo $errors['description']; ?></div>
		<label>Enter duration of the auction : </label>
		<input type="number" name="enddate" value="<?php echo htmlspecialchars($enddate) ?>" >
		<div class="center">
		<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>
