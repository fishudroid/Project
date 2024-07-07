<?php
session_start();
include 'connect.php';
if(!empty($_SESSION{'cus_login'})){
    $customer=$_SESSION['cus_login'];
    if (isset($_POST['name'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $order_note=$_POST['order_note'];
        $customer_id=$customer->id;

        $sql="INSERT INTO order(name,email,phone,address,order_note,customer_id) VALUES('$name','$email','$phone','$address','$order_note','$customer_id')";
        if ($conn->query($sql)){
            
        }
    }
}else{
    header('loction:login.php');
}
echo'<pre>';
print_r(($_POST));