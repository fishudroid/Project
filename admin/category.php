<?php include 'header.php';
$data = $conn -> query("SELECT * FROM category Order By id DESC");
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
            
            <form action="" method="POST" class="form-inline" role="form">
            
                <div class="form-group">
                    <input type="email" class="form-control" id="" placeholder="Input field">
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
                <td><?php echo $cat ->status ; ?></td>
                <td class="text-right">
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa fa-edit"></i> Edit</a>
                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa fa-trash"></i> Del</a>
                </td>
       <?php endwhile;?>
     </table>
     
        </div>
      </div>
      <!-- /.box -->
    </section>

  </div>

  <?php include 'footer.php';?>