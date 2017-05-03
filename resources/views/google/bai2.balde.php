<!DOCTYPE html>
<html>
<head>
	<title>google map</title>
	<link href="{{ URL::asset('public/css/gmap.css') }}" rel="stylesheet">
</head>
<body>
<div id="map"></div>
	<!-- <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script> -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap"
	    async defer></script>
	<script src="{{ URL::asset('public/js/gmap.js') }}"></script> -->
	<script>
			'user strick';
      var map;
      var mapDiv = document.getElementById('map');
      var myLatlng = {lat: 21.0277644, lng: 105.8341598};
      function initMap() {
        map = new google.maps.Map(mapDiv, {
          center: myLatlng,
          zoom: 13,
        });
        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Hello World!'
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
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap"
    async defer></script>
</body>
</html>