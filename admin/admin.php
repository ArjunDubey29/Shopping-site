<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['userid'])){
        if($_SESSION['userid']==111){
            
        }
        else{
            header("Location:../user/home.php");
        }
    
}
if (!isset($_SESSION['userid'])) {
    header('Location:../login.php');
    exit();
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/style.css">
<div class="adminHeader">
    <div class="menu">
        <i class="fa fa-bars" style="font-size:48px"></i> 
        <div>
            <a href="admin.php"><h1>Home</h1></a>
            <a href="addItems.php"><h1>Add items</h1></a>
            <a href="viewItems.php"><h1>View items</h1></a>
            
        </div>
    </div>
    <div></div>
    <a href="admin.php" style="text-decoration: none; color: white; font-size: larger "><h1>whyShop.com</h1></a>
    <div></div>
    <a style="padding-rigth: 10px; text-decoration: none; color: white; margin: 20px" href="logout.php">logout</a>
</div>
<h1 style="text-align: center">Welcome admin</h1>
