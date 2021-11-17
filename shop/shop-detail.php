<?php
require '../admin/connect.php';
$productId = $_GET['id'];
$tbl_product = DB::table('tbl_product')->find('productId', $productId);
// var_dump($tbl_product);
$today = date('d') . '-' . date('m') . '-' . date('Y') . ' ' . date("h:i:sa");
if (isset($_POST['submit'])) {
  $ids = $_POST['id'];
  $avt = $_POST['avt'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  DB::table('commentproduct')->insert([
    'userId' => $ids,
    'userAvatar' => $avt,
    'commentDate' => $today,
    'userName' => $name,
    'commentContent' => $comment,
    'productId' => $productId
  ]);
}
$stmt = DB::table('commentproduct')->limit(3)->orderBy('commentId','DESC')->where('productId', $productId)->get();

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>

</head>

<body>
  <?php include 'modules/header.php' ?>

  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Shop Detail</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
            <li class="breadcrumb-item active">Shop Detail </li>
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
        <form style="display: contents;" action="shop.php" method="POST">
          <input type="hidden" name="productId" value="<?= $tbl_product['productId'] ?>">
          <input type="hidden" name="productName" value="<?= $tbl_product['productName'] ?>">
          <input type="hidden" name="productPrice" value="<?= $tbl_product['productPrice'] ?>">
          <input type="hidden" name="productImage" value="<?= $tbl_product['productImage'] ?>">
          <!-- <input type="hidden" name="productQuantity" value="1"> -->
          <div class="col-xl-5 col-lg-5 col-md-6">
            <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
              <div class="carousel-inner" style="padding-bottom: 10px;" role="listbox">
                <div class="carousel-item active"> <img class="d-block w-100" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" alt="First slide"> </div>
                <div class="carousel-item"> <img class="d-block w-100" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" alt="Second slide"> </div>
                <div class="carousel-item"> <img class="d-block w-100" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" alt="Third slide"> </div>
              </div>
              <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
              </a>
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                  <img class="d-block w-100 img-fluid" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" />
                </li>
                <li data-target="#carousel-example-1" data-slide-to="1">
                  <img class="d-block w-100 img-fluid" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" />
                </li>
                <li data-target="#carousel-example-1" data-slide-to="2">
                  <img class="d-block w-100 img-fluid" src="../admin/img/Coffee/<?= $tbl_product['productImage'] ?>" />
                </li>
              </ol>
            </div>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-6">
            <div class="single-product-details">
              <h2><?= $tbl_product['productName'] ?></h2>
              <h5> <?= number_format($tbl_product["productPrice"], 0, '', ',') ?> VNĐ</h5>
              <!-- <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span> -->
              <p>
              <h4>Short Description:</h4>
              <p><?= $tbl_product['productDescription'] ?></p>
              <ul>
                <li>
                  <div class="form-group quantity-box">
                    <label class="control-label">Quantity</label>
                    <input class="form-control" value="1" min="0" max="30" type="number" name="productQuantity">
                  </div>
                </li>
              </ul>

              <div class="price-box-bar">
                <div class="cart-and-bay-btn">
                  <!-- <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a> -->
                  <input class="btn hvr-hover" name="add_cart" type="submit" value="Add to Cart">
                  <!-- <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a> -->
                </div>
              </div>

              <div class="add-to-btn">
                <div class="add-comp">
                  <input class="btn hvr-hover" name="add_wishlist" type="submit" value="Add to wishlist">
                  <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                </div>
                <div class="share-bar">
                  <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                  <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                  <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                  <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                  <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="row my-5">
        <?php if (isset($user['userId']) && $user['userId']) { ?>
          <div class="col-12">
            <div class="form-group">
              <form method="post">
                <input type="hidden" name="id" value="<?= $user['userId'] ?>">
                <input type="hidden" name="avt" value="<?= $user['userAvatar'] ?>">
                <input type="hidden" name="date" value="<?= $today ?>">
                <input type="hidden" name="name" value="<?= $user['userName'] ?>">
                <label for="comment">
                  <h2>Comment:</h2>
                  <h3><?= $user['userName'] ?></h3>
                </label>
                <textarea style="margin-bottom: 10px;" name="comment" class="form-control" rows="2" id="comment"></textarea>
                <input type="submit" class="btn btn-dark" name="submit" value="Comment">
              </form>
            </div>
          </div>
        <?php } ?>
        <div class="card card-outline-secondary col-12 my-4">
          <div class="card-header">
            <h2>Product Reviews</h2>
          </div>
          <div class="card-body">
            <?php foreach ($stmt as $row) { ?>
              <div class="media mb-3">
                <div class="mr-2">
                  <img class="rounded-circle border p-1" src="images/<?= $row['userAvatar'] ?>" width="70px" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                  <p><?= $row['commentContent'] ?></p>
                  <small class="text-muted">Posted by <?= $row['userName'] ?> on <?= $row['commentDate'] ?></small>
                </div>
              </div>
            <?php } ?>
            <hr>

            <a href="shop-detail.php?id=<?=$productId?>-6" class="btn hvr-hover">Leave a Review</a>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col-lg-12">
          <div class="title-all text-center">
            <h1>Featured Products</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
          </div>
          <div class="featured-products-box owl-carousel owl-theme">
            <?php foreach (DB::table('tbl_product')->get() as $row) { ?>
              <div class="item">
                <div class="products-single fix">
                  <div class="box-img-hover">
                    <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
                    <div class="mask-icon">
                      <ul>
                        <li><a href="shop-detail.php?id=<?= $row['productId'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                      </ul>
                      <input class="cart" name="add_cart" type="submit" value="Add to Cart">
                    </div>
                  </div>
                  <div class="why-text">
                    <h4><a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
                    <h5><?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ</h5>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
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