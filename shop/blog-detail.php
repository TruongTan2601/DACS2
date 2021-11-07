<?php 
require '../admin/connect.php';
$blogId = $_GET['id'];
$tbl_blogs = DB::table('tbl_blogs')->find('blogId',$blogId);
// var_dump($tbl_blogs);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Revetive - Free Business Corporate Template By MACode ID</title>

  <link rel="stylesheet" href="../assets/css/theme.css">
  <?php require 'modules/head.php' ?>

</head>

<body>

  <!-- Back to top button -->
  <!-- <div class="back-to-top"></div> -->

  <?php include 'modules/header.php' ?>

  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>BLOGS</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Blogs</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <main>
    <div class="page-section pt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="blog-single-wrap">
              <div class="post-thumbnail">
                <img src="../assets/img/bg_image_1.jpg" alt="">
              </div>
              <h1 class="post-title"><?= $tbl_blogs['blogName'] ?></h1>
              <div class="post-meta">
                <div class="post-author">
                  <span class="text-grey">By</span> <a href="#">Admin</a>
                </div>
                <span class="gap">|</span>
                <div class="post-date">
                  <a href="#"><?= $tbl_blogs['blogUpDate'] ?></a>
                </div>
                <span class="gap">|</span>
                <div>
                  <a href="#">StreetStyle</a>, <a href="#">Fashion</a>, <a href="#">Couple</a>
                </div>
                <span class="gap">|</span>
                <div class="post-comment-count">
                  <a href="#">8 Comments</a>
                </div>
              </div>
              <div class="post-content">
                <?php 
                $s = 'Blog1.txt';
                $f = '../admin/txt/Blog1.txt';
                $read = file($f);
                
                foreach ($read as $line) {
                  echo '<p style="text-indent: 20px;text-align: justify;font-size: 17px;">'.$line .'</p>';
                  }
                ?>
                
                <div class="post-tags">
                  <p class="mb-2">Tags:</p>
                  <a href="#" class="tag-link">LifeStyle</a>
                  <a href="#" class="tag-link">Food</a>
                  <a href="#" class="tag-link">Coronavirus</a>
                </div>
              </div>
            </div> <!-- .blog-single-wrap -->

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Leave a comment</h3>
              <form action="#" class="">
                <div class="form-row form-group">
                  <div class="col-md-6">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="col-md-6">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="website">Website</label>
                  <input type="url" class="form-control" id="website">
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="msg" id="message" cols="30" rows="8" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn btn-primary">
                </div>

              </form>
            </div> <!-- .comment-form-wrap -->
          </div>

          <div class="col-lg-4">
            <div class="widget">

              <div class="widget-box">
                <h3 class="widget-title">Recent Blog</h3>
                <div class="divider"></div>
                <div class="blog-item">
                  <div class="content">
                    <h6 class="post-title"><a href="#">Even the all-powerful Pointing has no control</a></h6>
                    <div class="meta">
                      <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                      <a href="#"><span class="mai-person"></span> Admin</a>
                      <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                    </div>
                  </div>
                </div>
                <div class="blog-item">
                  <div class="content">
                    <h6 class="post-title"><a href="#">Even the all-powerful Pointing has no control</a></h6>
                    <div class="meta">
                      <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                      <a href="#"><span class="mai-person"></span> Admin</a>
                      <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                    </div>
                  </div>
                </div>
                <div class="blog-item">
                  <div class="content">
                    <h6 class="post-title"><a href="#">Even the all-powerful Pointing has no control</a></h6>
                    <div class="meta">
                      <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                      <a href="#"><span class="mai-person"></span> Admin</a>
                      <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="widget-box">
                <h3 class="widget-title">Tag Cloud</h3>
                <div class="divider"></div>
                <div class="tagcloud">
                  <a href="#" class="tag-cloud-link">dish</a>
                  <a href="#" class="tag-cloud-link">menu</a>
                  <a href="#" class="tag-cloud-link">food</a>
                  <a href="#" class="tag-cloud-link">sweet</a>
                  <a href="#" class="tag-cloud-link">tasty</a>
                  <a href="#" class="tag-cloud-link">delicious</a>
                  <a href="#" class="tag-cloud-link">desserts</a>
                  <a href="#" class="tag-cloud-link">drinks</a>
                </div>
              </div>

              <div class="widget-box">
                <h3 class="widget-title">Paragraph</h3>
                <div class="divider"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
              </div>
            </div>
          </div>

        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->
  </main>


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
  <script src="js/form-validator.min.js"></script>
  <script src="js/contact-form-script.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>