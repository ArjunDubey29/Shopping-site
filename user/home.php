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


<?php include "../includes/header.html";
    include "../includes/config.php";
?>
<div class= container>
    <?php 
        if(isset($_POST['search'])){
            $name=$_POST['search'];
            $sql="SELECT * FROM product where productName LIKE '%$name%' or brand LIKE '%$name%' or type LIKE '%$name%' or Category LIKE '%$name%';";
            $rs=mysqli_query($conn,$sql);
        }
        else{
            $sql="SELECT * FROM product;";
            $rs=mysqli_query($conn,$sql);
        }
            
        while($row=mysqli_fetch_array($rs)){
            echo '<form action="details.php" class="card" method="GET">';
            echo '<input type="hidden" name="PID" value="'.$row['id'].'">';
            echo '<button type="submit">';
            echo '<img src="'.$row['imgSrc'].'">';
            echo '<div class="details">';
            echo '<h2>'.$row['brand'].'</h2>';
            echo '<h2>'.$row['productName'].'</h2>';
            echo '<p style="font-weight: bold;">'.$row['price'].'</p>';
            echo '<p>'.$row['type'].'</p>';
            echo '</div>';
            echo '</button>';
            echo "</form>";
        }
       
    ?>
</div>
