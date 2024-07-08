<?php
session_start();
include 'connect.php';
$customer = null;
$totalcart = 0;
if (!empty($_SESSION['cus_login'])) {
  $customer = $_SESSION['cus_login'];

  $sqlCart = "SELECT SUM(quantity) AS total FROM cart WHERE customer_id = $customer->id";
  $sqlCart = $conn->query($sqlCart)->fetch_object();
  $totalcart = $sqlCart->total;
}
?>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> A Tavola </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/banner.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              A Tavola
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
              <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            </ul>
            <div class="user_option">
              <?php if ($customer) : ?>

                <a href="profile.php" class="user_link">
                  <i class="fa fa-user" aria-hidden="true"></i> <?php echo $customer->name;?>
                </a>
                <a href="logout.php" class="user_link">
                  <i class="fa fa-power-off" aria-hidden="true"></i>
                </a>
                <a class="cart_link" href="cart-view.php">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  <span class="cart-notification"><?php echo $totalcart;?></span>
                </a>
                <a href="order-online.php" class="order_online">
                  Order Online
                </a>

              <?php else : ?>

                <a href="login.php" class="user_link">
                  <i class="fa fa-user" aria-hidden="true"></i> Hi Guest
                </a>

              <?php endif; ?>

              <form class="form-inline">
                <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>

            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <?php
    $url = $_SERVER['SCRIPT_NAME'];
    if (strpos($url, 'index.php')) {
      include 'banner.php';
    }
    ?>
  </div>
</body>