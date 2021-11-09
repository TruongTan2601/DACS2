<?php
require '../admin/connect.php';
$login_check = null;

if (isset($user)) {
  header('Location: my-account.php');
} else {
  if (isset($_POST['login'])) {
    try {
      $user = $_POST['userUser'];
      $pass = $_POST['userPass']; 
      if(empty($user) || empty($pass)){
        $login_check = "Invalid user or password";
      }else {
        $pass = md5($pass);
        $user = DB::table('tbl_user')->where('userUser',$user)->where('userPass',$pass)->first('userUser','userPass');
        if(!$user) throw new PDOException('No result');
        Session::set('userUSer',$user);

        header('Location: my-account.php');
      }
    } catch (PDOException $th) {
      $login_check = "Invalid user or password";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>
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
            <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
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
      <div class="row new-account-login">
        <div class="col-sm-6 col-lg-6 mb-3">
          <div class="title-left">
            <h3>Account Login</h3>
          </div>
          <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
          <form class="mt-3 collapse review-form-box" id="formLogin" method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="InputEmail" class="mb-0">Email Address</label>
                <input type="text" class="form-control" id="InputEmail" name="userUser" placeholder="Enter Email">
              </div>
              <div class="form-group col-md-6">
                <label for="InputPassword" class="mb-0">Password</label>
                <input type="password" class="form-control" id="InputPassword" name="userPass" placeholder="Password">
              </div>
            </div>
            <button type="submit" name="login" class="btn hvr-hover">Login</button>
          </form>
          <span style="color: red;">
              <?php
              if (isset($login_check)) {
                echo $login_check;
              }
              ?>
            </span>
        </div>
        <div class="col-sm-6 col-lg-6 mb-3">
          <div class="title-left">
            <h3>Create New Account</h3>
          </div>
          <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
          <form class="mt-3 collapse review-form-box" id="formRegister">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="InputName" class="mb-0">First Name</label>
                <input type="text" class="form-control" id="InputName" placeholder="First Name">
              </div>
              <div class="form-group col-md-6">
                <label for="InputLastname" class="mb-0">Last Name</label>
                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name">
              </div>
              <div class="form-group col-md-6">
                <label for="InputEmail1" class="mb-0">Email Address</label>
                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
              </div>
              <div class="form-group col-md-6">
                <label for="InputPassword1" class="mb-0">Password</label>
                <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
              </div>
            </div>
            <button type="submit" class="btn hvr-hover">Register</button>
          </form>
        </div>
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