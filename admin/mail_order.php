<?php
require 'modules/mailer.php';
$mail->Subject = 'Your order has been cancelled';
$mail->setFrom('votatruongtan2601@gmail.com');
$mail->isHTML(true);
$mail->addAttachment('img/logotre.jpg');
$mail->Body = 'Sorry for the inconvenience, currently the item you ordered is out of stock, the staff will contact you later!';
$mail->addAddress('votatruongtan2601@gmail.com');
if ($mail->Send()) {
  echo '<script>
  alert("You have responded to the customer with the email address: votatruongtan2601@gmail.com")
  window.location="order.php"
</script>';
}