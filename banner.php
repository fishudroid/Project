<?php
$product = $conn->query("SELECT * FROM product ORDER BY id DESC LIMIT 3"); 
?>
<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container ">
                    <div class="row">
                        <?php while ($np = $product->fetch_object()) : ?>
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>
                                <?php echo $np->name; ?>
                                </h1>
                                <p>
                                    <?php echo $np->description; ?>
                                </p>
                            </div>
                        </div>
                        <?php endwhile;?>
                    </div>
                </div>
            </div>
    </div>

</section>