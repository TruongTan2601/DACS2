<?php
require '../admin/connect.php';
$blogId = $_GET['id'];
$tbl_blogs = DB::table('tbl_blogs')->find('blogId', $blogId);
$tbl_blog = DB::table('tbl_blogs')->get();
// var_dump($tbl_blogs);
$today = date('d') . '-' . date('m') . '-' . date('Y') . ' ' . date("h:i:sa");
if (isset($_POST['submit'])) {
  $ids = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $comment = $_POST['msg'];
  DB::table('cmt_blogs')->insert([
    'userId' => $ids,
    'cmtDate' => $today,
    'cmtName' => $name,
    'cmtContent' => $comment,
    'cmtEmail'=> $email,
    'blogId' => $blogId
  ]);
}
$stmt = DB::table('cmt_blogs')->limit(5)->orderBy('cmt_Id', 'DESC')->where('blogId', $blogId)->get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Blog</title>
  <link rel="stylesheet" href="css/theme.css">
  <?php require 'modules/head.php' ?>
  <style>
    .comment {
      padding: 20px 20px 30px;
      position: relative;
      background: #f8f8f8;
    }

    .entriesContainer .comments-list .img {
      border: 2px solid #ed5f5e;
      color: #ed5f5e;
      float: left;
      height: 35px;
      width: 35px;
      line-height: 31px;
      margin-top: 5px;
      text-align: center;
    }

    .entriesContainer .comments-list .commentContent {
      margin-bottom: 15px;
      margin-left: 50px;
    }
  </style>

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
                <img src="../admin/img/Blogs/<?= $tbl_blogs['blogImage'] ?>" alt="">
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
                  <a href="#"><?= DB::table('cmt_blogs')->where('blogId', $blogId)->count() ?> Comments</a>
                </div>
              </div>
              <div class="post-content">
                <?php $read = file("../admin/txt/" . $tbl_blogs['blogDescription']); ?>

                <?php foreach ($read as $line) { ?>
                  <p style="text-indent: 20px;text-align: justify;font-size: 17px;"><?= $line ?></p>
                <?php } ?>


                <div class="post-tags">
                  <p class="mb-2">Tags:</p>
                  <a href="#" class="tag-link">LifeStyle</a>
                  <a href="#" class="tag-link">Food</a>
                  <a href="#" class="tag-link">Coronavirus</a>
                </div>
              </div>
            </div> <!-- .blog-single-wrap -->
            <div class="entriesContainer">
              <!--Comments and replys-->
              <?php foreach ($stmt as $row) { ?>
                <ul class="comments-list clearfix">
                  <li>
                    <div class="comment">
                      <div class="img">
                        <i class="fa fa-user"></i>
                      </div>
                      <div class="commentContent">
                        <div class="commentsInfo">
                          <div class="author"><?= $row['cmtName'] ?></div>
                          <div class="date">
                            <a href="#"><?= $row['cmtDate'] ?></a>
                          </div>
                        </div>
                        <p class="expert"><?= $row['cmtContent'] ?></p>
                      </div>
                    </div>
                  </li>
                </ul>
              <?php } ?>
              <!--End comments and replys-->
            </div>

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Leave a comment</h3>
              <?php if (isset($user['userId']) && $user['userId']) { ?>
                <form action="" method="POST" class="">
                  <input type="hidden" name="id" value="<?= $user['userId'] ?>">
                  <input type="hidden" name="date" value="<?= $today ?>">
                  <div class="form-row form-group">
                    <div class="col-md-6">
                      <label for="name">Name *</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?= $user['userName'] ?>">
                    </div>
                    <div class="col-md-6">
                      <label for="email">Email *</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?= $user['userEmail'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="msg" id="message" cols="30" rows="8" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <button class="btn hvr-hover" style="color: #fff;font-size: 16px;font-weight: 500;" type="submit" name="submit">Post a comment</button>
                  </div>

                </form>
              <?php } else { ?>
                <div class="col-12">
                  <button class="btn hvr-hover" style="color: #fff;font-size: 16px;font-weight: 500;" type="submit"><a href="login.php" style="color: #fff;">You need to login to comment</a></button>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="widget">

              <div class="widget-box">
                <h3 class="widget-title">Recent Blog</h3>
                <div class="divider"></div>
                <?php foreach ($tbl_blog as $row) { ?>
                  <div class="blog-item">
                    <div class="content">
                      <h6 class="post-title"><b><a href="blog-detail.php?id=<?= $row['blogId'] ?>"><?= $row['blogName'] ?></a></b></h6>
                      <div class="meta">
                        <a href="#"><span class="mai-calendar"></span> <?= $row['blogUpDate'] ?></a>
                        <a href="#"><span class="mai-person"></span> Admin</a>
                        <!-- <a href="#"><span class="mai-chatbubbles"></span> 19</a> -->
                      </div>
                    </div>
                  </div>
                <?php } ?>
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
                <?= $tbl_blogs['blogDemo'] ?>
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