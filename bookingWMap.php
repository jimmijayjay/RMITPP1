<?php include_once('includes/header.php'); ?>
  <?php include_once('tools/currentBookings.php'); ?>    
    <section class="probootstrap-cover">
      <div class="container">
        <div class="row probootstrap-vh-75 align-items-center text-left">
          <div class="col-sm">
            <div class="probootstrap-text pt-5">
              <h1 class="probootstrap-heading text-white mb-4">Book a car </h1>
              <div class="probootstrap-subheading mb-5">
                <p class="h4 font-weight-normal">Pick your car on the map below.<br><br>
                <!--This will allow you to log into our system and see when cars are available<br><br>
                You will need to finish your membership application and be activated before you can book --></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<form action="booking2.php" method="post" >
<div id="mapid" style="width: 80%;	height: 600px;	margin: 0 auto;	margin-top: 20px;	margin-bottom: 20px;"></div>
</form>


<script>

var mymap = L.map('mapid').setView([-37.810242, 144.954321], 15.8);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
  '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
  'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox.streets'
}).addTo(mymap);




var jArray2 = <?php echo json_encode($output_array); ?>;
var str1 = "jArray2"
var res = eval(jArray2)
Object.keys(res).forEach(function(key) {
  //console.log(key, res[key]);
  Object.keys(res[key]).forEach(function(subKey) {
    //console.log(subKey, res[key][subKey]);
    Object.keys(res[key][subKey]).forEach(function(subKey2) {
      //console.log(subKey2, res[key][subKey][subKey2]);
      Object.keys(res[key][subKey][subKey2]).forEach(function(subKey3) {
        //console.log(subKey3, res[key][subKey][subKey2][subKey3]);
        //console.log("VehicleLatitude" + res[key][subKey][subKey2][subKey3]["VehicleLatitude"]);
        //console.log("VehicleLongitude" + res[key][subKey][subKey2][subKey3]["VehicleLongitude"]);
        //console.log("VehicleAddress" + res[key][subKey][subKey2][subKey3]["VehicleAddress"]);
         

        L.marker([res[key][subKey][subKey2][subKey3]["VehicleLatitude"], res[key][subKey][subKey2][subKey3]["VehicleLongitude"]]).on('click', markerOnClick).addTo(mymap)
        .bindPopup("<b>Melbourne CBD - Public Parking</b><br>" + res[key][subKey][subKey2][subKey3]['VehicleAddress'] + "<br />" + subKey + ' '+ subKey2 + '<input type="hidden" name="location" value="' + res[key][subKey][subKey2][subKey3]["VehicleID"] + '"><br><input type="submit" value="book">');

      });
    });
  });
});

  var popup = L.popup();
  var strLong = "";
  var strLat = "";
  
  
  function onMapClick(e) {
    popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map at " + e.latlng.toString())
    .openOn(mymap);
  }
  
  /*  ONCLICK MY MARKER   */
  function markerOnClick(e)
  {
    strLong = e.latlng.lat;
    strLat = e.latlng.lng;
  }

  
  mymap.on('click', onMapClick);
  
  </script>

  <?php include_once('tools/footer.php'); ?>  
  
  
  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  </body>
  </html>