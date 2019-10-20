<?php

  require_once 'includes/init.php';

  if (isset($_SESSION['car_buddy_userid']) && !empty($_SESSION['car_buddy_userid'])) {
    $thisUser = new User($_SESSION['car_buddy_userid']);
  } else {
    $thisUser = new User();
  }

  $bookings = $thisUser->getAllBookings($thisUser->getUserID());

  include_once('includes/header.php');
?>

<!-- <section style="text-align: center;margin: 0 auto;">
  <a href="user.php">Account Details</a>
</section> -->

<section class="probootstrap-cover">
 <div class="container">
   <div class="row probootstrap-vh-75 align-items-center text-left">
     <div class="col-sm">
       <div class="probootstrap-text pt-5">
         <h1 class="probootstrap-heading text-white mb-4">Booking History</h1>
         <div class="probootstrap-subheading mb-5">
           <p class="h4 font-weight-normal">View all previous and current bookings<br><br>
           <!--This will allow you to log into our system and see when cars are available<br><br>
           You will need to finish your membership application and be activated before you can book --></p>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

<div id="account_submenu">
  <a href="user.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>
</div>

<section class="probootstrap-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 id="booking_history_title">Booking History</h4>
        <table id="booking_history_table">
          <tr>
            <th>Date</th>
            <th>Vehicle</th>
            <th>Vehicle&nbsp;Type</th>
            <th>Booking&nbsp;Duration</th>
            <th>Booking&nbsp;Fee</th>
            <th>Actions</th>
          </tr>
          <?php if (empty($bookings)) { ?>
          <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">
              <br/><br/>
              No bookings found.
              <br/><br/><br/>
            </td>
          </tr>

          <?php
            } else {
              while ($booking = $bookings->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $booking["BookingDate"] ?></td>
              <td><?= $booking["VehicleMake"] . ' ' . $booking["VehicleModel"] ?></td>
              <td><?= $booking["VehicleTypeName"] ?></td>
              <td><?= $booking["BookingStartTime"] . ' - ' . $booking["BookingStartTime"] ?></td>
              <td>$<?= $booking["BookingTotal"] ?></td>
              <td><a href="bookingHistoryPDF.php" target="_blank">PDF</a></td>
            </tr>
          <?php
              }
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- <table style="width:90%;margin: 0 auto;">
<tr class="bookingHistoryTableHeaders">
<th>Date</th>
<th>Vehicle Type</th>
<th>Vehicle Model</th>
<th>Booking Duration</th>
<th>Pick Up Location</th>
<th>Drop Off Location</th>
<th>Booking Fee</th>
</tr>
<tr class="bookingHistoryTableBody">
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table> -->

<?php include_once('includes/footer.php'); ?>
