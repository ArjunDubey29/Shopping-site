<?php 
    session_start();
    if(isset($_SESSION['userid'])){
        if($_SESSION['userid']==111){
            header("Location:adimin/admin.php");
        }
        else{
            header("Location:user/home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body  style="display: flex; flex-direction: column; height: 100%; justify-content: space-between; align-items: center;">
    <div style="width:100%;
    height: 100px;
    background-color: #44444C;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;"><h1>whyShop.com</h1></div>
    <div class="login" >
        <h1>Login</h1>

        <form action="index.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" style="background-color: blue; color: white; font-size: larger; font-weight: bold;
            border: none; cursor: pointer; box-shadow: 0 0 10px rgba(0,0,0,,0.8); padding: 0;
            "name="ok" value="Login">
        </form>
        
        <?php
            if(isset($_POST['ok'])){
                
                $email=$_POST['email'];
                $pass=$_POST['password'];
                $sql="SELECT * FROM user_login WHERE emailId='$email'";
                
                include "includes/config.php";
                
                $rs = mysqli_query($conn, $sql);

                if (!$rs) {
                    die("Query failed: " . mysqli_error($conn));
                }

               
                if(mysqli_num_rows($rs)>0){
                    while($row=mysqli_fetch_array($rs)){
                        if($row['password']==$pass){
                            $_SESSION['userid']=$row['ID'];
                            header("Location:user/home.php");
                        }
                        else {
                            echo 'Wrong pass';
                            echo '<script>alert("Wrong Password")</script>';
                        }
                    }
                }
                else{
                    echo 'id';
                    echo '<script>alert("Wrong Username")</script>';
                }
            }

        ?>
        <a href="registration.php">Dont have an account. <br>Click here to Register</a>
    </div>
</body>
</html>