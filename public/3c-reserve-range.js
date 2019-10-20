var res = {
  calstart : function () {
  // res.calstart() : show calendar for date start
    res.cal("start");
  },

  calend : function () {
  // res.calend() : show calendar for date end
    res.cal("end");
  },

  cal : function (target) {
  // res.cal() : show calendar
  // target : start or end

    // Disable submit first
    document.getElementById("res_go").disabled = true;

    // Target event handlers
    var calchange = target=="start" ? res.calstart : res.calend ;
    var picker = target=="start" ? res.pickstart : res.pickend ;

    // AJAX data
    var data = new FormData();
    data.append('req', 'show-cal');

    // Get selected month & year - If they exist
    var select = document.querySelector("#res_" + target +" select.month");
    if (select!=null) {
      data.append('month', select.value);
      select = document.querySelector("#res_" + target + " select.year");
      data.append('year', select.value);
    }

    // AJAX call
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-reserve.php", true);
    xhr.onload = function(){
      // Set contents, click, change actions
      document.getElementById("res_" + target).innerHTML = this.response;
      select = document.querySelector("#res_" + target + " select.month");
      select.addEventListener("change", calchange);
      select = document.querySelector("#res_" + target + " select.year");
      select.addEventListener("change", calchange);
      select = document.querySelectorAll("#res_" + target + " .pick, #res_" + target + " .active");
      for (var i of select) {
        i.addEventListener("click", picker);
      }
      
      if(target==="start"){
        // Load time slots
        res.slotStart();  
      }
      
       if(target==="end"){
        // Load time slots
        res.slotEnd();  
      }

      
      

      // Enable submit
      document.getElementById("res_go").disabled = false;
    };
    xhr.send(data);
  },

  slotStart : function () {
  // res.slot() : load time slot selector

    // Disable submit first
    document.getElementById("res_go").disabled = true;

    // Selected date
    var select = document.querySelector("#res_start td.active").innerHTML;
    if (select.length==1) { select = "0" + select; }
    select = document.querySelector("#res_start select.month").value + "-" + select;
    select = document.querySelector("#res_start select.year").value + "-" + select;

    // AJAX data
    var data = new FormData();
    data.append('req', 'show-slot');
    data.append('date', select);

    // AJAX call
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-reserve.php", true);
    xhr.onload = function(){
      // Set contents
      document.getElementById("res_slot_start").innerHTML = this.response;

      // Enable submit
      document.getElementById("res_go").disabled = false;
    };
    xhr.send(data);
  },
  
   slotEnd : function () {
  // res.slot() : load time slot selector

    // Disable submit first
    document.getElementById("res_go").disabled = true;

    // Selected date
    var select = document.querySelector("#res_end td.active").innerHTML;
    if (select.length==1) { select = "0" + select; }
    select = document.querySelector("#res_end select.month").value + "-" + select;
    select = document.querySelector("#res_end select.year").value + "-" + select;

    // AJAX data
    var data = new FormData();
    data.append('req', 'show-slot');
    data.append('date', select);

    // AJAX call
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-reserve.php", true);
    xhr.onload = function(){
      // Set contents
      document.getElementById("res_slot_end").innerHTML = this.response;

      // Enable submit
      document.getElementById("res_go").disabled = false;
    };
    xhr.send(data);
  },


  pickstart : function () {
  // res.pickstart() : change selected date for date start

    res.pick('start', this);
  },

  pickend : function () {
  // res.pickend() : change selected date for date end

    res.pick('end', this);
  },

  pick : function (target, picked) {
  // res.pick() : change selected date
  // target : start or end
  // picked : current element being clicked on

    var select = document.querySelector("#res_" + target + " .active");
    if (select!=picked) {
      select.classList.remove("active");
      select.classList.add("pick");
      picked.classList.remove("pick");
      picked.classList.add("active");
    }
  },

  save : function () {
  // res.save() : save the reservation

    // Selected start date
    var start = document.querySelector("#res_start td.active").innerHTML;
    if (start.length==1) { start = "0" + start; }
    start = document.querySelector("#res_start select.month").value + "-" + start;
    start = document.querySelector("#res_start select.year").value + "-" + start;

    // Selected end date
    var end = document.querySelector("#res_end td.active").innerHTML;
    if (end.length==1) { end = "0" + end; }
    end = document.querySelector("#res_end select.month").value + "-" + end;
    end = document.querySelector("#res_end select.year").value + "-" + end;

    // End date must be after start date
    if (Date.parse(start)- Date.parse(end)>30) {
      alert("Booking period cannot exceed a month");
    } else {
      // AJAX data
      var data = new FormData();
      data.append('req', 'book-range');
      data.append('name', document.getElementById("res_name").value);
      data.append('email', document.getElementById("res_email").value);
      data.append('tel', document.getElementById("res_tel").value);
      data.append('vehicle_id', document.getElementById("vehicle_id").value);
      data.append('notes', document.getElementById("res_notes").value);
      data.append('start', start);
      data.append('end', end);
      data.append('slot_start', document.querySelector("#res_slot_start select").value);
      data.append('slot_end', document.querySelector("#res_slot_end select").value);
      


      // AJAX call
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "2c-ajax-reserve.php", true);
      xhr.onload = function(){
        var res = JSON.parse(this.response);
        // OK - Redirect to thank you page
        if (res.status==1) {
          location.href = "3d-thank-you.html";
        }else if(res.status==2){
          location.href = "login.php"; 
        } else {
            // ERROR - show error
          alert(res.message);
        }
      };
      xhr.send(data);
    }
    return false;
  }
};

window.addEventListener("load", function(){
  res.calstart();
  res.calend();
  
});