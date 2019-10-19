<?php

  include_once('includes/init.php');

  if (isset($_SESSION[Config::get('sessions/session_name')])) {
    $thisUser = $_SESSION[Config::get('sessions/session_name')];

    $thisUser->logout();

    Redirect::to('index.php');
  }

?>
