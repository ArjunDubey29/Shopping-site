<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['userid'])){
        if($_SESSION['userid']==111){
            
        }
        else{
            header("Location:home.php");
        }
    
}
if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
    exit();
}
?>
<?php include "../includes/config.php"?>
<?php 

    $pid=$_GET['pid'];
    $sql="DELETE FROM product WHERE id='$pid'";
    $rs=mysqli_query($conn,$sql);
    header("Location:viewItems.php?")
?>