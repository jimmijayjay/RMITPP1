<?php
  session_start();
  include_once($_SERVER["DOCUMENT_ROOT"] . '/includes/db_connect.php');

  if ( !isset($_SESSION["admin_loggedin"]) || (isset($_SESSION["admin_loggedin"]) && !$_SESSION["admin_loggedin"]) ) {
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
    <p>Welcome <?php echo $_SESSION["firstname"] ?> <?php echo $_SESSION["lastname"] ?></p>
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
