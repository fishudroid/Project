<?php 
echo '<pre>';
include 'header.php';
if($customer) {
    $customer_id =$customer -> id;
    $produc_id = !empty($_GET['id']) ? (int) $_GET['id'] : 0;
    $quatity = !empty($_GET['quatity']) ? (int) $_GET['quatity'] : 1;

$sqlCheck = "SELECT price FROM product WHERE id = $product_id";
$query = $conn ->query($sqlCheck);
if($query -> num_rows > 0){
    $product = $query -> fretch_object();
    $price = $product -> $price;

     $sqlInsert = "INSERT INTO cart(customer_id, product_id, quatity, price) 
     VALUES($customer_id, $product_id, $quatity, $price)";
$conm -> query($sqlInsert);
header('location: cart-view.php' );
}else{
    header('location: index.php' );
}
    
}else{
    header('location: login.php' );
}

print_r(($_GET));