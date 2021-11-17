<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>

</head>

<body>
  <?php include 'modules/header.php' ?>
  <?php $i = 1; ?>
  <!-- Start All Title Box -->
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Wishlist</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
            <li class="breadcrumb-item active">Wishlist</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Wishlist  -->
  <div class="wishlist-box-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="table-main table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Images</th>
                  <th>Product Name</th>
                  <th>Unit Price </th>
                  <th>Add Item</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($wishlist) && $wishlist) { ?>
                  <?php
                  foreach ($wishlist as $row) {
                  ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td class="thumbnail-img">
                        <a href="#">
                          <img class="img-fluid" src="../admin/img/Coffee/<?= $row['wishlistImage'] ?>" alt="" />
                        </a>
                      </td>
                      <td class="name-pr">
                        <a href="shop-detail.php?id=<?= $row['productId'] ?>">
                          <?= $row['wishlistName'] ?>
                        </a>
                      </td>
                      <td class="price-pr">
                        <p><?= $row['wishlistPrice'] ?> VNĐ</p>
                      </td>
                      <td>
                        <form method="post" action="shop.php">
                          <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
                          <input type="hidden" name="productName" value="<?= $row['wishlistName'] ?>">
                          <input type="hidden" name="productPrice" value="<?= $row['wishlistPrice'] ?>">
                          <input type="hidden" name="productImage" value="<?= $row['wishlistImage'] ?>">
                          <input type="hidden" name="productQuantity" value="1">
                          <input class="btn hvr-hover" name="add_cart" type="submit" value="Add to Cart">
                        </form>
                      </td>
                      <td class="remove-pr">
                        <form method="post">
                          <input type="hidden" name="wishlistId" value="<?= $row['wishlist_Id'] ?>">
                          <input type="submit" style="border: none; background: none; cursor: pointer;" name="del_id" value="X">
                        </form>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td style="text-align: center;" colspan="6">
                      <h2>Your wishlist is empty!!!</h2>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Wishlist -->

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