<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $vehicleid = $vehicleLatitude = $vehicleLongitude = 0;
  $vehicleTypeName = $vehicleMake = $vehicleModel = $vehicleAvailability = $vehicleSuburb = $vehicleAddress = "";

  if ($stmt = mysqli_prepare($db, "SELECT VehicleID, VehicleMake, VehicleModel, VehicleTypeName, VehicleAvailability, VehicleSuburb, VehicleAddress, VehicleLatitude, VehicleLongitude FROM VehicleDetails WHERE VehicleID = ?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "i", $_GET['VehicleID']);

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $vehicleid, $vehicleMake, $vehicleModel, $vehicleTypeName, $vehicleAvailability, $vehicleSuburb, $vehicleAddress, $vehicleLatitude, $vehicleLongitude);

    /* fetch value */
    mysqli_stmt_fetch($stmt);
  }
?>

<script>
  $(function() {
    $("#vehicleForm").submit(function(event) {
      if (!checkForm()) {
        event.preventDefault();
      }
    });
  });

  function checkForm() {
    var error = "";

    if ($("#vehicleTypeName").val() == "") {
      error += "You must enter a vehicle type.<br/>";
    }

    if ($("#vehicleMake").val() == "") {
      error += "You must enter a vehicle make.<br/>";
    }

    if ($("#vehicleModel").val() == "") {
      error += "You must enter a vehicle model.<br/>";
    }

    if ($("#vehicleSuburb").val() == "") {
      error += "You must enter a suburb where the vehicle is located.<br/>";
    }

    if ($("#vehicleAddress").val() == "") {
      error += "You must enter the address where the vehicle is located.<br/>";
    }

    if (error != "") {
      $("#errorDiv").html(error);
      return false;
    }

    return true;
  }
</script>

<h1>Edit Vehicle</h1>
<div id="errorDiv" class="error"></div>
<table class="list_table">
  <form action="updateVehicle.php" method="post" id="vehicleForm">
    <tr>
      <td>Vehicle Type:</td>
      <td><input type="text" id="vehicleTypeName" name="vehicleTypeName" value="<?= $vehicleTypeName ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Make:</td>
      <td><input type="text" id="vehicleMake" name="vehicleMake" value="<?= $vehicleMake ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Model:</td>
      <td><input type="text" id="vehicleModel" name="vehicleModel" value="<?= $vehicleModel ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Suburb:</td>
      <td><input type="text" id="vehicleSuburb" name="vehicleSuburb" value="<?= $vehicleSuburb ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Address:</td>
      <td><input type="text" id="vehicleAddress" name="vehicleAddress" value="<?= $vehicleAddress ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Latitude:</td>
      <td><input type="text" id="vehicleLatitude" name="vehicleLatitude" value="<?= $vehicleLatitude ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Longitude:</td>
      <td><input type="text" id="vehicleLongitude" name="vehicleLongitude" value="<?= $vehicleLongitude ?>" class="formField_text_large"></td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="VehicleID" value="<?= $vehicleid ?>">
        <input type="hidden" name="action" value="edit">
        <button type="button" onClick="window.location.href='list.php'">Cancel</button>
        <button type="submit">Update</button>
      </td>
    </tr>
  </form>
</table>

<?php
  mysqli_stmt_close($stmt);
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
