<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php include_once 'modules/head.php' ?>
  <style>
    .x-display-hide {
      display: block;
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
      background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 100px auto;
      padding: 20px;
      border: 1px solid #888;
      width: 20%;
    }
  </style>
</head>

<?php
$user = Session::get("userUser");
$login_check = null;

$today = date('d') . '-' . date('m') . '-' . date('Y') . ' ' . date("h:i:sa");

if (isset($user) && $user) {
  header('Location: my-account.php');
} else {
  if (isset($_POST['login'])) {
    try {
      $user = $_POST['userUser'];
      $pass = $_POST['userPass'];

      if (empty($user) || empty($pass)) {
        $login_check = "Invalid user or password";
      } else {
        $pass = md5($pass);
        $user = DB::table('tbl_user')->where('userUser', $user)->where('userPass', $pass)->first('userUser', 'userPass', 'userId', 'userName', 'userEmail', 'userPhone', 'userAddress', 'userAvatar');
        if (!$user) throw new PDOException('No result');
        Session::set('userUser', $user);
        header('Location: my-account.php');
        exit();
      }
    } catch (PDOException $th) {
      $login_check = "Invalid user or password";
    }
  }
}

if (isset($_POST['register'])) {
  try {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    if ($username == 'admin') {
      $c = 'The account name cannot be used: ' . $username;
    } else {
      // $r = DB::table('tbl_user')->where('userEmail', $email)->orWhere('userUser', $username);
      $conn = new PDO("mysql:host=localhost;dbname=web_mvc", 'root', '');

      $sql = "SELECT * FROM tbl_user WHERE userEmail = '$email' OR userUser = '$username'";

      $result = $conn->query($sql);

      if ($result->fetchColumn() > 0) {
        $c = 'Email or username already exists !!!';
      } else {
        DB::table('tbl_user')->insert([
          'userName' => $name,
          'userEmail' => $email,
          'userUser' => $username,
          'userPass' => $pass,
          'userStartdate' => $today
        ]);
        echo '<script>alert("Sign Up Success!!");window.location="login.php";</script>';
      }
    }
  } catch (PDOException $th) {
    $login_check = "Invalid user or password";
  }
}

?>

<body>
  <script src="js/sweetalert.min.js">

  </script>
  <?php include_once 'modules/header.php' ?>
  <?php
  if (isset($_POST['forgot'])) {
    echo '<script>
    swal("Please fill in your email information:", {
      content: "input",
    })
    .then((value) => {
      swal("Success!", `Password has been updated in email: ${value}!`, "success");
      ';
    $gmail = '`${value}`';
    echo '
    });
    </script>';
    var_dump($gmail);
  }
  ?>
  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Account</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="my-account.php">Account</a></li>
            <li class="breadcrumb-item active">Login</li>
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
            <button onclick="testPromptDialog()" class="btn hvr-hover">Forgot password</button>
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
          <form class="mt-3 collapse review-form-box" id="formRegister" method="post">
            <input type="hidden" name="date" value="<?= $today ?>">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="InputName" class="mb-0">Full Name</label>
                <input type="text" class="form-control" id="InputName" name="name" placeholder="Full Name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="InputLastname" class="mb-0">User Name</label>
                <input type="text" class="form-control" id="InputLast_name" name="username" placeholder="User Name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="InputEmail1" class="mb-0">Email Address</label>
                <input type="email" class="form-control" id="InputEmail1" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group col-md-6">
                <label for="InputPassword1" class="mb-0">Password</label>
                <input type="password" class="form-control" id="InputPassword1" name="pass" placeholder="Password" required>
              </div>
            </div>
            <button type="submit" name="register" class="btn hvr-hover">Register</button>
          </form>
          <span style="color: red;">
            <?php
            if (isset($c)) {
              echo $c;
            }
            ?>
          </span>
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
  <script>
    var getId = document.getElementById("show_form");
    var editClose = document.getElementById("edit-close");
    if (getId) {
      editClose.onclick() = function() {
        getId.classList.add("x-display-hide");
        getId.classList.remove("x-display");
      }
    }

    function testPromptDialog() {

      var result = prompt("Enter your email:", "@gmail.com");

      if (result != null) {
        var conf = confirm("Your email is " + result);
        if (conf) {
          alert("OK Next lesson!");
        } else {
          alert("Bye!");
        }
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