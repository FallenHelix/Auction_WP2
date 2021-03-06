<?php
session_start();
session_unset();
$email = $password = '';
$errors = array('email' => '', 'password' => '');

if (isset($_POST['submit'])) {


	if (empty($_POST['email'])) {
		$errors['email'] = 'An email is required';
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Email must be a valid email address';
		}
	}

	if (empty($_POST["password"])) {
		$errors['password'] = 'Password is required';
	} else {
		$password =  $_POST['password'];
	}

	require 'templates/db.php';
	$email = $_POST['email'] ; 
	$pass = $_POST['password'] ; 
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

	$login_sql = 'SELECT * from users where email = ? ' ;
	$stmt = mysqli_stmt_init($conn) ;
	if (!mysqli_stmt_prepare($stmt, $login_sql)) {
		$errors['email'] = 'Email is incorrect';
	} else {
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		$rowResult = mysqli_stmt_get_result($stmt) ;
		if($row = mysqli_fetch_assoc($rowResult)){
			$password_check = password_verify($pass,$row['password'] ) ;
			if($password_check==false) {
				$errors['password'] = 'Password is incorrect';
			}
			else if($password_check){
				$_SESSION['email'] = $row['email'] ; 
				$_SESSION['logged_in'] = true ; 
				$_SESSION['user_image'] = $row["profile_pic"] ; 
				$_SESSION['name'] = $row['name'] ; 
				$_SESSION["user_id"] =  $row['id'] ; 
				$_SESSION['profile_pic'] = $row['profile_pic'] ; 
				header('Location: home.php?login=success');
				exit() ; 

			}

		}else{
			$errors['email'] = 'Email is incorrect';
		}
	}

	if (!array_filter($errors)) {
		$curr_date = date('Y-m-d');
		$update_sql = "UPDATE products SET completed = 1 where end_date < ?";
		if (!mysqli_stmt_prepare($stmt, $delete_sql1)) {
			header("Location: login.php?error=sqlerror1");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $curr_date);
			mysqli_stmt_execute($stmt);
		}

		$_SESSION['logged_in'] = true ; 
		header('Location: home.php');
	}
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
	<h2 class="brand-logo brand-text center">Login</h2><br>
	<h4 class="center">Enter your details</h4>
	<!-- LOGIN FORM -->
	<form class="white" action="login.php" method="POST">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Password</label>
		<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
		<div class="red-text"><?php echo $errors['password']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>
