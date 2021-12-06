<?php
require 'connect.php';
Session::checkSession();

$coupon = DB::table('coupon')->get();
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $up_date = $_POST['up_date'];
  $end_date = $_POST['end_date'];
  $discount = $_POST['discount'];
  $content = $_POST['content'];
  DB::table('coupon')->insert([
    'couponName' => $name,
    'couponUpDate' => $up_date,
    'couponEndDate' => $end_date,
    'couponDiscount' => $discount,
    'couponContent' => $content,
  ]);
  echo '<script> alert("Upload Successfully!!"); window.location="coupon.php"; </script>';
}
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require 'modules/head.php' ?>
  <title>ADMIN | Order</title>

</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><span><i class="fa fa-tag fa-stack"></i>New Coupon</span></div>
    <div class="card mb-12">
      <div class="table-responsive">
        <form action="" method="post">
          <div class="text-left">
            <div class="form-group">
              <label for="name">Coupon Name: </label>
              <input class="form-control" type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
              <label for="up_date">Coupon Up Date: </label>
              <input class="form-control" type="date" name="up_date" id="up_date" required>
            </div>
            <div class="form-group">
              <label for="end_date">Coupon End Date: </label>
              <input class="form-control" type="date" name="end_date" id="end_date" required>
            </div>
            <div class="form-group">
              <label for="discount">Coupon Discount: </label>
              <input class="form-control" type="number" min="10" max="100" name="discount" id="discount" required>
            </div>
            <div class="form-group">
              <label for="content">Coupon Content: </label>
              <input class="form-control" type="text" name="content" id="content" required>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="text"><span><i class="fa fa-tag fa-stack"></i> Coupon</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Date Up</th>
                  <th>Date End</th>
                  <th>Discount</th>
                  <th>Content</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($coupon as $row) { ?>
                  <tr>
                    <td><?= $row['couponName'] ?></td>
                    <td><?= $row['couponUpDate'] ?></td>
                    <td><?= $row['couponEndDate'] ?></td>
                    <td><?= $row['couponDiscount'] ?></td>
                    <td><?= $row['couponContent'] ?></td>
                    <td>
                      <form method="post">
                        <input type="hidden" name="bill_Id" value="<?= $row['couponId'] ?>">
                        <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                      </form>
                    </td>
                  <?php } ?>
                  </tr>
              </tbody>
            </table>
            There are currently <?= DB::table('coupon')->count() ?> coupon.

          </div>
        </div>
      </div>
    </div>

  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <script src="script/script.js"></script>
  <script src="script/admin.js"></script>
</body>

</html>