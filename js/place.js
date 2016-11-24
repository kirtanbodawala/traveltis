var map;
var placeDetail = _.template($("#place-info").html());
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
  var service = new google.maps.places.PlacesService(map);
  
  service.getDetails({placeId: placeId}, function (response, status) {
    $("#place-details").html("");
    console.log(response);
    var details = _.pick(response, ['name', 'formatted_address', 'international_phone_number', 'website']);
    var place = $(placeDetail({
      name: details.name,
      address: details.formatted_address,
      phoneNumber: details.international_phone_number,
      website: details.website
    }));
    $("#place-details").append(place);
    //initGallery(response.photos);
  });
}

function initGallery(photos) {
  var pswpElement = document.querySelectorAll('.pswp')[0];
  
  var items = [];
  _.each(photos, function(photo) {
    var maxWidth = photo.width;
    if(maxWidth > 800) {
      maxWidth = 800;
    }
    items.push({
      h: photo.height,
      w: photo.width,
      src: photo.getUrl({maxWidth: maxWidth})
    });
  });

  // define options (if needed)
  var options = {
    // optionName: 'option value'
    // for example:
    index: 0 // start at first slide
  };

  //Initializes and opens PhotoSwipe
  var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
  gallery.init();
}