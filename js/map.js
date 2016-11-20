var map;
var placeTemplate = _.template($("#place-media").html());
function initMap() {
  var centerpoint = new google.maps.LatLng(googleConfig.center.lat, googleConfig.center.lng); // center point of the map
  var infoWindow = new google.maps.InfoWindow();
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
  
  // On click at any area in map load locations near to that click
  google.maps.event.addDomListener(
    map,
    'click',
    function(event) {
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();
      setMapUserCenter(lat, lng);
      //map.setCenter({lat: lat,lng: lng});
      loadNearbyPlaces(lat, lng);
    }
  );
  
  // Initialize Google autcomplete search
  var autocomplete = new google.maps.places.Autocomplete(document.querySelector("#place-autocomplete"));
  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    setMapUserCenter(lat, lng);
    map.setCenter({lat: lat,lng: lng});
    loadNearbyPlaces(lat, lng);
  });
  
  (function($) {
    $(document).ready(function() {
  
      var goToCurrentLocation = function() {
        var ipapiPromise = $.getJSON("http://ip-api.com/json/?callback=?", function(data) {
          console.log('-0---->', data);
          if(data && data.lat && data.lon) {
            setMapUserCenter(data.lat, data.lon);
            map.setCenter({lat: data.lat,lng: data.lon});
            loadNearbyPlaces(data.lat, data.lon);
            ipapiPromise = null;
          }
        });
  
        // If geolocation is available in browser
        if(Modernizr.geolocation) {
          navigator.geolocation.getCurrentPosition(function (coordinates) {
            console.log(coordinates);
            if (
              coordinates.coords &&
              coordinates.coords.latitude &&
              coordinates.coords.longitude ) {
              if(ipapiPromise && ipapiPromise.abort) {
                ipapiPromise.abort();
              }
        
              var lat = coordinates.coords.latitude;
              var lng = coordinates.coords.longitude;
        
              // var lat = 32.740932;
              // var lng = -117.130875;
              setMapUserCenter(lat, lng);
              map.setCenter({lat: lat,lng: lng});
              loadNearbyPlaces(lat, lng);
            }
          });
        }
      }
      goToCurrentLocation();
      $("#to-current-location").on("click",function (e) {
        e.preventDefault();
        goToCurrentLocation();
      })
    });
  })(jQuery);
}

var userMarker = null;
function setMapUserCenter(lat, lng) {
  
  if(userMarker && userMarker.setMap) {
    userMarker.setMap(null);
  }
  
  if(map) {
    var LatLng = new google.maps.LatLng(lat, lng);
    userMarker = new google.maps.Marker({
      position: LatLng, //map Coordinates where user right clicked
      map: map,
      title: 'Your current location'
    });
  }
}

function loadNearbyPlaces(lat, lng) {
  var request = {
    location: new google.maps.LatLng(lat, lng),
    radius: '5000',
    types: ["airport","amusement_park","aquarium","art_gallery","bakery","bar","book_store","bowling_alley","bus_station","cafe","campground","casino","embassy","establishment","food","gas_station","liquor_store","meal_delivery","meal_takeaway","movie_theater","moving_company","museum","night_club","painter","park","parking","police","restaurant","shopping_mall","spa","stadium","university","zoo","point_of_interest"]
  };
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, function (response, status, pagination) {
    $("#list-places").html("");
    _.each(response, function(place, index) {
      console.log(place);
      //console.log(place.photos);
      var photo = "";
      if(place.photos && place.photos.length) {
        photo = place.photos[0].getUrl({
          maxWidth: 48
        });
      }
      // Populate places
      var place = $(placeTemplate({
        url: "",
        photo: photo,
        name: place.name,
        distance: distance(userMarker.position.lat(), userMarker.position.lng(), place.geometry.location.lat(), place.geometry.location.lng())
      }));
      $("#list-places").append(place);
    });
    
    // if(pagination.hasNextPage) {
    //   pagination.nextPage();
    // }
  });
}
function distance(lat1, lon1, lat2, lon2) {
  var R = 6371; // km (change this constant to get miles)
  var dLat = (lat2-lat1) * Math.PI / 180;
  var dLon = (lon2-lon1) * Math.PI / 180;
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
    Math.sin(dLon/2) * Math.sin(dLon/2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  var d = R * c * 0.6213711923;
  return d.toFixed(2);
}



// function initialize() {
//   //Los Angeles CenterPoint.
//
//
//
//   myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
//
//   google.maps.event.addDomListener(
//     myMap,
//     'click',
//     function(event) {
//       //Will Get the Latitude and Longitude when we click on map
//       position(event.latLng);
//       //Will create markers on the map
//       var marker = new google.maps.Marker({
//         position: event.latLng, //map Coordinates where user right clicked
//         map: myMap,
//         draggable:true, //set marker draggable
//         animation: google.maps.Animation.DROP, //bounce animation
//         title:'Click to zoom'
//       });
//       //Will create a red circle of 5km radius
//       var circle = new google.maps.Circle({
//         map: myMap,
//         radius: 5000,
//         fillColor: '#AA0000'
//       });
//       circle.bindTo('center', marker, 'position');
//       // google.maps.event.addListener(marker, 'click', function() {
//       //     infowindow.open(map,marker); // click on marker opens info window
//       // });
//     }
//   );
// }
// //Get latitude and longitude when map is clicked
// function position(coord) {
//   var pos = new google.maps.LatLng(coord.lat(), coord.lng());
//   //window.location.href = 'index.php?position=' + pos;
//   window.open('nearByPlaces.php?position=' + pos, "_blank");
//   // "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400"
// }
// var first_url = document.querySelector("#firstUrl").innerHTML;
// var next_page_token = document.querySelector("#nextPage").innerHTML;
// var page = first_url + "&pagetoken=" + next_page_token;
//
// if($('.portfolio-item').length > 0 || $('portfolio-item').length > 0){
//   var ids = $(".id");
//   var photo = [];
//   var arr = [];
//   for(var i = 0; i < ids.length; i++){
//     var pid = ids[i].innerHTML;
//     var photos = $(".photo")[i];
//     photo.push(photos);
//     arr.push(pid);
//   }
//   for(var i = 0; i < photo.length; i++){
//     photo[i].addEventListener("click", function(){
//       for(var j = 0; j < photo.length; j++){
//         if(this == photo[j]){
//           curl(j);
//         }
//         else{
//           console.log("Error");
//         }
//       }
//     })
//   }
//   function curl(num){
//     var c = arr[num];
//     //window.location.href = 'displayPlaces.php?url=' + c;
//     window.open('placeDetails.php?pid=' + c, "_blank");
//   }
// }
//
// jQuery(".images .magnify").imageMagnify({ //apply effect to image with CLASS="magnify"
//   magnifyby: 6,
//   magnifyduration: 1000 //<--No trailing comma after last option!
// });