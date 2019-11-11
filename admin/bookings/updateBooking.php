<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . '/includes/db_connect.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    // Update
    if ($action == "edit") {
      $userid = $_POST['userid'];
      $vehicleid = $_POST['vehicleid'];
      $bookingid = $_POST['BookingID'];
      $bookingTotal = $_POST['bookingTotal'];

      $reformatedStartDate = str_replace("/", "-", $_POST['bookingStartDate']);
      $reformatedEndDate = str_replace("/", "-", $_POST['bookingEndDate']);

      $bookingStartDateTime = new DateTime("{$reformatedStartDate} {$_POST['bookingStartTime']}");
      $bookingEndDateTime = new DateTime("{$reformatedEndDate} {$_POST['bookingEndTime']}");

      $bookingStartTime = $bookingStartDateTime->format('Y-m-d H:i:s');
      $bookingEndTime = $bookingEndDateTime->format('Y-m-d H:i:s');

      $query = $db->query("UPDATE BookingsCurrent SET UserID = $userid, VehicleID = $vehicleid, BookingStartTime = '$bookingStartTime', BookingEndTime = '$bookingEndTime', BookingTotal = '$bookingTotal' WHERE BookingID = $bookingid");

    } else if ($action == "add") {
      $userid = $_POST['userid'];
      $vehicleid = $_POST['vehicleid'];
      $bookingid = $_POST['BookingID'];
      $bookingTotal = $_POST['bookingTotal'];

      $reformatedStartDate = str_replace("/", "-", $_POST['bookingStartDate']);
      $reformatedEndDate = str_replace("/", "-", $_POST['bookingEndDate']);

      $bookingStartDateTime = new DateTime("{$reformatedStartDate} {$_POST['bookingStartTime']}");
      $bookingEndDateTime = new DateTime("{$reformatedEndDate} {$_POST['bookingEndTime']}");

      $bookingStartTime = $bookingStartDateTime->format('Y-m-d H:i:s');
      $bookingEndTime = $bookingEndDateTime->format('Y-m-d H:i:s');

      $query = $db->query("INSERT INTO BookingsCurrent (UserID, VehicleID, BookingDate, BookingStartTime, BookingEndTime, BookingTotal) VALUES ($userid, $vehicleid, NOW(), '$bookingStartTime', '$bookingEndTime', '$bookingTotal')");
    }

  } else {
    $action = $_GET['action'];
    $bookingid = $_GET['BookingID'];

    if ($action == "delete" || $action == "cancel") {
      $query = $db->query("UPDATE BookingsCurrent SET Active = 0 WHERE BookingID = $bookingid");
    }
  }

  header("location: list.php?action=" . $action);

?>
