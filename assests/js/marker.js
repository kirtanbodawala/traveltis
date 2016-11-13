$(document).ready(function() {
var mapCenter = new google.maps.LatLng(47.6145, -122.3418); //Google map Coordinates
var map;
map_initialize(); // load map
function map_initialize(){
    //Google map option
    var googleMapOptions = 
    { 
        center: mapCenter, // map center
        zoom: 17, //zoom level, 0 = earth view to higher value
        panControl: true, //enable pan Control
        zoomControl: true, //enable zoom control
        zoomControlOptions: {
        style: google.maps.ZoomControlStyle.SMALL //zoom control size
        },
        scaleControl: true, // enable scale control
        mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
    };
    map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions); 
    
        //##### drop a new marker on right click ######
    google.maps.event.addListener(map, 'rightclick', function(event) {
        var marker = new google.maps.Marker({
            position: event.latLng, //map Coordinates where user right clicked
            map: map,
            draggable:true, //set marker draggable 
            animation: google.maps.Animation.DROP, //bounce animation
            title:"Hello World!",
            icon: "http://PATH-TO-YOUR-WEBSITE-ICON/icons/pin_green.png" //custom pin icon
        });
        
        //Content structure of info Window for the Markers
        var contentString = $('<div class="marker-info-win">'+
        '<div class="marker-inner-win"><span class="info-content">'+
        '<h1 class="marker-heading">New Marker</h1>'+
        'This is a new marker infoWindow'+ 
        '</span>'+
        '</div></div>');
            
        //Create an infoWindow
        var infowindow = new google.maps.InfoWindow();
        
        //set the content of infoWindow
        infowindow.setContent(contentString[0]);
        
        //add click event listener to marker which will open infoWindow          
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker); // click on marker opens info window 
        });
        
    });
}
});