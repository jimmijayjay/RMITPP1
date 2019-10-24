<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $bookingid = 0;
  $vehicleid = $bookingDate = $bookingStartTime = $bookingEndTime = $bookingTotal = $userid = "";

  $users = mysqli_query($db, "SELECT UserID, FirstName, LastName FROM Users WHERE UserTypeID = 2 AND Active = 1 ORDER BY LastName");
  $getAllVehicleTypes = mysqli_query($db, "SELECT VehicleTypeName FROM VehicleDetails GROUP BY VehicleTypeName");

  if ($stmt = mysqli_prepare($db, "SELECT b.BookingID, b.VehicleID, b.BookingTotal, b.BookingDate, b.BookingStartTime, b.BookingEndTime, b.UserID, u.FirstName, u.LastName, v.VehicleTypeName, v.VehicleMake, v.VehicleModel FROM BookingsCurrent b INNER JOIN Users u ON b.UserID = u.UserID INNER JOIN VehicleDetails v ON b.VehicleID = v.VehicleID WHERE b.BookingID = ?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "i", $_GET['BookingID']);

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* store the result */
    mysqli_stmt_store_result($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $bookingid, $vehicleid, $bookingTotal, $bookingDate, $bookingStartTime, $bookingEndTime, $userid, $firstname, $lastname, $selectedVehicleTypeName, $vehicleMake, $selectedVehicleModel);

    /* fetch value */
    mysqli_stmt_fetch($stmt);

    $bookingStartDateTime = new DateTime($bookingStartTime);
    $bookingEndDateTime = new DateTime($bookingEndTime);

    $bookingStartTime = $bookingStartDateTime->format('H:i:s');
    $bookingEndTime = $bookingEndDateTime->format('H:i:s');

    if ($result = mysqli_prepare($db, "SELECT VehicleMake, VehicleModel FROM VehicleDetails WHERE VehicleTypeName = ?")) {
      mysqli_stmt_bind_param($result, "s", $selectedVehicleTypeName);
      mysqli_stmt_execute($result);
      $getAllVehicleModels = mysqli_stmt_get_result($result);
    }

    if ($result2 = mysqli_prepare($db, "SELECT VehicleID, VehicleAddress FROM VehicleDetails WHERE VehicleModel = ?")) {
      mysqli_stmt_bind_param($result2, "s", $selectedVehicleModel);
      mysqli_stmt_execute($result2);
      $getAllVehicleAddresses = mysqli_stmt_get_result($result2);
    }
  }

  function formatBookingTime($value, $onHour, $isAM) {
    if ($isAM == 0) {
      if ($value < 10)
        $value = "0" . $value;
    } else {
      $value += 12;
    }

    if ($onHour) {
      $minute = ":00:00";
    } else {
      $minute = ":30:00";
    }

    return $value . $minute;
  }
?>

<script src="/admin/js/bookingForm.js"></script>
<script>
  var bookingStartDate = "<?= $bookingStartDateTime->format('d/m/Y') ?>";
  var bookingEndDate = "<?= $bookingEndDateTime->format('d/m/Y') ?>";

  $(function() {
    $.datepicker.setDefaults({
      showOn: "button",
      buttonImage: "/admin/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: "dd/mm/yy"
    });

    $("#bookingStartDate, #bookingEndDate").datepicker();
    $("#bookingStartDate").datepicker("setDate", bookingStartDate);
    $("#bookingEndDate").datepicker("setDate", bookingEndDate);

    $("#bookingform").submit(function(event) {
      if (!checkForm()) {
        event.preventDefault();
      }
    });
  });
</script>

<h1>Edit Booking</h1>
<div id="errorDiv" class="error"></div>
<table class="list_table">
  <form action="updateBooking.php" method="post" id="bookingform">
    <tr>
      <td>Customer:</td>
      <td>
        <select name="userid">
          <?php
            if ($users) {
              while ($row = mysqli_fetch_assoc($users)) {
          ?>
                <option value="<?= $row['UserID'] ?>" <?php if ($row['UserID'] == $userid) { ?>selected<?php } ?>><?= $row['FirstName'] . ' ' . $row['LastName'] ?></option>
          <?php
              }
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Vehicle:</td>
      <td>
        <select id="vehicleType" name="vehicleType" onchange="getVehicleModel(this.options[this.selectedIndex].value)">
          <option value="">Please select a Vehicle Type</option>
          <?php
            if ($getAllVehicleTypes) {
              while ($row = mysqli_fetch_assoc($getAllVehicleTypes)) {
          ?>
                <option value="<?= $row['VehicleTypeName'] ?>" <?php if ($row['VehicleTypeName'] == $selectedVehicleTypeName) { ?>selected<?php } ?> ><?= $row['VehicleTypeName'] ?></option>
          <?php
              }
            }
          ?>
        </select>
        <br/>
        <select id="vehicleModel" name="vehicleModel" onchange="getVehicleAddress(this.options[this.selectedIndex].value)">
          <option value="">Please select a Vehicle Model</option>
          <?php
            while ($row = mysqli_fetch_assoc($getAllVehicleModels)) {
          ?>
                <option value="<?= $row['VehicleModel'] ?>" <?php if ($row['VehicleModel'] == $selectedVehicleModel) { ?>selected<?php } ?> ><?= $row['VehicleMake'] . ' ' . $row['VehicleModel'] ?></option>
          <?php
            }
          ?>
        </select>
        <br/>
        <select id="vehicleid" name="vehicleid">
          <option value="">Please select a vehicle address</option>
          <?php
            while ($row = mysqli_fetch_assoc($getAllVehicleAddresses)) {
          ?>
                <option value="<?= $row['VehicleID'] ?>" <?php if ($row['VehicleID'] == $vehicleid) { ?>selected<?php } ?> ><?= $row['VehicleAddress'] ?></option>
          <?php
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Booking Start Time (24 hr):</td>
      <td>
        <input type="text" id="bookingStartDate" name="bookingStartDate" value="<?= $bookingStartDateTime->format('d/m/Y') ?>" class="formField_date">&nbsp;&nbsp;&nbsp;
        <select id="bookingStartTime" name="bookingStartTime">
          <option value="00:00:00">midnight</option>
          <option value="00:30:00">12:30 AM</option>
          <?php for ($i = 0; $i < 2; $i++) { ?>
            <?php for ($j = 1; $j <= 11; $j++) { ?>
              <?php $firstTime = formatBookingTime($j, true, $i); ?>
              <?php $seondTime = formatBookingTime($j, false, $i); ?>
              <option value="<?= $firstTime ?>" <?php if ($firstTime == $bookingStartTime) { ?>selected<?php } ?>><?= $j . ":00 " ?><?= ($i == 0) ? "AM" : "PM" ?></option>
              <option value="<?= $seondTime ?>" <?php if ($seondTime == $bookingStartTime) { ?>selected<?php } ?>><?= $j . ":30 " ?><?=($i == 0) ? "AM" : "PM" ?></option>

              <?php if ($j == 11 && $i == 0) { ?>
                <option value="12:00:00">noon</option>
                <option value="12:30:00">12:30 PM</option>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Booking End Time (24 hr):</td>
      <td>
        <input type="text" id="bookingEndDate" name="bookingEndDate" value="<?= $bookingEndDateTime->format('d/m/Y') ?>" class="formField_date">&nbsp;&nbsp;&nbsp;
        <select id="bookingEndTime" name="bookingEndTime">
          <option value="00:00:00">midnight</option>
          <option value="00:30:00">12:30 AM</option>
          <?php for ($i = 0; $i < 2; $i++) { ?>
            <?php for ($j = 1; $j <= 11; $j++) { ?>
              <?php $firstTime = formatBookingTime($j, true, $i); ?>
              <?php $seondTime = formatBookingTime($j, false, $i); ?>
              <option value="<?= $firstTime ?>" <?php if ($firstTime == $bookingEndTime) { ?>selected<?php } ?>><?= $j . ":00 " ?><?= ($i == 0) ? "AM" : "PM" ?></option>
              <option value="<?= $seondTime ?>" <?php if ($seondTime == $bookingEndTime) { ?>selected<?php } ?>><?= $j . ":30 " ?><?=($i == 0) ? "AM" : "PM" ?></option>

              <?php if ($j == 11 && $i == 0) { ?>
                <option value="12:00:00">noon</option>
                <option value="12:30:00">12:30 PM</option>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Booking Total:</td>
      <td>$&nbsp;<input type="text" id="bookingTotal" name="bookingTotal" value="<?= $bookingTotal ?>" class="formField_text_med"></td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="BookingID" value="<?= $bookingid ?>">
        <input type="hidden" name="action" value="edit">
        <button type="button" onClick="window.location.href='list.php'">Cancel</button>
        <button type="submit">Update</button>
      </td>
    </tr>
  </form>
</table>

<?php
  if ($stmt)
    mysqli_stmt_close($stmt);
  if ($result)
    mysqli_stmt_close($result);
  if ($result2)
    mysqli_stmt_close($result2);

  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
