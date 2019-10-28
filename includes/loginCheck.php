<?php

  function pageIsRestricted() {
    $return = false;
    $restrictedPages = array("booking2.php", "bookingcheckout.php");

    for ($i=0; $i < count($restrictedPages); $i++) {
      if (strpos($_SERVER['SCRIPT_NAME'], $restrictedPages[$i])) {
        $return = true;
      }
    }

    return $return;
  }

  if (!strpos($_SERVER['SCRIPT_NAME'], "login.php")) {
    if (isset($_SESSION['car_buddy_userid']) && !empty($_SESSION['car_buddy_userid'])) {
      $loggedIn = true;
    } else {
      $loggedIn = false;
    }

    if (pageIsRestricted() && !$loggedIn) {
      Redirect::to('login.php');
    }
  }

?>
