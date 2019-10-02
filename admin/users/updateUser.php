<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . '/includes/db_connect.php');



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == "edit") {
      $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
      $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
      $email = mysqli_real_escape_string($db, preg_replace('/\s+/', '', $_POST['email']));

      $userid = $_POST['UserID'];

      $query = $db->query("UPDATE Users SET FirstName = '$firstName', LastName = '$lastName', Email = '$email' WHERE UserID = $userid");

    } else {
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']);

      $userid = $_POST['UserID'];
      $passwordHash = md5($password); // Hash the password

      $query = $db->query("UPDATE Users SET Password = '$passwordHash' WHERE UserID = $userid");
    }

  } else {
    $userid = $_GET['UserID'];
    $action = $_GET['action'];

    if ($action == "activate") {
      $query = $db->query("UPDATE Users SET Active = 1 WHERE UserID = $userid");

    } else if ($action == "deactivate") {
      $query = $db->query("UPDATE Users SET Active = 0 WHERE UserID = $userid");

    } else if ($action == "delete") {
      $query = $db->query("UPDATE Users SET Active = 0 WHERE UserID = $userid");
    }
  }

  header("location: list.php?action=" . $action);

?>
