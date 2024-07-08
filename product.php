<?php include 'header.php';
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$query = $conn->query("SELECT *, price - ((price * sale) / 100) as sale_price FROM product WHERE id = $id");
$product = $query->fetch_object();
?>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
  </div>
</body>
<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="uploads/<?php echo $product->image; ?>" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              <?php echo $product->name; ?>
            </h2>
          </div>
          <p>
            <?php echo $product->description; ?>
          </p>
          <?php if ($customer) : ?>
            <form actions="" method="POST" class="form-inline" roles="" form>
              <div class="forn-group">
                <input type="number" class="form-control" id=""  placeholder="Số lượng">
              </div>

              <button type="submit" class="btn btn-success ml-1"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
        </div>
        </form>
      <?php else : ?>
        <a href="login.php" onclick="alert('Vui lòng đăng nhập để thêm vào giỏ hàng')">
          <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
        </a>
      <?php endif; ?>
      </div>
    </div>
  </div>
  </div>
</section>

<!-- end about section -->
<?php include 'footer.php'; ?>