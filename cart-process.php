<?php 

include 'header.php';
if($customer) {
    $customer_id =$customer -> id;
    $produc_id = !empty($_GET['id']) ? (int) $_GET['id'] : 0;
    $quatity = !empty($_GET['quatity']) ? (int) $_GET['quatity'] : 1;
    $action = !empty($_GET['action']) ? $_GET['action'] : 'add';

if($action == 'add'){
    $checkE = checkExists($produc_id, $customer_id);
    if($checkE){
        $qtt = $check ->quantity;
        $newQtt = $qtt+1;
        $sqlCheck = "UPDATE cart SET quantity = $newQtt  WHERE id = $checkE ->id";
    }else{
        $sqlCheck = "SELECT price FROM product WHERE id = $product_id";
        $query = $conn ->query($sqlCheck);
        if($query -> num_rows > 0){
            $product = $query -> fretch_object();
            $price = $product -> $price;
        
             $sqlInsert = "INSERT INTO cart(customer_id, product_id, quatity, price) 
             VALUES($customer_id, $product_id, $quatity, $price)";
        $conm -> query($sqlInsert);
        header('location: cart-view.php' );

    }
    
    header('location: index.php' );

    
}
if($action == 'delete'){
    $cart_id = !empty($_GET['cart_id']) ? (int) $_GET['cart_id'] : 0;
    $conn ->query("DELETE FROM cart WHERE id =$cart_id");
    header('location: cart-view.php' );

}



}else{
    header('location: login.php' );
}
//echo '<pre>';
//echo $action;
//print_r(($_GET));

function checkExists($product_id,$customer_id){
    global $conn;
<<<<<<< HEAD
    $sqlCheckE ="SELECT id, quantity FROM cart WHERE product_id = $id AND customer_id =
     $customer_id";
     $queryE =$conn ->query($sqlCheckE);
=======
    $sqlCheckE ="SELECT id, quantity FROM cart WHERE product_id = $product_id AND customer_id = $customer_id"; 
    $queryE =$conn ->query($sqlCheckE);
>>>>>>> 5c1287712fbb9533390ccccac43b9f6f2342fe02

     if($queryE ->num_rows > 0){
        return $queryE ->fetch_object() ;
     }
     return false;
<<<<<<< HEAD
=======
    }
>>>>>>> 5c1287712fbb9533390ccccac43b9f6f2342fe02
}