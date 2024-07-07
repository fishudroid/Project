<?php include 'header.php';
$errors = [];
$image = '';
$cats = $conn->query ("SELECT id, name [FROM category Order By name ASC");
if (!empty($FILE['img']['name'])) {
  $image = time().'-'.$_FILES['img']['name'];
  $tmp_image = $_FILES['img']['name'];

  move_uploaded_file($tmp_image, '../uploads/'.$image);
}
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $sale = !empty($_POST['sale']) ? $_POST['price'] : 0 ;
  $category_id = $_POST['category_id'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  if ($name == '') {
    $errors ['name'] = 'Tên sản phẩm không được trống';
  }

  if ($category_id == '') {
    $errors ['category_id'] = 'Danh mục sản phẩm không được trống';
  }

  if ($image == '') {
    $errors ['image'] = 'Ảnh sản phẩm không được trống';
  }

  if ($price == '') {
    $errors ['price'] = 'Giá sản phẩm không được trống';
  } else if (is_numeric($price)) {
    $errors ['price'] = 'Giá sản phẩm phải là số';
  }
  
  if ($sale != '' && is_numeric($sale)) {
    $errors ['sale'] = 'Giá khuyến mãi phải là số';
  } else if ($sale < 0 || $sale >100) {
    $errors ['sale'] = 'Tỷ lệ khuyến phải nằm trong khoảng 0 - 100';
  }
  $query = $conn->query("SELECT * FROM product WHERE name = '$name'");
  if ($query->num_rows > 0) {
    $error = 'Tên sản phẩm đã được sử dụng';
  }
  if (!$error) {
    $sql = "INSERT INTO product (name, price, sale, image, category_id, description, status) VALUES ('$name', '$price', '$sale', '$image', '$category_id', '$description' , '$status')";
    if ($conn->query($sql)) {
      header('location: product.php');
    } else {
      $error = 'Thêm mới không thành công, vui lòng thử lại';
    }
  }
}
?>
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Create Product</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-body">
        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php foreach($errors as $error) : ?>
              <li>Lỗi: <?php echo $error; ?></li>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-8">

              <div class="panel panel-default">
                <div class="panel-body">

                  <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                  </div>

                  <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="Description" class="form-control" rows="8" placeholder="Mô tả sản phẩm"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="">Chọn danh mục</label>

                      <name="category_id" class="form-control">
                        <option value=""></option>
                        <?php while($cat = $cats -> fetch_object()) : ?>
                          <option value=""><?php echo $cat -> id; ?></option>
                        <?php endwhile; ?>
                      </name>

                    </div>

                    <div class="form-group">
                      <label for="">Giá sản phẩm</label>
                      <input type="number" class="form-control" name="price" placeholder="Nhập giá">
                    </div>

                    <div class="form-group">
                      <label for="">Giá khuyến mãi</label>
                      <input type="number" class="form-control" name="sale" placeholder="Nhập giá khuyến mãi">
                    </div>

                    <label for="">Trạng thái</label>

                    <div class="radio">
                      <label>
                        <input type="radio" name="status" value="1" checked=>
                        Hiển thị
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="status" value="0">
                        Tạm ẩn
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="img">
                  </div>

                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
                  <a href="category.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i>Quay lại</a>
        </form>
      </div>
    </div>

</div>
</div>



</div>
</div>
<!-- /.box -->
</section>

</div>

<?php include 'footer.php'; ?>