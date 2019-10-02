<?php
  if (!isset($db)) {
    // connecting to the database
    $host = '127.0.0.1';
    $user = "root";
    $password = "password23";
    $dbname = "car_buddy";

    $db = mysqli_connect($host, $user, $password, $dbname);


    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* check if server is alive */
    if (!mysqli_ping($db)) {
        printf ("Error: %s\n", mysqli_error($db));
    }
  }
?>
