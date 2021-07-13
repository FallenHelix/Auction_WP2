<?php
    session_start(); 
    include("templates/db.php"); 
    include("templates/header.php"); 
    

$user_id = $_SESSION['user_id']; 

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

<body>
<div class="container">
		<div class="row">
<?php
    // $sql = "SELECt * from bids LEFT OUTER JOIN   users on u_id = id where p_id = 66 " ;
    $sql = "SELECT * from products WHERE user_id = ? and completed = 1" ; 

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

        $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        
?>

<div class="col s6 md3">
    <div class="card z-depth-1">

        <div class="card-content left">
            
            <div class="col"><img src=<?php echo htmlspecialchars($row['product_pic']) ; ?> height="100"  width="   100"></div>
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
        <div class="card-action">
            <?php  echo '<a class="brand-text" style="padding-left:375px" href="completed_product.php?link=' . $row['id'] . '">More Info</a>'; ?>
        </div>
    </div>
</div>

<?php
    }} 
?>
        </div>
</div>
</body>
<?php
    include("templates/footer.php") ; 
?>