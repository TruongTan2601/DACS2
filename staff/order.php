<?php
require '../admin/connect.php';
Session::checkSessionStaff();

$bill = DB::table('bill')->where('check_seen', 0)->get();
$bills = DB::table('bill')->where('check_seen', 1)->get();
$productS = null;
if (isset($_POST['view_detail'])) {
  $productId = $_POST['bill_Id'];
  $productS = DB::table('bill_details')->where('bill_Id', $productId)->get();
}

$productE = null;
if (isset($_POST['accept'])) {
  $productId = $_POST['bill_Id'];
  $productE = DB::table('bill')->find('bill_Id', $productId);
}

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $content = $_POST['content'];
  $email = $_POST['email'];
  DB::table('bill')->where('bill_Id', $id)->update(['check_seen' => 1]);
  echo '<script>window.location = "order.php" </script>';
}
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require '../admin/modules/head.php' ?>
  <title>ADMIN | Order</title>
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
        <div class="text"><span><i class="fas fa-shopping-cart"></i> New Orders</span></div>
        <div class="block">
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Date</th>
                      <th>Orders</th>
                      <th>Total</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Date</th>
                      <th>Orders</th>
                      <th>Total</th>
                      <th>Option</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($bill as $row) { ?>
                      <tr>
                        <td><?= $row['billName'] ?></td>
                        <td><?= $row['billAddress'] ?></td>
                        <td><?= $row['billPhone'] ?></td>
                        <td><?= $row['billDate'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['bill_Id'] ?>">
                            <button style="background-color: #fff; border: none;" type="submit" name="view_detail"><i class="far fa-eye"></i></button>
                          </form>
                        </td>
                        <td><?= $row['subtotal'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['bill_Id'] ?>">
                            <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                            <button style="background-color: #fff; border: none;" type="submit" name="accept"><i class="fas fa-check"></i></button>
                          </form>
                        </td>
                      <?php } ?>
                      </tr>
                  </tbody>
                </table>
                There are currently <?= DB::table('bill')->where('check_seen', 0)->count() ?> orders.

              </div>
            </div>
          </div>
        </div>
        <?php if (isset($productS)) { ?>
          <div id="update-form" class="modal x-display">
            <div class="modal-content">
              <span id="edit-close" class="close">&times;</span>
              <div>
                <h1>View Detail</h1>
              </div>
              <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Product Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($productS as $row) { ?>
                    <tr>
                      <th><?= $row['productName'] ?></th>
                      <th><?= $row['productQuantity'] ?></th>
                      <th><?= $row['productPrice'] ?></th>
                      <th><?= $row['total'] ?></th>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php  } ?>
        <?php if (isset($productE)) { ?>
          <div id="update-form" class="modal x-display">
            <div class="modal-content">
              <span id="edit-close" class="close">&times;</span>
              <div class="col-md-12" id="form_container">
                <h2>Form</h2>
                <p>
                  Please check name and phone number information!!
                </p>
                <form role="form" method="post" id="reused_form">
                  <input type="hidden" name="id" value="<?= $productE['bill_Id'] ?>">
                  <div class="row">
                    <div class="col-sm-6 form-group">
                      <label for="name">
                        Name: </label>
                      <input type="text" class="form-control" name="content" value="<?= $productE['billName'] ?>">
                    </div>
                    <div class="col-sm-6 form-group">
                      <label for="email">
                        Phone number: </label>
                      <input type="text" class="form-control" name="email" value="<?= $productE['billPhone'] ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 form-group">
                      <button type="submit" class="btn btn-lg btn-default pull-right" name="submit" style="border: 1px solid">Receive purchase order</button>
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
        <div class="text"><span><i class="fas fa-shopping-cart"></i> Manager Orders</span></div>
        <div class="block">
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Date</th>
                      <th>Orders</th>
                      <th>Total</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($bills as $row) { ?>
                      <tr>
                        <td><?= $row['billName'] ?></td>
                        <td><?= $row['billAddress'] ?></td>
                        <td><?= $row['billPhone'] ?></td>
                        <td><?= $row['billDate'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['bill_Id'] ?>">
                            <button style="background-color: #fff; border: none;" type="submit" name="view_detail"><i class="far fa-eye"></i></button>
                          </form>
                        </td>
                        <td><?= $row['subtotal'] ?></td>
                        <td>
                          <form method="post">
                            <input type="hidden" name="bill_Id" value="<?= $row['bill_Id'] ?>">
                            <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                          </form>
                        </td>
                      <?php } ?>
                      </tr>
                  </tbody>
                </table>
                There are currently <?= DB::table('bill')->where('check_seen', 1)->count() ?> orders.

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