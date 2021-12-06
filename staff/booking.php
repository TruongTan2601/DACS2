<?php
require '../admin/connect.php';
Session::checkSessionStaff();
$tbl_reservation =  DB::table('tbl_reservations')->where('check_seen', 0)->get();
$tbl_reservations = DB::table('tbl_reservations')->where('check_seen', 1)->get();

$productS = null;
if (isset($_POST['accept'])) {
  $productId = $_POST['bill_Id'];
  $productS = DB::table('tbl_reservations')->find('Id', $productId);
}

require '../admin/includes/Exception.php';
require '../admin/includes/PHPMailer.php';
require '../admin/includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer();
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $content = $_POST['content'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $picture = $_POST['picture'];

  // var_dump($content);
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = "true";
  $mail->SMTPSecure = "tls";
  $mail->Port = "587";
  $mail->Username = "truongtannauan@gmail.com";
  $mail->Password = "q0942233975";
  $mail->Subject = $content;
  $mail->setFrom($email);
  $mail->isHTML(true);
  $mail->addAttachment($picture);
  $mail->Body = $message;
  $mail->addAddress($email);

  if ($mail->Send()) {
    echo '<script>
    alert("Email send ...");
  </script>';
    DB::table('tbl_reservations')->where('Id', $id)->update(['check_seen' => 1]);
  } else {
    echo "Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  }

  $mail->smtpClose();
}

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require '../admin/modules/head.php' ?>
  <title>ADMIN | Booking</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
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

<body>
  <div class="page-container">
    <?php require 'modules/sidebar.php' ?>
    <div class="main-content">
      <?php require './modules/headarea.php' ?>
      <section class="home-section">
        <div class="text"><span><i class="fas fa-couch"></i> New Booking</span></div>
        <div class="block">
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Date</th>
                      <th>Hour</th>
                      <th>People</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($tbl_reservation as $row) { ?>
                      <tr>
                        <td><?= $row['reservationName'] ?></td>
                        <td><?= $row['reservationPhone'] ?></td>
                        <td><?= $row['reservationEmail'] ?></td>
                        <td><?= $row['reservationDate'] ?></td>
                        <td><?= $row['reservationHour'] ?></td>
                        <td><?= $row['reservationPeople'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['Id'] ?>">
                            <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                            <button style="background-color: #fff; border: none;" type="submit" name="accept"><i class="fas fa-check"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                There are currently <b><?= DB::table('tbl_reservations')->where('check_seen', 0)->count() ?></b> bookings.
              </div>
            </div>
          </div>
        </div>
        <?php if (isset($productS)) { ?>
          <div id="update-form" class="modal x-display">
            <div class="modal-content">
              <span id="edit-close" class="close">&times;</span>
              <div class="col-md-12" id="form_container">
                <h2>Form</h2>
                <p>
                  Please send your message below. We will get back to you at the earliest!
                </p>
                <form role="form" method="post" id="reused_form">
                  <input type="hidden" name="id" value="<?= $productS['Id'] ?>">
                  <div class="row">
                    <div class="col-sm-6 form-group">
                      <label for="name">
                        Content:</label>
                      <input type="text" class="form-control" id="name" name="content" value="<?= $productS['reservationName'] ?>" required>
                    </div>
                    <div class="col-sm-6 form-group">
                      <label for="email">
                        Sent to email:</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?= $productS['reservationEmail'] ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 form-group">
                      <label for="message">
                        Message:</label>
                      <textarea class="form-control" type="textarea" name="message" id="message" maxlength="6000" rows="7"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 form-group">
                      <input type="file" class="form-control" name="picture" id="file">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 form-group">
                      <button type="submit" class="btn btn-lg btn-default pull-right" name="submit" style="border: 1px solid">Send →</button>
                    </div>
                  </div>

                </form>
                <div id="success_message" style="width:100%; height:100%; display:none; ">
                  <h3>Posted your message successfully!</h3>
                </div>
                <div id="error_message" style="width:100%; height:100%; display:none; ">
                  <h3>Error</h3>
                  Sorry there was an error sending your form.

                </div>
              </div>
            </div>
          </div>
        <?php  } ?>
        <div class="text"><span><i class="fas fa-couch"></i> Manager Booking</span></div>
        <div class="block">
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Date</th>
                      <th>Hour</th>
                      <th>People</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($tbl_reservations as $row) { ?>
                      <tr>
                        <td><?= $row['reservationName'] ?></td>
                        <td><?= $row['reservationPhone'] ?></td>
                        <td><?= $row['reservationEmail'] ?></td>
                        <td><?= $row['reservationDate'] ?></td>
                        <td><?= $row['reservationHour'] ?></td>
                        <td><?= $row['reservationPeople'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['Id'] ?>">
                            <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                There are currently <b><?= DB::table('tbl_reservations')->where('check_seen', 1)->count() ?></b> booking.
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <script src="../admin/script/script.js"></script>
  <script src="../admin/script/admin.js"></script>
  <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
  <!-- bootstrap 4 js -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.slicknav.min.js"></script>

  <!-- others plugins -->
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>

</html>