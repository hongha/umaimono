<!DOCTYPE html>
<html>
<head>
	<title>buy</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  	<link href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/css/footer-distributed-with-address-and-phones.css') }}">
    <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">
  	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
  	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer></script>
    <style type="text/css">
            html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map {
      height: 100%;
      width: 100%;
    }
    .control-left-wrapper{
      z-index: 0;
      position: absolute;
      left: 0;
      top: 60px;
      cursor: pointer;
      margin: 14px 10px 0px;
    }
    .controls {
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        height: 29px;
        margin-left: 17px;
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 345px;
      }

      .controls:focus {
        border-color: #4d90fe;
      }
    </style>

</head>
<body>


<div class="container">
  <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
              <th style="width:50%">Product</th>
              <th style="width:10%">Price</th>
              <th style="width:8%">Quantity</th>
              <th style="width:22%" class="text-center">Subtotal</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td data-th="Product">
                <div class="row">
                  <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                  <div class="col-sm-10">
                    <h4 class="nomargin">Product 1</h4>
                    <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                  </div>
                </div>
              </td>
              <td data-th="Price">$1.99</td>
              <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="1">
              </td>
              <td data-th="Subtotal" class="text-center">1.99</td>
              <td class="actions" data-th="">
                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>                
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr class="visible-xs">
              <td class="text-center"><strong>Total 1.99</strong></td>
            </tr>
            <tr>
              <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
              <td colspan="2" class="hidden-xs"></td>
              <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
              <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
          </tfoot>
        </table>
        <form>
          <input type="" name="receive_address" id="receive_address" style="display: none;" value="">
          <input type="" name="receive_address_Lat" id="receive_address_Lat" style="display: none;" value="">
          <input type="" name="receive_address_Lng" id="receive_address_Lng" style="display: none;" value="">
          <div class="col-md-6">
          <label>Người nhận</label>
          <input type="text" name="nguoi_nhan" class="form-control">
          </div>
          <div class="col-md-6">
          <label>Số điện thoại người nhận</label>
          <input type="text" name="phone_number" class="form-control">
          </div>
        </form>
        
          <div style="width: 100%; height: 800px; border: 1px solid black; margin-top: 100px;">
            <input id="pac-input" class="controls" type="text"
          placeholder="Địa chỉ nhận hàng">
            <div id="map"></div>
            <div id="infowindow-content">
          <span id="place-name"  class="title"></span>
          <span id="place-address"></span>
        </div>
    </div>
</div>
<!-- The content of your page would go here. -->

    <footer class="footer-distributed">

      <div class="footer-left">

        <a href="index.html"><img src="{{ URL::asset('public/img/logo.gif') }}" alt="">
        </a>

        <p class="footer-links">
          <a href="#">Home</a>
          ·
          <a href="#">Blog</a>
          ·
          <a href="#">Pricing</a>
          ·
          <a href="#">About</a>
          ·
          <a href="#">Faq</a>
          ·
          <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Company Name &copy; 2015</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>21 Revolution Street</span> Paris, France</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+1 555 123456</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:support@company.com">support@company.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>About the company</span>
          Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
        </p>

        <div class="footer-icons">

          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-github"></i></a>

        </div>

      </div>

    </footer>
  <script>
			// 'user strick';
      var map, infoWindow, infowindow2;
      var maker_created = [];
      var marker;
      var mapDiv = document.getElementById('map');
      
      function initMap(){
      
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionDistance = new google.maps.DistanceMatrixService;
        var infowindowDistance = new google.maps.InfoWindow();
        map = new google.maps.Map(mapDiv, {
          zoom: 13,
        });
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
  
        infoWindow = new google.maps.InfoWindow;
        //start infowindow
        var contentString = '<div id="container">'+
        '<h1>dia diem hien</h1>'+
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
        


        // //start current location
        // var currentLocationButton = document.getElementById('current-location');
        // google.maps.event.addDomListener(currentLocationButton, 'click', function(){
        //     navigator.geolocation.getCurrentPosition(function(position) {
        //     var pos = {
        //       lat: position.coords.latitude,
        //       lng: position.coords.longitude
        //     };
        //     infoWindow.open(map);
        //     marker.setPosition(pos);
        //     map.setCenter(pos);
        //   });
        // });
        // //end current location

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

        

        //place ID finder
        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker_search = new google.maps.Marker({
          map: map
        });
        marker_search.addListener('click', function() {
          infowindow.open(map, marker_search);
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
          marker_search.setPlace({
            placeId: place.place_id,
            location: place.geometry.location
          });
          marker_search.setVisible(true);

          // infowindowContent.children['place-name'].textContent = place.name;
          // infowindowContent.children['place-id'].textContent = place.place_id;
          infowindowContent.children['place-address'].textContent =
              place.formatted_address;
          infowindow.open(map, marker_search);
          receiptAddress = document.getElementById('pac-input').value;//lay ten dia chi search
          receiptAddressLat = place.geometry.location.lat();
          receiptAddressLng = place.geometry.location.lng();
          innerAddressValue(receiptAddress, receiptAddressLat, receiptAddressLng);
        });

      }
      function innerAddressValue(receiptAddress, receiptAddressLat, receiptAddressLng){
        document.getElementById("receive_address").value = receiptAddress;
        document.getElementById("receive_address_Lat").value = receiptAddressLat;
        document.getElementById("receive_address_Lng").value = receiptAddressLng;
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