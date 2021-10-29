<?php
require '../admin/connect.php';
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

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Site Metas -->
  <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Site Icons -->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Site CSS -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <?php include 'modules/header.php' ?>

  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Cart</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active">Cart</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Cart  -->
  <div class="cart-box-main">
    <div class="container">
      <?php
      if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        $subtotal = 0;
      ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-main table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Images</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($_SESSION['cart']) && $_SESSION['cart']) { ?>
                    <?php
                    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                      $total = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
                      $subtotal += $total;
                    ?>
                      <tr>
                        <td><?= $i + 1 ?></td>
                        <td class="thumbnail-img">
                          <a href="#">
                            <img class="img-fluid" src="images/Coffee/<?= $_SESSION['cart'][$i][0] ?>" alt="" />
                          </a>
                        </td>
                        <td class="name-pr">
                          <a href="#">
                            <?= $_SESSION['cart'][$i][1] ?>
                          </a>
                        </td>
                        <td class="price-pr">
                          <p><?= $_SESSION['cart'][$i][2] ?> VNĐ</p>
                        </td>
                        <td class="quantity-box"><input type="number" size="4" value="<?= $_SESSION['cart'][$i][3] ?>" min="0" step="1" class="c-input-text qty text"></td>
                        <td class="total-pr">
                          <p><?= $total ?> VNĐ</p>
                        </td>
                        <td class="remove-pr">
                          <a href="cart.php?del_id=<?= $i ?>">
                            <i class="fas fa-times"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td style="text-align: center;" colspan="7">
                        <h2>Your cart is empty!!!</h2>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row my-5">
          <div class="col-lg-6 col-sm-6">
            <div class="coupon-box">
              <div class="input-group input-group-sm">
                <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                <div class="input-group-append">
                  <button class="btn btn-theme" type="button">Apply Coupon</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6">
            <div class="update-box">
              <form action="">
                <input type="hidden" name="id">
                <a href="cart.php?del_cart=1">Delete cart</a>
                <input value="Update Cart" type="submit">
              </form>
            </div>
          </div>
        </div>

        <div class="row my-5">
          <div class="col-lg-8 col-sm-12"></div>
          <div class="col-lg-4 col-sm-12">
            <div class="order-box">
              <h3>Order summary</h3>
              <div class="d-flex">
                <h4>Sub Total</h4>
                <div class="ml-auto font-weight-bold"> <?= $subtotal ?> VNĐ </div>
              </div>
              <div class="d-flex">
                <h4>Discount</h4>
                <div class="ml-auto font-weight-bold"> <?= $discount = 0 ?> VNĐ </div>
              </div>
              <hr class="my-1">
              <div class="d-flex">
                <h4>Coupon Discount</h4>
                <div class="ml-auto font-weight-bold"> <?= $coupon_discount = 0 ?> VNĐ </div>
              </div>
              <div class="d-flex">
                <h4>Tax</h4>
                <div class="ml-auto font-weight-bold"> <?= $tax = 0 ?> VNĐ </div>
              </div>
              <div class="d-flex">
                <h4>Shipping Cost</h4>
                <div class="ml-auto font-weight-bold"> Free </div>
              </div>
              <hr>
              <div class="d-flex gr-total">
                <h5>Grand Total</h5>
                <div class="ml-auto h5"> <?= number_format($final_total = $subtotal - $discount - $coupon_discount - $tax, 0, '', ',') ?> VNĐ </div>
              </div>
              <hr>
            </div>
          </div>
          <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- End Cart -->

  <!-- Start Instagram Feed  -->
  <div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-01.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-02.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-03.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-04.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-05.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-06.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-07.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-08.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-09.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="ins-inner-box">
          <img src="images/instagram-img-05.jpg" alt="" />
          <div class="hov-in">
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Instagram Feed  -->


  <!-- Start Footer  -->
  <?php include 'modules/footer.php' ?>
  <!-- End Footer  -->

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

  <!-- ALL JS FILES -->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- ALL PLUGINS -->
  <script src="js/jquery.superslides.min.js"></script>
  <script src="js/bootstrap-select.js"></script>
  <script src="js/inewsticker.js"></script>
  <script src="js/bootsnav.js."></script>
  <script src="js/images-loded.min.js"></script>
  <script src="js/isotope.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/baguetteBox.min.js"></script>
  <script src="js/form-validator.min.js"></script>
  <script src="js/contact-form-script.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>