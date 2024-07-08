<?php
include 'header.php';
if (!$customer){
    header('location:login.php');
}
$customer_id=$customer->id;
$sql="SELECT o.*,SUM(od.quantity)as quantity,SUM(od.price*od.quantity) as total FROM oders o JOIN order_detail od ON od.order_id=o.id WHERE od.customer=$customer_id ORDER BY id DESC";
$query =$conn->query($sql);
?>
<section class="food_section layout_padding">
<div class = "container">
    <div class ="heading_container heading_center">
        <h2>Your Order detail</h2>
</div>
<div class="main-order">
    
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày Đặt</th>
            <th>Họ Tên</th>
            <th>Số ĐT</th>
            <th>Tổng SL</th>
            <th>Tổng TIền</th>
            <th></th>
        </tr>
</thead>
<tbody>
    <?php $total = 1; while($od = $query->fetch_object()) :?>
    <tr>
        <td>
           <?php echo $n;?>
</td>
<td><?php echo $n;?></td>
<td><?php echo $od->order_date;?></td>
<td><?php echo $od->name;?></td>
<td><?php echo $od->phone;?></td>
<td><?php echo $od->quantity;?></td>
<td><?php echo number_format($od->total);?>vnđ</td>
        </form>
</td>
<td><?php echo $od->price;?></td>
<td><?php echo $od->sub_total;?></td>
<td>
    <a herf="cart_process.php?cart_id=<?php echo $od->id;?>&action=delete" class="btn btn-sm btn-danger">Chi Tiết</a>
</td>
</tr>
<?php 
    $n++; 
    endwhile;
?>
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

