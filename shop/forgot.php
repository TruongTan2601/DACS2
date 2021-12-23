<?php
require '../admin/connect.php';
require '../admin/includes/Exception.php';
require '../admin/includes/PHPMailer.php';
require '../admin/includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer();
$email = 'votatruongtan2601@gmail.com';
$rand = rand();
$message = $rand;

$md_rand = md5($rand);
DB::table('tbl_user')->where('userEmail', $email)->update([
  'userPass' => $md_rand
]);

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = "truongtannauan@gmail.com";
$mail->Password = "q0942233975";
$mail->Subject = 'New password!!';
$mail->setFrom($email);
$mail->isHTML(true);
$mail->Body = $message;
$mail->addAddress($email);

if ($mail->Send()) {
  echo '<script>
    alert("Email send ...");
    window.location="login.php";
  </script>';
} else {
  echo "Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
}

$mail->smtpClose();
