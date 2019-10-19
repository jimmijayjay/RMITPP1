<?php
  spl_autoload_register(function($class) {
    //require_once 'classes/' . $class . '.php';

    if (file_exists("{$_SERVER['DOCUMENT_ROOT']}/classes/{$class}.php")) {
      require_once("{$_SERVER['DOCUMENT_ROOT']}/classes/{$class}.php");

    } else if (file_exists("{$_SERVER['DOCUMENT_ROOT']}/vendor/{$class}.php")) {
      require_once("{$_SERVER['DOCUMENT_ROOT']}/vendor/{$class}.php");
    }

  });

  session_start();

  include_once("{$_SERVER["DOCUMENT_ROOT"]}/includes/db_connect.php");

  if ( !isset($_SESSION["carbuddy"]) || (isset($_SESSION["carbuddy"]) && !$_SESSION["carbuddy"]->isLoggedIn())) {
    header("location: ../../index.php");
  }
?>

<!doctype html>
<html>
<head>
  <title>Car Buddy Admin</title>
  <link rel="stylesheet" type="text/css" href="/admin/css/style.css" />
</head>

<body>
  <div id="top_banner">
    <h1>CarBuddy Admin</h1>
    <p>Welcome <?php echo $_SESSION["carbuddy"]->getFirstName() ?> <?php echo $_SESSION["carbuddy"]->getLastName() ?></p>
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
