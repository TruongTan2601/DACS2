<?php
require 'connect.php';
Session::checkSession();

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $search_product = DB::table('tbl_product')->where('productName', 'like', "%$search%")->get();
  $search_blogs = DB::table('tbl_blogs')->where('blogName', 'like', "%$search%")->get();
  $search_booking = DB::table('tbl_reservations')->where('reservationName', 'like', "%$search%")->get();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require 'modules/head.php' ?>
  <title>Search</title>
</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <div class="shop-detail-box-main">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12" style="padding-bottom: 10px;">
          <h2>Search results all with keyword <b><?= $search ?></b> : </h2>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <h1>Products</h1>
          <thead>
            <tr>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Description</th>
              <th>Brand</th>
              <th>Current status</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($search_product as $row) { ?>
              <tr>
                <td><?= $row["productName"] ?></td>
                <td><img width="100px" src="img/Coffee/<?= $row["productImage"] ?>" alt=""></td>
                <td><?= number_format($row["productPrice"], 0, '', ',') ?></td>
                <td><?= $row["productDescription"] ?></td>
                <td><?= $row["brandID"] ?></td>
                <td><b><?= $row["productCurrentstatus"] ?></b></td>
                <td>
                  <form id="<?= $row['productId'] ?>" action="uploadproduct.php" method="POST">
                    <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
                    <button style="background-color: #fff; border: none;" type="button" name="delete" onclick="confirmDelete(this, '<?= $row['productId'] ?>');"><i class="fas fa-trash-alt"></i></button>
                    <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <h1>Blogs</h1>
          <thead>
            <tr>
              <th>Title</th>
              <th>Image</th>
              <th>Demo</th>
              <th>Description</th>
              <th>Date Upload</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($search_blogs as $row) { ?>
              <tr>
                <td><?= $row["blogName"] ?></td>
                <td><img width="100px" src="img/Blogs/<?= $row["blogImage"] ?>" alt=""></td>
                <td><?= $row["blogDemo"] ?></td>
                <td><?= $row["blogDescription"] ?></td>
                <td><b><?= $row["blogUpDate"] ?></b></td>
                <td>
                  <form id="<?= $row['blogId'] ?>" action="blogs.php" method="POST">
                    <input type="hidden" name="productId" value="<?= $row['blogId'] ?>">
                    <button style="background-color: #fff; border: none;" type="button" name="delete" onclick="confirmDelete(this, '<?= $row['blogId'] ?>');"><i class="fas fa-trash-alt"></i></button>
                    <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <h1>Booking</h1>
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
            <?php foreach ($search_booking as $row) { ?>
              <tr>
                <td><?= $row['reservationName'] ?></td>
                <td><?= $row['reservationPhone'] ?></td>
                <td><?= $row['reservationEmail'] ?></td>
                <td><?= $row['reservationDate'] ?></td>
                <td><?= $row['reservationHour'] ?></td>
                <td><?= $row['reservationPeople'] ?></td>
                <td>
                  <form method="post" action="">
                    <input type="hidden" name="bill_Id" value="<?= $row['Id'] ?>">
                    <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                    <button style="background-color: #fff; border: none;" type="submit" name="accept"><i class="fas fa-check"></i></button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>