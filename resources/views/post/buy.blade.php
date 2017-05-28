@extends('layouts.postViewTemplate')
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
      <form action="{{url('post/order')}}" method="post">
      {{ csrf_field() }}
        <div style="width: 100%; height: 420px; padding-top: 15px; margin-bottom: 15px;">
            <input id="pac-input" class="controls" type="text" placeholder="Địa chỉ nhận hàng" name="address" required="" value="" required="">
          <div id="map"></div>
            <div id="infowindow-content">
            <span id="place-name"  class="title"></span>
            <span id="place-address"></span>
            <input type="text" name="lat" id="lat" hidden="" value="" required="">
            <input type="text" name="lng" id="lng" hidden="" value="" required="">
            </div>
        </div>
        <div class="w3-half">
          <div class="w3-col m11">
            <input type="text" class="form-control" name="nguoi_nhan" placeholder="-Họ tên người nhận-" style="margin-bottom: 15px;" required="">
            <input type="text" class="form-control datepicker" name="receive_day" placeholder="-Ngày nhận-" style="margin-bottom: 15px;" required="">
            <input type="text" class="form-control" name="ghi_chu" placeholder="-Ghi chú-" style="margin-bottom: 15px;" required="">
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col m11">
            <input type="text" class="form-control" name="phone_number" placeholder="-Số điện thoại người nhận-" style="margin-bottom: 15px;" required="">
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

      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <h3>Các món ăn mới nhất</h3>
        <hr class="w3-clear">
        @if(isset($foods ))
        @foreach ($foods as $food)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../post/food_img/{{$food->avatar}}" width="60" height="60" onclick="">
        </div>
        <div class="deli-name-food-detail pull-left">
        <a class="deli-title-name-food" href="{{url('post/view_food/'.$food->id)}}">
        <h3 style="font-size: 16px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;">
        {{$food->name}}</h3>
        </a>
        <span class="deli-desc"></span>
        <div class="deli-rating-food">
        </div>
        <p style="margin: 0; color: #a1a1a1; font-size: 11px;">
        Đã được đặt <span style="color: #464646; font-weight: bold;">2</span> lần trong tháng</p>
        <a style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a>
        </div>
        <div class="deli-more-info">
        <div class="adding-food-cart">
        <span class="btn-adding" onclick="themHang({{$food->id}});">+</span>
        </div>
        <div class="product-price">
        <p class="current-price">
        <span class="txt-blue font16 bold">
        {{$food->price}}</span>
        <span class="unit">đ</span>
        </p>
        </div>
        </div>
        </div>
        @endforeach
        @endif 
      </div> 
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m3">
      <div class="w3-card-2 w3-round w3-white w3-center margin-bottom-15" id="menu-column">
        <div class="w3-container padding-none text-align-left">
          <div class="row-bill font12">
            <a href="javascript:void(0)" class="cart-stats">
            <span class="float-left bold700" id="number_total">{{$number_total}}&nbsp;</span>
            <span class="float-left">Phần</span>
            </a>
            <a href="javascript:void(0)" class="btn-reset" onclick="reset_menu()">Reset</a>
          </div>
          <?php if($shopping_carts != null){foreach ($shopping_carts as $shopping_cart) {?>
            <div class="row-bill reset_menu" id="{{$shopping_cart->id}}">
              <a href="javascript:void(0)" onclick="add_food({{$shopping_cart->id}})"><span class="fa fa-plus-square txt-green"></span></a>
              <span class="txt-red bold700 font12" style="display: inline-block; min-width: 18px; text-align: center;" >{{$shopping_cart->number}}</span>
              <span class="fa fa-minus-square" onclick="minus_food({{$shopping_cart->id}})"></span>
              <span class="bold700 font13">{{$shopping_cart->food_name}}</span>
              <div class="clearfix" style="margin-top: 2px;">
                <input type="text" width="200" placeholder="Ghi chú" class="pull-left" max="255" maxlength="255">
                <span class="bold700 font12" style="float: right;">{{$shopping_cart->price*$shopping_cart->number}}đ</span>
              </div>
            </div>
          <?php }}?>
          
          <div class="row-bill-grey">
            <span class="float-left">Cộng</span>
            <span class="bold700 font13 float-right" id="money_total">{{$price_total}}đ</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left">Phí vận chuyển</span>
            <span class="font14 float-right">7,000đ/km</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left font16 bold700">Tạm tính</span>
            <span class="font16 float-right bold700 txt-blue" id="money_Temporarily">{{$price_total}}đ</span>
          </div>
          <a href="javascript:void(0)" class="btn-book-first after-lick" onclick="checkout()">
          <i class="fa fa-check-circle"></i>
          Đặt trước</a>
        </div>
      </div>
      <div class="w3-card-2 w3-round w3-white">
      @if(isset($posts ))
        <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container" style="padding-top: 15px;">
        <h4>Các bài viết gần đây</h4>
        <hr class="w3-clear">
          @foreach($posts as $post_l)
          <div>
          <img src="../post/avatar/{{$post_l->avatar}}" style="width: 100%; height: auto;">
          </div>
          <div style="margin-top: 10px;">
          <a href="{{url('post/view/'.$post_l->id)}}" style="font-size: 14px;color: black;font-weight: 600;">
          {{$post_l->title}}
          </a>
          </div>
          <hr class="w3-clear">
          @endforeach
        </div>
        </div>
      @endif
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
var arr_resInfo =<?php echo json_encode($arr_res, JSON_FORCE_OBJECT) ?>;
var map, infoWindow;
var marker;
var mapDiv = document.getElementById('map');
function initMap(){
  var pos = {'lat': 21.0277644, 'lng': 105.83415979999995};
  map = new google.maps.Map(mapDiv, {
    center: pos,
    zoom: 13,
  });
  marker = new google.maps.Marker({
    position: pos,
    map: map,
    animation: google.maps.Animation.DROP,
  });
marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
  infoWindow = new google.maps.InfoWindow;
  //start infowindow
  var contentString = '<div style="height: 200px; width: 160px;" class="direction"><center>'+
  '<a href="https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_a_target" target="_blank" style="text-decoration: none;"><h4></h4></a>'+'<img style="width:150px;height:150px;" src="../avatar/{{Auth::user()->avatar}}">'+
  '</center></div>';
  infowindow = new google.maps.InfoWindow({
    content: contentString, //chứa nội dung bên trong
    maxwidth: 70,
  });
  marker.addListener('mouseover', function(){
    infowindow.open(map,marker);
  });
  marker.addListener('mouseout', function(){
    infowindow.close();
  });
  finder();
}
function createMarker(lat, lng, map){
  var pos = {'lat': lat, 'lng': lng};
  var marker = new google.maps.Marker({
    position: pos,
    map: map,
  });
  infoWindow = new google.maps.InfoWindow;
  //start infowindow
  var contentString = '<div id="container">'+
  '<h5>Vị trí hiện tại</h5>'+
  '</div>';
  infowindow = new google.maps.InfoWindow({
    content: contentString, //chứa nội dung bên trong
    maxwidth: 70,
  });
  // marker.addListener('click', function(){
  //   infowindow.open(map,marker);
  // });
}
function finder(){
  //place ID finder
var input = document.getElementById('pac-input');

var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.bindTo('bounds', map);

map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

var infowindow_search = new google.maps.InfoWindow();
var infowindowContent = document.getElementById('infowindow-content');
infowindow_search.setContent(infowindowContent);
var marker_search = new google.maps.Marker({
  map: map
});
marker_search.addListener('click', function() {
  infowindow_search.open(map, marker_search);
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
    map.setZoom(17);
  }

  // Set the position of the marker using the place ID and location.
  marker_search.setPlace({
    placeId: place.place_id,
    location: place.geometry.location
  });
  // marker_search.setVisible(true);

  infowindowContent.children['place-address'].textContent = place.formatted_address;
  infowindow_search.open(map, marker_search);
  var editAddressLat = place.geometry.location.lat();
  var editAddressLng = place.geometry.location.lng();
  document.getElementById("lat").value = editAddressLat;
  document.getElementById("lng").value = editAddressLng;
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
function minus_food(id_food){

  $.ajax({
    url: '/umaimono/post/minus_food/'+id_food,
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
        number_total.innerHTML = parseInt(number_total.innerHTML,10) - 1 + '&nbsp;';
        money_total.innerHTML = parseInt(money_total.innerHTML,10) - price_one_food+ 'đ';
        money_Temporarily.innerHTML = parseInt(money_total.innerHTML,10) + 'đ';
        spans[1].innerHTML = number_food - 1;
        spans[4].innerHTML = prices - price_one_food + 'đ';
        alertify.success("Đã xóa hành công!");
        if(number_food <= 1){
          document.getElementById(id_food).remove();
        }
    }
});
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
    }
});
}}
function checkout(){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){
    window.location.href = "http://localhost/umaimono/login";
  }else{
    window.location.href = "http://localhost/umaimono/post/buy";
  }
  
}
function themHang(id_food){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
  $.ajax({
    url: '/umaimono/post/them_hang/'+id_food,
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
