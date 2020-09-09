

<html>
<?php include('templates/header.php'); ?>
<title>Login</title>
<style>
.error {color: #FF0000;}
body {background-color: lightgreen;}
h1   {color: black;
     font-family: verdana;
     font-size: 200%;}
p    {color: blue;
     font-family: verdana;
     font-size: 160%;}
p1   {color: green;
     font-family: courier;
     font-size: 160%;}
input[type=text] {
  border: 2px solid blue;
  border-radius: 4px;
}
input[type=email] {
  border: 2px solid blue;
  border-radius: 4px;
}
input[type=password] {
  border: 2px solid blue;
  border-radius: 4px;
}
input[type=number] {
  border: 2px solid blue;
  border-radius: 4px;
}
div {
  background-color: white;
  width: 500px;

  margin: 20px;
}

</style>
<body>

<?php
$cookie_name = 'email';
$cookie_name1 = 'fname';
$cookie_name2 = 'lname';



$emailErr = '';
$passwordErr = '';

if(isset($_POST['email']))
{
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
  $emailErr = "Invalid email format";
}
else
{
  $emailErr = ' ';
}
}

if(isset($_POST["password"]))
{
if (empty($_POST["password"])) 
{
  $passwordErr = "Enter correct password";
} 
else 
{
  $passwordErr = ' ';
}
}

if($emailErr == ' ' && $passwordErr == ' ')
{
  header("Location: http://localhost/programs/homepage.php");
}

?>
<section class="container grey-text">
<center>
  <h4 class="center">Enter your details</h4>
  <div>
  <form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <br><br>
  Enter your email <input type="email" name="email"><span class="error">*<?php echo $emailErr;?></span>
  <br><br>
  Enter your password <input type="password" name="password"><span class="error">*<?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
</form>
</div>
</center>
</section>
</body>
<?php include('templates/footer.php'); ?>
</html>