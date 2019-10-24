<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . '/admin/includes/header.php');

  $sql = "SELECT v.VehicleID, v.VehicleMake, v.VehicleModel, v.VehicleTypeName, v.VehicleAvailability, v.VehicleSuburb, v.VehicleAddress, v.VehicleLatitude, v.VehicleLongitude, v.Active, br.BookingFee, br.BookingPenaltyRate FROM VehicleDetails v INNER JOIN BookingRates br ON v.VehicleTypeName = br.VehicleTypeName WHERE v.Active = 1 ORDER BY v.VehicleTypeName";
?>

<script>
  function deleteVehicle(vehicleid) {
    if (confirm("Are you sure you want to delete this Vehicle?")) {
      window.location.href = "updateVehicle.php?action=delete&VehicleID=" + vehicleid;
    }
  }
</script>

<?php if (isset($_GET['action'])) { ?>
  <p class="responseMessage">
    <?php
      switch ($_GET['action']) {
        case "add":
          echo "Vehicle added successfully.";
          break;
        case "edit":
          echo "Vehicle updated successfully.";
          break;
        case "delete":
          echo "Vehicle deleted successfully.";
          break;
      }
    ?>
  </p>
<?php } ?>
<div class="admin_section_title_div">
  <h1>All Vehicles</h1>
  <a href="add.php" class="admin_add_link">Add Vehicle</a>
</div>
<table class="list_table">
  <tr>
    <th>Vehicle&nbsp;Type</th>
    <th>Vehicle</th>
    <th>Vehicle&nbsp;Address</th>
    <th>Booking&nbsp;Fee</th>
    <th>Booking&nbsp;Penalty&nbsp;Rate</th>
    <th>Actions</th>
  </tr>
  <?php
    if ($result = mysqli_query($db, $sql)) {
      if ($result->num_rows > 0) {
        while ($vehicle = mysqli_fetch_assoc($result)) {
  ?>
    <tr>
      <td><?= $vehicle['VehicleTypeName'] ?></td>
      <td><?= $vehicle['VehicleMake'] . ' ' . $vehicle['VehicleModel'] ?></td>
      <td><?= $vehicle['VehicleAddress'] ?></td>
      <td><?= $vehicle['BookingFee'] ?></td>
      <td><?= $vehicle['BookingPenaltyRate'] ?></td>
      <td>
        <a href="edit.php?VehicleID=<?= $vehicle['VehicleID']?>">Edit</a>&nbsp;|&nbsp;<a href="javascript: deleteVehicle(<?= $vehicle['VehicleID'] ?>)">Delete</a>
      </td>
    </tr>
  <?php
      }
    } else {
  ?>
    <tr>
      <td colspan="5" style="text-align: center;">
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
