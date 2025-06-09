<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userid'])) {
    if ($_SESSION['userid'] == 111) {
        header("Location:../admin/admin.php");
    }
}
if (!isset($_SESSION['userid'])) {
    header('Location:../index.php');
    exit();
}
?>


<?php 
include "../includes/header.html";
include "../includes/config.php";
$uid = $_SESSION['userid'];
?>

<div class="cart">
    <?php
    $sql = "SELECT * FROM orders WHERE user_id='$uid'";
    $rs = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($rs) == 0) {
        echo '<h1>Nothing added to cart</h1>';
    } else {
        echo '<div>';
        echo '<h1 style="text-align: center">Your cart</h1>';
        
        while ($row = mysqli_fetch_array($rs)) {
            $pid = $row['product_id'];
            $oid = $row['order_id'];

            $sql2 = "SELECT * FROM product WHERE id='$pid'";
            $rs2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($rs2);

            echo '<div class="cartCard">';
            echo '<img src="'.$row2['imgSrc'].'">';
            echo '<div>';
            echo '<h1>'.$row2['productName'].'</h1>';
            echo '<h1>'.$row2['brand'].'</h1>';
            echo '<h2> ₹'.$row2['price'].'</h2>';
            echo '<h2><s> ₹'.$row2['originalPrice'].'</s></h2>';
            echo '<h1>'.$row2['type'].'</h1>';
            echo '</div>';

            echo '<form action="delete.php" method="GET">';
            echo '<input type="hidden" name="oid" value="'.$oid.'">';
            echo '<input type="submit" style="
                    height: 50px;
                    margin: 60px 10px;
                    width: 100px;
                    color: white;
                    font-weight: bolder;
                    font-size: large;
                    background-color: rgb(165, 8, 8);
                    border: none;" value="Delete">';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>';

        echo '<div style="
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5px;
            background-color: white;
            margin: 0;
            height:100vh;
            ">';

        $sql3 = "SELECT 
                    SUM(p.originalPrice) AS total_price, 
                    SUM(p.price) AS total 
                 FROM orders o 
                 JOIN product p ON o.product_id = p.id 
                 WHERE o.user_id = '$uid'";
    
        $rs3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($rs3);

        $total_price = $row3['total_price'] ?? 0;
        $total = $row3['total'] ?? 0;

        echo "<h1>Your total is: ₹$total_price</h1>";
        echo "<h1>After discount: ₹$total</h1>";
        
        echo '<button style="
            height: 80px;
            width: 160px;
            background-color: green;
            color: white;
            font-size: larger;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;">Checkout</button>';
        echo '</div>';
    }
    ?>
</div>
