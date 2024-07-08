<?php include 'header.php';
$cats = $conn->query("SELECT id, name FROM category ORDER BY id ASC");
$errors = [];
$image = '';
if (!empty($_FILES['img']['name'])) {
  $image = time() . '-' . $_FILES['img']['name'];
  $tmp_name = $_FILES['img']['tmp_name'];

  move_uploaded_file($tmp_name, '../uploads/' . $image);
}
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $sale = !empty($_POST['sale']) ? $_POST['sale'] : 0;
  $category_id = $_POST['category_id'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  if ($name == '') {
    $errors['name'] = 'Tên sản phẩm không được trống';
  }

  if ($price == '') {
    $errors['price'] = 'Giá sản phẩm không được trống';
  } else if (!is_numeric($price)) {
    $errors['price'] = 'Giá sản phẩm phải là số';
  }

  if ($sale == '' && !is_numeric($sale)) {
    $errors['sale'] = 'Tỷ lệ giảm giá phải là số';
  } else if ($sale < 0 || $sale > 100) {
    $errors['sale'] = 'Tỷ lệ giảm giá phải nằm từ 0 đến 100';
  }

  if ($category_id == '') {
    $errors['category_id'] = 'Danh mục sản phẩm không được trống';
  }

  if ($image == '') {
    $errors['image'] = 'Ảnh sản phẩm không được trống';
  }

  $query = $conn->query("SELECT * FROM product WHERE name = '$name'");
  if ($query->num_rows > 0) {
    $errors['name'] = 'Tên sản phẩm đã được sử dụng';
  }
  if (!$errors) {
    $sql = "INSERT INTO product (name, price, sale, image, category_id, description, status) VALUES ('$name', '$price', '$sale', '$image', '$category_id', '$description', '$status')";

    echo $sql; // Print the SQL query

    echo "Name: $name, Price: $price, Sale: $sale, Image: $image, Category ID: $category_id, Description: $description, Status: $status"; // Print variables

    if ($conn->query($sql)) { // Execute the query
      header('location: product.php');
    } else {
      $error = "Error: " . $conn->error; // Get a specific error message
    }
  }
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Thêm sản phẩm</h1>

  </section>
  <!-- Main content -->
  <section class="content">

    <div class="box">
      <div class="box-body">
        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php foreach ($errors as $error) : ?>
              <li><?php echo $error; ?></li>
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
                    <input type="text" class="form-control" name="name" placeholder="Điền tên sản phẩm muốn thêm">
                  </div>

                  <div class="form-group">
                    <label for="">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control description" rows="8" placeholder="Nhập nội dung sản phẩm"></textarea>
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

                      <select name="category_id" class="form-control">
                        <option value="">---- Chọn một danh mục ----</option>
                        <?php while ($cat = $cats->fetch_object()) : ?>
                          <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">Giá sản phẩm</label>
                      <input type="number" class="form-control" name="price" placeholder="Điền giá sản phẩm">
                    </div>

                    <div class="form-group">
                      <label for="">Giá Khuyến Mãi</label>
                      <input type="number" class="form-control" name="sale" placeholder="Điền tỷ lệ khuyến mãi sản phẩm">
                    </div>

                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" value="1" checked=>
                          Hiển thị
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" value="0" checked=>
                          Ẩn
                        </label>
                      </div>
                    </div>
                    <div class="form-group">

                      <label for="">Ảnh sản phẩm</label>
                      <input type="file" class="form-control" id="input_img" name="img" onchange="SHOW_IMG()">
                      <img src="" width="100%" id="img">

                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
                    <a href="category.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Quay lại</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
    <!-- /.box -->
  </section>

</div>

<?php include 'footer.php'; ?>

<script>
  function SHOW_IMG() {
    let imgInput = document.getElementById("input_img")
    let img = document.getElementById("img")
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>