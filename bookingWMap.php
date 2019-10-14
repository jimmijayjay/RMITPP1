<?php include_once('includes/header.php'); ?>

<section class="probootstrap-cover">
<div class="container">
<div class="row probootstrap-vh-75 align-items-center text-left">
<div class="col-sm">
<div class="probootstrap-text pt-5">
<h1 class="probootstrap-heading text-white mb-4">Booking</h1>
<div class="probootstrap-subheading mb-5">
<p class="h4 font-weight-normal">Car Buddy Booking Page</p>
</div>
</div>
</div>
</div>
</div>
</section>

<!--<section class="probootstrap-section">
<div class="container">



</div>
</section>-->

<form>
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

L.marker([-37.8142, 144.955]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Public Parking</b><br>248 Lonsdale Street<br />Ford Ranger.");

L.marker([-37.8142, 144.956]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Public Parking</b><br>557 Lonsdale Street<br />Toyota Hilux.");

L.marker([-37.8135, 144.958]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Public Parking</b><br>483 Lonsdale Street<br />Nissan Nivara.");

L.marker([-37.8093, 144.956]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Franklin Street Public Carpark<br />Mitsubsihi Triton.");

L.marker([-37.8087, 144.956]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Queen Victoria Market Public Carpark<br />Toyota LandCruiser.");

L.marker([-37.8083, 144.957]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Queen Victoria Market  Public Carpark<br />Ford Falcon FGX.");

L.marker([-37.8087, 144.957]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Queen Victoria Market  Public Carpark<br />Holden Commodore VF.");

L.marker([-37.8087, 144.959]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>175 Franklin Street Public Carpark<br />Mazda 6.");

L.marker([-37.8084, 144.96]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>139 Franklin Street Public Carpark<br />Jaguar XF.");

L.marker([-37.8079, 144.961]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>107 Franklin Street Public Carpark<br />Audi A6.");

L.marker([-37.807, 144.958]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Queen Street Public Carpark<br />Toyota Corolla.");

L.marker([-37.8066, 144.958]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Queen Street Public Carpark<br />Hyundai i30.");

L.marker([-37.8066, 144.955]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>65 Capel Street Public Carpark<br />Mazda 3.");

L.marker([-37.8071, 144.955]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>42 Capel Street Public Carpark<br />Ford Focus.");

L.marker([-37.8075, 144.955]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>22 Capel Street Public Carpark<br />Hyundai Veloster.");

L.marker([-37.8074, 144.953]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>40 Rosslyn Street Public Carpark<br />Kia Carnival.");

L.marker([-37.8078, 144.952]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>70 Rosslyn Street Public Carpark<br />Honda Odyssey Vti-L.");

L.marker([-37.8084, 144.951]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>96 Rosslyn Street Public Carpark<br />Toyota HiAce.");

L.marker([-37.808, 144.95]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>Stanley Street Public Carpark<br />Mazda MX-5.");

L.marker([-37.8088, 144.948]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>130 Stanley Street Public Carpark<br />BMW M850i.");

L.marker([-37.8083, 144.946]).on('click', markerOnClick).addTo(mymap)
.bindPopup("<b>Melbourne CBD - Secure Parking</b><br>143 Hawke Street Public Carpark<br />Alfa Romeo 4C.");


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

  <?php include_once('includes/footer.php'); ?>  
