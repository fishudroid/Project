<?php
session_start();
include 'connect.php';
if(!empty($_SESSION{'cus_login'})){
    $customer=$_SESSION['cus_login'];
    $customer_id=$customer->id;
    $sql1="SELECT price,quantity,product_id, FROM cart WHERE c.customer_id=$customer_id";
    $query=$conn->query($sql1);
    if (isset($_POST['name'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $order_note=$_POST['order_note'];
    
         if ($query->num_rows){
         $sql="INSERT INTO orders(name,email,phone,address,order_note,customer_id) VALUES('$name','$email','$phone','$address','$order_note','$customer_id')";
        if ($conn->query($sql)){
            $order_id=$conn->insert_id;
            
            while ($cart=$query->fetch_object()){
                $product_id=$cart->produc_id;
                $quantity=$cart->quantity;
                $price=$cart->price;

             $sqlDetail="INSERT INTO order_detail(order_id,product_id,price,quantity) VALUES ('$order_id','$product_id','$price','$quantity')";
             $conn->query($sqlDetail);   
          }
          header ('location: checkout-sccess.php');
     }
     header('loction:checkout-error.php');
  }else{
    header('loction:checkout.php');
  }
}
        
}else{
    header('loction:login.php');
}
echo'<pre>';
print_r(($_POST));