<?php include 'header.php';
$data = $conn->query("SELECT product.*, category.name as cat_name FROM product JOIN category ON category.id = product.category_id Order By id DESC");
$cats = $conn->query("SELECT id, name FROM category ORDER BY id ASC");

$key = isset($_GET['search_key']) ? $_GET['search_key'] : '';
$cat = isset($_GET['cat']) ? $_GET['cat'] : '';

if (!empty($key) && empty($cat)) { 
    $key = $_GET['search_key']; 
    $data = $conn->query("SELECT product.*, category.name as cat_name FROM product JOIN category ON category.id = product.category_id WHERE product.name LIKE '%$key%' Order By product.id DESC");
} else if (empty($key) && !empty($cat)) {  
  $key = $_GET['search_key']; 
  $data = $conn->query("SELECT product.*, category.name as cat_name FROM product JOIN category ON category.id = product.category_id WHERE product.category_id = $cat Order By product.id DESC");
} else if (!empty($key) && !empty($cat)) { 
  $key = $_GET['search_key']; 
  $data = $conn->query("SELECT product.*, category.name as cat_name FROM product JOIN category ON category.id = product.category_id WHERE product.name LIKE '%$key%' AND product.name LIKE '%$key%' Order By product.id DESC");
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product</h1>

    </section>
    <!-- Main content -->
    <section class="content">                           
      <div class="box">
        <div class="box-body">
            
            <form action="" method="GET" class="form-inline" role="form">
            
                <div class="form-group">
                    <input class="form-control" name="search-key" placeholder="Input field">
                </div>

                <div class="form-group">
                    
                    <select name="cat" class="form-control">
                      <option value="">Danh mục</option>
                      <?php while($cat = $cats->fetch_object()) : ?>
                          <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                        <?php endwhile;?>
                    </select>
                    
                </div>
            
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                <a href="product-create.php" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
            </form>
            

     
     <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Giá / Sale</th>
                <th>Trạng thái</th>
                <th>Ảnh</th>
            </tr>
        </thead>
        <tbody>
            <?php while($cat = $data ->fetch_object()) :?>
            <tr>
                <td><?php echo $cat ->id ; ?></td>
                <td><?php echo $cat ->name ; ?></td>
                <td><?php echo $cat ->description ?></td>
                <td><?php echo $cat ->cat_name; ?></td>
                <td>
                  <?php echo $cat ->price ; ?>
                  
                  <span class="badge"> <?php echo $cat ->sale; ?> %</span>
                  
                </td>
                <td><?php echo $cat ->status == 0 ? 'Tạm ẩn' : 'Hiển thị' ; ?></td>
                <td>
                  
                  <img src="../uploads/<?php echo $cat->image;?>" width="40">
                  
                </td>
                <td class="text-right">
                    <a href="product-edit.php?id=<?php echo $cat ->id ;?>" class="btn btn-sm btn-primary"><i class="fa fa fa-edit"></i> Edit</a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa không')"  href="product-delete.php?id=<?php echo $cat ->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Xoá</a>
                </td>
       <?php endwhile;?>
     </table>
     
        </div>
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>