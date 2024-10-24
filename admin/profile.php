<?php
include 'header.php';
$errors = [];
$id = $admin->id;
if (isset($_PoST['old_password'])) {
    $old_password = $_POST['old_password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    if ($name == '') {
        $errors['name'] = 'Bạn phải nhập họ tên';
    }
    if ($email == '') {
        $errors['email'] = 'Email không được để trống';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không đúng định dạng';
    }
    if ($old_password == '') {
        $errors['old_password'] = 'Bạn phải nhập mật khẩu cũ';
    }
    if (!$errors) {
        $sqlCheck = "SELECT email FROM admin WHERE email = '$email' AND id != '$id'";

        $query = $conn->query($sqlCheck);

        if ($query->num_rows == 1) {

            $errors['email'] = 'Email đã được sử dụng. Yêu cầu dùng email khác';
        } else {
            $sqlUpdate = "UPDATE admin SET name='$name', email = '$email' WHERE id = $admin->id";
            if ($conn->query($sqlUpdate)) {
                unset($_SESSION['admin_login']);
                header('location: login.php');
            } else {
                $errors['failed'] = 'Có lỗi, vui lòng thử lại';
            }
        }
    }
}; ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>Update profile</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <?php if ($errors) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidder="true">&times;</button>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label form="">Full Name</label>
                    <input type="text" class="form-cotrol" name="name" value=<?php echo $admin->name; ?> placeholder="Nhập tên">
                </div>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label form="">Email</label>
                        <input type="email" class="form-cotrol" name="email" value=<?php echo $admin->email; ?> placeholder="Nhập địa chỉ email">
                    </div>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label form="">Mật khẩu hiện tại</label>
                            <input type="password" class="form-cotrol" name="old_password" placeholder="Nhập mật khẩu hiện tại">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Xác nhận</button>
                    </form>
            </div>
        </div>
    </section>
</div>
<?php include 'footer.php'; ?>