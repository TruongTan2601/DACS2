<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <?php require 'modules/head.php' ?>
  <style>
    .banner {
      min-height: 100vh;
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("images/banner-img.jpg") center/cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #fff;
      padding-bottom: 20px;
    }

    .card-container {
      display: grid;
      grid-template-columns: 420px 420px;
    }

    .card-img {
      background: url("images/card-img.jpg") center/cover no-repeat;
    }

    .banner h2 {
      padding-bottom: 40px;
      margin-bottom: 20px;
      color: #fff;
      font-weight: 600;
      font-size: 30px;
    }

    .card-content {
      background: #fff;
      height: 330px;
    }

    .card-content h3 {
      text-align: center;
      color: #000;
      padding: 25px 0 10px 0;
      font-size: 26px;
      font-weight: 500;
    }

    .form-row {
      display: flex;
      width: 90%;
      margin: 0 auto;
      flex-wrap: nowrap;
    }

    form select,
    form input {
      display: block;
      width: 100%;
      margin: 15px 12px;
      padding: 5px;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
      outline: none;
      border: none;
      border-bottom: 1px solid #eee;
      font-weight: 300;
    }

    form input[type=text],
    form input[type=number],
    form input::placeholder,
    select {
      color: #9a9a9a;
    }

    form .form-row input[type=submit] {
      color: #fff;
      background: #f2745f;
      padding: 12px 0;
      border-radius: 4px;
      cursor: pointer;
    }

    form input[type=submit]:hover {
      opacity: 0.9;
    }

    @media(max-width: 992px) {
      .card-container {
        grid-template-columns: 100%;
        width: 100vw;
      }

      .card-img {
        height: 330px;
      }
    }
  </style>
</head>

<body>

<script src="js/sweetalert.min.js"></script>
  <?php include 'modules/header.php' ?>
  <?php
  $tbl_banner = DB::table('tbl_banner')->get();
  $tbl_blogs = DB::table('tbl_blogs')->get();
  if (isset($_POST['reservation'])) {
    echo '<script>
      swal("Successful Booking!", "Thank you for booking with us!", "success");
  </script>';
    $name = $_POST['full_name'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];
    $phone_number = $_POST['phone_number'];
    $people = $_POST['people'];
    if (isset($user) && $user) {
      DB::table('tbl_reservations')->insert([
        'reservationName' => $name,
        'reservationDate' => $days,
        'reservationHour' => $hours,
        'reservationPhone' => $phone_number,
        'reservationPeople' => $people,
        'reservationEmail' => $user['userEmail']
      ]);
    } else {
      DB::table('tbl_reservations')->insert([
        'reservationName' => $name,
        'reservationDate' => $days,
        'reservationHour' => $hours,
        'reservationPhone' => $phone_number,
        'reservationPeople' => $people
      ]);
    }
  }
  ?>
  <!-- Start Slider -->
  <div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
      <?php foreach ($tbl_banner as $row) { ?>
        <li class="text-center">
          <img src="../admin/img/Banner/<?= $row['bannerImage'] ?>" alt="">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1 class="m-b-20"><strong>Welcome To <br> TRE COFFEE</strong></h1>
                <p class="m-b-40"><?= $row['bannerDescription'] ?></p>
                <p><a class="btn hvr-hover" href="shop.php">Shop New</a></p>
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
            <a class="btn hvr-hover" href="shop.php?list=CoffeeViet">Coffee</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="shop-cat-box">
            <img class="img-fluid" src="images/yogurt.jpg" alt="" />
            <a class="btn hvr-hover" href="shop.php?list=Yogurt">Yogurt</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="shop-cat-box">
            <img class="img-fluid" src="images/juice.jpg" alt="" />
            <a class="btn hvr-hover" href="shop.php?list=Juice">Juice</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Categories -->
  <section class="banner">
    <h2>BOOK YOUR TABLE NOW</h2>
    <div class="card-container">
      <div class="card-img">
        <!-- image here -->
      </div>

      <div class="card-content">
        <h3>Reservation</h3>
        <form method="POST">
          <div class="form-row">
            <input type="date" name="days" required required_msg="Please check this box!">

            <select name="hours" required required_msg="Please check this box!">
              <option value="">Select Hour</option>
              <option value="8: 00">8: 00</option>
              <option value="9: 00">9: 00</option>
              <option value="10: 00">10: 00</option>
              <option value="11: 00">11: 00</option>
              <option value="12: 00">12: 00</option>
              <option value="13: 00">13: 00</option>
              <option value="14: 00">14: 00</option>
              <option value="15: 00">15: 00</option>
              <option value="16: 00">16: 00</option>
              <option value="17: 00">17: 00</option>
              <option value="18: 00">18: 00</option>
              <option value="19: 00">19: 00</option>
              <option value="20: 00">20: 00</option>
            </select>
          </div>

          <div class="form-row">
            <input type="text" placeholder="Full Name" name="full_name" required required_msg="Please fill in this box!">
            <input type="text" placeholder="Phone Number" name="phone_number" minlength="10" maxlength="10" required required_msg="Please enter your correct phone number (10 numbers)!">
          </div>

          <div class="form-row">
            <input type="number" placeholder="How Many Persons?" min="1" max="30" name="people" required required_msg="Please select the number of people!">
            <input type="submit" name="reservation" onclick="executeExample()" value="BOOK TABLE" />
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Start Products  -->
  <div class="products-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="title-all text-center">
            <h1>Coffee & Drinking Water</h1>
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
        <?php foreach (DB::table('tbl_product')->limit(4)->get() as $row) { ?>
          <div class="col-lg-3 col-md-6 special-grid best-seller">
            <div class="products-single fix">
              <div class="box-img-hover">
                <div class="type-lb">
                  <p class="sale"><?= $row["productCurrentstatus"] ?></p>
                </div>
                <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
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
                <h4><a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
                <h5><?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ</h5>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php foreach (DB::table('tbl_product')->where('brandID', 'ItaliaCoffee')->limit(4)->get() as $row) { ?>
          <div class="col-lg-3 col-md-6 special-grid top-featured">
            <div class="products-single fix">
              <div class="box-img-hover">
                <div class="type-lb">
                  <p class="sale"><?= $row["productCurrentstatus"] ?></p>
                </div>
                <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
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
                <h4><a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
                <h5><?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ</h5>
              </div>
            </div>
          </div>
        <?php } ?>
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
            <h1>Blogs</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach ($tbl_blogs as $row) { ?>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="blog-box">
              <div class="blog-img">
                <img class="img-fluid" src="../admin/img/Blogs/<?= $row['blogImage'] ?>" alt="" />
              </div>
              <div class="blog-content">
                <div class="title-blog">
                  <h3><a href="blog-detail.php?id=<?= $row['blogId'] ?>"><?= $row['blogName'] ?></a></h3>
                  <p><?= $row['blogDemo'] ?></p>
                </div>
                <ul class="option-blog">
                  <li><a href="#"><i class="far fa-heart"></i></a></li>
                  <li><a href="blog-detail.php?id=<?= $row['blogId'] ?>"><i class="fas fa-eye"></i></a></li>
                  <li><a href="#"><i class="far fa-comments"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        <?php } ?>
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

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var elements = $("input, select");
      for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
          e.target.setCustomValidity("");
          if (!e.target.validity.valid) {
            e.target.setCustomValidity(e.target.getAttribute("required_msg"));
          }
        };
        elements[i].oninput = function(e) {
          e.target.setCustomValidity("");
        };
      }
    })
  </script>


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
  <script src="js/sweetalert.min.js"></script>
</body>

</html>