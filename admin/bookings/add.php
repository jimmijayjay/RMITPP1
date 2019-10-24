<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $users = mysqli_query($db, "SELECT UserID, FirstName, LastName FROM Users WHERE UserTypeID = 2 AND Active = 1 ORDER BY LastName");

?>

<script src="/admin/js/bookingForm.js"></script>
<script>
  var today = new Date();
  var todayFormatted = today.getDate().toString() + "/" + today.getMonth().toString() + "/" + today.getFullYear().toString();

  $(function() {
    getVehicleTypeNames();

    $.datepicker.setDefaults({
      showOn: "button",
      buttonImage: "/admin/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: "dd/mm/yy"
    });

    $("#bookingStartDate, #bookingEndDate").datepicker();
    $("#bookingStartDate").datepicker("setDate", todayFormatted);
    $("#bookingEndDate").datepicker("setDate", todayFormatted);

    $("#bookingform").submit(function(event) {
      if (!checkForm()) {
        event.preventDefault();
      }
    });
  });
</script>

<h1>Add Booking</h1>
<div id="errorDiv" class="error"></div>
<table class="list_table">
  <form action="updateBooking.php" method="post" id="bookingform">
    <tr>
      <td>Customer:</td>
      <td>
        <select id="userid" name="userid">
          <option value="0">Please select a customer</option>
          <?php
            if ($users) {
              while ($row = mysqli_fetch_assoc($users)) {
          ?>
                <option value="<?= $row['UserID'] ?>"><?= $row['FirstName'] . ' ' . $row['LastName'] ?></option>
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
        </select>
        <br/>
        <select id="vehicleModel" name="vehicleModel" onchange="getVehicleAddress(this.options[this.selectedIndex].value)">
          <option value="">Please select a Vehicle Model</option>
        </select>
        <br/>
        <select id="vehicleid" name="vehicleid">
          <option value="0">Please select a vehicle address</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Booking Start Time (24 hr):</td>
      <td>
        <input type="text" id="bookingStartDate" name="bookingStartDate" value="" class="formField_date">&nbsp;&nbsp;&nbsp;
        <input type="text" id="bookingStartDateHour" name="bookingStartDateHour" value="" class="formField_time">&nbsp;&nbsp;:&nbsp;
        <input type="text" id="bookingStartDateMinute" name="bookingStartDateMinute" value="" class="formField_time">
      </td>
    </tr>
    <tr>
      <td>Booking End Time (24 hr):</td>
      <td>
        <input type="text" id="bookingEndDate" name="bookingEndDate" value="" class="formField_date">&nbsp;&nbsp;&nbsp;
        <input type="text" id="bookingEndDateHour" name="bookingEndDateHour" value="" class="formField_time">&nbsp;&nbsp;:&nbsp;
        <input type="text" id="bookingEndDateMinute" name="bookingEndDateMinute" value="" class="formField_time">
      </td>
    </tr>
    <tr>
      <td>Booking Total:</td>
      <td>
        $&nbsp;<input type="text" id="bookingTotal" name="bookingTotal" value="" class="formField_text_med">&nbsp;<p id="booking_fee_div"></p>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="action" value="add">
        <button type="button" onClick="window.location.href='list.php'">Cancel</button>
        <button type="submit">Update</button>
      </td>
    </tr>
  </form>
</table>

<?php
  if ($users)
    mysqli_free_result($users);

  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
