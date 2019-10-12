<!DOCTYPE html>
<html>
  <head>
    <title>
      PHP Reservation Demo - Date Range Booking
    </title>
    <script src="public/3c-reserve-range.js"></script>
    <link href="public/3-theme.css" rel="stylesheet">
  </head>
  <body>
    <h1>
      RESERVATION
    </h1>
    <form id="res_form" onsubmit="return res.save()">
 
      <input type="hidden" id="res_name" value="John Doe"/>

      <input type="hidden" id="res_email" value="john@doe.com"/>

      <input type="hidden" id="res_tel" value="123456"/>

      <input type="hidden" id="res_notes" value="test"/>
      <label for="vehicle_id">Vehicle ID</label>
      <input type="text" required id="vehicle_id"  value="<?php echo $_POST['location'];?>"/>
      <label>Reservation Start Date</label>
      <div id="res_start" class="calendar"></div>
      <label>Reservation Start Time</label>
      <div id="res_slot_start"></div>
      <label>Reservation End Date</label>
      <div id="res_end" class="calendar"></div>
      <label>Reservation End Time</label>
      <div id="res_slot_end"></div>
      <button id="res_go" disabled>
        Submit
      </button>
    </form>
  </body>
</html>