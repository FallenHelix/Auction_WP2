<?php 
	$conn = mysqli_connect('localhost', 'admin', 'admin', 'auction') ; 
	if(!$conn){
		echo "Database connection Error!" . mysqli_connect_error() ; 
	}

	//sql command line 
	$sql1 = 'SELECT title, description from auction_detail' ; 
	$result1 = mysqli_query($conn, $sql1) ; 

	$list = mysqli_fetch_all($result1, MYSQLI_ASSOC) ; 
	print_r($list) ; 
?>
<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Auction!</h4>

	<div class="container">
		<div class="row">

		

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>