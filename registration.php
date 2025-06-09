<?php 
    if(!session_start()){
        session_start();
    }

    if(isset($_SESSION['userid'])){
        if($_SESSION['userid'] == 111){
            header('Location: admin.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass1 = $_POST['pass1'] ?? '';
        $pass2 = $_POST['pass2'] ?? '';

        if ($pass1 !== $pass2) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            echo "<script>alert('Registration successful!');</script>";
        }
    }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!DOCTYPE html>
<html>
<head>
    <link href="css/style.css" rel="stylesheet">
    <title>Register - whyShop.com</title>
</head>
<body style=" margin: 0; display: flex; flex-direction: column; height: 100%; justify-content: space-between; align-items: center;">
    <div style="width: 100%; height: 100px; background-color: #44444C; display: flex; justify-content: center; align-items: center; color: white;">
        <h1>whyShop.com</h1>
    </div>
    <form action="" method="POST" class="register" style="display: flex; flex-direction: column; gap: 10px; margin-top: 20px;">
        <h1>Register Here</h1>
        <input name="name" type="text" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="text" name="pass1" placeholder="Create a password" required>
        <input type="password" name="pass2" placeholder="Confirm password" required>
        <button type="submit">Submit</button>
        <a href="index.php" style="text-align: center;">Already have a account.<br>Click here to login.</a>
    </form>
    
</body>
</html>
<?php 
include "includes/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass1 = $_POST['pass1'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';

    if ($pass1 !== $pass2) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $email = mysqli_real_escape_string($conn, $email);
        $pass = mysqli_real_escape_string($conn, $pass1);

        $checkEmail = "SELECT * FROM user_login WHERE emailID = '$email'";
        $result = mysqli_query($conn, $checkEmail);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            $insert = "INSERT INTO user_login (emailID, password) VALUES ('$email', '$pass')";
            if (mysqli_query($conn, $insert)) {
                echo "<script>alert('Registration successful!');</script>";
                header("Location:index.php");
            } else {
                echo "<script>alert('Error: Could not register');</script>";
            }
        }
    }
}
?>