<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>
  <link rel="stylesheet" href="css/admin.css">
  <style>
    .x-hide-display {
      display: none;
    }

    .x-display {
      display: block;
    }

    .modal {
      position: fixed;
      z-index: 3;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 60%;
      top: 170px;
    }

    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .form-item {
      display: block;
      padding: 5px;
      margin-left: auto;
      margin-right: auto;
    }

    .form-item input {
      max-width: 100%;
      width: 98%;
      height: 34px;
      font-size: 16px;
    }

    tbody th {
      font-weight: 400;
    }

    @media screen and (max-width: 768px) {
      .modal-content {
        width: 80%;
      }
    }
  </style>
</head>
<?php
if (isset($_POST['logout'])) {
  Session::logout();
}
?>

<body>
  <?php require 'modules/header.php' ?>
  <?php
  if (isset($_POST['change_address'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    DB::table('tbl_user')->where('userId', $user['userId'])->update([
      'userName' => $full_name,
      'userEmail' => $email,
      'userPhone' => $phone,
      'userAddress' => $address
    ]);
  }
  $productS = null;
  if (isset($_POST['view_detail'])) {
    $productId = $_POST['bill_Id'];
    $productS = DB::table('bill')->where('userId', $productId)->get();
  }
  ?>
  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>My Account</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active">My Account</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start My Account  -->
  <div class="my-account-box-main">
    <div class="container">
      <div class="my-account-page">
        <?php if (isset($user) && $user) { ?>
          <div class="nameUser">
            <h3>Hello<b> <?= $user['userName'] ?> !!</b></h3>
            <form method="post">
              <button type="submit" class="btn btn-dark" name="logout">
                Logout
              </button>
            </form>
          <?php } else { ?>

          <?php } ?>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <form method="post">
                      <input type="hidden" name="bill_Id" value="<?= $user['userId'] ?>">
                      <button style="border: none;" type="submit" name="view_detail"><i class="fas fa-gift"></i></button>
                    </form>
                  </div>
                  <div class="service-desc">
                    <h4>Your Orders</h4>
                    <p>Track, return, or buy things again</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <a href="login.php"><i class="fa fa-lock"></i> </a>
                  </div>
                  <div class="service-desc">
                    <h4>Login &amp; security</h4>
                    <p>Login or Register</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <span onclick="show_upload();"> <i class="fa fa-location-arrow"></i> </span>
                  </div>
                  <div class="service-desc">
                    <h4>Personal Information</h4>
                    <p>Edit addresses for orders and gifts</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="block pt-3 upload_pro hidden">
                <form action="" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-4 col-md-12">
                      <label for="pname">Full name:</label>
                      <input type="text" class="form-control" id="pname" placeholder="Enter name" name="full_name" value="<?= $user['userName'] ?>" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <label for="email">Email address:</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?= $user['userEmail'] ?>">
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <label for="phone">Phone number:</label>
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number" value="<?= $user['userPhone'] ?>">
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" value="<?= $user['userAddress'] ?>">
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <input type="submit" class="btn btn-dark" name="change_address" value="Change">
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <a href="#"> <i class="fa fa-credit-card"></i> </a>
                  </div>
                  <div class="service-desc">
                    <h4>Payment options</h4>
                    <p>Edit or add payment methods</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <a href="#"> <i class="fab fa-paypal"></i> </a>
                  </div>
                  <div class="service-desc">
                    <h4>PayPal</h4>
                    <p>View benefits and payment settings</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="account-box">
                <div class="service-box">
                  <div class="service-icon">
                    <a href="#"> <i class="fab fa-amazon"></i> </a>
                  </div>
                  <div class="service-desc">
                    <h4>Amazon Pay balance</h4>
                    <p>Add money to your balance</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bottom-box">
            <div class="row">
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>Gold &amp; Diamond Jewellery</h4>
                      <ul>
                        <li> <a href="#">Apps and more</a> </li>
                        <li> <a href="#">Content and devices</a> </li>
                        <li> <a href="#">Music settings</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>Handloom &amp; Handicraft Store</h4>
                      <ul>
                        <li> <a href="#">Advertising preferences </a> </li>
                        <li> <a href="#">Communication preferences</a> </li>
                        <li> <a href="#">SMS alert preferences</a> </li>
                        <li> <a href="#">Message center</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>The Designer Boutique</h4>
                      <ul>
                        <li> <a href="#">Amazon Pay</a> </li>
                        <li> <a href="#">Bank accounts for refunds</a> </li>
                        <li> <a href="#">Coupons</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>Gift Boxes, Gift Tags, Greeting Cards</h4>
                      <ul>
                        <li> <a href="#">Leave delivery feedback</a> </li>
                        <li> <a href="#">Lists</a> </li>
                        <li> <a href="#">Photo ID proofs</a> </li>
                        <li> <a href="#">Profile</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>Other accounts</h4>
                      <ul>
                        <li> <a href="#">Amazon Business registration</a> </li>
                        <li> <a href="#">Seller account</a> </li>
                        <li> <a href="#">Amazon Web Services</a> </li>
                        <li> <a href="#">Login with Amazon</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="account-box">
                  <div class="service-box">
                    <div class="service-desc">
                      <h4>Shopping programs and rentals</h4>
                      <ul>
                        <li> <a href="#">Subscribe &amp; Save</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- End My Account -->

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
  <?php if (isset($productS)) { ?>
    <div id="update-form" class="modal x-display">
      <div class="modal-content">
        <span id="edit-close" class="close">&times;</span>
        <div>
          <h1>View your order</h1>
        </div>
        <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
          <thead>
            <tr>
              <th>Date</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Total</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($productS as $row) { ?>
              <tr>
                <th><?= $row['billDate'] ?></th>
                <th><?= $row['billAddress'] ?></th>
                <th><?= $row['billPhone'] ?></th>
                <th><?= number_format($row['subtotal']) ?></th>
                <td>
                  <form method="post">
                    <input type="hidden" name="bill_Id" value="<?= $row['bill_Id'] ?>">
                    <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php  } ?>

  <!-- Start Footer  -->
  <?php include 'modules/footer.php' ?>
  <!-- End copyright  -->

  <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

  <!-- ALL JS FILES -->
  <script>
    function show_upload() {
      document.querySelector('.upload_pro').classList.toggle('hidden')
    }
    var updateForm = document.getElementById("update-form");
    var editClose = document.getElementById("edit-close");

    if (updateForm) {
      editClose.onclick = function() {
        updateForm.classList.add("x-hide-display");
        updateForm.classList.remove("x-display");
      }
    }
  </script>
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