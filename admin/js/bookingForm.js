var SELECTED_BOOKING_FEE = 0; // Note: This is a global variable that is referenced in the js script

function getVehicleTypeNames() {
  $.ajax({
    type: "GET",
    url: "/admin/bookings/vehicleSearch.php?action=getVehicleTypeNames",
    success: function(data) {
      var opts = JSON.parse(data);

      resetDropdown(1);
      resetDropdown(2);
      resetDropdown(3);

      $.each(opts, function(i, d) {
        $('#vehicleType').append('<option value="' + d + '">' + d + '</option>');
      });
    }
  });
}

function getVehicleModel(value) {
  $.ajax({
    type: "GET",
    url: "/admin/bookings/vehicleSearch.php?action=getVehicleModelByType&vehicleTypeName=" + value,
    success: function(data) {
      var opts = JSON.parse(data);

      resetDropdown(2);
      resetDropdown(3);

      $.each(opts, function(i, d) {
        var split = d.split("|");
        $('#vehicleModel').append('<option value="' + split[1] + '">' + split[0] + ' ' + split[1] + '</option>');
      });

      var split = opts[0].split("|");

      // Set the global booking fee
      SELECTED_BOOKING_FEE = parseInt(split[2]);
    }
  });
}

function getVehicleAddress(value) {
  $.ajax({
    type: "GET",
    url: "/admin/bookings/vehicleSearch.php?action=getVehicleAddress&vehicleModel=" + value,
    success: function(data) {
      var opts = JSON.parse(data);

      resetDropdown(3);

      $.each(opts, function(i, d) {
        var split = d.split("|");
        $('#vehicleid').append('<option value="' + split[0] + '">' + split[1] + '</option>');
      });
    }
  });
}

function resetDropdown(type) {
  if (type == 1) {
    $('#vehicleType').empty();
    $('#vehicleType').append('<option value="">Please select a vehicle type</option>');
  } else if (type == 2) {
    $('#vehicleModel').empty();
    $('#vehicleModel').append('<option value="">Please select a vehicle model</option>');
  } else if (type == 3) {
    $('#vehicleid').empty();
    $('#vehicleid').append('<option value="0">Please select a vehicle address</option>');
  }
}

function checkHour(hour) {
  if (hour < 0 || hour > 23) {
    return false;
  }

  return true;
}

function checkMinute(minute) {
  if (minute < 0 || minute > 59) {
    return false;
  }

  return true;
}

function checkForm() {
  var error = "";
  var startHour = $("#bookingStartDateHour").val();
  var startMin = $("#bookingStartDateMinute").val();
  var endHour = $("#bookingEndDateHour").val();
  var endMin = $("#bookingEndDateMinute").val();

  if ($("#userid").val() == 0) {
    error += "You must select a customer.<br/>";
  }

  if ($("#vehicleid").val() == 0) {
    error += "You must select a vehicle.<br/>";
  }

  if ($("#bookingStartDate").val() == "") {
    error += "You must select a booking start date.<br/>";
  }

  if ((startHour == "" || (startHour != "" && !checkHour(startHour))) || (startMin == "" || (startMin != "" && !checkMinute(startMin)))) {
    error += "You must enter a valid booking start time.<br/>";
  }

  if ($("#bookingEndDate").val() == "") {
    error += "You must select a booking end date.<br/>";
  }

  if ((endHour == "" || (endHour != "" && !checkHour(endHour))) || (endMin == "" || (endMin != "" && !checkMinute(endMin)))) {
    error += "You must enter a valid booking end time.<br/>";
  }

  if ($("#bookingTotal").val() == "") {
    error += "You must enter a booking total.";
  }

  if (error != "") {
    $("#errorDiv").html(error);
    return false;
  }

  return true;
}

function calculateBookingFee() {
  // Split the date field to get to the values
  var date1_split = $("#bookingStartDate").val().split("/");
  var date2_split = $("#bookingEndDate").val().split("/");

  // Split the time form field
  var time1_split = $("#bookingStartTime").val().split(":");
  var time2_split = $("#bookingEndTime").val().split(":");

  // Create the JS date/time object from the splits above
  var date1 = new Date(date1_split[2], parseInt(date1_split[1])-1, date1_split[0], time1_split[0], time1_split[1]);
  var date2 = new Date(date2_split[2], parseInt(date2_split[1])-1, date2_split[0], time2_split[0], time2_split[1]);

  // Now calculate the number of hours in between
  var hours = Math.abs(date2 - date1) / 3600000;

  $("#bookingTotal").val(hours * SELECTED_BOOKING_FEE);
}
