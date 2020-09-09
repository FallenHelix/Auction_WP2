<?php
// Start the session
session_start();
?>

<?php
if(isset($_POST['email']))
{
$cookie_name = "email";
$cookie_value = $_POST['email'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
$_SESSION["email"] = $_POST['email'];
}

if(isset($_POST['fname']))
{
$cookie_name1 = "fname";
$cookie_value1 = $_POST['fname'];
setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day
$_SESSION["fname"] = $_POST['fname'];
}

if(isset($_POST['lname']))
{
$cookie_name2 = "lname";
$cookie_value2 = $_POST['lname'];
setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
$_SESSION["lname"] = $_POST['lname'];
}
?>

<html>
<?php include('templates/header.php'); ?>
<title>Sign Up</title>
<style>
.error {color: #FF0000;}

h1   {color: black;
     font-family: verdana;
     font-size: 200%;}

p1   {color: green;
     font-family: courier;
     font-size: 160%;}
input[type=text] {
  border: 2px solid grey;
  border-radius: 4px;
}
input[type=email] {
  border: 2px solid grey;
  border-radius: 4px;
}
input[type=password] {
  border: 2px solid grey;
  border-radius: 4px;
}
input[type=number] {
  border: 2px solid grey;
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

$fnameErr = "";
$lnameErr = "";
$emailErr = '';
$passwordErr = '';
$confirmpasswordErr = "";
$ageErr = '';

if(isset($_POST['fname']))
{
if(preg_match("/^([a-zA-Z']+)$/",$_POST['fname']))
{
  $fnameErr = " ";
}
else
{
  $fnameErr = 'Enter your correct first name';
}
}

if(isset($_POST['lname']))
{
if(preg_match("/^([a-zA-Z']+)$/",$_POST['lname']))
{
  $lnameErr = " ";
}
else
{
  $lnameErr = 'Enter your correct last name';
}
}

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

if(isset($_POST['password']))
{
if (empty($_POST["password"]))
{ 
  $passwordErr = "Enter correct password";
} 
else 
{
  $passwordErr = ' ';
}



if ($_POST["password"] != $_POST['confirm_password']) 
{
  $confirmpasswordErr = "Enter correct password";
} 
else 
{
  $confirmpasswordErr = ' ';
}
}




if(isset($_POST['age']))
{
if (empty($_POST["age"])) 
{
  $ageErr = "Enter your age";
} 
else
{
  $ageErr = ' ';
}
}

if($fnameErr == " " && $lnameErr == " " && $emailErr == ' ' && $passwordErr == ' ' && $confirmpasswordErr == " "  && $ageErr == ' ')
{
  header("Location: http://localhost/programs/login.php");
}

?>
<section class="container grey-text">
<center>
  <h4 class="center">Enter your details</h4>
  <div>
  <form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <br>
  Enter your first name <input type="text" name="fname"><span class="error">*<?php echo $fnameErr;?></span>
  <br><br>
  Enter your last name <input type="text" name="lname"><span class="error">*<?php echo $lnameErr;?></span>
  <br><br>
  Enter your email <input type="email" name="email"><span class="error">*<?php echo $emailErr;?></span>
  <br><br>
  Enter your password <input type="password" name="password"><span class="error">*<?php echo $passwordErr;?></span>
  <br><br>
  Confirm password <input type="password" name="confirm_password"><span class="error">*<?php echo $confirmpasswordErr;?></span>
  <br><br>
  Enter your age <input type="number" name="age" min="18" max="100"><span class="error">*<?php echo $ageErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
</form>
</div>
</center>
</section>
</body>

<?php include('templates/footer.php'); ?>
</html>