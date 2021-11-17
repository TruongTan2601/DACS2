<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>

</head>

<?php
$tbl_product = DB::table('tbl_product')->orderBy('productPrice')->get();
$i = DB::table('tbl_product')->count();
$tbl_img_ig = DB::table('tbl_img_ig')->get();

$user = Session::get("userUser");

if (isset($_POST['add_cart'])) {
  if (isset($user) && $user) {
    $productId = $_POST['productId'];
    $productImage = $_POST['productImage'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];


    $item = DB::table('cart')->where('productId', $productId)->where('userId', $user['userId'])->first();

    if (isset($item['cartQuantity']) && $item['cartQuantity']) {
      $Quantity = $item['cartQuantity'] + $productQuantity;
      DB::table('cart')->where('productId', $productId)->where('userId', $user['userId'])->update(['cartQuantity' => $Quantity]);
    } else {
      DB::table('cart')->insert([
        'productId' => $productId,
        'cartName' => $productName,
        'cartImage' => $productImage,
        'cartPrice' => $productPrice,
        'cartQuantity' => $productQuantity,
        'userId' => $user['userId']
      ]);
    }
    echo '<script> window.location = "shop.php" </script>';
  } else {
    header('Location: login.php');
  }
}
if (isset($_POST['add_wishlist'])) {
  if (isset($user) && $user) {
    $productId = $_POST['productId'];
    $productImage = $_POST['productImage'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];


    $item = DB::table('wishlist')->where('productId', $productId)->where('userId', $user['userId'])->first();

    if (isset($item['productId']) && $item['productId']) {
      echo '<script> alert("The product is already on the wishlist!");window.location = "wishlist.php"; </script>';
    } else {
      DB::table('wishlist')->insert([
        'productId' => $productId,
        'wishlistName' => $productName,
        'wishlistImage' => $productImage,
        'wishlistPrice' => $productPrice,
        'userId' => $user['userId']
      ]);
    }
    echo '<script> window.location = "wishlist.php" </script>';
  } else {
    header('Location: login.php');
  }
}
// $list;
if ((isset($_GET['list'])) && ($_GET['list'])) {
  $tbl_product = DB::table('tbl_product')->where('brandID',$_GET['list'])->orderBy('productPrice')->get();
  $i = DB::table('tbl_product')->where('brandID',$_GET['list'])->count();
}
?>

<body>
  <?php include 'modules/header.php' ?>
  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Shop</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Shop</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Shop Page  -->
  <div class="shop-box-inner">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
          <div class="right-product-box">
            <div class="product-item-filter row">
              <div class="col-12 col-sm-8 text-center text-sm-left">
                <div class="toolbar-sorter-right">
                  <span>Sort by </span>
                  <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                    <option data-display="Select">Nothing</option>
                    <option value="1">Popularity</option>
                    <option value="2">High Price → Low Price</option>
                    <option value="3">Low Price → High Price</option>
                    <option value="4">Best Selling</option>
                  </select>
                </div>
                <p>Showing all <?= $i ?> results</p>
              </div>
              <div class="col-12 col-sm-4 text-center text-sm-right">
                <ul class="nav nav-tabs ml-auto">
                  <li>
                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                  </li>
                  <li>
                    <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="product-categorie-box">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                  <div class="row">
                    <?php foreach ($tbl_product as $row) { ?> 
                      <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <form action="shop.php" method="POST">
                          <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
                          <input type="hidden" name="productName" value="<?= $row['productName'] ?>">
                          <input type="hidden" name="productPrice" value="<?= $row['productPrice'] ?>">
                          <input type="hidden" name="productImage" value="<?= $row['productImage'] ?>">
                          <input type="hidden" name="productQuantity" value="1">

                          <div class="products-single fix">
                            <div class="box-img-hover">
                              <div class="type-lb">
                                <p class="sale"><?= $row["productCurrentstatus"] ?></p>
                              </div>
                              <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
                              <div class="mask-icon">
                                <ul>
                                  <li><a href="shop-detail.php?id=<?= $row['productId'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                  <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <!-- <a class="cart add_to_cart" href="#">Add to Cart</a> -->
                                <input class="cart" name="add_cart" type="submit" value="Add to Cart">
                              </div>
                            </div>
                            <div class="why-text">
                              <h4><a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
                              <h5><?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ</h5>
                            </div>
                          </div>
                        </form>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="list-view">
                  <?php foreach ($tbl_product as $row) { ?>
                    <form action="shop.php" method="POST">
                      <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
                      <input type="hidden" name="productName" value="<?= $row['productName'] ?>">
                      <input type="hidden" name="productPrice" value="<?= $row['productPrice'] ?>">
                      <input type="hidden" name="productImage" value="<?= $row['productImage'] ?>">
                      <input type="hidden" name="productQuantity" value="1">
                      <div class="list-view-box">
                        <div class="row">
                          <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                              <div class="box-img-hover">
                                <div class="type-lb">
                                  <p class="new"><?= $row["productCurrentstatus"] ?></p>
                                </div>
                                <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                  <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                  </ul>

                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                            <div class="why-text full-width">
                              <h4><a style="color: #000;" href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
                              <h5>
                                <!-- <del>$ 60.00</del> -->
                                <?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ
                              </h5>
                              <p><?= $row["productDescription"] ?></p>
                              <input class="btn hvr-hover" name="add_cart" type="submit" value="Add to Cart">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
          <div class="product-categori">
            <div class="search-product">
              <form action="#">
                <input class="form-control" placeholder="Search here..." type="text">
                <button type="submit"> <i class="fa fa-search"></i> </button>
              </form>
            </div>
            <div class="filter-sidebar-left">
              <div class="title-left">
                <h3>Categories</h3>
              </div>
              <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                <div class="list-group-collapse sub-men">
                  <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1">Coffee<small class="text-muted">(10)</small>
                  </a>
                  <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                    <div class="list-group">
                      <a href="shop.php?list=CoffeeViet" class="list-group-item list-group-item-action active">Coffee Vietnam <small class="text-muted">(5)</small></a>
                      <a href="shop.php?list=ItaliaCoffee" class="list-group-item list-group-item-action">Coffee Italia <small class="text-muted">(5)</small></a>
                    </div>
                  </div>
                </div>
                <div class="list-group-collapse sub-men">
                  <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Juices
                    <small class="text-muted">(8)</small>
                  </a>
                  <div class="collapse" id="sub-men2" data-parent="#list-group-men">
                    <div class="list-group">
                      <a href="shop.php?list=SugarcaneJuice" class="list-group-item list-group-item-action">Juice <small class="text-muted">(10)</small></a>
                      <a href="shop.php?list=Juice" class="list-group-item list-group-item-action">Juices <small class="text-muted">(20)</small></a>
                    </div>
                  </div>
                </div>
                <a href="shop.php?list=Vitamin" class="list-group-item list-group-item-action"> Vitamin <small class="text-muted">(5) </small></a>
                <a href="shop.php?list=Tea" class="list-group-item list-group-item-action"> Tea <small class="text-muted">(6)</small></a>
                <a href="shop.php?list=Yogurt" class="list-group-item list-group-item-action"> Yogurts <small class="text-muted">(5)</small></a>
              </div>
            </div>
            <!-- <div class="filter-price-left">
              <div class="title-left">
                <h3>Price</h3>
              </div>
              <div class="price-box-slider">
                <div id="slider-range"></div>
                <p>
                  <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                  <button class="btn hvr-hover" type="submit">Filter</button>
                </p>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Shop Page -->

  <!-- Start Instagram Feed  -->
  <div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
      <?php foreach ($tbl_img_ig as $row) { ?>
        <div class="item">
          <div class="ins-inner-box">
            <img src="images/Instagram/<?= $row['imageImage'] ?>" alt="" />
            <div class="hov-in">
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      <?php } ?>

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
  <?php include 'modules/footer.php' ?>

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
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
  <script src="js/form-validator.min.js"></script>
  <script src="js/contact-form-script.js"></script>
  <script src="js/custom.js"></script>

  <script src="js/script.js"></script>
</body>

</html>