<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $bookingid = 0;
  $vehicleid = $bookingDate = $bookingStartTime = $bookingEndTime = $bookingTotal = $userid = "";

  if ($stmt = mysqli_prepare($db, "SELECT b.BookingID, b.VehicleID, b.BookingTotal, b.BookingDate, b.BookingStartTime, b.BookingEndTime, b.UserID, u.FirstName, u.LastName, v.VehicleTypeName, v.VehicleMake, v.VehicleModel FROM BookingsCurrent b INNER JOIN Users u ON b.UserID = u.UserID INNER JOIN VehicleDetails v ON b.VehicleID = v.VehicleID WHERE b.BookingID = ?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "i", $_GET['BookingID']);

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $bookingid, $vehicleid, $bookingTotal, $bookingDate, $bookingStartTime, $bookingEndTime, $userid, $firstname, $lastname, $vehicleTypeName, $vehicleMake, $vehicleModel);

    /* fetch value */
    mysqli_stmt_fetch($stmt);

    $bookingStartDateTime = new DateTime($bookingStartTime);
    $bookingEndDateTime = new DateTime($bookingEndTime);
  }
?>

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

  function checkHour(hour) {
    if (hour < 0 || hour > 23) {
      return false;
    }

    return true;
  }

  function checkMinute(minute) {
    if (minute < 0 || minute > 59) {
      return false;
    }

    return true;
  }

  function checkForm() {
    var error = "";
    var startHour = $("#bookingStartDateHour").val();
    var startMin = $("#bookingStartDateMinute").val();
    var endHour = $("#bookingEndDateHour").val();
    var endMin = $("#bookingEndDateMinute").val();

    if ($("#bookingStartDate").val() == "") {
      error += "You must select a booking start date.<br/>";
    }

    if ((startHour == "" || (startHour != "" && !checkHour(startHour))) || (startMin == "" || (startMin != "" && !checkMinute(startMin)))) {
      error += "You must enter a valid booking start time.<br/>";
    }

    if ($("#bookingEndDate").val() == "") {
      error += "You must select a booking end date.<br/>";
    }

    if ((endHour == "" || (endHour != "" && !checkHour(endHour))) || (endMin == "" || (endMin != "" && !checkMinute(endMin)))) {
      error += "You must enter a valid booking end time.<br/>";
    }

    if ($("#bookingTotal").val() == "") {
      error += "You must enter a booking total.";
    }

    if (error != "") {
      $("#errorDiv").html(error);
      return false;
    }

    return true;
  }

</script>

<h1>Edit Booking</h1>
<div id="errorDiv" class="error"></div>
<table class="list_table">
  <form action="updateBooking.php" method="post" id="bookingform">
    <tr>
      <td>Customer:</td>
      <td><?= $firstname ?> <?= $lastname ?></td>
    </tr>
    <tr>
      <td>Vehicle:</td>
      <td><?= $vehicleMake ?> <?= $vehicleModel ?> (<?= $vehicleTypeName ?>)</td>
    </tr>
    <tr>
      <td>Booking Start Time (24 hr):</td>
      <td>
        <input type="text" id="bookingStartDate" name="bookingStartDate" value="<?= $bookingStartDateTime->format('d/m/Y') ?>" class="formField_date">&nbsp;&nbsp;&nbsp;
        <input type="text" id="bookingStartDateHour" name="bookingStartDateHour" value="<?= $bookingStartDateTime->format('H') ?>" class="formField_time">&nbsp;&nbsp;:&nbsp;
        <input type="text" id="bookingStartDateMinute" name="bookingStartDateMinute" value="<?= $bookingStartDateTime->format('i') ?>" class="formField_time">
      </td>
    </tr>
    <tr>
      <td>Booking End Time (24 hr):</td>
      <td>
        <input type="text" id="bookingEndDate" name="bookingEndDate" value="<?= $bookingEndDateTime->format('d/m/Y') ?>" class="formField_date">&nbsp;&nbsp;&nbsp;
        <input type="text" id="bookingEndDateHour" name="bookingEndDateHour" value="<?= $bookingEndDateTime->format('H') ?>" class="formField_time">&nbsp;&nbsp;:&nbsp;
        <input type="text" id="bookingEndDateMinute" name="bookingEndDateMinute" value="<?= $bookingEndDateTime->format('i') ?>" class="formField_time">
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

  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
