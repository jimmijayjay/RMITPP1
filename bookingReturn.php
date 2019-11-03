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

<?php

$carID = $_GET['BookingID'];

echo "<h1>Booking ID = ".$carID;


if ($result = $thisUser->returnBookings($carID)) {
  $_SESSION['returned']="success";
  Redirect::to('return.php');
} else {
  array_push($errors, "Return failed. Please try again later.");
}

