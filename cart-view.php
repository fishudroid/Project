<?php include 'header.php';
if (!$customer) {
    header('location: login.php');
}
$customer_id = $customer->id;
$sql = "SELECT c.id, c.price, c.quantity, SUM(c.price * c.quantity) as sub_total, p.name, p.image FROM cart c JOIN product p ON p.id = c.product_id WHERE c.customer = $customer_id GROUP BY c.id";
$query = $conn->query($sql);
?>

<body class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="images/hero-bg.jpg" alt="">
        </div>
    </div>
</body>
<section class="foot_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Your Shopping cart
            </h2>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product name</th>
                <th>Product Quantity</th>
                <th>Price</th>
                <th>Sub total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cart = $query->fetch_object()) : ?>
                <tr>
                    <td>
                        <img src="uploads/<?php echo $cart->image; ?>" alt="" width="40">
                    </td>
                    <td>
                        <?php echo $cart->name; ?> </td>
                    <td><?php echo $cart->quantity; ?></td>
                    <td><?php echo $cart->price; ?></td>
                    <td><?php echo $cart->sbb_total; ?></td>
                    <td>
                        <a href="cart-process.php?cart_id=<?php echo $cart->id; ?>&action=delete" class="btn btn sm btn-danger">&times;</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>



</section>
<?php include 'footer.php'; ?>