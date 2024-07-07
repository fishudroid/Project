<?php include 'header.php';
$id = !empty($_GET ['id']) ? (int)$_GET['id'] : 0;
$error = '';
if($id){
  $query = $conn->query("SELECT * FROM product WHERE category_id = $id");
  if ($query->num_rows > 0){
    $error = 'Danh mục này đang có sản phẩm. Không thể thao tác tác vụ này.';
  } else {
    if($conn -> query("DELETE FROM category WHERE id = $id")){  
      header('location: category.php');
    }else{
      $error = 'Xóa thất bại !';
    }
  } 
} else {
  $error = 'Bạn chưa chọn danh mục để xóa';
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Xoá danh mục</h1>

    </section>
    <!-- Main content -->
    <section class="content">                           
     
      <div class="box">
        <div class="box-body">
        <?php if($error): ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Lỗi !!</strong> <?php echo $error; ?>
            </div>
           <?php endif; ?> 
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>