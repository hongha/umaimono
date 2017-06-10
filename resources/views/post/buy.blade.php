@extends('layouts.home')
@section('title')
    Đặt hàng - @parent
@stop
@section('content')
<!-- Page Container -->
<?php use App\RestaurantProfile; ?>
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
#curent-position{
  width: 100%;
  height: 100%;
}
</style>
<div class="w3-container w3-content" style="max-width:1400px;margin-top:20px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m2">
      <!-- Profile -->
      <div style="background: #e5e5e5; height: 50px; margin-top: -10px;">
        <H4 style="line-height: 50px;
          margin-left: 15px;
          font-size: 14px;
          text-transform: uppercase;
          color: #333;">Danh mục</H4>
      </div>
      <div class=" padding-15">
        @foreach($food_types as $food_type)
        <a href="#" class="danh-muc" style="color: #333;"><p><span class="danh-muc">{{$food_type->name}}</span><i class="fa fa-angle-right" style="float: right;"></i></p></a>
        <hr>
        @endforeach
      </div>
    <!-- End Left Column -->
    
    </div>
    <!-- Middle Column -->
    <div class="w3-col m7">
      <div class="w3-container w3-card-2 w3-white w3-round margin-left-right-16">
      <form action="{{url('post/order/'.$id)}}" method="post">
      {{ csrf_field() }}
        <div style="width: 100%; height: 420px; padding-top: 15px; margin-bottom: 15px;">
            <input id="pac-input" class="controls" type="text" placeholder="Địa chỉ nhận hàng" name="address" required="" value="" >
          <div id="map"></div>
            <div id="infowindow-content">
            <span id="place-name"  class="title"></span>
            <span id="place-address"></span>
            <input type="text" name="lat" id="lat" hidden="" value="" required="">
            <input type="text" name="lng" id="lng" hidden="" value="" required="">
            </div>
        </div>
        <div style="width: 100%; line-height: 25px;" id="distance">
          
        </div>
        <div class="w3-half">
          <div class="w3-col m11">
            <input type="text" class="form-control" name="nguoi_nhan" placeholder="-Họ tên người nhận-" style="margin-bottom: 15px; margin-top: 15px;" required="">
            <input type="text" class="form-control datepicker" name="receive_day" placeholder="-Ngày nhận-" style="margin-bottom: 15px;" required="">
            <input type="text" class="form-control" name="ghi_chu" placeholder="-Ghi chú-" style="margin-bottom: 15px;" required="">
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col m11">
            <input type="text" class="form-control" name="phone_number" placeholder="-Số điện thoại người nhận-" style="margin-bottom: 15px; margin-top: 15px;" required="">
            <select class="form-control" name="receive_hour" id="time" style="margin-bottom: 15px;" required="">
              <option value="chưa xác định" disabled selected>-Khung giờ nhận-</option>
              <option value="7h - 8h">7h - 8h</option>
              <option value="8h - 9h">8h - 9h</option>
              <option value="9h - 10h">9h - 10h</option>
              <option value="10h - 11h">10h - 11h</option>
              <option value="11h - 12h">11h - 12h</option>
              <option value="12h - 13h">12h - 13h</option>
              <option value="13h - 14h">13h - 14h</option>
              <option value="14h - 15h">14h - 15h</option>
              <option value="15h - 16h">15h - 16h</option>
              <option value="16h - 17h">16h - 17h</option>
              <option value="17h - 18h">17h - 18h</option>
              <option value="18h - 19h">18h - 19h</option>
              <option value="19h - 20h">19h - 20h</option>
              <option value="20h - 21h">20h - 21h</option>
              <option value="21h - 22h">21h - 22h</option>
            </select>
            <button type="submit" class="btn btn-primary">Đặt hàng</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m3">
      <div class="w3-card-2 w3-round w3-white w3-center margin-bottom-15" id="menu-column">
        <div class="w3-container padding-none text-align-left">
          <div class="row-bill font12">
            <a href="javascript:void(0)" class="cart-stats">
            <span class="float-left bold700" id="number_total">Tổng {{$number_total}}&nbsp;</span>
            <span class="float-left">phần</span>
            </a>
            <!-- <a href="javascript:void(0)" class="btn-reset" onclick="reset_menu()">Reset</a> -->
          </div>
          <?php if($shopping_carts != null){foreach ($shopping_carts as $shopping_cart) {?>
            <div class="row-bill reset_menu" id="{{$shopping_cart->id}}">
              <!-- <a href="javascript:void(0)" onclick="add_food({{$shopping_cart->id}})"><span class="fa fa-plus-square txt-green"></span></a> -->
              <span class="txt-red bold700 font12" style="display: inline-block; min-width: 18px; text-align: center;" >{{$shopping_cart->number}} phần</span>
              <!-- <span class="fa fa-minus-square" onclick="minus_food_buy({{$shopping_cart->id}})"></span> -->
              <span class="bold700 font13">{{$shopping_cart->food_name}}</span>
              <div class="clearfix" style="margin-top: 2px;">
                <input type="text" width="200" placeholder="Ghi chú" class="pull-left" max="255" maxlength="255" value="{{$shopping_cart->ghi_chu}}" onblur="blurFunction({{$shopping_cart->id}},this)">
                <span class="bold700 font12" style="float: right;">{{$shopping_cart->price*$shopping_cart->number}}đ</span>
              </div>
              <a href="" target="_blank"><span style="font-size: 12px;"><?php $restaurant = RestaurantProfile::where('id_restaurant',$shopping_cart->id_restaurant)->get(); echo $restaurant[0]->restaurant_name; ?></span></a>
            </div>
          <?php }}?>
          
          <div class="row-bill-grey">
            <span class="float-left">Cộng</span>
            <span class="bold700 font13 float-right" id="money_total">{{$price_total}}đ</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left">Phí vận chuyển</span>
            <span class="font14 float-right">5,000đ/km</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left font16 bold700">Tạm tính</span>
            <span class="font16 float-right bold700 txt-blue" id="money_Temporarily">{{$price_total}}đ</span>
          </div>
          <a href="javascript:void(0)" class="btn-book-first after-lick" onclick="checkout({{$id}})">
          <i class="fa fa-check-circle"></i>
          Đặt trước</a>
        </div>
      </div>
    </div>
    <!-- End Right Column -->   
  <!-- End Grid -->
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
<script>
$( ".datepicker" ).datepicker({ minDate: 0});
var map;
var marker;
var toltal = 0;
var markers = [];
var mapDiv = document.getElementById('map');
var directionsService,directionsDisplay,directionDistance,infowindowDistance;
var arr_resInfo =<?php echo json_encode($arr_res, JSON_FORCE_OBJECT) ?>;
var size = Object.keys(arr_resInfo).length;
function initMap(){
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  directionDistance = new google.maps.DistanceMatrixService;
  infowindowDistance = new google.maps.InfoWindow();
  var pos = {'lat': 21.0277644, 'lng': 105.83415979999995};
  map = new google.maps.Map(mapDiv, {
    center: pos,
    zoom: 11,
  });
  marker = new google.maps.Marker({
    // position: pos,
    map: map,
    animation: google.maps.Animation.DROP,
  });
marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
  for (i = 0; i < size; i++) { 
    createMarker(arr_resInfo[i][0]['lat'],arr_resInfo[i][0]['lng'],arr_resInfo[i][0]['restaurant_name'],arr_resInfo[i][0]['address'],arr_resInfo[i][0]['link_website'],arr_resInfo[i][0]['phone_number'],map,directionsService,directionsDisplay,directionDistance,infowindowDistance);
  }
  finder();
}
function createMarker(lat, lng,restaurant_name,address,link_website,phone_number,map,directionsService,directionsDisplay,directionDistance,infowindowDistance){
  var pos = {'lat': lat, 'lng': lng};
  var newMarker = new google.maps.Marker({
    position: pos,
    map: map,
  });
  //start infowindow
  var contentString = '<div id="container">'+
  '<h5>'+restaurant_name+'</h5>'+'<h5>'+address+'</h5>'+'<a href="'+link_website+'" target="_blank"><h5>'+link_website+'</h5></a>'+'<h5>'+phone_number+'</h5>'+
  '</div>';
  var infowindow = new google.maps.InfoWindow({
    content: contentString, //chứa nội dung bên trong
    maxwidth: 70,
  });
  newMarker.addListener('mouseover', function(){
    infowindow.open(map,newMarker);
  });

  newMarker.addListener('click', function(){
    infowindow.close();
    calculateAndDisplayRoute(directionsService, directionsDisplay, newMarker, directionDistance, infowindowDistance);
  });
  markers.push(newMarker);
}
function finder(){
var checkLastRes = 0;
  //place ID finder
var input = document.getElementById('pac-input');
var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.bindTo('bounds', map);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
var infowindow_search = new google.maps.InfoWindow();
var infowindowContent = document.getElementById('infowindow-content');
infowindow_search.setContent(infowindowContent);
marker.addListener('click', function() {
  infowindow_search.open(map, marker);
});

autocomplete.addListener('place_changed', function() {
  infowindow_search.close();
  var place = autocomplete.getPlace();
  if (!place.geometry) {
    return;
  }

  if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
  } else {
    map.setCenter(place.geometry.location);
    map.setZoom(13);
  }

  // Set the position of the marker using the place ID and location.
  marker.setPlace({
    placeId: place.place_id,
    location: place.geometry.location
  });
  // marker_search.setVisible(true);
  infowindowContent.children['place-address'].textContent = place.formatted_address;
  infowindow_search.open(map, marker);
  var editAddressLat = place.geometry.location.lat();
  var editAddressLng = place.geometry.location.lng();
  var latlng = new google.maps.LatLng(editAddressLat, editAddressLng);
  marker.setPosition(latlng);
  document.getElementById("lat").value = editAddressLat;
  document.getElementById("lng").value = editAddressLng;
  $("#distance").empty();
  console.log(editAddressLat);
  console.log(editAddressLng);
  // if(arr_resInfo){
    for(var i=0;i<markers.length;i++){
      if (i == markers.length - 1) {
        checkLastRes = 1;
      }
    calculateRoute(markers[i],marker,arr_resInfo[i][0]['restaurant_name'],arr_resInfo[i][0]['address'],checkLastRes);
    }
  // }
});
}
function calculateRoute(newMarker,marker,restaurant_name,address,checkLastRes){
  var directionDistance = new google.maps.DistanceMatrixService;
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
        var dt = element.distance.text;//khoảng cách
        var dr = element.duration.text;//thời gian
        var res = dt.split(" ");
        toltal = toltal + res[0]*5000;       
        $('<span class="font14 bold700 w3-white ">'+restaurant_name+': </span><span class="font14 txt-red">'+address+'</span><br><span class="font14 bold700 w3-white">Quãng đường đến: </span><span class="font14 txt-red">'+dt+'</span>&nbsp;&nbsp;<span class="font14 bold700 w3-white">Thời gian di chuyển: </span><span class="font14 txt-red">'+dr+'</span>&nbsp;&nbsp;<span class="font14 bold700 w3-white">Tiền ship: </span><span class="font14 txt-red">'+dt+' x 5,000đ/km = '+res[0]*5000+'đ</span><hr>').appendTo( "#distance" );
        if(checkLastRes == 1){
          var toltalMoneySpan = document.getElementById("money_total");
          var toltalMoney = parseInt(toltalMoneySpan.innerHTML,10);
          toltalMoney = toltalMoney + toltal;
          $('<div style="width: 100%;"><span class="font14 bold700 w3-white">Tổng tiền cần thanh toán: </span><span class="font16 txt-red bold700">'+toltalMoney+'đ</span><input name="tong_ship" style="display:none;" value="'+toltal+'"><input name="tong_thanh_toan" style="display:none;" value="'+toltalMoney+'"><div>').appendTo( "#distance" );
        }
      };
    };
    };
  });
}
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

function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function blurFunction(id_food,input){
  if(!$(input).val()){
    console.log(input);
  }else{
    $.ajax({
    url: '/umaimono/post/add_ghi_chu/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food,
        "ghi_chu": $(input).val(),
        },
    success: function (response) {
        alertify.success("Đã thêm ghi chú!");
      }
    });
  }
}
function add_food(id_food){

  $.ajax({
    url: '/umaimono/post/add_food/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food
        },
    success: function (data) {
        var div = document.getElementById(id_food);
        var spans = div.getElementsByTagName("span");
        var number_food = parseInt(spans[1].innerHTML,10);
        var prices = parseInt(spans[4].innerHTML,10);
        var price_one_food = prices/number_food;
        var money_total = document.getElementById("money_total");
        var money_Temporarily = document.getElementById("money_Temporarily");
        var number_total = document.getElementById("number_total");
        number_total.innerHTML = parseInt(number_total.innerHTML,10) + 1 + '&nbsp;';
        money_total.innerHTML = parseInt(money_total.innerHTML,10) + price_one_food + 'đ';
        money_Temporarily.innerHTML = parseInt(money_total.innerHTML,10) + 'đ';
        spans[1].innerHTML = number_food + 1;
        spans[4].innerHTML = prices + price_one_food + 'đ';
        alertify.success("Đã thêm hành công!");
    }
});
}
function minus_food_buy(id_food){

  $.ajax({
    url: '/umaimono/post/minus_food_buy/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food
        },
    success: function (data,response) {
        var div = document.getElementById(id_food);
        var spans = div.getElementsByTagName("span");
        var number_food = parseInt(spans[1].innerHTML,10);
        var prices = parseInt(spans[4].innerHTML,10);
        var price_one_food = prices/number_food;
        var money_total = document.getElementById("money_total");
        var money_Temporarily = document.getElementById("money_Temporarily");
        var number_total = document.getElementById("number_total");
        number_total.innerHTML = parseInt(number_total.innerHTML,10) - 1 + '&nbsp;';
        money_total.innerHTML = parseInt(money_total.innerHTML,10) - price_one_food+ 'đ';
        money_Temporarily.innerHTML = parseInt(money_total.innerHTML,10) + 'đ';
        spans[1].innerHTML = number_food - 1;
        spans[4].innerHTML = prices - price_one_food + 'đ';
        alertify.success("Đã xóa hành công!");
        if(number_food <= 1){
          document.getElementById(id_food).remove();
        }
        setMapOnAll(null);
        markers = [];
        for (var i = 0; i < data.length; i++) {
          createMarker(data[i][0]['lat'],data[i][0]['lng'],data[i][0]['restaurant_name'],data[i][0]['address'],data[i][0]['link_website'],data[i][0]['phone_number'],map,directionsService,directionsDisplay,directionDistance,infowindowDistance);
        }
    }
});
}
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
function reset_menu(){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
  $.ajax({
    url: '/umaimono/post/reset_menu',
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        },
     success: function (data) {
      $('.reset_menu').remove();
      var money_total = document.getElementById("money_total");
      var money_Temporarily = document.getElementById("money_Temporarily");
      var number_total = document.getElementById("number_total");
      number_total.innerHTML = 0 + '&nbsp;';
      money_total.innerHTML = 0 + 'đ';
      money_Temporarily.innerHTML = 0 + 'đ';
      alertify.success("Đã reset hành công!");
      setMapOnAll(null);
      markers = [];
    }
});
}}
function checkout(id){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){
    window.location.href = "http://localhost/umaimono/login";
  }else{
    window.location.href = 'http://localhost/umaimono/post/buy/'+id;
  }
  
}
function themHangBuy(id_food){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
  $.ajax({
    url: '/umaimono/post/them_hang_buy/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id":id_food
        },
    success: function (response) {
      var menuColumn = document.getElementById("menu-column");
      $("#menu-column").empty();
      $(response).appendTo( "#menu-column" );
      alertify.success("Đã thêm hàng!");
      var div = document.getElementById("position");
      var spans = div.getElementsByTagName("span");
      var span_number = $("#position > span").length;
      setMapOnAll(null);
      markers = [];
      for (i = 0; i < span_number; i=i+6) { 
        createMarker(parseFloat(spans[i].innerHTML),parseFloat(spans[i+1].innerHTML),spans[i+2].innerHTML,spans[i+3].innerHTML,spans[i+4].innerHTML,spans[i+5].innerHTML,map,directionsService,directionsDisplay,directionDistance,infowindowDistance);
      }
    },
    error: function(data){

    }
  });
  }
}
</script>
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html> 
@stop
