var map;
function initMap() {
  var centerpoint = new google.maps.LatLng(googleConfig.center.lat, googleConfig.center.lng); // center point of the map
  var mapOptions = {
    zoom: 12,
    center: centerpoint,
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.LARGE,
      position: google.maps.ControlPosition.RIGHT_CENTER
    }
  };
  
  // Load google maps in map-canvas
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}