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
    
    $errors = array('amount' => '') ; 
    if(isset($_POST['submit'])){
        $userId = $_SESSION['user_id'] ;
        $bidId = $_SESSION['bid_id'] ; 
        if(empty($_POST['amount'])){
            $errors['amount'] = "Enter Amount" ;
        } else {
            $amount = $_POST['amount'] ; 
            $sql1 = "SELECT base_amount from products where id = ?"; 
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql1)) {
                header("Location: login.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $bidId);
                if(!mysqli_stmt_execute($stmt)){
                    echo mysqli_stmt_error($stmt);
                    exit() ;  
                }
                $result1 = mysqli_stmt_get_result($stmt);
                while ($row1= mysqli_fetch_row($result1)) {
                    if($amount < $row1[0]){
                        $errors['amount'] = "Amount must be greater than or equal to the minimum value" ; 
                    }
                }
            }
            $sql2 = "SELECT MAX(amount) as amount from bids where p_id = ?"; 
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql2)) {
                header("Location: login.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $bidId);
                if(!mysqli_stmt_execute($stmt)){
                    echo mysqli_stmt_error($stmt);
                    exit() ;  
                }
                $result2 = mysqli_stmt_get_result($stmt);
                while ($row2= mysqli_fetch_row($result2)) {
                    if($amount <= $row2[0]){
                        $errors['amount'] = "Amount must be greater than the highest bid" ; 
                    }
                }
            }
        }

        if (!array_filter($errors)) {
            $sql = "INSERT INTO bids (u_id , p_id , amount, name, email) VALUES (?, ?, ?, ?, ?) " ;  
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: add_new.php?error=sqlerror1");
                exit();
            } else{
            mysqli_stmt_bind_param($stmt, "sssss", $userId, $bidId, $amount, $_SESSION['name'],  $_SESSION['email']);
                if(!mysqli_stmt_execute($stmt)){
                    echo "<h1>".mysqli_stmt_error($stmt) ; 
                    exit() ; 
                }else {
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Your bid has been submitted");'; 
                    echo 'window.location.href = "home.php";';
                    echo '</script>';
                    //header('Location: home.php');
                }
            }
            mysqli_stmt_close($stmt) ; 
        } 
    } // end POST check
?>

<section class="row container grey-text center">

<div class="col s6 m4" style="margin-right:175px">
        <h4 class="center">Product Detail</h4>
        <form class="white" action=<?php  echo 'product.php?link=' . $_GET['link']; ?> method="POST" enctype="multipart/form-data">
            <div class="white" id="item-image">    
                <div class><img src=<?php echo htmlspecialchars($row['product_pic']) ; ?> height="200"  width="200"></div>
                <p style="font-size:25px;"><?php echo htmlspecialchars($row['title']);  ?></p>
                <p>Category : <?php echo htmlspecialchars($row['category']);  ?></p>
                <p>Description : <?php echo htmlspecialchars($row['description']);  ?></p>
                <p>Minimum value : Rs <?php echo htmlspecialchars($row['base_amount']);  ?></p>
                <p>End Date : <?php echo htmlspecialchars($row['end_date']);  ?></p>
                <br>
                <label>Enter value</label>
                <input type="number" name="amount">
                <div class="red-text"><?php echo $errors['amount']; ?></div>
                <br>
                <div class="center">
                    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                </div>
            </div>
        </form>
    </div>

    <div class="col s6">
        <h3>Bids for this Product</h3>
        <?php
        //$bid_sql = "SELECT * FROM bids WHERE p_id = ? ORDER BY amount DESC LIMIT 5";
        $bid_sql = "SELECT name, MAX(amount) as amount FROM bids WHERE p_id = ? GROUP BY name ORDER BY amount DESC LIMIT 5";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $bid_sql)) {
            header("Location: login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $item_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $idx = 1 ; 
            ?>
            <div class="white">
            <table style="width:100%">
            <tr>
            <th>Index</th>
            <th>Name</th>
            <th>Amount</th>
            <?php
            while ($row2 = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        ?>
                <tr>
                <th><?php echo $idx;?></th>
                <th><?php echo htmlspecialchars($row2['name']);?></th>
                <th><?php echo htmlspecialchars($row2['amount']);?></th>
                </tr>

        <?php
        $idx ++ ; 
            }
        }
        ?>
        </table>
        </div>
    </div>

</section>


<!-- <?php include('templates/footer.php'); ?> -->

</html>