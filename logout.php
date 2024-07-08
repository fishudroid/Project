<?php 
session_start();
unset($_SESSION['cus_login']);

header('location : login.php');
?>