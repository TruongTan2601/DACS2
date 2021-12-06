<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>
  <?php
  $user = Session::get("userUser");

  if (isset($user) && $user) {
    $cart = DB::table('cart')->where('userId', $user['userId'])->get();
  }

  $today = date('d') . '-' . date('m') . '-' . date('Y') . ' ' . date("h:i:sa");
  $month = date('m');

  if (isset($_POST['place_order'])) {
    $billName = $_POST['name'];
    $billDate = $_POST['date'];
    $billPhone = $_POST['phone'];
    $address = $_POST['address'] . ', ' . $_POST['ward'] . ', ' . $_POST['state'] . ', ' . $_POST['country'];

    $subtotal = 0;
    foreach ($cart as $row) {
      $total = $row['cartPrice'] * $row['cartQuantity'];
      $subtotal +=$total;
    }

    DB::table('bill')->insert([
      'userId' =>  $user['userId'],
      'billName' => $billName,
      'billDate' => $billDate,
      'billAddress' => $address,
      'billPhone' => $billPhone,
      'subtotal' => $subtotal,
      'month' =>$month
    ]);

    $s = DB::table('bill')->where('billDate', $billDate)->get();

    foreach ($cart as $row) {
      $total = $row['cartPrice'] * $row['cartQuantity'];

      DB::table('bill_details')->insert([
        'bill_Id' => $s[0]['bill_Id'],
        'productId' => $row['productId'],
        'productName' => $row['cartName'],
        'productPrice' => $row['cartPrice'],
        'productQuantity' => $row['cartQuantity'],
        'total' => $total,
        'month' =>$month
      ]);
    }
    DB::table('cart')->where('userId', $user['userId'])->delete();
    header('Location: index.php');
  }
  
  ?>
</head>

<body>
  <?php include 'modules/header.php' ?>

  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Checkout</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active">Checkout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->
  <!-- Start Cart  -->
  <div class="cart-box-main">
    <div class="container">
      <form method="post">
        <div class="row">
          <div class="col-sm-6 col-lg-6 mb-3">
            <div class="checkout-address">
              <div class="title-left">
                <h3>Billing address</h3>
                <input type="hidden" name="date" value="<?= $today ?>">
              </div>
              <div class="mb-3">
                <label for="firstName">User name *</label>
                <input type="text" class="form-control" id="firstName" name="name" value="<?= $user['userName'] ?>" required>
                <div class="invalid-feedback"> Valid first name is required. </div>
              </div>
              <div class="mb-3">
                <label for="email">Email Address *</label>
                <input type="email" class="form-control" id="email" value="<?= $user['userEmail'] ?>" required>
                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
              </div>
              <div class="mb-3">
                <label for="address">Phone number *</label>
                <input type="text" class="form-control" id="address" name="phone" value="<?= $user['userPhone'] ?>" required>
                <div class="invalid-feedback"> Please enter your shipping address. </div>
              </div>
              <div class="mb-3">
                <label for="address">Address *</label>
                <input type="text" class="form-control" name="address" id="address" value="<?= $user['userAddress'] ?>" required>
                <div class="invalid-feedback"> Please enter your shipping address. </div>
              </div>
              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country *</label>
                  <select class="wide w-100" name="country" id="country">
                    <option value="Choose..." data-display="Select">Choose...</option>
                    <option value="VietNam" selected="">VietNam</option>
                  </select>
                  <div class="invalid-feedback"> Please select a valid country. </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">State *</label>
                  <select class="wide w-100" name="state" id="state">
                    <option data-display="Select">Choose...</option>
                    <option value="Ha Noi">Ha Noi</option>
                    <option value="Ho Chi Minh">TP. Ho Chi Minh</option>
                    <option value="Da Nang" selected="">Da Nang</option>
                  </select>
                  <div class="invalid-feedback"> Please provide a valid state. </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="ward">Ward *</label>
                  <select id="ward" name="ward" class="form-control">
                    <option value="">Ward</option>
                    <option value="Cam Le">Cam Le</option>
                    <option value="Hai Chau">Hai Chau</option>
                    <option value="Hoa Vang">Hoa Vang</option>
                    <option value="Lien Chieu">Lien Chieu</option>
                    <option value="Ngu Hanh Son">Ngu Hanh Son</option>
                    <option value="Son Tra" selected="">Son Tra</option>
                    <option value="Thanh Khe">Thanh Khe</option>
                  </select>
                </div>
              </div>
              <hr class="mb-4">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address" checked>
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info" checked>
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
              </div>
              <hr class="mb-4">
              <div class="title"> <span>Payment</span> </div>
              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="direct" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="direct">Direct payment</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name"> <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback"> Name on card is required </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number">
                  <div class="invalid-feedback"> Credit card number is required </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration">
                  <div class="invalid-feedback"> Expiration date required </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv">
                  <div class="invalid-feedback"> Security code required </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="payment-icon">
                    <ul>
                      <li><img class="img-fluid" src="images/payment-icon/1.png" alt=""></li>
                      <li><img class="img-fluid" src="images/payment-icon/2.png" alt=""></li>
                      <li><img class="img-fluid" src="images/payment-icon/3.png" alt=""></li>
                      <li><img class="img-fluid" src="images/payment-icon/5.png" alt=""></li>
                      <li><img class="img-fluid" src="images/payment-icon/7.png" alt=""></li>
                    </ul>
                  </div>
                </div>
              </div>
              <hr class="mb-1">
            </div>
          </div>
          <div class="col-sm-6 col-lg-6 mb-3">
            <div class="row">
              <?php $subtotal = 0; ?>
              <div class="col-md-12 col-lg-12">
                <div class="shipping-method-box">
                  <div class="title-left">
                    <h3>Shipping Method</h3>
                  </div>
                  <div class="mb-4">
                    <div class="custom-control custom-radio">
                      <input id="shippingOption1" onclick="a()" name="shipping-option" class="custom-control-input" checked="checked" type="radio" value="FREE">
                      <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span>
                    </div>
                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                    <div class="custom-control custom-radio">
                      <input id="shippingOption2" onclick="b()" name="shipping-option" class="custom-control-input" type="radio" value="50000">
                      <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">50000 VNĐ</span>
                    </div>
                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                    <div class="custom-control custom-radio">
                      <input id="shippingOption3" onclick="c()" name="shipping-option" class="custom-control-input" type="radio" value="100000">
                      <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">100000 VNĐ</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-12">
                <div class="odr-box">
                  <div class="title-left">
                    <h3>Shopping cart</h3>
                  </div>
                  <div class="rounded p-2 bg-light">
                    <?php if (isset($cart) && $cart) { ?>
                      <?php
                      foreach ($cart as $row) {
                        $total = $row['cartPrice'] * $row['cartQuantity'];
                        $subtotal += $total;
                      ?>
                        <div class="media mb-2 border-bottom">
                          <div class="media-body">
                            <a href="shop-detail.php?id=<?= $row['productId'] ?>">
                              <?= $row['cartName'] ?>
                            </a>
                            <div class="small text-muted">Price: <?= $row['cartPrice'] ?> VNĐ <span class="mx-2">|</span> Qty: <?= $row['cartQuantity'] ?> <span class="mx-2">|</span> Subtotal: <?= $total ?> VNĐ</div>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } else { ?>
                      <div class="media mb-2 border-bottom">
                        <h4>Your cart is empty!!!</h4>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="order-box">
                  <div class="title-left">
                    <h3>Your order</h3>
                  </div>
                  <div class="d-flex">
                    <div class="font-weight-bold">Product</div>
                    <div class="ml-auto font-weight-bold">Total</div>
                  </div>
                  <hr class="my-1">
                  <div class="d-flex">
                    <h4>Sub Total</h4>
                    <div class="ml-auto font-weight-bold"> <?= $subtotal ?> VNĐ </div>
                  </div>
                  <div class="d-flex">
                    <h4>Discount</h4>
                    <div class="ml-auto font-weight-bold"> <?= $discount = $subtotal *  $row['coupon']/100 ?> VNĐ </div>
                  </div>
                  <hr class="my-1">
                  <div class="d-flex">
                    <h4>Coupon Discount</h4>
                    <div class="ml-auto font-weight-bold"> <?= $coupon_discount = $row['coupon'] ?> % </div>
                  </div>
                  <div class="d-flex">
                    <h4>Tax</h4>
                    <div class="ml-auto font-weight-bold"> <?= $tax = 0 ?> VNĐ </div>
                  </div>
                  <div class="d-flex">
                    <h4>Shipping Cost</h4>
                    <div class="ml-auto font-weight-bold">
                      <p id="gs"></p>
                    </div>
                  </div>
                  <hr>
                  <div class="d-flex gr-total">
                    <h5>Grand Total</h5>
                    <div class="ml-auto h5"> <?= number_format($final_total = $subtotal - $discount - $tax, 0, '', ',') ?> VNĐ </div>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="col-12 d-flex shopping-box">
                <input type="submit" class="ml-auto btn hvr-hover" name="place_order" value="Place Order">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Cart -->
  <script>
    function a() {
      var a = document.getElementById('shippingOption1').value
      document.getElementById('gs').innerHTML = a
    }

    function b() {
      var a = document.getElementById('shippingOption2').value
      document.getElementById('gs').innerHTML = a
    }

    function c() {
      var a = document.getElementById('shippingOption3').value
      document.getElementById('gs').innerHTML = a
    }
  </script>
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
  <!-- End copyright  -->

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