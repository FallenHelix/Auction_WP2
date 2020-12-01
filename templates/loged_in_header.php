<?php
	session_start() ;
	if(isset($_SESSION)) {
		$auth = $_SESSION['logged_in'] ?? false ;
		if($auth != 1){
			header("Location: login.php") ; 
			exit() ; 
		}
		$user_img = $_SESSION['user_image'] ?? "";
		$round_image = '<a href="#"><img alt="icons/default.png" src ='.$user_img.' class="circular"></a>' ;
	}

?>
<head>
	<title>Auction Ninja</title>
	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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
  </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="#" class="brand-logo brand-text">Auction Ninjas</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      </ul>
    </div>
		<a href="#"><img src="icons/down-arrow.svg" class="arrow"></a>

    <?php
		echo $round_image??"" ; 
		echo $_SESSION["loged_in"] ?? "" ; 
        ?>
  </nav>