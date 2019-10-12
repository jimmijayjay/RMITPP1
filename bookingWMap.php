<!DOCTYPE html>
<html lang="en">
<?php include_once('tools/head.php'); ?>
<body>
<?php include_once('tools/nav.php'); ?>    

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


<div id="mapid" style="width: 100%; height: 600px;"></div>


<script>

var mymap = L.map('mapid').setView([-37.810242, 144.954321], 15.8);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
  '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
  'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox.streets'
}).addTo(mymap);

L.marker([-37.8142, 144.955]).addTo(mymap)
.bindPopup("<b>Location 1</b><br />Ford Ranger.");

L.marker([-37.8142, 144.956]).addTo(mymap)
.bindPopup("<b>Location 2</b><br />Toyota Hilux.");

L.marker([-37.8135, 144.958]).addTo(mymap)
.bindPopup("<b>Location 3</b><br />Nissan Nivara.");

L.marker([-37.8093, 144.956]).addTo(mymap)
.bindPopup("<b>Location 4</b><br />Mitsubshi Triton.");

L.marker([-37.8087, 144.956]).addTo(mymap)
.bindPopup("<b>Location 5</b><br />Toyota LandCruiser.");

L.marker([-37.8083, 144.957]).addTo(mymap)
.bindPopup("<b>Location 6</b><br />Ford Falcon FGX.");

L.marker([-37.8087, 144.957]).addTo(mymap)
.bindPopup("<b>Location 7</b><br />Holden Commodore VF.");

L.marker([-37.8087, 144.959]).addTo(mymap)
.bindPopup("<b>Location 8</b><br />Mazda 6.");

L.marker([-37.8084, 144.96]).addTo(mymap)
.bindPopup("<b>Location 9</b><br />Jaguar XF.");

L.marker([-37.8079, 144.961]).addTo(mymap)
.bindPopup("<b>Location 10</b><br />Audi A6.");

L.marker([-37.807, 144.958]).addTo(mymap)
.bindPopup("<b>Location 11</b><br />Toyota Corolla.");

L.marker([-37.8066, 144.958]).addTo(mymap)
.bindPopup("<b>Location 12</b><br />Hyundai i30.");

L.marker([-37.8066, 144.955]).addTo(mymap)
.bindPopup("<b>Location 13</b><br />Mazda 3.");

L.marker([-37.8071, 144.955]).addTo(mymap)
.bindPopup("<b>Location 14</b><br />Ford Focus.");

L.marker([-37.8075, 144.955]).addTo(mymap)
.bindPopup("<b>Location 15</b><br />Hyundai Veloster.");

L.marker([-37.8074, 144.953]).addTo(mymap)
.bindPopup("<b>Location 16</b><br />Kia Carnival.");

L.marker([-37.8078, 144.952]).addTo(mymap)
.bindPopup("<b>Location 17</b><br />Honda Odyssey Vti-L.");

L.marker([-37.8084, 144.951]).addTo(mymap)
.bindPopup("<b>Location 18</b><br />Toyota HiAce.");

L.marker([-37.808, 144.95]).addTo(mymap)
.bindPopup("<b>Location 19</b><br />Mazda MX-5.");

L.marker([-37.8088, 144.948]).addTo(mymap)
.bindPopup("<b>Location 20</b><br />BMW M850i.");

L.marker([-37.8083, 144.946]).addTo(mymap)
.bindPopup("<b>Location 21</b><br />Alfa Romeo 4C.");

/*
L.marker([51.5, -0.09]).addTo(mymap)
.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

L.circle([51.508, -0.11], 500, {
  color: 'red',
  fillColor: '#f03',
  fillOpacity: 0.5
}).addTo(mymap).bindPopup("I am a circle.");

L.polygon([
  [51.509, -0.08],
  [51.503, -0.06],
  [51.51, -0.047]
  ]).addTo(mymap).bindPopup("I am a polygon.");
  */
  
  var popup = L.popup();
  
  function onMapClick(e) {
    popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map at " + e.latlng.toString())
    .openOn(mymap);
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