<?php

require_once 'includes/init.php';

if (isset($_SESSION['car_buddy_userid']) && !empty($_SESSION['car_buddy_userid'])) {
    $thisUser = new User($_SESSION['car_buddy_userid']);
  } else {
    $thisUser = new User();
  }



$booking = $_GET["bookingid"];

echo "<h1>Booking id : ".$booking." - CANCELED";


if ($result = $thisUser->cancelBookings($booking)) {
    echo"here";
    $_SESSION["canceled"]="success";
    Redirect::to('bookingHistory.php');
  } else {
    array_push($errors, "Return failed. Please try again later.");
  }
  