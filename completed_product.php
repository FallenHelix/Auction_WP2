<!DOCTYPE html>
<?php
    session_start();
    include('templates/header.php');
    include("templates/db.php");
?>


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
        padding: 20px;
        width: 450px;
    }

    #item-image img {
        width: 150px;
        height: 150px;
        border: 3px solid black;
        left: 100px;
    }
</style>
<?php
if(session_status() == PHP_SESSION_NONE){
    session_start(); 
}
include("templates/db.php") ; 
$item_id = $_GET['link'];
$sql = "SELECT * from products where id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: login.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $item_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    $_SESSION['bid_id'] = $item_id;
}

?>

<section class="row container grey-text center">

<div class="col s6 m4" style="margin-right:175px">
        <h4 class="center">Product Detail</h4>
        <div class="white" id="item-image">    
            <div class><img src=<?php echo htmlspecialchars($row['product_pic']) ; ?> height="200"  width="200"></div>
            <p style="font-size:25px;"><?php echo htmlspecialchars($row['title']);  ?></p>
            <p>Category : <?php echo htmlspecialchars($row['category']);  ?></p>
            <p>Description : <?php echo htmlspecialchars($row['description']);  ?></p>
            <p>Minimum value : Rs <?php echo htmlspecialchars($row['base_amount']);  ?></p>
            <p>End Date : <?php echo htmlspecialchars($row['end_date']);  ?></p>
            <br>
        </div>
    </div>

    <div class="col s6">
        <h3>Auction Won by : </h3>
        <?php
        $bid_sql = "SELECT * FROM bids WHERE amount = (SELECT MAX(amount) FROM bids WHERE p_id = ?) and p_id = ?";
        if (!mysqli_stmt_prepare($stmt, $bid_sql)) {
            header("Location: login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $item_id, $item_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $idx = 1 ; 
            $row2 = mysqli_fetch_array($result, MYSQLI_BOTH);
        }
            ?>
            <div class="white">
            <table style="width:100%">
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <tr>
            <th><?php echo htmlspecialchars($row2['name']);?></th>
            <th><?php echo htmlspecialchars($row2['email']);?></th>
            <th><?php echo htmlspecialchars($row2['amount']);?></th>
            </tr>
        </table>
        </div>
    </div>

</section>


<!-- <?php include('templates/footer.php'); ?> -->

</html>