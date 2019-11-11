<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $sql = "SELECT b.BookingID, b.VehicleID, b.BookingType, b.BookingTotal, b.BookingDate, b.BookingStartTime, b.BookingEndTime, b.UserID, v.VehicleMake, v.VehicleModel, v.VehicleTypeName, u.FirstName, u.LastName FROM BookingsCurrent b INNER JOIN VehicleDetails v ON b.VehicleID = v.VehicleID INNER JOIN Users u ON b.UserID = u.UserID WHERE b.Active = 1 ORDER BY b.DateCreated DESC";

  $today = date("Y-m-d H:i:s");
?>

<script>
  function deleteBooking(bookingid) {
    if (confirm("Are you sure you want to delete this Booking?")) {
      window.location.href = "updateBooking.php?action=delete&BookingID=" + bookingid;
    }
  }

  function cancelBooking(bookingid) {
    if (confirm("Are you sure you want to cancel this Booking?")) {
      window.location.href = "updateBooking.php?action=cancel&BookingID=" + bookingid;
    }
  }
</script>

<?php if (isset($_GET['action'])) { ?>
  <p class="responseMessage">
    <?php
      switch ($_GET['action']) {
        case "activate":
          echo "Booking activated successfully.";
          break;
        case "add":
          echo "Booking added successfully.";
          break;
        case "edit":
          echo "Booking updated successfully.";
          break;
        case "delete":
          echo "Booking deleted successfully.";
          break;
        case "cancel":
          echo "Booking cancelled successfully.";
          break;
      }
    ?>
  </p>
<?php } ?>

<div class="admin_section_title_div">
  <h1>All Bookings</h1>
  <a href="add.php" class="admin_add_link">Add Booking</a>
</div>
<table class="list_table">
  <tr>
    <th>Vehicle</th>
    <th>Customer</th>
    <th>Booking Date</th>
    <th>Booking Start Time</th>
    <th>Booking End Time</th>
    <th>Booking Total</th>
    <th>Actions</th>
  </tr>
  <?php
    if ($result = mysqli_query($db, $sql)) {
      if ($result->num_rows > 0) {
        while ($booking = mysqli_fetch_assoc($result)) {
  ?>
    <tr>
      <td><?= $booking['VehicleMake'] . ' ' . $booking['VehicleModel'] . ' (' . $booking['VehicleTypeName'] . ')' ?></td>
      <td><?= $booking['FirstName'] . ' ' . $booking['LastName'] ?></td>
      <td><?= $booking['BookingDate'] ?></td>
      <td><?= $booking['BookingStartTime'] ?></td>
      <td><?= $booking['BookingEndTime'] ?></td>
      <td>$<?= $booking['BookingTotal'] ?></td>
      <td>
        <a href="edit.php?BookingID=<?= $booking['BookingID']?>">Edit</a>&nbsp;|&nbsp;
        <a href="javascript: deleteBooking(<?= $booking['BookingID'] ?>)">Delete</a>
        <?php if($booking['BookingStartTime'] >= $today) { ?>
          &nbsp;|&nbsp;<a href="javascript: cancelBooking(<?= $booking['BookingID'] ?>)">Cancel</a>
        <?php } ?>
      </td>
    </tr>
  <?php
      }
    } else {
  ?>
    <tr>
      <td colspan="7" style="text-align: center;">
        <br/>
        No records found.
        <br/><br/><br/>
      </td>
    </tr>
  <?php
      }
    }
  ?>
</table>

<?php
  if ($result)
    mysqli_free_result($result);
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/footer.php');
?>
