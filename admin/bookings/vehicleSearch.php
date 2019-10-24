<?php
  session_start();

  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/db_connect.php');

  if ($_GET['action'] == 'getVehicleTypeNames') {

    $result = array();

    if ($vehicles = mysqli_query($db, "SELECT VehicleTypeName FROM VehicleDetails GROUP BY VehicleTypeName")) {
      while ($vehicle = mysqli_fetch_assoc($vehicles)) {
        array_push($result, $vehicle['VehicleTypeName']);
      }
    }

    echo json_encode($result);

  } else if ($_GET['action'] == 'getVehicleModelByType') {

    $result = array();

    if ($stmt = mysqli_prepare($db, "SELECT v.VehicleMake, v.VehicleModel, br.BookingFee FROM VehicleDetails v INNER JOIN BookingRates br ON v.VehicleTypeName = br.VehicleTypeName WHERE v.VehicleTypeName = ?")) {

      /* bind parameters for markers */
      mysqli_stmt_bind_param($stmt, "s", $_GET['vehicleTypeName']);

      /* execute query */
      mysqli_stmt_execute($stmt);

      /* get the result set */
      $vehicleModels = mysqli_stmt_get_result($stmt);

      /* fetch value */
      while ($row = mysqli_fetch_assoc($vehicleModels)) {
        $value = $row['VehicleMake'] . '|' . $row['VehicleModel'] . '|' . $row['BookingFee'];
        array_push($result, $value);
      }
    }

    echo json_encode($result);

  } else if ($_GET['action'] == 'getVehicleAddress') {

    $result = array();

    if ($stmt = mysqli_prepare($db, "SELECT VehicleID, VehicleAddress FROM VehicleDetails WHERE VehicleModel = ?")) {

      /* bind parameters for markers */
      mysqli_stmt_bind_param($stmt, "s", $_GET['vehicleModel']);

      /* execute query */
      mysqli_stmt_execute($stmt);

      /* get the result set */
      $vehicles = mysqli_stmt_get_result($stmt);

      /* fetch value */
      while ($row = mysqli_fetch_assoc($vehicles)) {
        $value = $row['VehicleID'] . '|' . $row['VehicleAddress'];
        array_push($result, $value);
        //$result[$row['VehicleID']] = $row['VehicleAddress'];
      }
    }

    echo json_encode($result);
  }
?>
