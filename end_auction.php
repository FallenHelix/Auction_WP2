<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start(); 
    }
    include("templates/db.php"); 
    include('templates/header.php');
    $item_id = $_GET['link'];

    $stmt = mysqli_stmt_init($conn);    

    $bid_sql = "SELECT * FROM bids WHERE amount = (SELECT MAX(amount) FROM bids WHERE p_id = ?) and p_id = ?";
    if (!mysqli_stmt_prepare($stmt, $bid_sql)) {
        header("Location: login.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $item_id, $item_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row1 = mysqli_fetch_array($result, MYSQLI_BOTH);
    } 

    if (empty($row1)) {
        echo '<script type="text/javascript">'; 
        echo 'alert("You do not have any bids on this product");'; 
        echo 'window.location.href = "my_products.php"';
        echo '</script>';
        exit();
    }

    $product_sql = "SELECT * FROM products WHERE id = ?";
    if (!mysqli_stmt_prepare($stmt, $product_sql)) {
        header("Location: login.php?error=sqlerror2");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $item_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row2 = mysqli_fetch_array($result, MYSQLI_BOTH);
    } 

    $sql = "UPDATE products set completed = 1, winner_mail = ? where id = ?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=sqlerror3");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $row1['email'], $item_id);
        mysqli_stmt_execute($stmt);
    }

    $to_email = $_SESSION['email'];
    $subject = "PRODUCT SOLD";
    $body = "Hi, This is to inform you that your product ". $row2['title'] . " has been sold to ". $row1['email'] .
    " for an amount of Rs.". $row1['amount'];
    $headers = "From: bharatchoithani10@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }

    $to_email = $row1['email'];
    $subject = "AUCTION WON";
    $body = "Hi, This is to inform you that you have won the auction for the product ". $row2['title'] . 
    ", sold by ". $_SESSION['email'] ." for an amount of Rs.". $row1['amount'];
    $headers = "From: bharatchoithani10@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo '<script type="text/javascript">'; 
        echo 'alert("Auction Completed");'; 
        echo 'window.location.href = "home.php";';
        echo '</script>';
    } else {
        echo "Email sending failed...";
    }

?>