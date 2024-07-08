<?php
include 'header.php';
if (!$customer){
    header('location:login.php');
}
$customer_id = $customer -> id;
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT od.price ,od.quantity, SUM(od.price*od.quantity) as total,p.name FROM oders_detail od JOIN produc p ON p.id=od.product_id WHERE od.order_id=$id GROUP BY p.id";
$query =$conn->query($sql);
?>
<section class="food_section layout_padding">
<div class = "container">
    <div class ="heading_container heading_center">
        <h2>Your Order detail</h2>
</div>
<div class="main-order">
    <div class ="od-header"></div> 
</div>
    <div class ="od-number"></div>
    <div class ="od-customer"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn Giá</th>
            <th>Tổng Tiền</th>
        </tr>
</thead>
<tbody>
    <?php $total = 1; while ($cart=$query->fetch_object()) :?>
    <tr>
        <td>
           <?php echo $n;?>
</td>
<td><?php echo $n;?></td>
<td><?php echo $od->name;?></td>
<td><?php echo $od->quantity;?></td>
<td><?php echo number_format($od->price);?>vnđ</td>
<td><?php echo number_format($od->total);?>vnđ</td>
</tr>
<?php $n++; endwhile;?>
</tbody>
</table>
<div class="text-center">
    <div class="cart-total">
        <h2>Total: <?php echo number_format(($total));?>VND</h2>
</div>
<br>
<a herf="index.php" class="btn btn-success">Continue Shopping</a>
<a herf="checkout.php" class="btn btn-success">Checkout Process</a>
</div>


</div>
</section>

<?php include 'footer.php';?>
