<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start() ; 
    }

    include("templates/db.php") ; 
    
    $errors = array('amount' => '') ; 
    if(isset($_POST['submit'])){
        $userId = $_SESSION['user_id'] ;
        $bidId = $_SESSION['bid_id'] ; 
        if(empty($_POST['amount'])){
            $errors['amount'] = "Enter Amount" ;
        }else{
            $amount = $_POST['amount'] ; 
            if($amount <100){
                $errors['amount'] = "Enter Valid Amount" ; 
            }
        }

        if (!array_filter($errors)) {
            $sql = "INSERT INTO bids (u_id , p_id , amount) VALUES (?, ?, ?) " ;  
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: add_new.php?error=sqlerror1");
                exit();
            } else{
            mysqli_stmt_bind_param($stmt, "sss", $userId, $bidId, $amount);
                if(!mysqli_stmt_execute($stmt)){
                    echo "<h1>".mysqli_stmt_error($stmt) ; 
                    exit() ; 
                }else {
                    header('Location: home.php');
                }
            }
            mysqli_stmt_close($stmt) ; 
            
    
        } else {
            mysqli_close($conn) ; 
            var_dump($errors) ;
           
        }
    } // end POST check
