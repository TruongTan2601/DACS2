<?php
require 'connect.php';
Session::checkSession();

$tbl_banner = DB::table('tbl_banner')->get();

$productS = null;
if (isset($_POST['update'])) {
  $productId = $_POST['bannerId'];
  $productS = DB::table('tbl_banner')->find('bannerId', $productId);
  // var_dump($productS);
}

if (isset($_POST['change'])) {
  $productId = $_POST['bannerId'];
  $productName = $_POST['bannerName'];
  $productImage = $_POST['bannerImage'];
  $productDescription = $_POST['bannerDescription'];

  $tbl_product_update = DB::table("tbl_banner")->where('bannerId', $productId)->update([
    'bannerName' => $productName,
    'bannerImage' => $productImage,
    'bannerDescription' => $productDescription
  ]);
  header('Location: image.php');
}

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
<?php require 'modules/head.php' ?>
<title>ADMIN | Image</title>
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
      width: 25%;
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

    .update-form button {
      width: 50%;
      display: block;
      margin-left: auto;
      margin-right: auto;
      height: 30px;
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
  </style>
</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><span onclick="showupload();"><i class="fab fa-audible"></i> Banner </span></div>
    <div class="block pt-3 uploadpro hidden">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_banner as $row) { ?>
                  <tr>
                    <td><?= $row["bannerName"] ?></td>
                    <td><img width="100px" src="img/Banner/<?= $row["bannerImage"] ?>" alt=""></td>
                    <td><?= $row["bannerDescription"] ?></td>
                    <td>
                      <form id="<?= $row['bannerId'] ?>" method="POST">
                        <input type="hidden" name="bannerId" value="<?= $row['bannerId'] ?>">
                        <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                      </form>
                    </td>
                  </tr> 
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php if (isset($productS)) { ?>
      <div id="update-form" class="modal x-display">
        <div class="modal-content">
          <span id="edit-close" class="close">&times;</span>
          <div>
            <h1>Cập nhật thông tin</h1>
          </div>
          <div class="update-form">
            <form method="POST">
              <input type="hidden" name="bannerId" value="<?= $productS['bannerId'] ?>">
              <div class="form-item">
                <p>Product name</p>
                <input type="text" name="bannerName" value="<?= $productS['bannerName'] ?>">
              </div>
              <div class="form-item">
                <p>Product image</p>
                <input type="file" name="bannerImage" value="<?= $productS['bannerImage'] ?>">
              </div>
              <br />
              <div class="form-item">
                <p>Description</p>
                <input type="text" name="bannerDescription" value="<?= $productS['bannerDescription'] ?>">
              </div>
              <br />
              <div class="form-item">
                <button type="submit" name="change">Sửa</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php  } ?>
  </section>
  <section class="home-section">
    <div class="text"><span onclick="show_instagram();"><i class="fab fa-instagram"></i></i> Image Instagram </span></div>
    <div class="block pt-3 show_instagram hidden">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th> 
                  <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_banner as $row) { ?>
                  <tr>
                    <td><?= $row["bannerName"] ?></td>
                    <td><img width="100px" src="img/Banner/<?= $row["bannerImage"] ?>" alt=""></td>
                    <td><?= $row["bannerDescription"] ?></td>
                    <td>
                      <form id="<?= $row['bannerId'] ?>" method="POST">
                        <input type="hidden" name="bannerId" value="<?= $row['bannerId'] ?>">
                        <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php if (isset($productS)) { ?>
      <div id="update-form" class="modal x-display">
        <div class="modal-content">
          <span id="edit-close" class="close">&times;</span>
          <div>
            <h1>Cập nhật thông tin</h1>
          </div>
          <div class="update-form">
            <form method="POST">
              <input type="hidden" name="bannerId" value="<?= $productS['bannerId'] ?>">
              <div class="form-item">
                <p>Product name</p>
                <input type="text" name="bannerName" value="<?= $productS['bannerName'] ?>">
              </div>
              <div class="form-item">
                <p>Product image</p>
                <input type="file" name="bannerImage" value="<?= $productS['bannerImage'] ?>">
              </div>
              <br />
              <div class="form-item">
                <p>Description</p>
                <input type="text" name="bannerDescription" value="<?= $productS['bannerDescription'] ?>">
              </div>
              <br />
              <div class="form-item">
                <button type="submit" name="change">Sửa</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php  } ?>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <script src="script/script.js"></script>
  <script src="script/admin.js"></script>
</body>

</html>