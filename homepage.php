

<html>
<?php include('templates/homepage_header.php'); ?>
<title>Home Page</title>
<style>
.error {color: #FF0000;}
p1   {
     font-size: 300%;}
a    {color : grey;
      font-size: 100%;}
div {
  background-color: white;
  width: 500px;

  padding: 50px;
  margin: 20px;
}

.column {
  float: left;
  width: 33.33%;
  padding: 10px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<body>
  <br><br>
<center>
<section class="container grey-text">
  <h4 class="center">Select an option</h4>
  <div class = 'row'>
  <div class = 'column'>
  <img src="hammer.png" style="width:150px;height:160px;">
  <figcaption><a href="https://www.w3schools.com/" target="_blank">Want to bid for items? Click here!</a></figcaption>
</div>
  <div class = 'column'>
  <img src="object.png" style="width:150px;height:160px;">
  <figcaption><a href="http://localhost/programs/add.php" target="_blank">Want to put up an item for auction? Click here!</a></figcaption>
</div>
</div>
</section>
</center>
</body>
<?php include('templates/footer.php'); ?>
</html>