<?php
require 'connect.php';
Session::checkSession();

if (isset($_POST['submit'])) {
  $pname = $_POST['pname'];
  $pcate = $_POST['pcate'];
  $pquan = $_POST['pquan'];
  $pprice = $_POST['pprice'];

  $pimg = $_FILES['pimg']['name'];
  $target_dir = "img/Coffee/";
  $target_file = $target_dir . basename($pimg);
  $pimg_tmp = $_FILES['pimg']['tmp_name'];

  $pdetail = $_POST['pdetail'];

  $tbl_product = DB::table("tbl_product")->insert([
    'productName' => "$pname",
    'brandId' => "$pcate",
    'productPrice' => "$pprice",
    'productCurrentstatus' => "$pquan",
    'productImage' => "$pimg",
    'productDescription' => "$pdetail"
  ]);
  move_uploaded_file($pimg_tmp, $target_file);
}

$tbl_product = DB::table("tbl_product")->get();
$tbl_brand = DB::table('tbl_brand')->get();

// if (isset($_POST['delete'])) {
//   $productId = DB::table("tbl_product")->delete();
// }

$productS = null;
if (isset($_POST['update'])) {
  $productId = $_POST['productId'];
  $productS = DB::table('tbl_product')->find('productId', $productId);
  // var_dump($productS);
}

if (isset($_POST['change'])) {
  $productId = $_POST['productId'];
  $productName = $_POST['productName'];

  $productImage = $_POST['productImage'];
  
  $productPrice = $_POST['productPrice'];
  $productCurrentstatus = $_POST['productCurrentstatus'];
  $productDescription = $_POST['productDescription'];

  DB::table("tbl_product")->where('productId', $productId)->update([
    'productName' => $productName,
    'productImage' => $productImage,
    'productPrice' => $productPrice,
    'productCurrentstatus' => $productCurrentstatus,
    'productDescription' => $productDescription
  ]);
  header('Location: uploadproduct.php');
}

if (isset($_POST['delete'])) {
  $productId = $_POST['productId'];
  DB::table('tbl_product')->where('productId', $productId)->delete();
  header('Location: uploadproduct.php');
}

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">


<head>
  <?php require 'modules/head.php' ?>
  <title>ADMIN | Products</title>

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
    <div class="text"><span><i class="far fa-folder-open"></i> Products</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Brand</th>
                  <th>Current status</th>
                  <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_product as $row) { ?>
                  <tr>
                    <td><?= $row["productName"] ?></td>
                    <td><img width="100px" src="img/Coffee/<?= $row["productImage"] ?>" alt=""></td>
                    <td><?= number_format($row["productPrice"], 0, '', ',') ?></td>
                    <td><?= $row["productDescription"] ?></td>
                    <td><?= $row["brandID"] ?></td>
                    <td><b><?= $row["productCurrentstatus"] ?></b></td>
                    <td>
                      <form id="<?= $row['productId'] ?>" method="POST">
                        <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
                        <button style="background-color: #fff; border: none;" type="button" name="delete" onclick="confirmDelete(this, '<?= $row['productId'] ?>');"><i class="fas fa-trash-alt"></i></button>
                        <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            There are currently <?= DB::table('tbl_product')->count() ?> products
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
              <input type="hidden" name="productId" value="<?= $productS['productId'] ?>">
              <div class="form-item">
                <p>Product name</p>
                <input type="text" name="productName" value="<?= $productS['productName'] ?>">
              </div>
              <div class="form-item">
                <p>Product image</p>
                <input type="file" name="productImage" value="<?= $productS['productImage'] ?>">
              </div>
              <div class="form-item">
                <p>Product price</p>
                <input type="number" name="productPrice" min="1000" value="<?= $productS['productPrice'] ?>">
              </div>
              <div class="form-item">
                <p>Current status</p>
                <input type="text" name="productCurrentstatus" value="<?= $productS['productCurrentstatus'] ?>">
              </div>
              <br />
              <div class="form-item">
                <p>Description</p>
                <input type="text" name="productDescription" value="<?= $productS['productDescription'] ?>">
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
    <div class="text"><span onclick="showupload();"><i class="far fa-folder-open"></i> Upload Products</span></div>
    <div class="block pt-3 uploadpro hidden">
      <form action="" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
        <div class="text-left">
          <div class="form-group">
            <label for="pname">Product Name:</label>
            <input type="text" class="form-control" id="pname" placeholder="Enter name" name="pname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="pcate">Brand:</label>
            <select class="form-control" name="pcate" id="pcate">
              <<?php foreach ($tbl_brand as $row) { ?> 
                <option value="<?= $row['brandId'] ?>"><?= $row['brandName'] ?></option>
              <?php } ?>
            </select>
            <!-- <input type="text" class="form-control" id="pcate" placeholder="Enter category" name="pcate" required> -->
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="pprice">Price:</label>
            <input type="number" class="form-control" id="pprice" name="pprice" min="1000" value="1000" required>
            <!-- <input type="text" class="form-control" id="pcate" placeholder="Enter category" name="pcate" required> -->
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="pquan">Current status:</label>
            <select class="form-control" name="pquan" id="pquan">
              <option value=""></option>
              <option value="NEW">NEW</option>
              <option value="SALE">SALE</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="pimg">Image:</label>
            <input type="file" class="form-control-file border" id="pimg" placeholder="Enter image" name="pimg" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="editor">Description:</label>
            <textarea class="form-control" rows="5" id="editor" placeholder="Enter details" name="pdetail" required></textarea>
            <script>
              ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                  console.error(error);
                });
            </script>
            <!-- <textarea class="form-control" rows="5" id="pdetail" placeholder="Enter details" name="pdetail" required></textarea> -->
            <!-- <input type="text" class="form-control" id="pdetail" placeholder="Enter details" name="pdetail" required> -->
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->
  <script src="script/admin.js"></script>
  <script src="script/script.js"></script>
  <script src="script/validator.js"></script>
</body>

</html>