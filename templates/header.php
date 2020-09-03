<?php 

	if(isset($_POST['submit'])){

		//cookie for gender
		setcookie('gender', $_POST['gender'], time() + 86400);


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

<!-- <?php 

  // get cookie
  $gender = $_COOKIE['gender'] ?? 'NULL';
  $name = $_COOKIE['name'] ?? 'Unkown';

?>


<head>
	<title>Auction Ninja</title>
	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel= "stylesheet" src="add.css">
  <style type="text/css">
	  .brand{
	  	background: #cbb09c !important;
	  }
  	.brand-text{
  		color: #cbb09c !important;
  	}
  	form{
  		max-width: 460px;
  		margin: 20px auto;
  		padding: 20px;
  	}
  </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="#" class="brand-logo brand-text">Auction Ninja</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
		<li class="grey-text"><?php echo htmlspecialchars($name); ?></li>

		<li class="grey-text"> (<?php echo htmlspecialchars($gender); ?> )</li>

        <li><a href="#" class="btn brand z-depth-0">Check for New Auctions</a></li>
      </ul>
    </div>
  </nav> -->