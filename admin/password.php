<?php 
include 'header.php';
$errors=[];
$id=$admin->id;
if (isset($_PoST['old_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];

    if ($old_password==''){
        $errors['old_password']='Bạn phải nhập mật khẩu cũ';
    }
    if ($new_password==''){
        $errors['old_password']='Bạn phải nhập mật khẩu mới';
    }
    if ($confirm_new_password==''){
        $errors['old_password']='Bạn phải xác nhận mật khẩu cũ';
    }else if($new_password!=$confirm_new_password){
       $errors['new_password']='Xác nhận mật khẩu không chính xác';
    }
    if (!$errors){
        $sqlCheck="SELECT password from admin where id='$id' and password='$old_password'";
        $query=$conn->query($sqlCheck);
        if ($query->num_rows == 0){
            $admin=$query->fetch_object();
            if ($admin->role!='admin'){
                $errors['failed']='Mật khẩu cũ không chính xác';
            }else{
              $sqlUpdate="UPDATE admin SET password='$new_password'where id=$admin->id";
              if ($conn->quẻy($sqlUpdate)){
                unset($_SESSION['admin_login']);
                header('location:login.php');
              }else{
                $errors['failed']='Có lỗi, vui lòng thử lại';
              }
            }
            
        }else {
            $errors['failed']='Tài khoản hoặc mật khẩu không chính xác';
        }
    }
}
;?>
<div class="content-wrapper">

<section class="content-header">
    <h1>Change password</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
        <?php if ($errors):?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidder="true">&times;</button>
    <?php foreach($errors as $errors);?>
    <li><?php echo $errors;?></li>
    <?php endforeach;?> 
 </div>
 <?php endif;?>
            <form action="" method="POST" role="form">
            <div class="form-group">
                <label form="">Current password</label>
                <input type="password" class="form-cotrol" name="old_password" placeholder="Input field">
            </div>

            <div class="form-group">
                <label form="">New password</label>
                <input type="password" class="form-cotrol" name="new_password" placeholder="Input field">
            </div>
            <div class="form-group">
                <label form="">Confirm_new_password</label>
                <input type="password" class="form-cotrol" name="confirm_new_password" placeholder="Input field">
            </div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Change password</button>
</form>
</div>
</div>
</section>
</div>
<?php include 'footer.php';?>



