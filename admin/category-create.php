<?php include 'header.php';
$error = '';
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $status = $_POST['status'];

  if ($name == '') {
    $error = 'Tên danh mục không được trống';
  }
  $query = $conn->query("SELECT * FROM category WHERE name = '$name'");
  if ($query->num_rows > 0) {
    $error = 'Tên danh mục đã được sử dụng';
  }
  if (!$error) {
    $sql = "INSERT INTO category (name, status) VALUES ('$name', '$status')";
    if ($conn->query($sql)) {
      header('location: category.php');
    } else {
      $error = 'Thêm mới không thành công, vui lòng thử lại';
    }
  }
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Thêm danh mục</h1>

  </section>
  <!-- Main content -->
  <section class="content">

    <div class="box">
      <div class="box-body">
        <?php if ($error) : ?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Lỗi !!</strong> <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <form action="" method="POST" role="form">
          <div class="row">
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group">
                    <label for="">Tên danh mục</label>
                    <input type="text" class="form-control" name="name" placeholder="Điền tên danh mục muốn tạo">
                  </div>

                  <div class="form-group">
                    <label for="">Tên danh mục</label>

                    <div class="radio">
                      <label>
                        <input type="radio" name="status" value="1" checked=>
                        Hiển thị
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="status" value="0" checked=>
                        Tạm ẩn
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
                  <a href="category.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i>Quay lại</a>
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