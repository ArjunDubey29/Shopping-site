<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userid'])) {
    header('Location:../index.php');
    exit();
}

include "../includes/config.php";


if (isset($_GET['oid']) && is_numeric($_GET['oid'])) {
    $oid = intval($_GET['oid']); 

    $uid = $_SESSION['userid'];
    $sql = "DELETE FROM orders WHERE order_id = $oid AND user_id = $uid LIMIT 1";
    mysqli_query($conn, $sql);
}

header("Location:cart.php");
exit();
?>
