<?php include 'header.php';
$data = $conn -> query("SELECT * FROM category Order By id DESC");
if(!empty($_GET['search_key'])){
  $key =$_GET['search_key'];
  $data = $conn ->query("SELECT * FROM category WHERE name LIKE '%$key%' Oder By id DESC")
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Category</h1>

    </section>
    <!-- Main content -->
    <section class="content">                           
      <div class="box">
        <div class="box-body">
            
            <form action="" method="GET" class="form-inline" >
            
                <div class="form-group">
                    <input class="form-control" name="search_key" placeholder="Input field">
                </div>
            
                
              
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                <a href="category-create.php" class="btn btn-success"><i class="fa fa-plus"></i>Thêm mới</a>
            </form>
            

     
     <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while($cat = $data ->fetch_object()) :?>
            <tr>
                <td><?php echo $cat ->id ; ?></td>
                <td><?php echo $cat ->name ; ?></td>
                <td><?php echo $cat ->status == 0 ? 'Tạm ẩn' : 'Hiển thị' ; ?></td>
                <td class="text-right">
                    <a href="category-edit.php?id=<?php echo $cat ->id ;?>" class="btn btn-sm btn-primary"><i class="fa fa fa-edit"></i> Edit</a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa không')" href="category-delete.php?id="<?php echo $cat ->id; ?>><i class="fa fa fa-trash"></i>Del</a>
                </td>
       <?php endwhile;?>
     </table>
     
        </div>
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>