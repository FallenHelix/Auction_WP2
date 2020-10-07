<?php

    $conn = mysqli_connect('localhost', 'admin', 'admin', 'auction') ; 

    if(!$conn){
		echo "Database connection Error!" . mysqli_connect_error() ; 
    }

    $description = $_POST['description'];
    $date =  $_POST['date'];
    $title = $_POST['title'];
    $img = "imgURL" ;
    $cat = "cat"; 
    
    echo $description ." ". $date." " . $title ." ". $img . " ".$cat ;

    
    // $stmt = $conn->prepare("INSERT INTO auction_detail (title , description, url, category) VALUES (?, ?, ?)");
    if ($stmt = mysqli_prepare($conn, "INSERT INTO auction_detail (title , description, url, category) VALUES (?, ?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt,"ssss", $title, $description, $img ,$cat);
        mysqli_stmt_execute($stmt);

       
        mysqli_stmt_close($stmt);
    }
?> 
