<?php include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php'); ?>

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

    if ($("#bookingFee").val() == 0 || isNaN($("#bookingFee").val())) {
      error += "You must enter a booking fee for this vehicle.<br/>";
    }

    if ($("#bookingPenaltyRate").val() == 0 || isNaN($("#bookingPenaltyRate").val())) {
      error += "You must enter a booking penalty rate for this vehicle.<br/>";
    }

    if ($("#vehicleLatitude").val() == 0 || isNaN($("#vehicleLatitude").val())) {
      error += "You must enter the latitude of this address.<br/>";
    }

    if ($("#vehicleLongitude").val() == 0 || isNaN($("#vehicleLongitude").val())) {
      error += "You must enter the longitude of this address.<br/>";
    }

    if (error != "") {
      $("#errorDiv").html(error);
      return false;
    }

    return true;
  }
</script>

<h1>Add Vehicle</h1>
<div id="errorDiv" class="error"></div>
<table class="list_table">
  <form action="updateVehicle.php" method="post" id="vehicleForm">
    <tr>
      <td>Vehicle Type:</td>
      <td><input type="text" id="vehicleTypeName" name="vehicleTypeName" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Make:</td>
      <td><input type="text" id="vehicleMake" name="vehicleMake" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Model:</td>
      <td><input type="text" id="vehicleModel" name="vehicleModel" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Suburb:</td>
      <td><input type="text" id="vehicleSuburb" name="vehicleSuburb" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Vehicle Address:</td>
      <td><input type="text" id="vehicleAddress" name="vehicleAddress" class="formField_text_large"></td>
    </tr>
    <tr>
      <td>Booking Fee:</td>
      <td><input type="text" id="bookingFee" name="bookingFee" class="formField_text_large" value="0"></td>
    </tr>
    <tr>
      <td>Booking Penalty Rate:</td>
      <td><input type="text" id="bookingPenaltyRate" name="bookingPenaltyRate" class="formField_text_large" value="0"></td>
    </tr>
    <tr>
      <td>Vehicle Latitude:</td>
      <td><input type="text" id="vehicleLatitude" name="vehicleLatitude" class="formField_text_large" value="0"></td>
    </tr>
    <tr>
      <td>Vehicle Longitude:</td>
      <td><input type="text" id="vehicleLongitude" name="vehicleLongitude" class="formField_text_large" value="0"></td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="action" value="add">
        <button type="button" onClick="window.location.href='list.php'">Cancel</button>
        <button type="submit">Add</button>
      </td>
    </tr>
  </form>
</table>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php'); ?>
