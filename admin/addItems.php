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
<div style="display: flex;
justify-content: center; 
align-items: center">
<form action="" method="POST" enctype="multipart/form-data" class="additems">
    <input type="number" name="id" placeholder="Enter item id">
    <input type="file" name="files" placeholder="Upload product image">
    <input type="text" name="productName" placeholder="Enter product name">
    <input type="text" name="Brand" placeholder="Enter product brand">    
    <input type="text" name="Type" placeholder="Enter product type">
    <input type="text" name="Description" placeholder="Enter product description" style="width: 60%; height: 200px">
    <input type="text" name="Category" placeholder="Enter product category">
    <input type="number" name="Price" placeholder="Enter product price">
    <input type="number" name="discount" placeholder="Enter product discount">
    <input type="submit" name="ok" value="Add Product" style="background-color: green; color: white">
</form>

</div>

<?php 
    if(isset($_POST['ok'])){
        $id=$_POST['id'];
        $filename = $_FILES['files']['name'];
        $filename2 ="../img/".$filename; 
        $name=$_POST['productName'];
        $brand=$_POST['Brand'];
        $type=$_POST['Type'];
        $description=$_POST['Description'];
        $category=$_POST['Category'];
        $price=$_POST['Price'];
        $discount=$_POST['discount'];
        move_uploaded_file($_FILES['files']['tmp_name'],"../img/".$filename);
        include "../includes/config.php";
        $orgPrice=$price-($price*$discount/100);
        $sql="INSERT INTO product(id,imgSrc,productName,brand,type,price,originalPrice,description,Category,discount) values
        ('$id','$filename2','$name','$brand','$type','$price','$orgPrice','$description','$category','$discount')";
        if(!mysqli_query($conn,$sql)){
            echo '<script>alert("item not added");</script>';
        }
        else{
            echo '<script>alert("Product added");</script>';
        }

    }
?>