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

<script>
  function returnCar(bookingid) {
    window.open('bookingReturn.php?BookingID=' + bookingid, '_self');
  }

</script>

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
      <div class="col-md-12" style="text-align: center;">
          <?php 
          if($_SESSION['returned']=="success"){?>
              <h1>Thank you, Car returned successfully!</h1><br>  
          <?php 
            $_SESSION['returned']="";
          }

          if ($bookings->num_rows == 0) { ?>
          No Bookings Found.
        <?php } else {?>
          <!--<h4 id="booking_history_title">Unreturned Cars</h4>-->
          <table style="width:90%;margin: 0 auto;">
              <tr class="bookingHistoryTableHeaders">
              <th>Booking Date</th>
              <th>Vehicle</th>
              <th>Vehicle&nbsp;Type</th>
              <th>Due&nbsp;Back</th>
              <th>Booking&nbsp;Fee</th>
              <th>Return</th>
            </tr>
            <?php
              while ($booking = $bookings->fetch_assoc()) {
                $bookingDate = date_create($booking['BookingDate']);
                $bookingStartDate = date_create($booking['BookingStartTime']);
                $bookingEndDate = date_create($booking['BookingEndTime']);
                date_default_timezone_set('Australia/Melbourne');
                $date = date('Y-m-d h:i:s H', time());
                $today = date("Y-m-d H:i:s");
               
                if ( ($booking["BookingReturned"] == NULL) && ($booking['BookingStartTime'] <= $today)){?>
                  <tr class="bookingHistoryTableBody">
                      <td><?= date_format($bookingDate, "d M, Y") ?></td>
                      <td><?= $booking["VehicleMake"] . ' ' . $booking["VehicleModel"] ?></td>
                      <td><?= $booking["VehicleTypeName"] ?></td>
                      <td><?= date_format($bookingEndDate, "d M, Y (g:i A)") ?></td>
                      <td>$<?= $booking["BookingTotal"] ?></td>
                      <td>
                      <button type="button" onclick="return confirm('Are you sure want to return this car?'),returnCar(<?= $booking['BookingID'] ?>)" class="btn_download">Return</button></td>
                  </tr>
                  <?php
                }
               
              }
            }
          ?>
        </table>
      </div>
    </div>
  </div>

</section>



<?php include_once('includes/footer.php'); ?>
