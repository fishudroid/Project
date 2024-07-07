<?php 
session_start();
include'../connect.php';
$errors =[];
if (isset($_POST['email'])){
    $email =$_POST['email'];
    $password =$_POST['password'];
    
    if ($email==''){
        $errors['email']='Email không được để trống';
    }else if (!filter_var($email,Filter_Validate_Email)){
        $errors['email']='Email không đúng định dạng';
    
    }
    if ($password ==''){
        $errors['email']='Mật khẩu không được để trống';
    }
    if (!$errors){
        $sqlCheck="SELECT id, name , email from admin where email='$email' and password='$password'";
        $query=$conn->query($sqlCheck);
        if ($query->num_rows==1){
            $admin=$query->fetch_object();
            if ($admin->role!='admin'){
                $errors['failed']='Tài khoản của bạn không có quyền đăng nhập vào trang quản trị';
            }else{
              $_session['admin_login']=$admin;
              header('location:index.php';)
            }
            
        }else {
            $errors['failed']='Tài khoản hoặc mật khẩu không chính xác';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>AdminLTE 2 | Log in</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
</header>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href=""><b>Admin</b>LTE</a>
</div>

<div class="login-box-body">
<p class="login-box-msg">Sign in to start your session</p>
<?php if ($errors):?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidder="true">&times;</button>
    <?php foreach($errors as $errors);?>
    <li><?php echo $errors;?></li>
    <?php endforeach;?> 
</div>
<?php endif;?>
<form action="" method="post">
<div class="form-group has-feedback">
<input type="email" name="email" class="form-control" placeholder="Email">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input type="password" name="password" class="form-control" placeholder="Password">
<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
<div class="col-xs-8">
<div class="checkbox">
<label>
<input type="checkbox"> Remember Me
</label>
</div>
</div>

<div class="col-xs-4">
<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
</div>

</div>
</form>

</div>

</body>
</html>