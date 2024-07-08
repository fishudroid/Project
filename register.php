<?php include 'header.php';
$errors = [];
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($name == '') {
    $errors['name'] = 'Họ tên không được để trống';
  } else if (strlen($name) < 2) {
    $errors['name'] = 'Họ tên tối thiểu 2 ký tự';
  }
  if ($phone == '') {
    $errors['phone'] = 'Số điện thoại không được để trống';
  } else if (strlen($phone) < 10) {
    $errors['phone'] = 'Số điện thoại tối thiểu 10 chữ số';
  }
  if ($email == '') {
    $errors['email'] = 'Email không được để trống';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email không đúng định dạng';
  }
  if ($address == '') {
    $errors['address'] = 'Địa chỉ không được để trống';
  } else if (strlen($address) < 10) {
    $errors['address'] = 'Địa chỉ tối thiểu 10 ký tự';
  }

  if ($password == '') {
    $errors['password'] = 'Mật khẩu không được để trống';
  } else if ($password < 6) {
    $errors['password'] = 'Mật khẩu tối thiểu 6 ký tự';
  }
  if ($confirm_password == '') {
    $errors['confirm_password'] = 'Mật khẩu xác nhận không được để trống';
  } else if ($password != $confirm_password) {
    $errors['confirm_password'] = 'Mật khẩu không trùng với mật khẩu xác nhận';
  }
  if (!$errors) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO customer(name, email, address, password) VALUES ('$name', '$email', '$address', '$pass_hash')";

    if ($conn->query($sql)) {
      header('location : login.php');
    } else {
      $errors['failed'] = 'Đăng ký không thành công, vui lòng thử lại';
    }
  }
}
?>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
  </div>
</body>
<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Đăng ký tài khoản
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">

        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php foreach ($errors as $error) : ?>
              <li><?php echo $error; ?></li>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="form_container">
          <form action="" method="POST">
            <div>
              <input type="text" name="name" class="form-control" placeholder="Họ và tên" />
            </div>
            <div>
              <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" />
            </div>
            <div>
              <input type="email" name="email" class="form-control" placeholder="Địa chỉ mail của bạn" />
            </div>
            <div>
              <input type="text" name="address" class="form-control" placeholder="Địa chỉ" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Mật khẩu của bạn" />
            </div>
            <div>
              <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu của bạn" />
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" required> Chấp nhận điều khoản dịch vụ & quyền riêng tư
              </label>
            </div>
            <div class="btn_box">
              <button>
                Đăng ký
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <img width="100%" src="images/signup.jpg" alt="">
      </div>
    </div>
  </div>
</section>
<!-- end book section -->
<?php include 'footer.php'; ?>