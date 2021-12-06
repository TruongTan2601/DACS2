<?php 
$read = file("../admin/txt/send_email.txt");
foreach ($read as $line) {
  $line;
}
require '../admin/includes/Exception.php';
require '../admin/includes/PHPMailer.php';
require '../admin/includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$mail = new PHPMailer();
if (isset($_POST['send_email'])) {
  $email = $_POST['email'];
  $message = $_POST['message'];
  
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = "true";
  $mail->SMTPSecure = "tls";
  $mail->Port = "587";
  $mail->Username = "truongtannauan@gmail.com";
  $mail->Password = "q0942233975";
  $mail->Subject = 'Notification!!';
  $mail->setFrom($email);
  $mail->isHTML(true);
  $mail->Body = $message;
  $mail->addAddress($email);

  if ($mail->Send()) {
    echo '<script>
    alert("Email send ...");
  </script>';
  } else {
    echo "Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  }

  $mail->smtpClose();
}
?>
<footer>
  <div class="footer-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-top-box">
            <h3>Business Time</h3>
            <ul class="list-time">
              <li>Monday - Friday: 08.00am to 05.00pm</li>
              <li>Saturday: 10.00am to 08.00pm</li>
              <li>Sunday: <span>Closed</span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-top-box">
            <h3>Newsletter</h3>
            <form class="newsletter-box" method="POST">
              <input type="hidden" name="message" value="<?= $line ?>">
              <div class="form-group">
                <input class="" type="email" name="email" placeholder="Email Address*" />
                <i class="fa fa-envelope"></i>
              </div>
              <button class="btn hvr-hover" name="send_email" type="submit">Submit</button>
            </form>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-top-box">
            <h3>Social Media</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <ul>
              <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-widget">
            <h4>About Tre-Coffee</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-link">
            <h4>Information</h4>
            <ul>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Customer Service</a></li>
              <li><a href="#">Our Sitemap</a></li>
              <li><a href="#">Terms &amp; Conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Delivery Information</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="footer-link-contact">
            <h4>Contact Us</h4>
            <ul>
              <li>
                <p><i class="fas fa-map-marker-alt"></i>Address: <a href="contact-us.php"> 110-112 Thu Khoa Huan Street <br>An Hai Dong, Son Tra,<br> Da Nang City </a></p>
              </li>
              <li>
                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:0329 734 008">0329 734 008</a></p>
              </li>
              <li>
                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:vtttan.20it11@vku.udn.vn">vtttan.20it11@vku.udn.vn</a></p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Start copyright  -->
<div class="footer-copyright">
  <p class="footer-company">All Rights Reserved. &copy; 2021 <a href="#">TruongTanIT</a> Design By :
    <a href="https://fb.com/stick.roser/">Truong Tan Dz</a>
  </p>
</div>
<!-- End copyright  -->