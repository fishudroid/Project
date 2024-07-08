<?php include 'header.php';
$id = !empty($_GET ['id']) ? (int)$_GET['id'] : 0;
$error = '';
if($id){
  if($conn -> query("DELETE FROM product WHERE id = $id")){  
    header('location: product.php');
    
  }else{
    $error = 'Xóa sản phẩm thất bại !';
  } 
} else {
  $error = 'Bạn chưa chọn sản phẩm để xóa';
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Xoá sản phẩm</h1>

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
           <a href="product.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Quay lại</a>
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>