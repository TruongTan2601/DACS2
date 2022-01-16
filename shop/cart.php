<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>

</head>

<body>
  <?php include 'modules/header.php' ?>
  <?php
  $coupon_discount = 0;

  if (isset($_POST['add_cart'])) {
    $productId = $_POST['productId'];
    $productImage = $_POST['productImage'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];

    $user = Session::get("userUser");
    $item = DB::table('cart')->where('productId', $productId)->where('userId', $user['userId'])->first();

    if (!isset($item['cartQuantity'])) {
      DB::table('cart')->insert([
        'productId' => $productId,
        'cartName' => $productName,
        'cartImage' => $productImage,
        'cartPrice' => $productPrice,
        'cartQuantity' => $productQuantity,
        'userId' => $user['userId']
      ]);
    } else {
      $Quantity = $item['cartQuantity'] + $productQuantity;
      DB::table('cart')->where('productId', $productId)->where('userId', $user['userId'])->update(['cartQuantity' => $Quantity]);
    }
  }

  if (isset($_POST['del_id'])) {
    $id = $_POST['cartId'];
    DB::table('cart')->where('cartId', $id)->delete();
  }

  if (isset($_POST['delete_cart'])) {
    DB::table('cart')->where('userId', $user['userId'])->delete();
  }

  if (isset($_POST['coupon'])) {
    $coupon_discount = $_POST['couponId'];
    DB::table('cart')->where('userId', $user['userId'])->update(['coupon' => $coupon_discount]);
  }
  ?>

  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Cart</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
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
      $subtotal = 0;
      $i = 1;
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
                <?php if (isset($cart) && $cart) { ?>
                  <?php
                  foreach ($cart as $row) {
                    $total = $row['cartPrice'] * $row['cartQuantity'];
                    $subtotal += $total;
                  ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td class="thumbnail-img">
                        <a href="#">
                          <img class="img-fluid" src="../admin/img/Coffee/<?= $row['cartImage'] ?>" alt="" />
                        </a>
                      </td>
                      <td class="name-pr">
                        <a href="shop-detail.php?id=<?= $row['productId'] ?>">
                          <?= $row['cartName'] ?>
                        </a>
                      </td>
                      <td class="price-pr">
                        <p><?= $row['cartPrice'] ?> VNĐ</p>
                      </td>
                      <td class="quantity-box"><input type="number" size="4" value="<?= $row['cartQuantity'] ?>" min="0" max="50" step="1" class="c-input-text qty text"></td>
                      <td class="total-pr">
                        <p><?= $total ?> VNĐ</p>
                      </td>
                      <td class="remove-pr">
                        <form method="post">
                          <input type="hidden" name="cartId" value="<?= $row['cartId'] ?>">
                          <input type="submit" style="border: none; background: none; cursor: pointer;" name="del_id" value="X">
                        </form>
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
      <script src="js/jquery-3.2.1.min.js"></script>
      <script>
        $(document).ready(function() {
          $('.search_coupon').keyup(function() {
            var txt = $('.search_coupon').val()
            $.post('ajax/list_coupon.php', {
              data: txt
            }, function(data) {
              $('.list_coupon').html(data)
            })
          })
        });
      </script>
      <div class="row my-5">
        <div class="col-lg-7 col-sm-7">
          <div class="coupon-box">
            <div class="input-group input-group-sm">
              <input class="search_coupon form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
              <div class="input-group-append">
                <button class="btn btn-theme" type="button">Apply Coupon</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-5">
          <div class="update-box">
            <form method="POST">
              <input type="hidden" name="id">
              <input value="Delete Cart" type="submit" name="delete_cart">
              <input value="Update Cart" type="submit" name="update_cart">
            </form>
          </div>
        </div>
      </div>

      <div class="row my-5">

        <div class="col-lg-8 col-sm-12 list_coupon" style="padding-bottom: 20px;">
          <?php foreach (DB::table('coupon')->orWhere('show_check',0)->get() as $row) { ?>
            <?php $times = floor((time() - strtotime($row['couponEndDate'])) / (60 * 60 * 24)) ?>
            <?php if ($times <= 0) { ?>
              <div class="row coupon_s" style="padding-bottom: 20px;">
                <div class="col-md-1 icon-coupon">
                  <i class="fa fa-gift" style="font-size: 45px; padding-right: 25px;" aria-hidden="true"></i>
                </div>
                <div class="col-md-7 coupon">
                  <div class="coupon-name">
                    <h3><?= $row['couponName'] ?></h3>
                  </div>
                  <div class="coupon-g">
                    <?= $row['couponContent'] ?>
                  </div>
                </div>
                <div class="col-md-3 coupon-click">
                  <form method="post">
                    <input type="hidden" name="couponId" value="<?= $row['couponDiscount'] ?>">
                    <input type="submit" name="coupon" class="btn hvr-hover" style="color: #fff;" value="USE COUPON">
                  </form>
                </div>
              </div>
            <?php } else {
            } ?>
          <?php } ?>
        </div>


        <div class="col-lg-4 col-sm-12">
          <div class="order-box">
            <h3>Order summary</h3>
            <div class="d-flex">
              <h4>Sub Total</h4>
              <div class="ml-auto font-weight-bold"> <?= $subtotal ?> VNĐ </div>
            </div>
            <div class="d-flex">
              <h4>Discount</h4>
              <div class="ml-auto font-weight-bold"> <?= $discount = $subtotal * $coupon_discount / 100 ?> VNĐ </div>
            </div>
            <hr class="my-1">
            <div class="d-flex">
              <h4>Coupon Discount</h4>
              <div class="ml-auto font-weight-bold"> <?= $coupon_discount ?> % </div>
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
              <div class="ml-auto h5"> <?= number_format($final_total = $subtotal - $discount - $tax, 0, '', ',') ?> VNĐ </div>
            </div>
            <hr>
          </div>
        </div>
        <div class="col-12 d-flex shopping-box"><a href="checkout.php" style="color: #fff;" class="ml-auto btn hvr-hover">Checkout</a> </div>
      </div>
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