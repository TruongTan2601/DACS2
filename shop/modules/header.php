<?php
$user = Session::get("userUser");

if (isset($user) && $user) {
  $cart = DB::table('cart')->where('userId', $user['userId'])->get();
  $wishlist = DB::table('wishlist')->where('userId', $user['userId'])->get();
}

?>
<!-- Start Main Top -->

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
              <span class="badge">
                <?php if (isset($user) && $user) { ?>
                  <?= DB::table('cart')->where('userId', $user['userId'])->count() ?>
                <?php } else { ?>
                  0
                <?php } ?>

              </span>
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
      $subtotal = 0;
      ?>
      <li class="cart-box">
        <ul class="cart-list">
          <?php if (isset($cart) && $cart) { ?>
            <?php
            foreach ($cart as $row) {
              $total = $row['cartPrice'] * $row['cartQuantity'];
              $subtotal += $total;
            ?>
              <li>
                <a href="#" class="photo"><img src="../admin/img/Coffee/<?= $row['cartImage'] ?>" class="cart-thumb" alt=""></a>
                <h6><a href="#"><?= $row['cartName'] ?> </a></h6>
                <p><?= $row['cartQuantity'] ?>x - <span class="price"><?= $row['cartPrice'] ?> VNĐ</span></p>
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