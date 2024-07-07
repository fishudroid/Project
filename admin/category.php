<?php include 'header.php';
$data = $conn->query("SELECT * FROM category Order By id ASC"); 
if (!empty($_GET['search_key'])) { 
    $key = $_GET['search_key']; 
    $data = $conn->query("SELECT * FROM category WHERE name LIKE '%$key%' Order By id ASC");
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Danh Mục</h1>

    </section>
    <!-- Main content -->
    <section class="content">                           
      <div class="box">
        <div class="box-body">
            
            <form action="" method="POST" class="form-inline" role="form">
            
              <div class="form-group">
                <input type="text" class="form-control" id="key" placeholder="Nhập tên cần tìm">
              </div>
            
            
              <a href="category-edit.php?id=<?php echo $cat->id;?>" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></a>
              <a onclick="return confirm('Bạn chắc chắn xoá danh mục này không ?')" href="category-create.php?id=<?php echo $cat->id;?>" type="submit" class="btn btn-success"><i class="fa fa-plus"></i></a>
            </form>
            
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php while($cat = $data->fetch_object()) : ?>
                <tr>
                  <td><?php echo $cat->$id ?></td>
                  <td><?php echo $cat->$name ?></td>
                  <td><?php echo $cat->$status == 0 ? 'Ẩn' : 'Hiện';?></td>
                  <td class="text-right">
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i> Xoá</a>
                  </td>
                </tr>
              </tbody>
              <?php endwhile; ?>
            </table>
            
     
        </div>
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>