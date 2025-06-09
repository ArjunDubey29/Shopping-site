<?php
// Define database credentials as constants
define('DB_SERVER', 'sql113.infinityfree.com');
define('DB_USERNAME', 'if0_39188404');
define('DB_PASSWORD', 'a7qMSIKmnTCWH');  // Replace with your actual vPanel password
define('DB_NAME', 'if0_39188404_user_cred');

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
