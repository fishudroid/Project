<?php
include 'header.php';
$new_product = $conn->query("SELECT * FROM product ORDER BY id DESC LIMIT 3");
$sale_product = $conn->query("SELECT *, price - ((price * sale) / 100) as sale_price FROM product WHERE sale > 0 ORDER BY id DESC LIMIT 3");
?>

<style>
  <?php include 'css/style.css'; ?>
</style>
<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Món mới
      </h2>
    </div>
    <div class="filters-content">
      <div class="row grid">
        <?php while ($np = $new_product->fetch_object()) : ?>
          <div class="col-sm-6 col-lg-4 all item">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="uploads/<?php echo $np->image; ?>">
                </div>
                <div class="detail-box">
                  <h5>
                    <a href="product.php?id=<?php echo $np->id; ?>"><?php echo $np->name; ?></a>
                  </h5>
                  <p>
                    <?php echo substr(strip_tags($np->description), 0, 100); ?>
                  </p>
                  <div class="options">
                    <h6>
                      <?php echo number_format($np->price); ?> vnđ
                    </h6>
                    <?php if ($customer) : ?>
                      <a href="cart-process.php?id=<?php echo $sale_product->id; ?>">
                        <i class="fa fa-shopping-cart"></i>
                      </a>
                    <?php else : ?>
                      <a href="login.php" onclick="alert('Vui lòng đăng nhập để thêm vào giỏ hàng')">
                        <i class="fa fa-shopping-cart"></i>
                      </a>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="btn-box">
        <a href="menu.php">
          View More
        </a>
      </div>
    </div>
</section>

<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Giảm giá
      </h2>
    </div>
    <div class="filters-content">
      <div class="row grid">
        <?php while ($sp = $sale_product->fetch_object()) : ?>
          <div class="col-sm-6 col-lg-4 all item">
            <span class="sale-notification">
              <?php echo $sp->sale; ?> %
            </span>
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="uploads/<?php echo $sp->image; ?>">
                </div>
                <div class="detail-box">
                  <h5>
                    <a href="product.php?id=<?php echo $sp->id; ?>"><?php echo $sp->name; ?></a>
                  </h5>
                  <p>
                    <?php echo substr(strip_tags($sp->description), 0, 100); ?>
                  </p>
                  <div class="options">
                    <h6>
                      <?php if ($sp->sale > 0) : ?>
                        <s><?php echo number_format($sp->price); ?> vnđ</s>
                        <?php echo number_format($sp->sale_price); ?> vnđ
                      <?php else : ?>
                        <?php echo number_format($sp->sale_price); ?>
                      <?php endif; ?>
                    </h6>
                    <?php if ($customer) : ?>
                      <a href="cart-process.php?id=<?php echo $np->id; ?>">
                        <i class="fa fa-shopping-cart"></i>
                      </a>
                    <?php else : ?>
                      <a href="login.php" onclick="alert('Vui lòng đăng nhập để thêm vào giỏ hàng')">
                        <i class="fa fa-shopping-cart"></i>
                      </a>
                    <?php endif; ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="btn-box">
        <a href="menu.php">
          View More
        </a>
      </div>
    </div>
</section>


<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="images/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Chúng tôi là A Tavola
            </h2>
          </div>
          <p>
          </p>
          <a href="about.php">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->
<?php include 'footer.php'; ?>