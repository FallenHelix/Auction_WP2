<?php
session_start();
session_unset();
include('templates/header.php');
$email = $password = '';
	$errors = array('email' => '', 'password' => '');

	if(isset($_POST['submit'])){

		require 'templates/db.php';

    if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

    if (empty($_POST["password"])){
      $errors['password'] = 'Password is required';
    }
    else {
      $password=  $_POST['password'];

			$sql = "SELECT * FROM users WHERE email=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: http://localhost/WP2_Auction/Auction/login.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $email);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				if ($row) {
					$password_check = password_verify($password, $row['password']);
					if ($password_check == false) {
						$errors['password'] = 'Incorrect Password';
					}
				}
				else {
					$errors['email'] = 'No User has been created with this email';
				}
			}
    }

    if(!array_filter($errors)){

			//session_start();
			$_SESSION['user_id'] = $row["user_id"];
			$_SESSION['profile_pic'] = $row["profile_pic"];
			$_SESSION['name'] = $row['name'];

			mysqli_stmt_close($stmt);

			if (isset($_SESSION['user_id'])) {
				header('Location: home.php');
				echo $_SESSION['name'];
			}
    }
		mysqli_close($conn);
  }

?>

<!DOCTYPE html>
<html>
	<section class="container grey-text">
		<h2 class="brand-logo brand-text center">Login</h2><br>
		<h4 class="center">Enter your details</h4>
		<form class="white" action="login.php" method="POST">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
      <div class="red-text"><?php echo $errors['email']; ?></div>
      <label>Password</label>
			<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
      <div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0"><br><br>
				<div class="border-top pt-3">
	        <small class="text-muted">
	            New User? <a class="ml-2" href="signup.php">Sign Up</a>
	        </small>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
