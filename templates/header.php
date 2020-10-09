<head>
	<title>Auction Ninja</title>
	<!-- Compiled and minified CSS -->
	<meta name = "viewport" content = "width = device-width, initial-scale = 1">
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel = "stylesheet"
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      <script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script>
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
	.arrow{
	  width: 25px;
	  height: 25px;
		float: right;
		position: relative;
		top: 25px;
	}
	.circular{
	  width: 65px;
	  height: 65px;
	  border-radius: 50%;
		float: right;
		position: relative;
		top: 2px;
		padding: 10px
	}
	#login-pos {
  font-size: 20px;
	 margin: auto 10px;
}
  </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="#" class="brand-logo brand-text">Auction Ninjas</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      </ul>
    </div>

		<?php
			if (isset($_SESSION['user_id'])) {
				echo '<ul id = "dropdown" class = "dropdown-content">
		       <li><a href = "#" class="brand-text" style="font-size:12px">Edit Account</a></li>
		       <li><a href = "logout.php" class="brand-text" style="font-size:12px">Logout</a></li>
		    </ul>

				<a class="dropdown-button" style="float:right" data-activates = "dropdown"><img src="icons/down-arrow.svg" class="arrow"></a>
				<a href="#"><img src="' . $_SESSION['profile_pic'] . '" class="circular"></a>';
			}
			else {
				if (basename($_SERVER['PHP_SELF']) == 'login.php') {
					echo '<a href = "signup.php" class="brand-text" id="login-pos" style="float:right">Sign Up</a></li>';
				}
				else {
					echo '<a href = "login.php" class="brand-text" id="login-pos" style="float:right">Login</a></li>';
				}

			}
		 ?>

  </nav>
</body>
