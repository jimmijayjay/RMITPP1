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

<section class="probootstrap-cover">
 <div class="container">
   <div class="row probootstrap-vh-75 align-items-center text-left">
     <div class="col-sm">
       <div class="probootstrap-text pt-5">
         <h1 class="probootstrap-heading text-white mb-4">Booking History</h1>
         <div class="probootstrap-subheading mb-5">
           <p class="h4 font-weight-normal">
             View all previous and current bookings
             <br/><br/>
           </p>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

<div id="account_submenu">
  <a href="user.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>&nbsp;&nbsp;&nbsp;<a href="return.php">Return Car</a>
</div>

<section class="probootstrap-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 id="booking_history_title">Booking History</h4>&nbsp;<a href="bookingHistoryPDF.php" target="_blank" id="booking_history_download"><img src="images/pdf_icon_16_x_16.png" width="16" height="16" id="pdf_icon">&nbsp;Download History</a>
        <table id="booking_history_table">
          <tr>
            <th>Date</th>
            <th>Vehicle</th>
            <th>Vehicle&nbsp;Type</th>
            <th>Booking&nbsp;Duration</th>
            <th>Booking&nbsp;Fee</th>
            <th>Download</th>
          </tr>
          <?php if ($bookings->num_rows == 0) { ?>
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
                $bookingDate = date_create($booking['BookingDate']);
                $bookingStartDate = date_create($booking['BookingStartTime']);
                $bookingEndDate = date_create($booking['BookingEndTime']);
          ?>
            <tr>
              <td><?= date_format($bookingDate, "d M, Y") ?></td>
              <td><?= $booking["VehicleMake"] . ' ' . $booking["VehicleModel"] ?></td>
              <td><?= $booking["VehicleTypeName"] ?></td>
              <td><?= date_format($bookingStartDate, "d M, Y (g:i A)") . ' - ' . date_format($bookingEndDate, "d M, Y (g:i A)") ?></td>
              <td>$<?= $booking["BookingTotal"] ?></td>
              <td><a href="bookingInvoicePDF.php?bookingid=<?= $booking['BookingID'] ?>" target="_blank">Invoice</a></td>
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

<?php include_once('includes/footer.php'); ?>
