<?php

  /*spl_autoload_register(function($class) {
    //require_once 'classes/' . $class . '.php';

    if (file_exists("{$_SERVER['DOCUMENT_ROOT']}/classes/{$class}.php")) {
      require_once("{$_SERVER['DOCUMENT_ROOT']}/classes/{$class}.php");
    }
  });*/

  session_start();

  include_once("db_connect.php");

  if (!isset($_SESSION["car_buddy_userid"]) || (isset($_SESSION["car_buddy_userid"]) && empty($_SESSION['car_buddy_userid']))) {
    header("location: ../../index.php");
  }
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car Buddy Admin</title>
  
  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="/admin/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/admin/css/jquery-ui.min.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</head>

<body>
  <div id="top_banner">
    <h1>CarBuddy Admin</h1>
    <p>Welcome <?= $_SESSION["car_buddy_firstname"] ?> <?= $_SESSION["car_buddy_lastname"] ?></p>
  </div>
  <div id="sidebar">
    <ul id="admin_side_menu">
      <li><a href="/admin/users/list.php">Users</a></li>
      <li><a href="/admin/bookings/list.php">Bookings</a></li>
      <li><a href="/admin/vehicles/list.php">Vehicles</a></li>
      <li id="btn_logout"><a href="/logout.php">LOGOUT</a></li>
    </ul>
  </div>
  <div id="main_body">
