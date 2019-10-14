<?php

class Email
{
  private static $_instance = null;

  public static function getInstance()
  {
    if (!isset(self::$_instance)) {
      self::$_instance = new Email();
    }

    return self::$_instance;
  }

  public function sendEmail($subject, $body, $recepientEmail)
  {
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("carbuddy2019@outlook.com", "Car Buddy");
    $email->setSubject($subject);
    $email->addTo($recepientEmail, "");
    $email->addContent("text/plain", $body);

    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

    try {
      $response = $sendgrid->send($email);

      print $response->statusCode() . "\n";
      print_r($response->headers());
      print $response->body() . "\n";

    } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
    }
  }
}
