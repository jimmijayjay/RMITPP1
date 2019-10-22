function getVehicleTypeNames() {
  $.ajax({
    type: "GET",
    url: "/admin/bookings/vehicleSearch.php?action=getVehicleTypeNames",
    success: function(data) {
      var opts = $.parseJSON(data);

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
      var opts = $.parseJSON(data);

      resetDropdown(2);
      resetDropdown(3);

      $.each(opts, function(i, d) {
        var split = d.split("|");
        $('#vehicleModel').append('<option value="' + split[1] + '">' + split[0] + ' ' + split[1] + '</option>');
      });
    }
  });
}

function getVehicleAddress(value) {
  $.ajax({
    type: "GET",
    url: "/admin/bookings/vehicleSearch.php?action=getVehicleAddress&vehicleModel=" + value,
    success: function(data) {
      var opts = $.parseJSON(data);

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
