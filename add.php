<?php
	
include('templates/loged_in_header.php');
	$logged = $_SESSION['logged_in'] ?? 0 ; 
$email = $title = $description = ''; $base_amount ='' ; 
$errors = array('email' => '', 'title' => '', 'description' => '', 'date' =>'' , 'product_pic'=>'', 'base_amount' => '');
function append_string ($str1, $str2){ 
      
    // Using Concatenation assignment 
    // operator (.) 
	$str = $str1 . $str2; 
	
      
    // Returning the result  
    return $str; 
} 
  
if (isset($_POST['submit'])) {
	require 'templates/db.php';
	
	// check title
	if (empty($_POST['title'])) {
		$errors['title'] = 'A title is required';
	} else {
		$title = $_POST['title'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
			$errors['title'] = 'Title must be letters and spaces only';
		} 
	}
	if(empty($_POST['base_amount'])){
		$errors['base_amount'] = 'Enter Valid amount' ; 
	}else{
		$base_amount = $_POST['base_amount'] ; 
		if($base_amount < 0){
			$errors['base_amount'] = 'Enter Valid amount' ;
		} 
	}
//Parse date
	if(!empty($_POST['date'])){
	$date = date('Y-m-d' ,strtotime($_POST['date']));
	$curr_date = date('Y-m-d');
	 
	if($date < $curr_date){
		$errors['date'] = 'End Date is Invalid!!' ; 
	}
}


	if (empty($_POST['description'])) {
		$errors['description'] = 'A Description is required';
	}else{
        $description = $_POST['description'] ; 
	}
	if (!empty($_POST["cat"])){
		$category = "" ;
		$categories = $_POST['cat'] ; 
		foreach($categories as $cat) {
			$category = append_string ($category, $cat);
			$category = append_string ($category, " ");
		}
	}
	

	/////////////////////////

	

// Check if image file is a actual image or fake image
	if(isset($_FILES["product_pic"]) && !empty($_FILES["product_pic"]["tmp_name"])) {
		$check = getimagesize($_FILES["product_pic"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$errors['product_pic'] ="File is not an image.";
			$uploadOk = 0;
		}
		$target_dir = "images/auction/";
		$target_file = $target_dir . basename($_FILES["product_pic"]["name"]);
		$img_dir = $target_dir . basename($_FILES["product_pic"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		if ($_FILES["product_pic"]["size"] > 500000) {
			$errors['product_pic'] ="Sorry, your file is too large.";
			$uploadOk = 0;
			}
		
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$errors['product_pic'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
		
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$errors['product_pic'] = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
					if (!move_uploaded_file($_FILES["product_pic"]["tmp_name"], $target_file)) {
						$errors['proudct_pic'] = "Sorry, there was an error uploading your file.";
					}
			}
	} else{
		$errors['product_pic'] = "Images is needed!!" ; 
	}

	

	/////////////////////////////////////////// 

    
    
    if (!array_filter($errors)) {
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
		$user_id = $_SESSION['user_id'] ?? 60;
		$cdate = $_POST['date'] ;
        $sql =   "INSERT INTO auction_detail (title , description, url, category  ,user_id, due , base_amount) VALUES (?,?,?, ?, ?, ?	,?)" ;
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: add_new.php?error=sqlerror1");
			exit();
		} else{
            mysqli_stmt_bind_param($stmt, "sssssss", $title, $description, $img_dir, $category , $user_id, $cdate , $base_amount);
			if(!mysqli_stmt_execute($stmt)){
				echo "<h1> Error : " .mysqli_stmt_error($stmt) ."</h1>" ; 
			}
			else{
			header('Location: home.php');
			}
			
		}
		mysqli_stmt_close($stmt) ; 
		

	} else {
		mysqli_close($conn) ; 
		$_SESSION["description"] = $_POST['description'];
		$date =  $_POST['date'];
		$timestamp = date('Y-m-d H:i:s', strtotime($date));
	}
	

} // end POST check

?>

<!DOCTYPE html>
<html>
<?php 

// session_start() ; 
// echo "<h1>" .$_SESSION['user_id']."</h1>" ;  ?>
<style media="screen">
	.custom-file-input::-webkit-file-upload-button {
		visibility: hidden;
	}
	.custom-file-input::before {
		content: 'Upload pic';
		display: inline-block;
		background: linear-gradient(top, #f9f9f9, #e3e3e3);
		border: 1px solid #999;
		border-radius: 3px;
		padding: 5px 8px;
		outline: none;
		white-space: nowrap;
		-webkit-user-select: none;
		cursor: pointer;
		text-shadow: 1px 1px #fff;
		font-weight: 700;
		font-size: 10pt;
	}

	.custom-file-input:hover::before {
		border-color: black;
	}

	.custom-file-input:active::before {
		background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
	}
</style>

<section class="container grey-text">
	<h4 class="center">Add a new Auction Item</h4>

	<form class="white" action="add.php" method="POST" enctype="multipart/form-data">
		
		<label>Auction Title</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Description of the Autction Item </label>

		<input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
		<div class="red-text"><?php echo $errors['description']; ?></div>
		
		<label>Starting Bid  </label>
		<input type="number" min= "1" max="10000" step="any" name="base_amount" value="<?php echo htmlspecialchars($base_amount) ?>">
		<div class="red-text"><?php echo $errors['base_amount'] ; ?> </div>
		<label>Enter The Duration of Auction : </label>

		<input type="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
		<div class="red-text"><?php echo $errors['date']; ?></div>
		<p>
			<label>
				<input class="with-gap" type="checkbox" name="cat[]" value="Electroinc" checked />
				<span>Electroinc</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Computer Hardware" />
				<span>Computer Hardware</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Mechanical" />
				<span>Mechanical</span>
			</label>
		</p>
		<p>
			<label>
				<input class="with-gap" name="cat[]" type="checkbox" value="Others" />
				<span>Others</span>
			</label>
		</p>
		<label>Profile Pic</label>
		<input type="file" class="custom-file-input" name="product_pic" , id="product_pic">
		<div class="red-text"><?php echo $errors['product_pic']; ?></div><br>

		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>

</html>
