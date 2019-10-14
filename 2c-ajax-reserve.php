<?php
// INIT
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-res.php";
$reslib = new Res();

/* ANTI-SPAM MEASURE YOU CAN CONSIDER
 * ONLY ALLOW REGISTERED USERS TO BOOK
 * YOU CAN DO SOMETHING LIKE THIS ->
session_start();
if (!is_array($_SESSION['user'])) {
  die(json_encode([
    "status" => 0,
    "message" => "You must be signed in first"
  ]));
}
*/

// HANDLE AJAX REQUEST
if ($_POST['req']) { switch ($_POST['req']) {
  // INVALID REQUEST
  default :
    echo json_encode([
      "status" => 0,
      "message" => "Invalid request"
    ]);
    break;

  // SHOW CALENDAR OR DATE SELECTOR
  case "show-cal":
    // Selected month and year + Various date yoga
    // * Will take current server time if not provided
    $thisMonth = (is_numeric($_POST['month']) && $_POST['month']>=1 && $_POST['month']<=12) ? $_POST['month'] : date("n");
    $thisYear = is_numeric($_POST['year']) ? $_POST['year'] : date("Y");
    $thisStart = strtotime(sprintf("%s-%02u-01", $thisYear, $thisMonth));
    $daysInMonth = date("t", $thisStart);
    $thisEnd = strtotime(sprintf("%s-%02u-%s", $thisYear, $thisMonth, $daysInMonth));
    $startDay = date("N", $thisStart);
    $endDay = date("N", $thisEnd);
    $yearNow = date("Y");
    $monthNow = date("n");
    $dayNow = date("j");

    // Calculate calendar squares
    $squares = [];

    // If the first day of the month is not Sunday, pad with blanks
    if ($startDay != 7) { for ($i=0; $i<$startDay; $i++) {
      $squares[] = ["b"=>1];
    }}

    // Days that have already past are not selectable
    // Earliest selectable is next day - Change this if you want
    $inow = 1;
    if ($thisYear==$yearNow && $thisMonth==$monthNow) {
      for ($inow=1; $inow<=$dayNow; $inow++) {
        $squares[] = ["d"=>$inow, "b"=>1];
      }
    }

    // Populate the rest of the selectable days
    for ($inow; $inow<=$daysInMonth; $inow++) {
      $squares[] = ["d"=>$inow];
    }

    /* This is an alternate version to show how you can put in date restrictions
     * For example, close off Sat & Sun reservations
    $dayNow = date("N", strtotime(sprintf("%s-%02u-%02u", $thisYear, $thisMonth, $inow)));
    for ($inow; $inow<=$daysInMonth; $inow++) {
      if ($dayNow==6 || $dayNow==7) { $squares[] = ["d"=>$inow, "b"=>1]; }
      else { $squares[] = ["d"=>$inow]; }
      $dayNow++;
      if ($dayNow==8) { $dayNow = 1; }
    }
    */

    // If the last day of the month is not Saturday, pad with blanks
    if ($endDay != 6) {
      $blanks = $endDay==7 ? 6 : 6-$endDay;
      for ($i=0; $i<$blanks; $i++) {
        $squares[] = ["b"=>1];
      }
    }

    // Draw calendar - Limit your selectable periods here if you want
    // Month selector
    $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    echo "<select class='month'>";
    // Does not allow months that have already passed this year
    for ($i=($yearNow==$thisYear ? $monthNow : 1); $i<=12; $i++) {
      printf("<option value='%02u'%s>%s</option>", 
        $i, $i==$thisMonth?" selected":"", $months[$i-1]
      );
    }
    echo "</select>";

    // Year selector
    echo "<select class='year'>";
    // Set to max 3 years from now - change it if you want
    for ($i=$yearNow; $i<=$yearNow+3; $i++) {
      printf("<option value='%s'%s>%s</option>", 
        $i, $i==$thisYear?" selected":"", $i
      );
    }
    echo "</select>";

    // Dates
    echo "<table><tr class='days'>";

    // First row - Days of week
    $days = ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
    foreach ($days as $d) { echo "<td>$d</td>"; }
    echo "</tr><tr>";

    // Following rows - Days in month
    $total = count($squares);
    $first = true;
    for ($i=0; $i<$total; $i++) {
      echo "<td class='";
      if ($squares[$i]['b']) {
        echo "blank";
      } else if ($first) {
        echo "active";
        $first = false;
      } else {
        echo "pick";
      }
      echo "'>";
      if ($squares[$i]['d']) { echo $squares[$i]['d']; }
      echo "</td>";
      if ($i!=0 && ($i+1)%7==0) {
        echo "</tr><tr>";
      }
    }
    echo "</tr></table>";
    break;

  // SHOW TIME SLOT SELECTOR
  case "show-slot":
    /* Do your own time slot logic here - AM/PM, Hourly, Bi-hourly, etc...
    // You can use the $_POST['date'] variable to restrict
    // E.g. AM slots for Sat & Sun
    $selected = date("N", strtotime($_POST['date']));
    $weekend = $selected==6 || $selected==7;
    if ($weekend) { RESTRICT }
    else { AS USUAL } */ ?>
    <select>
      <option value="00:00">00:00</option>>
      <option value="00:30">00:30</option>>
      <option value="01:00">01:00</option>>
      <option value="01:30">01:30</option>>
      <option value="02:00">02:00</option>>
      <option value="02:30">02:30</option>>
      <option value="03:00">03:00</option>>
      <option value="03:30">03:30</option>>
      <option value="04:00">04:00</option>>
      <option value="04:30">04:30</option>>
      <option value="05:00">05:00</option>>
      <option value="05:30">05:30</option>>
      <option value="06:00">06:00</option>>
      <option value="06:30">06:30</option>>
      <option value="07:00">07:00</option>>
      <option value="07:30">07:30</option>>
      <option value="08:00">08:00</option>>
      <option value="08:30">08:30</option>>
      <option value="09:00">09:00</option>>
      <option value="09:30">09:30</option>>
      <option value="10:00">10:00</option>>
      <option value="10:30">10:30</option>>
      <option value="11:00">11:00</option>>
      <option value="11:30">11:30</option>>
      <option value="12:00">12:00</option>>
      <option value="12:30">12:30</option>>
      <option value="13:00">13:00</option>>
      <option value="13:30">13:30</option>>
      <option value="14:00">14:00</option>>
      <option value="14:30">14:30</option>>
      <option value="15:00">15:00</option>>
      <option value="15:30">15:30</option>>
      <option value="16:00">16:00</option>>
      <option value="16:30">16:30</option>>
      <option value="17:00">17:00</option>>
      <option value="17:30">17:30</option>>
      <option value="18:00">18:00</option>>
      <option value="18:30">18:30</option>>
      <option value="19:00">19:00</option>>
      <option value="19:30">19:30</option>>
      <option value="20:00">20:00</option>>
      <option value="20:30">20:30</option>>
      <option value="21:00">21:00</option>>
      <option value="21:30">21:30</option>>
      <option value="22:00">22:00</option>>
      <option value="22:30">22:30</option>>
      <option value="23:00">23:00</option>>
      <option value="23:30">23:30</option>>
      <option value="24:00">24:00</option>>      
    </select>
    <?php break;

  // ADD NEW RESERVATION - WHOLE DAY BOOKING
  case "book-day":
    // Save reservation to database
    $pass = $reslib->bookDay(
      $_POST['name'], $_POST['email'], $_POST['tel'], $_POST['date'], 
      $_POST['notes'] ? $_POST['notes'] : ""
    );

    /* You can send an email if you want
    if ($pass) {
      $message = "";
      foreach ($_POST as $k=>$v) {
        $message .= $k . " - " . $v;
      }
      @mail("admin@yoursite.com", "Reservation receieved", $message);
    }
    */

    // Server response
    echo json_encode([
      "status" => $pass ? 1 : 0,
      "message" => $pass ? "OK" : $reslib->error
    ]);
    break;

  // ADD NEW RESERVATION - TIME SLOT BOOKING
  case "book-slot":
    // Save reservation to database
    $pass = $reslib->bookSlot(
      $_POST['name'], $_POST['email'], $_POST['tel'], $_POST['date'], $_POST['slot'],
      $_POST['notes'] ? $_POST['notes'] : ""
    );
    /* You can send an email if you want
    if ($pass) {
      $message = "";
      foreach ($_POST as $k=>$v) {
        $message .= $k . " - " . $v;
      }
      @mail("admin@yoursite.com", "Reservation receieved", $message);
    }
    */
    // Server response
    echo json_encode([
      "status" => $pass ? 1 : 0,
      "message" => $pass ? "OK" : $reslib->error
    ]);
    break;

  // ADD NEW RESERVATION - DATE RANGE BOOKING
  case "book-range":
    // Save reservation to database
    $startDateTime = $_POST['start']." ".$_POST['slot_start'].":00";
    $endDateTime = $_POST['end']." ".$_POST['slot_end'].":00";
    $pass = $reslib->bookRange(
      $_POST['name'], $_POST['email'], $_POST['tel'], $startDateTime, $endDateTime, 
      $_POST['notes'] ? $_POST['notes'] : "",  $_POST['vehicle_id']
    );
    
    /* You can send an email if you want
    if ($pass) {
      $message = "";
      foreach ($_POST as $k=>$v) {
        $message .= $k . " - " . $v;
      }
      @mail("admin@yoursite.com", "Reservation receieved", $message);
    }
    */
    
    // Server response
    echo json_encode([
      "status" => $pass ? 1 : 0,
      "message" => $pass ? "OK" : $reslib->error
    ]);
    break;
}}