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
<div >
    <?php include "../includes/config.php"?>
    <form action="" method="POST" style="display: flex; justify-content: center; align-item: center; height: 50px; margin: 10px 20px" >
        <input type= "text" name="toFind" placeholder="Search here">
        <input type= "submit" name="ok" value="search">
    </form>
    <?php 
        
        if(isset($_POST["ok"])){
            $name=$_POST["toFind"];
            $sql="SELECT * FROM product where productName LIKE '%$name%' or brand LIKE '%$name%' or type LIKE '%$name%' or Category LIKE '%$name%' ORDER BY Category;";
            $rs=mysqli_query($conn,$sql);
        }
        else{
            $sql="SELECT * FROM product ORDER BY Category;";
            $rs=mysqli_query($conn,$sql);
        }
        if(mysqli_num_rows($rs)==0){
            echo '<h1>No result found</h1>';
        }
        $category="";
        while($row=mysqli_fetch_array($rs)){
            $pid=$row['id'];
            if($category!=$row['Category']){
                $category=$row['Category'];
                echo '<h1  style="display: flex; justify-content: center; align-item: center;">'.$category.'</h1>';
            }
            echo '<div class="adminView">';
            echo '<img src="'.$row['imgSrc'].'">';
            echo '<div>';
            echo '<h2>Product Name: '.$row['productName'].'</h2>';
            echo '<h2>Brand: '.$row['brand'].'</h2>';
            echo '<h2>₹'.$row['price'].'</h2>';
            echo '<h2><s>₹'.$row['originalPrice'].'</s></h2>';
            echo '<h2>Type: '.$row['type'].'</h2>';
            echo '</div>';
            echo '<form action="delItem.php" method = "GET">';
            echo '<input type="hidden" name="pid" value="'.$pid.'">';
            echo '<input type="submit" onclick="alert(\'Item deleted\')" value="Delete">';
            echo '</form>';
            echo '</div>';
        }
    ?>
</div>
