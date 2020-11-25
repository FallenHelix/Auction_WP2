<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('templates/header.php');
include("templates/db.php");


?>
<html>

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

    #item-image {
        position: relative;
        padding: 10px;
        width: 500px;
    }

    #item-image img {
        width: 100px;
        height: 100px;
        border: 3px solid black;
        left: 100px;
    }
</style>
<?php
    $item_id = $_GET['link'] ; 
    $sql = "SELECT * from auction_detail where id = ?" ; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $item_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result, MYSQLI_BOTH) ; 

    } 

?>

<section class="container grey-text left">
    <h4 class="center">Item Detail</h4>
    <center>
        <div class="white" id="item-image">
            <img src="images/gym.jpg"><br>
            <p>Name : <?php echo htmlspecialchars($row['title']) ;  ?></p>
            <p>Category : <?php echo htmlspecialchars($row['category']) ;  ?></p>
            <p>Description : <?php echo htmlspecialchars($row['description']) ;  ?></p>
            <p>Minimum value<?php echo htmlspecialchars($row['title']) ;  ?></p>
            <p>End Date <?php echo htmlspecialchars($row['Date']) ;  ?></p>
            <br><br>
            <form action="details.php" method="POST" enctype="multipart/form-data">
                <label>Enter value</label>
                <input type="number" name="fname">
                <div class="center">
                    <input type="submit" name="submit" value="BID NOW" class="btn brand z-depth-0">
                </div>
            </form>
        </div>
        <center>
</section>





<section class="container grey-text right">
    <h4 class="center">Item Detail</h4>
    <center>
        <div class="white" id="item-image">
            <img src="images/gym.jpg"><br>
            <p>Name</p>
            <p>Category</p>
            <p>Description</p>
            <p>Minimum value</p>
            <p>End Date</p>
            <br><br>
            <form action="details.php" method="POST" enctype="multipart/form-data">
                <label>Enter value</label>
                <input type="number" name="fname">
                <div class="center">
                    <input type="submit" name="submit" value="BID NOW" class="btn brand z-depth-0">
                </div>
            </form>
        </div>
        <center>
</section>
<?php include('templates/footer.php'); ?>

</html>