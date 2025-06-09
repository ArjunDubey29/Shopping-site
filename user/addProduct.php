<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['userid'])){
        if($_SESSION['userid']==111){
            header("Location:../admin/admin.php");
        }
    
}
if (!isset($_SESSION['userid'])) {
    header('Location:../index.php');
    exit();
}

?>
<?php
    include "../includes/config.php";
    $pid= $_GET['pid'];
    $uid= $_SESSION['userid'];
    $sql="INSERT INTO orders(user_id,product_id) values('$uid','$pid')";
    mysqli_query($conn,$sql);
    if(isset($_GET['BuyNow'])){
        header("Location:cart.php");
    }
    else{
        header("Location:details.php?PID=$pid");
    }
    
?>