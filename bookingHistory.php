<?php

  require_once 'includes/init.php';

  $thisUser = new User();

  if (isset($_SESSION[Config::get('sessions/session_name')]) && $_SESSION[Config::get('sessions/session_name')]->isLoggedIn()) {
    $thisUser = $_SESSION[Config::get('sessions/session_name')];
  }

  $bookings = $thisUser->getAllBookings($thisUser->getUserID());

  include_once('includes/header.php');
?>

<section class="probootstrap-cover">
 <div class="container">
   <div class="row probootstrap-vh-75 align-items-center text-left">
     <div class="col-sm">
       <div class="probootstrap-text pt-5">
         <h1 class="probootstrap-heading text-white mb-4">Your CarBuddy Account</h1>
         <div class="probootstrap-subheading mb-5">
           <p class="h4 font-weight-normal">Manage your account below<br><br>
           <!--This will allow you to log into our system and see when cars are available<br><br>
           You will need to finish your membership application and be activated before you can book --></p>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

<div id="account_submenu">
  <a href="account.php">Account Details</a>&nbsp;&nbsp;&nbsp;<a href="bookingHistory.php">Booking History</a>
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
            <th>Vehicle Type</th>
            <th>Booking Duration</th>
            <th>Booking Fee</th>
          </tr>
          <?php //foreach($bookings as $key => $value) { ?>
            <tr>
              <td><?= $bookings ?></td>
              <td>whatever</td>
              <td>whatever</td>
              <td>whatever</td>
              <td>whatever</td>
            </tr>
          <?php //} ?>
        </table>
      </div>
    </div>
  </div>
</section>



<?php include_once('includes/footer.php'); ?>
