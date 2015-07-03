<?php
require("cab_cip.php");
//require($include.'sisdoc_debug.php');
require($include."sisdoc_menus.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Marker animations with <code>setTimeout()</code></title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px;
        
      }
      #panel {
        position: center;
    	left: 100px;
    	top: 150px;
        margin-left: -0px;
        z-index: 5;
        background-color: #fff;
        padding: 2px;
        
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
		// If you're adding a number of markers, you may want to drop them on the map
		// consecutively rather than all at once. This example shows how to use
		// window.setTimeout() to space your markers' animation.
		
		var brasil = new google.maps.LatLng(-15.79422870, -47.8821657999999960);
		
		var neighborhoods = [
		new google.maps.LatLng(-22.758233,-43.194438),
		new google.maps.LatLng(-21.235817,-50.407692),
		new google.maps.LatLng(-21.191163,-50.455506),
		new google.maps.LatLng(-23.564533,-46.637231),
		new google.maps.LatLng(-16.293352,-48.944374),
		new google.maps.LatLng(-27.067700,-48.885859),
		new google.maps.LatLng(-7.1226120,-34.883753),
		new google.maps.LatLng(-20.408398,-49.968519),
		new google.maps.LatLng(-29.684354,-53.81067),
		new google.maps.LatLng(-25.438092,-49.273863),
		new google.maps.LatLng(-21.970426,-46.79477),
		new google.maps.LatLng(-29.916471,-51.182642),
		new google.maps.LatLng(-22.935692,-43.177125),
		new google.maps.LatLng(-30.036085,-51.200595),
		new google.maps.LatLng(-19.932597,-43.939672),
		new google.maps.LatLng(-27.210881,-49.644888),
		new google.maps.LatLng(-22.732417,-45.124509),
		new google.maps.LatLng(-23.597654,-46.609638),
		new google.maps.LatLng(-29.447093,-51.950261),
		new google.maps.LatLng(-19.924156,-43.93164),
		new google.maps.LatLng(-20.339143,-47.792047),
		new google.maps.LatLng(-8.058726,-34.889252),
		new google.maps.LatLng(-19.838534,-43.952314),
		new google.maps.LatLng(-29.696282,-53.785634),
		new google.maps.LatLng(-19.002704,-57.653557),
		new google.maps.LatLng(-29.639019,-50.787053),
		new google.maps.LatLng(-15.805061,-47.905642),
		new google.maps.LatLng(-22.833242,-47.051982),
		new google.maps.LatLng(-16.73374,-49.213983),
		new google.maps.LatLng(-19.975406,-44.025028),
		new google.maps.LatLng(-23.537682,-46.671234),
		new google.maps.LatLng(-25.451569,-49.251178),
		new google.maps.LatLng(-22.978886,-43.23337),
		new google.maps.LatLng(-30.060505,-51.175574),
		new google.maps.LatLng(-15.867606,-48.031972),
		new google.maps.LatLng(-31.774629,-52.341317),
		new google.maps.LatLng(-8.054744,-34.887334),
		new google.maps.LatLng(-22.50779,-43.167642),
		new google.maps.LatLng(-23.946653,-46.321967),
		new google.maps.LatLng(-12.964897,-38.438737),
		new google.maps.LatLng(-20.408088,-54.618885),
		new google.maps.LatLng(-27.092536,-52.666668),
		new google.maps.LatLng(-31.315931,-54.107528),
		new google.maps.LatLng(-26.251902,-48.855906),
		new google.maps.LatLng(-28.489349,-50.937011),
		new google.maps.LatLng(-28.569451,-53.62291),
		new google.maps.LatLng(-28.235708,-52.417703),
		new google.maps.LatLng(-29.696963,-52.442325),
		new google.maps.LatLng(-23.500223,-47.398514),
		new google.maps.LatLng(-28.703349,-49.410061),
		new google.maps.LatLng(-27.134499,-52.59943),
		new google.maps.LatLng(-27.823958,-50.317296),
		new google.maps.LatLng(-27.596815,-48.550817),
		new google.maps.LatLng(-26.91405,-48.661076),
		new google.maps.LatLng(-23.207306,-45.952917),
		new google.maps.LatLng(-29.795948,-51.154043),
		new google.maps.LatLng(-29.664253,-51.119024),
		new google.maps.LatLng(-22.782676,-47.591942),
		new google.maps.LatLng(-23.653139,-46.575789),
		new google.maps.LatLng(-23.548142,-46.650373),
		new google.maps.LatLng(-28.391298,-53.952526),
		new google.maps.LatLng(-28.277564,-54.269022),
		new google.maps.LatLng(-22.976952,-46.534655),
		new google.maps.LatLng(-18.864554,-41.981068),
		new google.maps.LatLng(-21.692313,-45.260047)
		  
		];

var markers = [];
var map;

function initialize() {
  var mapOptions = {
    zoom: 4,
    center: brasil
  };

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function drop() {
  clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
    addMarkerWithTimeout(neighborhoods[i], i * 200);
  }
}

function addMarkerWithTimeout(position, timeout) {
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP
    }));
  }, timeout);
}

function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}

	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="panel" style="margin-left: -10px">
    	<button id="drop" onclick="drop()">Veja as IES</button>
    </div>
    <div id="map-canvas">
	</div>
  </body>
</html>

<?php
require("../foot.php");
?>

