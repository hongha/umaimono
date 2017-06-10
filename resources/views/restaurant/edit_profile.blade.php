@extends('layouts.adminTemplate')
@section('content')
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
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <a href="{{url('restaurant/index')}}"><h3>Restaurant Manage</h3></a>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Báo cáo <small>Hoạt động</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> 
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="{{url('restaurant/update_res_profile/'.$restaurant_i->id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="col-md-12">
              <div class="col-md-6 col-xs-12 col-sm-12">
              <div class="row">
                  <div class="col-md-3 col-xs-12 col-sm-12">
                    <img id="change-avatar-img" onclick="document.getElementById('change-avatar').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="../avatar/{{Auth::user()->avatar}}"/>
                    <input style="display: none;" type="file" enctype="multipart/form-data"  id="change-avatar" name="change-avatar" accept="image/*" onchange="addNewLogo(this,'#change-avatar-img')"/>
                  </div>
                  <div class="col-md-9 col-xs-12 col-sm-12">
                    <input type="text" class="style-input form-control margin-bottom-15" placeholder="Địa chỉ website" name="link_website" value="{{{ isset($restaurant_i->link_website) ? $restaurant_i->link_website : '' }}}">
                    <input type="text" class="style-input form-control margin-bottom-15" placeholder="Tên nhà hàng" name="restaurant_name" value="{{{ isset($restaurant_i->restaurant_name) ? $restaurant_i->restaurant_name : '' }}}">
                  </div>
                    
                    <div id="ckeContainer" class="col-md-12">
                    <textarea id="edit-restaurant-profile" class="margin-bottom-15" required="" name="introduction">{{{ isset($restaurant_i->introduction) ? $restaurant_i->introduction : '' }}}</textarea>
                  </div>
              </div>
              </div>
              <div class="col-md-6 col-xs-12 col-sm-12">
                <input type="text" class="style-input form-control margin-bottom-15" placeholder="Số điện thoại liên hệ" name="phone_number" required="" value="{{{ isset($restaurant_i->phone_number) ? $restaurant_i->phone_number : '' }}}">
                <div style="width: 100%; height: 420px;">
                <input id="pac-input" class="controls" type="text" placeholder="Địa chỉ nhà hàng" name="address" required="" value="{{{ isset($restaurant_i->address) ? $restaurant_i->address : '' }}}">
                  <div id="map"></div>
                  <div id="infowindow-content">
                <span id="place-name"  class="title"></span>
                <span id="place-address"></span>
                <input type="text" name="lat" id="lat" hidden="" value="{{{ isset($restaurant_i->lat) ? $restaurant_i->lat : '' }}}">
                <input type="text" name="lng" id="lng" hidden="" value="{{{ isset($restaurant_i->lng) ? $restaurant_i->lng : '' }}}">
                </div>
                </div>
              </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
              <button type="submit" class="btn btn-success">Lưu</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckeditor/ckeditor.js') }}" ></script>
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckfinder/ckfinder.js') }}" ></script>
<script>
 var map, infoWindow, infowindow2, curentPositionMap, focusSearchMapInput=0;
      var maker_created = [];
      var marker;
      var curentPosition = document.getElementById('curent-position');
      var mapDiv = document.getElementById('map');
      var resInfo =<?php echo json_encode($restaurant_i, JSON_FORCE_OBJECT) ?>;
  function initMap(){
  var pos = {'lat': 21.0277644, 'lng': 105.83415979999995};
  map = new google.maps.Map(mapDiv, {
    center: pos,
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
    position: pos,
    map: map,
    icon: icon,
    animation: google.maps.Animation.DROP,
  });

  infoWindow = new google.maps.InfoWindow;
  //start infowindow
  var contentString = '<div style="height: 200px; width: 160px;" class="direction"><center>'+
  '<a href="https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_a_target" target="_blank" style="text-decoration: none;"><h4>'+resInfo.restaurant_name+'</h4></a>'+'<img style="width:150px;height:150px;" src="../avatar/{{Auth::user()->avatar}}">'+
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
//get position when click on map
  var geocoder = new google.maps.Geocoder();
  var clickPos;
  google.maps.event.addListener(map, 'click', function(event) {
    geocoder.geocode({
      'latLng': event.latLng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          document.getElementById("pac-input").value = results[0].formatted_address;
          document.getElementById("lat").value = event.latLng.lat();
          document.getElementById("lng").value = event.latLng.lng();
          marker.setMap(null);
          clickPos = {'lat': event.latLng.lat(), 'lng': event.latLng.lng()};
          marker = new google.maps.Marker({
            position: clickPos,
            map: map,
          });
          contentString = '<div id="container">'+
          '<h5>'+results[0].formatted_address+'</h5>'+
          '</div>';
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
        }
      }
    });
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
  marker_search.setVisible(true);

  infowindowContent.children['place-address'].textContent = place.formatted_address;
  infowindow_search.open(map, marker_search);
  var editAddressLat = place.geometry.location.lat();
  var editAddressLng = place.geometry.location.lng();
  document.getElementById("lat").value = editAddressLat;
  document.getElementById("lng").value = editAddressLng;
});
}
var addNewLogo = function(input,id_img){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //Hiển thị ảnh vừa mới upload lên
            $(id_img).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);     
    }
}
CKEDITOR.replace( 'edit-restaurant-profile',{
    filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl      : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>
@stop