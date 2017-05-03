<!DOCTYPE html>
<html>
<head>
	<title>google map</title>
	<link href="{{ URL::asset('public/css/gmap.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer></script>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&libraries=places"></script> -->
  <!-- <link href="{{ URL::asset('public/js/jquery.min.js') }}" rel="stylesheet"> -->
  <!-- <script src="{{ URL::asset('public/js/google map infobox/infobox.min.js') }}"></script> -->
</head>
<body>

<input id="pac-input" class="controls" type="text"
          placeholder="Enter a location">
        <div id="map"></div>
        <div id="infowindow-content">
          <span id="place-name"  class="title"></span><br>
          Place ID <span id="place-id"></span><br>
          <span id="place-address"></span>
        </div>
        
<div class="control-left-wrapper">
  <div class="zoom-in" id="zoom-in"><i class="fa fa-plus"></i></div>
  <div class="zoom-out" id="zoom-out"><i class="fa fa-minus"></i></div>
  <div class="current-location" id="current-location"><i class="fa fa-paper-plane"></i></div>
</div>
	<!-- <script src="{{ URL::asset('public/js/gmap.js') }}"></script> -->
	<script>
			'user strick';
      var map, infoWindow, infowindow2;
      var maker_created = [];
      var marker;
      var mapDiv = document.getElementById('map');
      var myLatlng = {lat: 21.0277644, lng: 105.8341598};
      
      function initMap(){
      
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionDistance = new google.maps.DistanceMatrixService;
        var infowindowDistance = new google.maps.InfoWindow();4
        map = new google.maps.Map(mapDiv, {
          center: myLatlng,
          zoom: 13,
        });
        //icon marker
        var icon = {
          url: "{{URL::asset('public/img/icon/google_marker.png') }}", // url
          scaledSize: new google.maps.Size(50, 50), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };
        marker = new google.maps.Marker({
          map: map,
          icon: icon,
          animation: google.maps.Animation.DROP,
        });
        var customMapType = new google.maps.StyledMapType([
        		{stylers: [{hue:'#D2E4CB'}]},
        		{
        			featureType: 'water',
        			stylers: [{color: '#599459'}]
        		}
        	]);
        var customMapTypeId = 'custom_style';
        map.mapTypes.set(customMapTypeId, customMapType);
        map.setMapTypeId(customMapTypeId);
        var zoomInButton = document.getElementById('zoom-in');
        var zoomOutButton = document.getElementById('zoom-out');
        google.maps.event.addDomListener(zoomInButton, 'click', function(){
          map.setZoom(map.getZoom()+1);
        });//add zoom
        google.maps.event.addDomListener(zoomOutButton, 'click', function(){
          map.setZoom(map.getZoom()-1);
        });//minus zoom
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.open(map);
            marker.setPosition(pos);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        };
        //start current location
        var currentLocationButton = document.getElementById('current-location');
        google.maps.event.addDomListener(currentLocationButton, 'click', function(){
            navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.open(map);
            marker.setPosition(pos);
            map.setCenter(pos);
          });
        });
        //end current location

        //start multi marker google maps
        var markers = [
          {'coord': {'lat':21.0327340, 'lng': 105.7754337}, 'title': 'title infowindow 1'},
          {'coord': {'lat':21.0127345, 'lng': 105.7754340},'title': 'title infowindow 2'},
          {'coord': {'lat':21.1127350, 'lng': 105.7754345},'title': 'title infowindow 3'},
          {'coord': {'lat':21.2127355, 'lng': 105.7754350},'title': 'title infowindow 4'},
          {'coord': {'lat':21.3127370, 'lng': 105.7754355},'title': 'title infowindow 5'},
        ];
        for (var i = markers.length - 1; i >= 0; i--) {
          var item = createMarkers(directionsService, directionsDisplay, markers[i], directionDistance, infowindowDistance);
          maker_created.push(item);
        };
        //end multi marker google maps

        //start infowindow
        var contentString = '<div id="container">'+
        '<h1>test infowindow doan hong ha 1994 hedspi k57  gmail . com</h1>'+
        '</div>';
        infowindow = new google.maps.InfoWindow({
          content: contentString, //chứa nội dung bên trong
          maxwidth: 300,
        });
        marker.addListener('mouseover', function(){
          infowindow.open(map,marker);
        });
        marker.addListener('mouseout', function(){
          infowindow.close();
        });

        //place ID finder
        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            return;
          }

          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }

          // Set the position of the marker using the place ID and location.
          marker.setPlace({
            placeId: place.place_id,
            location: place.geometry.location
          });
          marker.setVisible(true);

          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-id'].textContent = place.place_id;
          infowindowContent.children['place-address'].textContent =
              place.formatted_address;
          infowindow.open(map, marker);
        });
      }
      function createMarkers(directionsService, directionsDisplay, pos, directionDistance, infowindowDistance){
        
        var contentString2 = '<div style="height: 200px; width: 200px;" class="direction">'+
        '<a href="https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_a_target" target="_blank" style="text-decoration: none;"><h3>'+pos.title+'</h3></a>'+'<img style="width:auto;height:150px;" src="{{ URL::asset('public/img/avatar.jpg') }}">'+
        '</div>';
        infowindow2 = new google.maps.InfoWindow({
          content: contentString2, //chứa nội dung bên trong
          maxwidth: 200,
        });
        var newMarker = new google.maps.Marker({
            position: pos.coord,
            map: map,
          });
        
        newMarker.addListener('mouseover', function(){
          infowindow2.open(map, newMarker);
        });

        newMarker.addListener('click', function(){
          calculateAndDisplayRoute(directionsService, directionsDisplay, newMarker, directionDistance, infowindowDistance);
          infowindow2.close();
          // $('.direction').fadeOut('300');
        });
        // newMarker.addListener('click', function(){
        //   infowindow2.close();
        // });
        return newMarker;
      }


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
      // ham chi duong
       function calculateAndDisplayRoute(directionsService, directionsDisplay, newMarker, directionDistance, infowindowDistance) {
        var middle;
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({suppressMarkers: true});
        directionsService.route({
          origin: marker.getPosition(), //vi tri 1
          destination: newMarker.getPosition(), // vi tri 2
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var m = Math.ceil((response.routes[0].overview_path.length)/2);
            middle = response.routes[0].overview_path[m];
            //sau khi chi duong xong thi se tinh toan quang duong va thoi gian
             directionDistance.getDistanceMatrix({
              origins: [marker.getPosition()],
              destinations: [newMarker.getPosition()],
              travelMode: 'DRIVING',
            }, function(response, status) {
              if(status === google.maps.DistanceMatrixStatus.OK){
                var originList = response.originAddresses;
                var destinationList = response.destinationAddresses;
                for (var i = 0; i < originList.length; i++) {
                  var results = response.rows[i].elements;
                  for (var j = 0; j < results.length; j++) {
                    var element = results[j];
                    var dt = element.distance.text;//thoi gian
                    var dr = element.duration.text;//khoang cach
                  };
                };
                
              };
              var contentDistance = '<div>'+dt+'<br>'+dr+'</div';
              infowindowDistance.setContent(contentDistance);
              infowindowDistance.setPosition(middle);
              infowindowDistance.open(map);
              }); 
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Lỗi: Máy chủ định vị bị lỗi.' :
                              'Lỗi: Trình duyệt của bạn không hỗ trợ định vị.');
        infoWindow.open(map);
      }

    </script>
    
</body>
</html>