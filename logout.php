<?php 
session_start();
unset($_SESSION['cus_login']);

header('location: login.php');
?>

<!-- //file .htacces  -->
 <!-- Thừa khoản cách chỗ location -->