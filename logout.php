<?php

  include_once('includes/init.php');

  if (isset($_SESSION['car_buddy_userid']) && !empty($_SESSION['car_buddy_userid'])) {
    $thisUser = new User($_SESSION['car_buddy_userid']);

    $thisUser->logout();
  }

  Redirect::to('index.php');

?>
