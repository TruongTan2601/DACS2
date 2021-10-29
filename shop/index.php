<?php require '../admin/connect.php';

$tbl_banner = DB::table('tbl_banner')->get();
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Site Metas -->
  <title>TRE COFFEE</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Site Icons -->
  <link rel="shortcut icon" href="images/logotre.jpg" type="image/x-icon">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Site CSS -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <?php include 'modules/header.php' ?>

  <!-- Start Slider -->
  <div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
      <?php foreach($tbl_banner as $row) { ?>
      <li class="text-center">
        <img src="images/Banner/<?= $row['bannerImage'] ?>" alt="">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20"><strong>Welcome To <br> TRE COFFEE</strong></h1>
              <p class="m-b-40"><?= $row['bannerDescription'] ?></p>
              <p><a class="btn hvr-hover" href="#">Shop New</a></p>
            </div>
          </div>
        </div>
      </li>
      <?php } ?>
    </ul>
    <div class="slides-navigation">
      <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
      <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
  </div>
  <!-- End Slider -->

  <!-- Start Categories  -->
  <div class="categories-shop">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="shop-cat-box">
            <img class="img-fluid" src="images/coffee.jpg" alt="" />
            <a class="btn hvr-hover" href="#">Coffee</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="shop-cat-box">
            <img class="img-fluid" src="images/yogurt.jpg" alt="" />
            <a class="btn hvr-hover" href="#">Yogurt</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="shop-cat-box">
            <img class="img-fluid" src="images/juice.jpg" alt="" />
            <a class="btn hvr-hover" href="#">Juice</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Categories -->

  <div class="box-add-products">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="offer-box-products">
            <img class="img-fluid" src="images/add-img-01.jpg" alt="" />
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="offer-box-products">
            <img class="img-fluid" src="images/add-img-02.jpg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Products  -->
  <div class="products-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="title-all text-center">
            <h1>Fruits & Vegetables</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="special-menu text-center">
            <div class="button-group filter-button-group">
              <button class="active" data-filter="*">All</button>
              <button data-filter=".top-featured">Top featured</button>
              <button data-filter=".best-seller">Best seller</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row special-list">
        <div class="col-lg-3 col-md-6 special-grid best-seller">
          <div class="products-single fix">
            <div class="box-img-hover">
              <div class="type-lb">
                <p class="sale">Sale</p>
              </div>
              <img src="images/img-pro-01.jpg" class="img-fluid" alt="Image">
              <div class="mask-icon">
                <ul>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                </ul>
                <a class="cart" href="#">Add to Cart</a>
              </div>
            </div>
            <div class="why-text">
              <h4>Lorem ipsum dolor sit amet</h4>
              <h5> $7.79</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 special-grid top-featured">
          <div class="products-single fix">
            <div class="box-img-hover">
              <div class="type-lb">
                <p class="new">New</p>
              </div>
              <img src="images/img-pro-02.jpg" class="img-fluid" alt="Image">
              <div class="mask-icon">
                <ul>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                </ul>
                <a class="cart" href="#">Add to Cart</a>
              </div>
            </div>
            <div class="why-text">
              <h4>Lorem ipsum dolor sit amet</h4>
              <h5> $9.79</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 special-grid top-featured">
          <div class="products-single fix">
            <div class="box-img-hover">
              <div class="type-lb">
                <p class="sale">Sale</p>
              </div>
              <img src="images/img-pro-03.jpg" class="img-fluid" alt="Image">
              <div class="mask-icon">
                <ul>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                </ul>
                <a class="cart" href="#">Add to Cart</a>
              </div>
            </div>
            <div class="why-text">
              <h4>Lorem ipsum dolor sit amet</h4>
              <h5> $10.79</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 special-grid best-seller">
          <div class="products-single fix">
            <div class="box-img-hover">
              <div class="type-lb">
                <p class="sale">Sale</p>
              </div>
              <img src="images/img-pro-04.jpg" class="img-fluid" alt="Image">
              <div class="mask-icon">
                <ul>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                </ul>
                <a class="cart" href="#">Add to Cart</a>
              </div>
            </div>
            <div class="why-text">
              <h4>Lorem ipsum dolor sit amet</h4>
              <h5> $15.79</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Products  -->

  <!-- Start Blog  -->
  <div class="latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="title-all text-center">
            <h1>latest blog</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="blog-box">
            <div class="blog-img">
              <img class="img-fluid" src="images/blog-img.jpg" alt="" />
            </div>
            <div class="blog-content">
              <div class="title-blog">
                <h3>Fusce in augue non nisi fringilla</h3>
                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
              </div>
              <ul class="option-blog">
                <li><a href="#"><i class="far fa-heart"></i></a></li>
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="far fa-comments"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="blog-box">
            <div class="blog-img">
              <img class="img-fluid" src="images/blog-img-01.jpg" alt="" />
            </div>
            <div class="blog-content">
              <div class="title-blog">
                <h3>Fusce in augue non nisi fringilla</h3>
                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
              </div>
              <ul class="option-blog">
                <li><a href="#"><i class="far fa-heart"></i></a></li>
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="far fa-comments"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="blog-box">
            <div class="blog-img">
              <img class="img-fluid" src="images/blog-img-02.jpg" alt="" />
            </div>
            <div class="blog-content">
              <div class="title-blog">
                <h3>Fusce in augue non nisi fringilla</h3>
                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
              </div>
              <ul class="option-blog">
                <li><a href="#"><i class="far fa-heart"></i></a></li>
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="far fa-comments"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog  -->


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