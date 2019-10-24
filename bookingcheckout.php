<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
  
    // INIT
    require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
    require PATH_LIB . "2b-lib-res.php";
    require_once 'includes/init.php';

    $errors = array();
    
    $start = $_SESSION['start'];
    $end = $_SESSION['end'];
    $vehicle_id = $_SESSION['vehicle_id'];

    $payment = new Payment();
    $Hours = $payment->calHours($start, $end);
    $FeePerHour = $payment->getFeePerHour($vehicle_id);
    $TotalFee = $payment->calFee($start, $end, $vehicle_id);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reslib = new Res();

        $start = $_SESSION['start'];
        $end = $_SESSION['end'];
        $vehicle_id = $_SESSION['vehicle_id'];
        $payment = new Payment();
        $Hours = $payment->calHours($start, $end);
        $FeePerHour = $payment->getFeePerHour($vehicle_id);
        $TotalFee = $payment->calFee($start, $end, $vehicle_id);
        
        $check = $reslib->bookRangeValidate("", "", "", $start, $end, "",  $vehicle_id);
        if(!$check){
           Redirect::to('car-alreay-booked.php');
           echo "If condition (check) is running";
        }else{
            echo "If (Check) is not running";
        }
        
        $pass = $reslib->bookRange(
        "", "", "", $start, $end, 
        "",  $vehicle_id, $FeePerHour, $Hours, $TotalFee, $FeePerHour, $Hours, $TotalFee);       
            
        if($pass){
            Redirect::to('3d-thank-you.php');
        }
    }

    
    
 ?>   

<head>
  <link rel="stylesheet" href="./css/checkoutstyles.css">
</head>
<body>
     
    
    
    <div class="row">
  <div class="col-75">
    <div class="container">
       <form action="bookingcheckout.php" method="post">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fullname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="300 Bourke St">
            <label for="suburb"><i class="fa fa-institution"></i> Suburb</label>
            <input type="text" id="suburb" name="suburb" placeholder="Melbourne">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="VIC">
              </div>
              <div class="col-50">
                <label for="zip">Post Code</label>
                <input type="text" id="PostCode" name="PostCode" placeholder="3000">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cardname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>
        <label>
          <input type="checkbox" id="SaveCard" checked="checked" name="savecard"> Save Card Details for Next Booking
        </label>

        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Booking Details
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
       
        </span>
      </h4>
      <p>Booking Start Time</a> <span class="price"><?php echo $_SESSION['start']?></span></p>
      <p>Booking End Time</a> <span class="price"><?php echo $_SESSION['end'] ?></span></p>
      <p>Fee Per Hour</a> <span class="price"><?php echo "$".$FeePerHour ?></span></p>
      <p>Number of Hours</a> <span class="price"><?php echo $Hours ?></span></p>


      <hr>
      <p>Total <span class="price" style="color:black"><b><?php echo "$".$TotalFee;?></b></span></p>
    </div>
  </div>
</div>

</body>


