<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . '/includes/db_connect.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    // Update
    if ($action == "edit") {
      $bookingid = $_POST['BookingID'];
      $bookingTotal = $_POST['bookingTotal'];

      $reformatedStartDate = str_replace("/", "-", $_POST['bookingStartDate']);
      $reformatedEndDate = str_replace("/", "-", $_POST['bookingEndDate']);

      $bookingStartDateTime = new DateTime("{$reformatedStartDate} {$_POST['bookingStartDateHour']}:{$_POST['bookingStartDateMinute']}:00");
      $bookingEndDateTime = new DateTime("{$reformatedEndDate} {$_POST['bookingEndDateHour']}:{$_POST['bookingEndDateMinute']}:00");

      $bookingStartTime = $bookingStartDateTime->format('Y-m-d H:i:s');
      $bookingEndTime = $bookingEndDateTime->format('Y-m-d H:i:s');

      //echo $bookingStartTime . "<br/>" . $bookingEndTime;

      $query = $db->query("UPDATE BookingsCurrent SET BookingStartTime = '$bookingStartTime', BookingEndTime = '$bookingEndTime', BookingTotal = '$bookingTotal' WHERE BookingID = $bookingid");
    }

  } else {
    $action = $_GET['action'];
    $bookingid = $_GET['BookingID'];

    if ($action == "delete") {
      $query = $db->query("UPDATE BookingsCurrent SET Active = 0 WHERE BookingID = $bookingid");
    }
  }

  header("location: list.php?action=" . $action);

?>
