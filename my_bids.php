<?php
    session_start(); 
    include("templates/db.php"); 
    include("templates/header.php"); 
    

$user_id = $_SESSION['user_id']; 

?>

<body>
<?php
    $sql = "SELECT p_id, MAX(amount) as amount from bids where u_id = ? GROUP BY p_id" ; 

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        if(!mysqli_stmt_execute($stmt)){
            echo mysqli_stmt_error($stmt) ;
            exit() ;  

        }
        $idx = 1; 
        $result = mysqli_stmt_get_result($stmt);
        ?>

     <br><br>
     <div class="container">
        <div class="white">
                <table style="width:100%">
                <tr>
                <th>Index</th>
                <th>Product Name</th>
                <th>Latest Bid</th>
                <th>Status</th>
                <th>Product Link</th>
                <?php
                while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            ?>
                    <tr>
                    <th><?php echo $idx;?></th>
                    <th><?php  
                    $sql1 = "SELECT * from products where id = ?" ; 

                    if (!mysqli_stmt_prepare($stmt, $sql1)) {
                        header("Location: login.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $row['p_id']);
                        if(!mysqli_stmt_execute($stmt)){
                            echo mysqli_stmt_error($stmt) ;
                            exit() ;  
                        }
                    $result1 = mysqli_stmt_get_result($stmt);
                    $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
                    echo htmlspecialchars($row1['title']);
                    } 
                    ?></th>
                    <th><?php echo htmlspecialchars($row['amount']);?></th>
                    <th><?php 
                        if ($row1['completed'] == 0) {
                            echo 'Ongoing';
                        } else {
                            if ($row1['winner_mail'] == $_SESSION['email']) {
                                echo 'Won';
                            } else {
                                echo 'Lost';
                            }
                        }
                    ?></th>
                    <th><?php 
                        if ($row1['completed'] == 0) {
                            echo '<a class="brand-text" href="product.php?link=' . $row['p_id'] . '">Click</a>';
                        } else {
                            echo '<a class="brand-text" href="completed_product.php?link=' . $row['p_id'] . '">Click</a>';
                        }    
                    ?></th>
                    </tr>
            <?php
            $idx ++ ; 
                }
            }
            ?>
            </table>
        </div>
    </div>   

</body>
<?php
    include("templates/footer.php") ; 
?>