<?php
include 'header.php';
if (!$customer) {
  header('location : login.php');
}
$errors = [];
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $password = $_POST['password'];

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
  } else if (!password_verify($password, $customer->password)) {
    $errors['password'] = 'Mật khẩu chính xác';
  }
  if (!$errors) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE customer SET name='$name', phone='$phone', email='$email', address='$address', WHERE id = $customer->id";
    if ($conn->query($sql)) {
      header('location : logout.php');
    } else {
      $errors['failed'] = 'Cập nhật không thành công, vui lòng thử lại';
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
        Hồ sơ tài khoản
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
          <form action="" method="GET">
            <div>
              <input type="text" name="name" class="form-control" value="<?php echo $customer->name; ?>" placeholder="Họ và tên" />
            </div>
            <div>
              <input type="text" name="phone" class="form-control" value="<?php echo $customer->phone; ?>" placeholder="Số điện thoại" />
            </div>
            <div>
              <input type="email" name="email" class="form-control" value="<?php echo $customer->email; ?>" placeholder="Địa chỉ mail của bạn" />
            </div>
            <div>
              <input type="text" name="address" class="form-control" value="<?php echo $customer->address; ?>" placeholder="Địa chỉ" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Mật khẩu của bạn" />
            </div>
            <div class="btn_box">
              <button>
                Cập nhật
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