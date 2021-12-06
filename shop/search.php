<?php
require '../admin/connect.php';

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $search_product = DB::table('tbl_product')->where('productName', 'like', "%$search%")->get();
  $search_blogs = DB::table('tbl_blogs')->where('blogName', 'like', "%$search%")->get();
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>
  <style>
    .search_out {
      border-bottom: 1px dashed;
    }

    .search_out h3{
      padding-top: 10px;
      font-size: 16px;
    }

    .date_post {
      font-size: 12px;
    }
  </style>
</head>

<body>
  <?php include 'modules/header.php' ?>

  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Search Results</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Web </a></li>
            <li class="breadcrumb-item active">Search Results </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Shop Detail  -->
  <div class="shop-detail-box-main">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12" style="padding-bottom: 10px;">
          <h2>Search results all with keyword <b><?= $search ?></b> : </h2>
        </div>
        <?php foreach($search_product as $row) { ?>
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="search_out">
            <h3><b>[Product] 
              <a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row['productName'] ?></a></b> <span class="date_post">(12:30, 22/07/2021)</span>
            </h3>
            <div class="short"><?= $row['productDescription'] ?></div>
            <br>
          </div>
        </div>
        <?php } ?>
        <?php foreach($search_blogs as $row) { ?>
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="search_out">
            <h3><b>[Blogs] 
              <a href="blog-detail.php?id=<?= $row['blogId'] ?>"><?= $row['blogName'] ?></a></b> <span class="date_post"><?= $row['blogUpDate'] ?></span>
            </h3>
            <div class="short"><?= $row['blogDemo'] ?></div>
            <br>
          </div>
        </div>
        <?php } ?>
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