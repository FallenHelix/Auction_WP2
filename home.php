<html>
<?php
session_start();
include('templates/header.php');
?>


<title>Home Page</title>
<body>
  <br><br>
  <h4 class="center" style="color:grey">Select an option</h4>
  <div class="container" style="margin-right:80px">
		<div class="row">
			<div class="col s6 m4" style="margin-right:60px">
				<div class="card z-depth-0">
					<div class="card-content center">
            <div class="white">
          <img src="icons/hammer.svg" style="width:250px;height:250px;"></div>
					</div>
          <div class="card-action center">
						<a class="brand-text" href="allAuctions.php">Want to bid for items? <br> Click here!</a>
					</div>
				</div>
			</div>
			<div class="col s6 m4">
				<div class="card z-depth-0">
					<div class="card-content center">
            <div class="white">
          <img src="icons/object.svg" style="width:250px;height:250px;"></div>
					</div>
          <div class="card-action center">
						<a class="brand-text" href="add.php">Want to add items for auction? <br> Click here!</a>

					</div>
				</div>
			</div>
    </div>
  </div>
</body>
<?php include('templates/footer.php'); ?>
</html>
