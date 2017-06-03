@extends('layouts.userProfile') 
@section('content')
<?php use App\RestaurantProfile; ?>
<style type="text/css">
.my-tbl{
    width: 100%;
}
.my-tbl tr{
    height: 40px;
}
.center{
  width: 150px;
  margin: 40px auto;
}
#map{
  height: 500px;
  width: 100%;
  border: 2px solid gray;
}
</style>
  <div class="w3-row-padding">
  <h3>Các các món đã đặt</h3>
  <table class="w3-table-all">
    <thead>
      <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
        <th>STT</th>
        <th>Tên món ăn</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Ghi chú</th>
        <th>Nhà hàng</th>
      </tr>
    </thead>
    @foreach($orders as $index => $order)
    <tr class="w3-hover-green" style="line-height: 27px;">
      <td>{{$index+1}}</td>
      <td>{{$order->food_name}}</td>
      <td>{{$order->price}}đ</td>
      <td>{{$order->number}}</td>
      <td>{{$order->ghi_chu}}</td>
      <td><?php $res = RestaurantProfile::where('id_restaurant',$order->id_restaurant)->get(); echo $res[0]->restaurant_name;?></td>
    </tr>
    @endforeach
  </table>
  {!! $orders->render() !!}
  <br>
  <table class="my-tbl">
    <tr class="" style="line-height: 27px;">
      <td><b>Địa chỉ nhận</b></td>
      <td style="color: red;">{{$receipt->receive_address}}</td>
      <td><b>Số điện thoại</b></td>
      <td style="color: red;">{{$receipt->phone_number}}</td>
      <td><b>Người nhận</b></td>
      <td style="color: red;">{{$receipt->nguoi_nhan}}</td>
    </tr>
    <tr class="" style="line-height: 27px;">
      <td><b>Tổng tiền(cả ship)</b></td>
      <td style="color: red;">{{$receipt->toltal_money}}đ</td>
      <td><b>Tiền ship</b></td>
      <td style="color: red;">{{$receipt->toltal_ship}}đ</td>
      <td><b>Thanh toán</b></td>
      <td style="color: red;"><?php if($receipt->thanh_toan == 1){echo "Đã thanh toán";}else{echo "Chưa thanh toán";}?></td>
    </tr>
    <tr class="" style="line-height: 27px;">
      <td><b>Thời gian nhận</b></td>
      <td style="color: red;">{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
      <td><b>Ghi chú</b></td>
      <td style="color: red;">{{$receipt->ghi_chu}}</td>
      <td><b>Trạng thái</b></td>
      <td style="color: red;"><?php if($receipt->shipping == 0){echo "Chưa ship hàng";}elseif($receipt->shipping == 1){echo "Đang ship hàng";}else{echo "Đã ship hàng";}?></td>
    </tr>
    <tr class="" style="line-height: 27px;">
      <td><b>Cập nhật gần nhất</b></td>
      <td style="color: red;">{{$receipt->updated_at}}</td>
      
    </tr>
  </table>
  <h3>Người ship</h3>
    <table class="data table table-striped no-margin">
      <thead>
        <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
          <th>Tên người ship</th>
          <th>Email</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Giờ làm việc</th>
        </tr>
      </thead>
      <tr class="w3-hover-green" style="line-height: 27px;" id="{{$index}}">
        <td>{{$shipper->name}}</td>
        <td>{{$shipper->email}}</td>
        <td>{{$shipper->address}}</td>
        <td>{{$shipper->phone_number}}</td>
        <td id="{{$order->id}}">{{$shipper->gio_giao_hang}}</td>
      </tr>
    </table>
  </div>

  <div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
<script>
var map;
var marker;
var mapDiv = document.getElementById('map');
var directionsService,directionsDisplay,directionDistance,infowindowDistance;
var restaurant =<?php echo json_encode($restaurant, JSON_FORCE_OBJECT) ?>;
var receiptAdd =<?php echo json_encode($receipt, JSON_FORCE_OBJECT) ?>;
function initMap(){
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  directionDistance = new google.maps.DistanceMatrixService;
  infowindowDistance = new google.maps.InfoWindow();
  var pos = {'lat': restaurant.lat, 'lng': restaurant.lng};
  map = new google.maps.Map(mapDiv, {
    center: pos,
    zoom: 14,
  });
  marker = new google.maps.Marker({
    position: pos,
    map: map,
    animation: google.maps.Animation.DROP,
  });
  marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
  var contentString = '<div id="container">'+
  '<h5>'+restaurant.restaurant_name+'</h5>'+'<h5>'+restaurant.address+'</h5>'+'<a href="'+restaurant.link_website+'" target="_blank"><h5>'+restaurant.link_website+'</h5></a>'+'<h5>'+restaurant.phone_number+'</h5>'+
  '</div>';
  var infowindow = new google.maps.InfoWindow({
    content: contentString, //chứa nội dung bên trong
    maxwidth: 70,
  });
  marker.addListener('mouseover', function(){
    infowindow.open(map,marker);
  });
  marker.addListener('mouseout', function(){
    infowindow.close();
  });
  
  createMarker(parseFloat(receiptAdd.receive_address_lat),parseFloat(receiptAdd.receive_address_lng),receiptAdd.receive_address,map,directionsService,directionsDisplay,directionDistance,infowindowDistance);
}
function createMarker(lat,lng,address,map,directionsService,directionsDisplay,directionDistance,infowindowDistance){
  var pos = {'lat': lat, 'lng': lng};

  var newMarker = new google.maps.Marker({
    position: pos,
    map: map,
  });
  var content = '<div id="container">'+
  '<h5>'+address+'</h5>'+'</div>';
  var info = new google.maps.InfoWindow({
    content: content, //chứa nội dung bên trong
    maxwidth: 70,
  });
  newMarker.addListener('mouseover', function(){
    info.open(map,newMarker);
  });
  newMarker.addListener('mouseout', function(){
    info.close();
  });
  calculateAndDisplayRoute(directionsService, directionsDisplay, newMarker, directionDistance, infowindowDistance);
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
</script>
@stop