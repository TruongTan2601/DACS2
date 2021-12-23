<?php
require './includes/Exception.php';
require './includes/PHPMailer.php';
require './includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {

  private $service;

  function __construct()
  {
    $this->service = new PHPMailer();
    $this->service->isSMTP();
    $this->service->Host = "smtp.gmail.com";
    $this->service->SMTPAuth = "true";
    $this->service->SMTPSecure = "tls";
    $this->service->Port = "587";
    $this->service->Username = "truongtannauan@gmail.com";
    $this->service->Password = "q0942233975";
    $this->service->isHTML(true);
  }

  function build($toMails, $subject, $body) {
    foreach ($toMails as $email) {
      $this->service->addAddress($email);
    }
    $this->service->Subject = $subject;
    $this->service->Body = $body;
    return $this;
  }

  function to(...$toMails) {
    foreach ($toMails as $email) {
      $this->service->addAddress($email);
    }
    return $this;
  }

  function template($template, $subject, $data) {
    $this->service->Subject = $subject;
    $this->service->Body = $this->getContent($template, $data);
    return $this;
  }

  private function getContent($template, $data) {
    ob_start();
    extract($data);
    require_once($template);
    return ob_get_clean();
  }
 
  function send() {
    $result = $this->service->Send();
    $this->service->smtpClose();
    return $result;
  }
}