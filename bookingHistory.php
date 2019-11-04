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

<script>
  function downloadInvoice(bookingid) {
    window.open('bookingInvoicePDF.php?bookingid=' + bookingid, '_blank');
  }

  function downloadHistory(bookingid) {
    window.open('bookingHistoryPDF.php?bookingid=' + bookingid, '_blank');
  }

  function cancelBooking(bookingid) {
    window.open('cancel.php?bookingid=' + bookingid);
  }

</script>

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
  <a href="user.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>&nbsp;&nbsp;&nbsp;<a href="return.php">Return Car</a><br/><br/>
  <button type="button" onclick="downloadHistory(<?= $booking['BookingID'] ?>)" class="btn_download">Download PDF</button>
</div>

<section class="probootstrap-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <?php if ($_SESSION["canceled"]=="success"){?>
          <h3>Booking Canceled</h3> 
          <?php 
            $_SESSION["canceled"]="Fail"; 
            ?>
        <?php } ?>
        <?php if ($bookings->num_rows == 0) { ?>
          No Bookings Found.
        <?php } else { ?>
          <table style="width:90%;margin: 0 auto;">
            <tr class="bookingHistoryTableHeaders">
              <th>Date</th>
              <th>Vehicle</th>
              <th>Vehicle&nbsp;Type</th>
              <th>Booking&nbsp;Duration</th>
              <th>Booking&nbsp;Fee</th>
              <th>Download</th>
              <th></th>
            </tr>
            <?php
                while ($booking = $bookings->fetch_assoc()) {
                  $bookingDate = date_create($booking['BookingDate']);
                  $bookingStartDate = date_create($booking['BookingStartTime']);
                  $bookingEndDate = date_create($booking['BookingEndTime']);
            ?>
              <tr class="bookingHistoryTableBody">
                <td><?= date_format($bookingDate, "d M, Y") ?></td>
                <td><?= $booking["VehicleMake"] . ' ' . $booking["VehicleModel"] ?></td>
                <td><?= $booking["VehicleTypeName"] ?></td>
                <td><?= date_format($bookingStartDate, "d M, Y (g:i A)") . ' - ' . date_format($bookingEndDate, "d M, Y (g:i A)") ?></td>
                <td>$<?= $booking["BookingTotal"] ?></td>
                <td><button type="button" onclick="downloadInvoice(<?= $booking['BookingID'] ?>)" class="btn_download">Invoice</button></td>
                <td>
                <?php
                $today = date("Y-m-d H:i:s");
                  if($booking['BookingStartTime'] >= $today){?>
                    <button type="button" onclick="return confirm('Are you sure want to return this car?'),cancelBooking(<?= $booking['BookingID'] ?>)" class="btn_download">Cancel</button>
                  <?php } ?>
                  </td>
              </tr>
            <?php } ?>
          </table>
        <?php } ?>
      </div>
    </div>
  </div>
</section>



<?php include_once('includes/footer.php'); ?>
