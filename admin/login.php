<?php
require './connect.php';
$user = Session::get("adminUser");
$login_check = null;

if (isset($user)) {
  header("Location: index.php");
} else {
  if (isset($_POST['login'])) {
    try {
      $user = $_POST['adminUser'];
      $pass = $_POST['adminPass'];

      if (empty($user) || empty($pass)) {
        $login_check = "Invalid user or password";
        // echo '<script>alert("Invalid user or password");</script>';
      } else {
        $pass =  md5($pass);
        $user = DB::table("tbl_admin")->where("adminUser", $user)->where("adminPass", $pass)->first("adminUser", "adminEmail");

        if (!$user) throw new PDOException("No result");
        Session::set("adminUser", $user);

        header("Location: index.php");
      } 
    } catch (PDOException $th) {
      // echo $th->getMessage(); 
      $login_check = "Invalid user or password";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="img/logotre.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>

<body>
  <img class="wave" src="img/wave.png" alt="">
  <div class="container">
    <div class="img">
      <img src="img/2.svg" alt="">
    </div>
    <div class="login-container">
      <form method="POST">
        <img class="avatar" src="img/avatar.svg" alt="">
        <h2>Welcome</h2>
        <span>
          <?php

          if (isset($login_check)) {
            echo $login_check;
          }

          ?>
        </span>
        <div class="input-div one ">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div>
            <h5>Username</h5>
            <input type="text" class="input" name="adminUser">
          </div>
        </div>
        <div class="input-div two ">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div>
            <h5>Password</h5>
            <input type="password" class="input" name="adminPass">
          </div>
        </div>
        <a href="#">Forgot Password?</a>
        <input type="submit" class="btn" name="login" value="Login">
      </form>
    </div>
  </div>
  <script type="text/javascript" src="script/main.js"></script>
</body>

</html>