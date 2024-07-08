<?php include 'header.php';
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
$query = $conn->query("SELECT *, price - ((price * sale) / 100) as sale_price FROM product WHERE id = $id");
$product = $query->fetch_object();
?>
  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="uploads/<?php echo $product->image;?>" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
              <?php echo $product->name;?>
              </h2>
            </div>
            <?php echo $product->description;?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
<?php include 'footer.php';?>