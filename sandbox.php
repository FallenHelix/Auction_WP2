<?php 

	if(isset($_POST['submit'])){

		//cookie for gender
        setcookie('gender', $_POST['gender'], time() + 86400 * 2); 
        setcookie('name', $_POST['name'], time() + 86400*2);
		// There are 8640 seconds in 1 day
		session_start();

		$_SESSION['name'] = 'Session : '.$_POST['name'].' ';

		header('Location: index.php');
        header('Location: index.php');
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>php tuts</title>
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">	
		<input type="text" name="name">
		<select name="gender">
			<option value="male">male</option>
			<option value="female">female</option>
		</select>
		<input type="submit" name="submit" value="submit">
	</form>

</body>
</html>
