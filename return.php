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
         <h1 class="probootstrap-heading text-white mb-4">Return Car</h1>
         <div class="probootstrap-subheading mb-5">
           <p class="h4 font-weight-normal">View cars that you haven't returned yet<br><br>
           <!--This will allow you to log into our system and see when cars are available<br><br>
           You will need to finish your membership application and be activated before you can book --></p>
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
        <h4 id="booking_history_title">Unreturned Cars</h4>
        <table id="booking_history_table">
          <tr>
            <th>Booking Date</th>
            <th>Vehicle</th>
            <th>Vehicle&nbsp;Type</th>
            <th>Due&nbsp;Back</th>
            <th>Booking&nbsp;Fee</th>
            <th>Download</th>
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
                $bookingDate = date_create($booking['BookingDate']);
                $bookingStartDate = date_create($booking['BookingStartTime']);
                $bookingEndDate = date_create($booking['BookingEndTime']);
                //date_default_timezone_set('Australia/Melbourne');
                //$date = date('m/d/Y h:i:s a', time());
                //if ( $booking["BookingStartTime"]!="returned"){?>
                <tr>
                    <td><?= $bookingDate ?></td>
                    <td><?= $booking["VehicleMake"] . ' ' . $booking["VehicleModel"] ?></td>
                    <td><?= $booking["VehicleTypeName"] ?></td>
                    <td><?= date_format($bookingEndDate, "d M, Y (g:i A)") ?></td>
                    <td>$<?= $booking["BookingTotal"] ?></td>
                    <td><?php echo '<a href="bookingReturn.php?BookingID='.$booking["id"].'">';?>RETURN CAR</a></td>
                </tr>
            <?php 
              }
            }
          ?>
        </table>
      </div>
    </div>
  </div>
  <pre>
  <?php echo print_r($booking) ; ?>
  </pre>

</section>



<?php include_once('includes/footer.php'); ?>
