<?php
if(session_status() == PHP_SESSION_NONE){
    session_start(); 
}
include("templates/db.php"); 
$item_id = $_GET['link'];

$delete_sql1 = "DELETE from products where id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $delete_sql1)) {
    header("Location: login.php?error=sqlerror1");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $item_id);
    mysqli_stmt_execute($stmt);
}

$delete_sql2 = "DELETE from bids where p_id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $delete_sql2)) {
    header("Location: login.php?error=sqlerror2");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $item_id);
    mysqli_stmt_execute($stmt);
    echo '<script type="text/javascript">'; 
    echo 'alert("Your product has been deleted");'; 
    echo 'window.location.href = "home.php";';
    echo '</script>';
    //header('Location: home.php');
}
    

?>