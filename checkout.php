<?php
include 'header.php';
if (!$customer){
    header('location:login.php');
    
}
$customer_id=$customer->id;
$sql="SELECT c.idc.price,c.quantity,c.product_id, SUM(c.price*c.quantity) as sub_total,p.name,p.image FROM cart JOIN product p ON p.id=c.product_id WHERE c.customer_id=$customer_id GROUP BY c.id";
$query=$conn->query($sql);
}
?>
<section class="food_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form action=""method="checkout-proccess.php" role="form">
                    <div class="heading_container heading_center">
                    <legend>Checkout form</legend>
                    <div class="form-group">
                        <label for="">Họ Tên</label>
                        <input type="text" class="form-control" value=""<?php echo $customer->name;?> placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Số ĐT</label>
                        <input type="text" class="form-control" value=""<?php echo $customer->phone;?> placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value=""<?php echo $customer->email;?> placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" value=""<?php echo $customer->address;?> placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú đơn hàng</label>
                        <textarea name="order_note" class="form-control" placeholder="Ghi chú yêu cầu"></textarea>
                    </div>
                    <bytton type="submit"class="btn btn-success">Place Order</buttton>
                     </form>
                     </div>
                     <div class="col-md-8">
                <form action=""method="POST" role="form">
                <div class="heading_container heading_center">
                    <legend>Shopping cart</legend>
                        <table class="table table-hover">
    <thead>
        <tr>
            <th>Image</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Sub total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0;
        <?php while($cart = $query -> fetch_object()) : ?>
        <tr>
            <td>
                <img src="uploads/<?php echo $cart -> image;?>" alt="" width="40">
            </td>
            <td><?php echo $cart->name;?></td>
            <td>
                <form action="cart-process.php" method="get">
                <input type="hidder" name="cart_id" value="<?php echo $cart->id;?>"?/>
                <input type="hidden" name="action" value="update"/>
                <input type="number" name="quantity" style="width:80px;text-align:center; forn-weigh:bold" value ="<?php echo $cart->quantity;?>"/>
                <button>Update</button>
            <td><?php echo $cart -> price ;?></td>
            <td><?php echo $cart -> sbb_total ;?></td>
            <td>
                <a href="cart-process.php?cart_id=<?php echo $cart -> id; ?>&action=delete" class="btn btn sm btn-danger">&times;</a>
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
<div class="text-center">
    <div class="cart-total">
        <h2>Total:<?php echo number_format(($total));?> vnđ</h2>
        </div>
        <br>
        <a herf="index.php" class="btn btn-success">Contine Shopping</a>
        </div>
        </div>
        </div>
</div>
</section>
  <?php include 'footer.php';?>









