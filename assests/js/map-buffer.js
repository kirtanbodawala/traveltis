$(document).ready(function() {
    initialize();
});

var myMap;                  // holds the map object
var centerpoint;            // center point of the map
var infoWindow = new google.maps.InfoWindow();;

function initialize() {

    //Los Angeles CenterPoint.
    centerpoint = new google.maps.LatLng(34.052235,-118.243683);

    var mapOptions = {
        zoom: 12, 
        center: centerpoint,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
    };
    
    myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    google.maps.event.addDomListener(
        myMap, 
        'click', 
        function(event) {
            //Will Get the Latitude and Longitude when we click on map 
            position(event.latLng);
            //Will create markers on the map
            var marker = new google.maps.Marker({
                position: event.latLng, //map Coordinates where user right clicked
                map: myMap,
                draggable:true, //set marker draggable 
                animation: google.maps.Animation.DROP, //bounce animation
                title:'Click to zoom'
            });
            //Will create a red circle of 5km radius
            var circle = new google.maps.Circle({
              map: myMap,
              radius: 5000,
              fillColor: '#AA0000'
            });
            circle.bindTo('center', marker, 'position');
            // google.maps.event.addListener(marker, 'click', function() {
            //     infowindow.open(map,marker); // click on marker opens info window 
            // });            
        }
    );
}    
//Get latitude and longitude when map is clicked
function position(coord) {
        var pos = new google.maps.LatLng(coord.lat(), coord.lng());
        //window.location.href = 'index.php?position=' + pos;
        window.open('nearByPlaces.php?position=' + pos, "_blank");
        // "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400"
}
    var first_url = document.querySelector("#firstUrl").innerHTML;
    var next_page_token = document.querySelector("#nextPage").innerHTML;
    var page = first_url + "&pagetoken=" + next_page_token;
    var next_page_btn = document.querySelector(".nextBtn");

if($('table.first').length > 0 || $('table.next').length > 0){
    var ids = $(".id");
    var btn = [];
    var arr = [];
    for(var i = 0; i < ids.length; i++){
        var pid = ids[i].innerHTML;
        var btns = $(".btn")[i]; 
        btn.push(btns);
        arr.push(pid);
    }
    for(var i = 0; i < btn.length; i++){  
        btn[i].addEventListener("click", function(){
            for(var j = 0; j < btn.length; j++){
                if(this == btn[j]){
                    curl(j);
                }
                else{
                    console.log("Error");
                }
            }
        })
    }
    function curl(num){
        var c = arr[num];
        //window.location.href = 'displayPlaces.php?url=' + c;
        window.open('displayPlaces.php?pid=' + c, "_blank");
    }

    next_page_btn.addEventListener("click", function(){
        window.open('nextPage.php?token=' + page, "_blank");
    })
}    

jQuery("div.magnify img").imageMagnify({ //apply effect to image with CLASS="img"
         magnifyby: 6,
         magnifyduration: 1000 //<--No trailing comma after last option!
})
