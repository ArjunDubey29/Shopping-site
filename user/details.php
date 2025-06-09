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

<body style="height=100vh">

<?php include "../includes/header.html";
    include "../includes/config.php";
    $pid = $_GET['PID'];
    $sql="Select * from product where id='$pid'";
    $rs=mysqli_query($conn,$sql);
    
    $row=mysqli_fetch_array($rs);
    $brand=$row['brand'];
    $name=$row['productName'];
    $type=$row['type'];
    $price=$row['price'];
    $orgPrice=$row['originalPrice'];
    $description=$row['description'];

?>
<div class="allDetails">
    <div class="image">
        <img src="<?php echo $row['imgSrc']; ?>" id="imgg">
        <div style="display: flex; height:100%">
            <form action="addProduct.php" method="GET" class="addToCart" style="width:50%">
                <input type="hidden" name="pid"  value="<?php echo $pid ?>">
                <input type="submit" style="width:100%; height:40px" name ="addtocart" value="Add to cart">
            </form> 
            <form action="addProduct.php" method="GET" class="buyNow" style="width:50%">
                <input type="hidden" name="pid"  value="<?php echo $pid ?>">
                <input type="submit" style="width:100%; height:40px" name="BuyNow" value="Buy Now">
            </form> 
        </div>
    </div>

    <div class="Description">
        <h1 id="brandName">Brand: <?php echo $brand; ?></h1>
        <h1 style="font-size: 40px" id="ProductName">Name: <?php echo $name; ?></h1>
        <h1 id="type">Type: <?php echo $type; ?></h1>
        <h1 id="Price">Price: <?php echo $price; ?></h1>
        <h2 id="OriginalPrice">Original Price: <?php echo $orgPrice; ?></h2>
        <h2 id="ProductDescription">Description:<br><?php echo $description; ?></h2>
    </div>
</div>
</body>