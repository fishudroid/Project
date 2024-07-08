<?php 
include 'header.php';
$errors = [];
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($email == '') {
    $errors['email'] = 'Email không được để trống';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email không đúng định dạng';
  }

  if ($password == '') {
    $errors['password'] = 'Mật khẩu không được để trống';
  } else if ($password < 6) {
    $errors['password'] = 'Mật khẩu tối thiểu 6 ký tự';
  }

  if (!$errors) {
    $sql = "SELECT * FROM customer WHERE email = '$email'";

    $query = $conn->query($sql);
    if ($query->num_rows == 1) {
      $customer = $query->fetch_object();
      if (password_verify($password, $customer->password)) {
        $_SESSION['cus_login'] = $customer;
        header('location : index.php');
      } else {
        $errors['failed'] = 'Mật khẩu không chính xác. Vui lòng kiểm tra lại';
      }
    } else {
      $errors['failed'] = 'Địa chỉ email không chính xác.';
    }
  }
}
?>
<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Đăng nhập tài khoản
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
              <input type="email" name="email" class="form-control" placeholder="Địa chỉ mail của bạn" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Mật khẩu của bạn" />
            </div>
            <div class="row">
              <div class="col-md-5 btn_box d-flex flex-row">
                <button>
                  <a>Đăng nhập</a>
                </button>
              </div>
              <div class="col-md-7 btn_box d-flex flex-row-reverse">
                <button>
                  <a href="register.php">Đăng ký tài khoản</a>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <img width="100%" src="images/login.jpg" alt="">
      </div>
    </div>
  </div>
</section>
<!-- end book section -->
<?php include 'footer.php'; ?>