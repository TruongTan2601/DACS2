<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_GET['del_cart']) && $_GET['del_cart'] == 1) {
  unset($_SESSION['cart']);
  header('Location: cart.php');
}

if (isset($_GET['del_id']) && $_GET['del_id'] >= 0) {
  array_splice($_SESSION['cart'], $_GET['del_id'], 1);
  header('Location: cart.php');
}

if (isset($_POST['add_cart']) && ($_POST['add_cart'])) {
  $productId = $_POST['productId'];
  $productImage = $_POST['productImage'];
  $productName = $_POST['productName'];
  $productPrice = $_POST['productPrice'];
  $productQuantity = $_POST['productQuantity'];

  // Check product session
  $check = 0;

  for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
    if ($_SESSION['cart'][$i][4] == $productId) {
      $check = 1;
      $Quantity_new = $productQuantity + $_SESSION['cart'][$i][3];
      $_SESSION['cart'][$i][3] = $Quantity_new;
      break;
    }
  }

  // Add product to session
  if ($check == 0) {
    $product = [$productImage, $productName, $productPrice, $productQuantity, $productId];
    $_SESSION['cart'][] = $product;
  }
  // var_dump($_SESSION['cart']);
}

?>
<!-- Start Main Top -->
<!-- <div class="main-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="custom-select-box">
          <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
            <option>¥ JPY</option>
            <option>$ USD</option>
            <option>€ EUR</option>
          </select>
        </div>
        <div class="right-phone-box">
          <p>Call US :- <a href="#"> +11 900 800 100</a></p>
        </div>
        <div class="our-link">
          <ul>
            <li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>
            <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="login-box">
          <select id="basic" class="selectpicker show-tick form-control" data-placeholder="Sign In">
            <option>Register Here</option>
            <option>Sign In</option>
          </select>
        </div>
        <div class="text-slid-box">
          <div id="offer-box" class="carouselTicker">
            <ul class="offer-box">
              <li>
                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
              </li>
              <li>
                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
              </li>
              <li>
                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
              </li>
              <li>
                <i class="fab fa-opencart"></i> Off 50%! Shop Now
              </li>
              <li>
                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
              </li>
              <li>
                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
              </li>
              <li>
                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
              </li>
              <li>
                <i class="fab fa-opencart"></i> Off 50%! Shop Now
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
    <div class="container">
      <!-- Start Header Navigation -->
      <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="index.php"><img src="images/logotre.jpg" width="110px" class="logo" alt=""></a>
      </div>
      <!-- End Header Navigation -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
          <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
          <li class="dropdown">
            <a href="shop.php" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">MENU</a>
            <ul class="dropdown-menu">
              <li><a href="shop.php">Sidebar Shop</a></li>
              <!-- <li><a href="shop-detail.php">Shop Detail</a></li> -->
              <li><a href="cart.php">Cart</a></li>
              <li><a href="checkout.php">Checkout</a></li>
              <li><a href="my-account.php">My Account</a></li>
              <li><a href="wishlist.php">Wishlist</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->

      <!-- Start Atribute Navigation -->
      <div class="attr-nav">
        <ul>
          <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
          <li class="side-menu">
            <a href="#">
              <i class="fa fa-shopping-bag"></i>
              <span class="badge">~</span>
              <p>My Cart</p>
            </a>
          </li>
        </ul>
      </div>
      <!-- End Atribute Navigation -->
    </div>
    <!-- Start Side Menu -->
    <div class="side">
      <a href="#" class="close-side"><i class="fa fa-times"></i></a>
      <?php
      if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        $subtotal = 0;
      ?>
        <li class="cart-box">
          <ul class="cart-list">
            <?php if (isset($_SESSION['cart']) && $_SESSION['cart']) { ?>
              <?php
              for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $total = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
                $subtotal += $total;
              ?>
                <li>
                  <a href="#" class="photo"><img src="../admin/img/Coffee/<?= $_SESSION['cart'][$i][0] ?>" class="cart-thumb" alt=""></a>
                  <h6><a href="#"><?= $_SESSION['cart'][$i][1] ?> </a></h6>
                  <p><?= $_SESSION['cart'][$i][3] ?>x - <span class="price"><?= $_SESSION['cart'][$i][2] ?> VNĐ</span></p>
                </li>

              <?php } ?>
              <li class="total">
                <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                <span class="float-right"><strong>Total</strong>: <?= number_format($subtotal, 0, '', ',') ?> VNĐ</span>
              </li>
            <?php } else { ?>
              <tr>
                <li>
                  <h2>Your cart is empty!!!</h2>
                </li>
              </tr>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>
    </div>
    <!-- End Side Menu -->
  </nav>
  <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
  <div class="container">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-search"></i></span>
      <form style="width: 85%;" action="search.php" method="post">
      <input type="text" name="search" class="form-control" placeholder="Search">
      </form>
      <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
    </div>
  </div>
</div>
<!-- End Top Search -->