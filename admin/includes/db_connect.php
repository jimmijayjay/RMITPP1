<?php
  if (!isset($db)) {
    // connecting to the database
    $host = '127.0.0.1';
    $user = "root";
    $password = "password23";
    $dbname = "car_buddy";

    $db = new mysqli($host, $user, $password, $dbname);

    /* check connection */
    if ($db->connect_errno) {
      printf("Connect failed: %s\n", $db->connect_error);
      exit();
    }
  }
?>
