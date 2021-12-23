<?php
require 'connect.php';
Session::checkSession();
$i = 1;
$q=1;

$productS = null;
if (isset($_POST['accept'])) {
  $productId = $_POST['bill_Id'];
  $productS = DB::table('contact')->find('contactId', $productId);
}

require 'modules/mailer.php';
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $content = $_POST['content'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // var_dump($content);
  $mail->Subject = $content;
  $mail->setFrom($email);
  $mail->isHTML(true);
  $mail->addAttachment('img/logotre.jpg');
  $mail->Body = $message;
  $mail->addAddress($email);

  if ($mail->Send()) {
    echo '<script>
    alert("Email send ...");
  </script>';
    DB::table('contact')->where('contactId', $id)->update(['check_seen' => 1]);
  } else {
    echo "Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  }

  $mail->smtpClose();
}
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require 'modules/head.php' ?>
  <title>ADMIN | Chat</title>
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
      width: 60%;
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

    tbody th {
      font-weight: 400;
    }

    @media screen and (max-width: 768px) {
      .modal-content {
        width: 80%;
      }
    }
  </style>
</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><span><i class="far fa-comments"></i> New Chat</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach (DB::table('contact')->where('check_seen', 0)->get() as $row) { ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['contactName'] ?></td>
                    <td><?= $row['contactEmail'] ?></td>
                    <td><?= $row['contactDate'] ?></td>
                    <td><?= $row['contactTitle'] ?></td>
                    <td><?= $row['contactMessage'] ?></td>
                    <td>
                      <form method="post">
                        <input type="hidden" name="bill_Id" value="<?= $row['contactId'] ?>">
                        <button style="background-color: #fff; border: none; padding-right: 10px;" type="submit" name="delete"><i class="fas fa-times"></i></button>
                        <button style="background-color: #fff; border: none;" type="submit" name="accept"><i class="fas fa-check"></i></button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            There are currently <b><?= DB::table('contact')->where('check_seen', 0)->count() ?></b> messages.
          </div>
        </div>
      </div>
    </div>
    <?php if (isset($productS)) { ?>
      <div id="update-form" class="modal x-display">
        <div class="modal-content">
          <span id="edit-close" class="close">&times;</span>
          <div class="col-md-12" id="form_container">
            <h2>Form</h2>
            <p>
              Please send your message below. We will get back to you at the earliest!
            </p>
            <form role="form" method="post" id="reused_form">
              <input type="hidden" name="id" value="<?= $productS['contactId'] ?>">
              <div class="row">
                <div class="col-sm-6 form-group">
                  <label for="name">
                    Content:</label>
                  <input type="text" class="form-control" id="name" name="content" value="<?= $productS['contactName'] ?>" required>
                </div>
                <div class="col-sm-6 form-group">
                  <label for="email">
                    Sent to email:</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $productS['contactEmail'] ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 form-group">
                  <label for="message">
                    Message:</label>
                  <textarea class="form-control" type="textarea" name="message" id="message" maxlength="6000" rows="7"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 form-group">
                  <button type="submit" class="btn btn-lg btn-default pull-right" name="submit" style="border: 1px solid">Send →</button>
                </div>
              </div>

            </form>
            <div id="success_message" style="width:100%; height:100%; display:none; ">
              <h3>Posted your message successfully!</h3>
            </div>
            <div id="error_message" style="width:100%; height:100%; display:none; ">
              <h3>Error</h3>
              Sorry there was an error sending your form.

            </div>
          </div>
        </div>
      </div>
    <?php  } ?>
    <div class="text"><span><i class="far fa-comments"></i> Chat</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach (DB::table('contact')->where('check_seen', 1)->get() as $row) { ?>
                  <tr>
                    <td><?= $q++ ?></td>
                    <td><?= $row['contactName'] ?></td>
                    <td><?= $row['contactEmail'] ?></td>
                    <td><?= $row['contactDate'] ?></td>
                    <td><?= $row['contactTitle'] ?></td>
                    <td><?= $row['contactMessage'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            There are currently <b><?= DB::table('contact')->where('check_seen', 1)->count() ?></b> messages.
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <script src="script/script.js"></script>
</body>

</html>