<!DOCTYPE html>
<?php
    session_start();

include('templates/header.php');
include("templates/db.php");


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<div class="container">
		<div class="row">
    <?php
    $all_auctions = 'SELECT * from products where user_id != ? and completed = 0 ORDER BY end_date DESC';
    require 'templates/db.php';
    $id = $_SESSION['user_id'] ; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $all_auctions)) {
        header("Location: login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {?>

    <div class="col s6 md3">
        <div class="card z-depth-1">

            <div class="card-content left">
                
                <div class="col"><img src=<?php echo htmlspecialchars($row['product_pic']) ; ?> height="200"  width="200"></div>
            </div>
            <div class="card-content center">
                <h6><?php echo htmlspecialchars($row['title']); ?></h6>
                <div><?php echo htmlspecialchars($row['description']); ?></div>
                <div><?php echo htmlspecialchars($row['category']   ); ?></div> 
                <div>Rs <?php echo htmlspecialchars($row['base_amount']   ); ?></div> 
                <div>Last Date : <?php $date = date_create($row['end_date']) ;  echo htmlspecialchars(date_format($date, "d/M/Y l"   )); ?></div> 
                <!-- <ul>
                    <?php foreach(explode(" " , $row['category']) as $cat) { ?>
                    <li><?php echo htmlspecialchars($cat) ?></li>

                    <?php } ?> 
                    </ul> -->
                
            </div>
            <div class="card-action right-align">
                <?php  echo '<a class="brand-text" href="product.php?link=' . $row['id'] . '">More Info</a>'; ?>
            </div>
        </div>
    </div>

            <!-- <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($row['title']); ?></h6>
                        <div><?php echo htmlspecialchars($row['description']); ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="#">more info</a>
                    </div>
                </div> -->
        <?php 
        // var_dump($row) ; 
    }} ?>
        </div>
</div>
</body>

</html>