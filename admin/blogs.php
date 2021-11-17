<?php
require 'connect.php';
Session::checkSession();

if (isset($_POST['submit'])) {
  $pname = $_POST['pname'];

  $pimg = $_FILES['pimg']['name'];
  $target_dir = "img/Blogs/";
  $target_file = $target_dir . basename($pimg);
  $pimg_tmp = $_FILES['pimg']['tmp_name'];

  $tmp_dir = $_FILES["upload-file"]["tmp_name"];
  $target_dir = "txt/";
  $target_file = $target_dir . basename($_FILES["upload-file"]["name"]);

  $pdetail = $_POST['pdetail'];

  $tbl_blogs = DB::table("tbl_blogs")->insert([
    'blogName' => "$pname",
    'blogDescription' => "$target_file",
    'blogImage' => "$pimg",
    'blogDemo' => "$pdetail"
  ]);
  move_uploaded_file($pimg_tmp, $target_file);
  move_uploaded_file($tmp_dir, $target_file);
}

$tbl_blogs = DB::table("tbl_blogs")->get();

// if (isset($_POST['delete'])) {
//   $productId = DB::table("tbl_product")->delete();
// }

$productS = null;
if (isset($_POST['update'])) {
  $productId = $_POST['productId'];
  $productS = DB::table('tbl_blogs')->find('blogId', $productId);
  // var_dump($productS);
}

if (isset($_POST['change'])) {
  $productId = $_POST['productId'];
  $productName = $_POST['productName'];
  $productImage = $_POST['productImage'];
  $productCurrentstatus = $_POST['productCurrentstatus'];
  $productDescription = $_POST['productDescription'];

  $tbl_blogs = DB::table("tbl_blogs")->where('blogId', $productId)->update([
    'blogName' => $productName,
    'blogImage' => $productImage,
    'blogDemo' => $productCurrentstatus,
    'blogDescription' => $productDescription
  ]);
  header('Location: blogs.php');
}

if (isset($_POST['delete'])) {
  $productId = $_POST['productId'];
  $delete = DB::table('tbl_blogs')->where('blogId', $productId)->delete();
  header('Location: blogs.php');
}

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">


<head>
<?php require 'modules/head.php' ?>
  <title>ADMIN | Blogs</title>

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
    <div class="text"><span><i class="far fa-folder-open"></i> Blogs</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
              <tfoot>
                <tr>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Demo</th>
                  <th>Description</th>
                  <th>Date Upload</th>
                  <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_blogs as $row) { ?>
                  <tr>
                    <td><?= $row["blogName"] ?></td>
                    <td><img width="100px" src="img/Blogs/<?= $row["blogImage"] ?>" alt=""></td>
                    <td><?= $row["blogDemo"] ?></td>
                    <td><?= $row["blogDescription"] ?></td>
                    <td><b><?= $row["blogUpDate"] ?></b></td>
                    <td>
                      <form id="<?= $row['blogId'] ?>" method="POST">
                        <input type="hidden" name="productId" value="<?= $row['blogId'] ?>">
                        <button style="background-color: #fff; border: none;" type="button" name="delete" onclick="confirmDelete(this, '<?= $row['blogId'] ?>');"><i class="fas fa-trash-alt"></i></button>
                        <button style="background-color: #fff; border: none;" type="submit" name="update"><i class="fas fa-user-cog"></i> </button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            There are currently <?= DB::table('tbl_blogs')->count() ?> posts.
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
              <input type="hidden" name="productId" value="<?= $productS['blogId'] ?>">
              <div class="form-item">
                <p>Blog name</p>
                <input type="text" name="productName" value="<?= $productS['blogName'] ?>">
              </div>
              <div class="form-item">
                <p>Blog image</p>
                <input type="file" name="productImage" value="<?= $productS['blogImage'] ?>" required>
              </div>
              <div class="form-item">
                <p>Demo</p>
                <input type="text" name="productCurrentstatus" value="<?= $productS['blogDemo'] ?>">
              </div>
              <br />
              <div class="form-item">
                <p>Description</p>
                <input type="file" name="productDescription" value="<?= $productS['blogDescription'] ?>" required>
              </div>
              <br />
              <div class="form-item">
                <button type="submit" name="change">Change</button>
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
            <label for="pname">Blog title:</label>
            <input type="text" class="form-control" id="pname" placeholder="Enter name" name="pname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <label for="upload-file">Demo: </label>
            <input type="file" class="form-control-file border" id="upload-file" placeholder="Enter file" name="upload-file" required>
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