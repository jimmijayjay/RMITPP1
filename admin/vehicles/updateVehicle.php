<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . '/includes/db_connect.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    // Update
    if ($action == "edit") {
      $vehicleid = $_POST['VehicleID'];
      $vehicleTypeName = $_POST['vehicleTypeName'];
      $vehicleMake = $_POST['vehicleMake'];
      $vehicleModel = $_POST['vehicleModel'];
      $vehicleSuburb = $_POST['vehicleSuburb'];
      $vehicleAddress = $_POST['vehicleAddress'];
      $vehicleLatitude = $_POST['vehicleLatitude'];
      $vehicleLongitude = $_POST['vehicleLongitude'];

      $query = $db->query("UPDATE VehicleDetails SET VehicleTypeName = '$vehicleTypeName', VehicleMake = '$vehicleMake', VehicleModel = '$vehicleModel', VehicleSuburb = '$vehicleSuburb', VehicleAddress = '$vehicleAddress', VehicleLatitude = $vehicleLatitude, VehicleLongitude = $vehicleLongitude WHERE VehicleID = $vehicleid");

    } else if ($action == "add") {
      $vehicleTypeName = $_POST['vehicleTypeName'];
      $vehicleMake = $_POST['vehicleMake'];
      $vehicleModel = $_POST['vehicleModel'];
      $vehicleSuburb = $_POST['vehicleSuburb'];
      $vehicleAddress = $_POST['vehicleAddress'];
      $vehicleLatitude = $_POST['vehicleLatitude'];
      $vehicleLongitude = $_POST['vehicleLongitude'];

      $query = $db->query("INSERT INTO VehicleDetails (VehicleTypeName, VehicleMake, VehicleModel, VehicleSuburb, VehicleAddress, VehicleLatitude, VehicleLongitude, Active) VALUES ('$vehicleTypeName', '$vehicleMake', '$vehicleModel', '$vehicleSuburb', '$vehicleAddress', $vehicleLatitude, $vehicleLongitude, 1)");
    }

  } else {
    $action = $_GET['action'];
    $vehicleid = $_GET['VehicleID'];

    if ($action == "delete") {
      $query = $db->query("UPDATE VehicleDetails SET Active = 0 WHERE VehicleID = $vehicleid");
    }
  }

  header("location: list.php?action=" . $action);

?>
