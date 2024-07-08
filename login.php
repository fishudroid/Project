<?php include 'header.php'; ?>
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
        <div class="form_container">
          <form action="">
            <div>
              <input type="email" class="form-control" placeholder="Địa chỉ mail của bạn" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Mật khẩu của bạn" />
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Ghi nhớ đăng nhập
              </label>
            </div>
            <div class="row">
              <div class="col-md-5 btn_box d-flex flex-row">
                <button>
                  Đăng nhập
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