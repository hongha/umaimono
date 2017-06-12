@extends('layouts.home')
@section('title')
    Trang chủ - @parent
@stop
@section('content')
<?php use App\RestaurantProfile; 
use Illuminate\Support\Facades\DB;
?>
<style type="text/css">
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
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:10px">    
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
    <div class="w3-col m10">
    <div class="margin-left-right-16 w3-white">
    <div class="w3-col m6" style="margin-bottom: 7px;">
  <div class="w3-row">
    <a href="javascript:void(0)" onclick="openCity(event, 'London');" >
      <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Mới nhất</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Paris');" data-toggle="tab">
      <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding">Gần tôi</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
      <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding">Phổ biến</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Hanoi');" >
      <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding">Top tuần</div>
    </a>
  </div>
    </div>

    <div class="w3-col m6 float-right">
      <div class="form-group w3-col m3" style="margin-left: 15px;">
        <select class="form-control" id="sel1">
          <option>-Danh mục-</option>
          <option>Nhà hàng</option>
          <option>Ăn chay</option>
          <option>Quán ăn</option>
        </select>
      </div>
      <div class="form-group w3-col m3" style="margin-left: 15px;">
        <select class="form-control" id="sel1">
          <option>-Ẩm thực-</option>
          <option>Việt Nam</option>
          <option>Hàn Quốc</option>
          <option>Nhật Bản</option>
        </select>
      </div>
      <div class="form-group w3-col m3" style="margin-left: 15px;">
        <select class="form-control" id="sel1">
          <option>-Quận huyện-</option>
          <option>Hoàn Kiếm</option>
          <option>Tây Hồ</option>
          <option>Ba Đình</option>
        </select>
      </div>
    </div>

  <div id="London" class="w3-container city row" style=" background:#f5f7f8 !important;">
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn mới nhất</h3>
    </div>
    </div>
    @foreach($foods as $food)
    <?php $restaurants = RestaurantProfile::where('id_restaurant',$food->id_restaurant)->get(); foreach ($restaurants as $restaurant) {} ?>
      <div class="w3-col m4" style="margin-top: 15px; height: 380px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <img src="../umaimono/post/food_img/{{$food->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;">
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view_food/'.$food->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$food->name}}</p></a>
          <p class="txt-blue font16 bold" style="margin-left: 15px;">{{$food->price}} đ</p>
          <a href="{{url('post/view_restaurant/'.$restaurant->id_restaurant)}}"><p style="margin-left: 15px; color: #c1e3a1; font-size: 14px;"><?php 
             echo $restaurant->restaurant_name;
           ?></p></a>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php echo $restaurant->address ?></p>
          <?php $j = 0; if(isset(Auth::user()->id)){foreach ($liked_foods as $liked_food) {
            if($food->id == $liked_food){$j = 1;break;}}} ?>
          <?php if($j == 1){?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikeFood({{$food->id}},this)"><span>Bỏ thích</span><input type="text" name="" value="1" hidden=""></a>&nbsp;<span>{{$food->likes}}</span>
          <?php }else{?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikeFood({{$food->id}},this)"><span>Thích</span><input type="text" name="" value="0" hidden=""></a>&nbsp;<span>{{$food->likes}}</span>
          <?php } ?>
          <a href="{{url('post/view_food/'.$food->id)}}" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>{{$food->comments}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$food->saveds}}</span>
          <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="update({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="update({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
          
          </div>
        </div>
      </div>
    @endforeach
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết mới nhất</h3>
    </div>
    </div>
    @foreach($posts as $post)
    <?php $restaurants = RestaurantProfile::where('id_restaurant',$post->id_restaurant)->get(); foreach ($restaurants as $restaurant) {} ?>
      <div class="w3-col m4" style="margin-top: 15px; height: 360px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <a href="{{url('post/view/'.$post->id)}}">
          <img src="../umaimono/post/avatar/{{$post->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;"></a>
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view/'.$post->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$post->title}}</p></a>
          <a href="{{url('post/view_restaurant/'.$restaurant->id_restaurant)}}"><p style="margin-left: 15px; color: #c1e3a1; font-size: 14px;"><?php 
             echo $restaurant->restaurant_name;
           ?></p></a>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php $restaurants = RestaurantProfile::where('id_restaurant',$post->user_id)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></p>
          <?php $j = 0; if(isset(Auth::user()->id)){foreach ($liked_posts as $liked_post) {
            if($post->id == $liked_post){$j = 1;break;}}} ?>
          <?php if($j == 1){?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Bỏ thích</span><input type="text" name="" value="1" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php }else{?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Thích</span><input type="text" name="" value="0" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php } ?>
          <a href="{{url('post/view/'.$post->id)}}" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>{{$post->comments}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$post->saveds}}</span>
          <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_posts as $saved_post) {
            if($post->id == $saved_post){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
          </div>
        </div>
      </div>
    @endforeach
  </div>
    
  <div id="Paris" class="w3-container city" style="display:none; background: #f5f7f8;">
    <div style="width: 100%; height: 500px; border: 1px solid black; margin-top: 30px;" class="row">
      <div id="map"></div>
    </div>
    <div id="chikai_res" class="w3-white row" style="margin-right: 14px;"></div>
  </div>

  <div id="Tokyo" class="w3-container city" style="display:none;background: #f5f7f8;">
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn được yêu thích</h3>
    </div>
    </div>
    @foreach($food_pb as $food)
    <?php $restaurants = RestaurantProfile::where('id_restaurant',$food->id_restaurant)->get(); foreach ($restaurants as $restaurant) {} ?>
      <div class="w3-col m4" style="margin-top: 15px; height: 380px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <img src="../umaimono/post/food_img/{{$food->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;">
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view_food/'.$food->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$food->name}}</p></a>
          <p class="txt-blue font16 bold" style="margin-left: 15px;">{{$food->price}} đ</p>
          <a href="{{url('post/view_restaurant/'.$restaurant->id_restaurant)}}"><p style="margin-left: 15px; color: #c1e3a1; font-size: 14px;"><?php 
             echo $restaurant->restaurant_name;
           ?></p></a>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php echo $restaurant->address ?></p>
          <?php $j = 0; if(isset(Auth::user()->id)){foreach ($liked_foods as $liked_food) {
            if($food->id == $liked_food){$j = 1;break;}}} ?>
          <?php if($j == 1){?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikeFood({{$food->id}},this)"><span>Bỏ thích</span><input type="text" name="" value="1" hidden=""></a>&nbsp;<span>{{$food->likes}}</span>
          <?php }else{?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikeFood({{$food->id}},this)"><span>Thích</span><input type="text" name="" value="0" hidden=""></a>&nbsp;<span>{{$food->likes}}</span>
          <?php } ?>
          <a href="{{url('post/view_food/'.$food->id)}}" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>{{$food->comments}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$food->saveds}}</span>
          <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="update({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="update({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
          
          </div>
        </div>
      </div>
    @endforeach
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết được yêu thích</h3>
    </div>
    </div>
    @foreach($post_pb as $post)
      <div class="w3-col m4" style="margin-top: 15px; height: 310px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <a href="{{url('post/view/'.$post->id)}}">
          <img src="../umaimono/post/avatar/{{$post->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;"></a>
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view/'.$post->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$post->title}}</p></a>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php $restaurants = RestaurantProfile::where('id_restaurant',$post->user_id)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></p>
          <?php $j = 0; if(isset(Auth::user()->id)){foreach ($liked_posts as $liked_post) {
            if($post->id == $liked_post){$j = 1;break;}}} ?>
          <?php if($j == 1){?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Bỏ thích</span><input type="text" name="" value="1" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php }else{?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Thích</span><input type="text" name="" value="0" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php } ?>
          <a href="{{url('post/view/'.$post->id)}}" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>{{$post->comments}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$post->saveds}}</span>
          <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_posts as $saved_post) {
            if($post->id == $saved_post){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div id="Hanoi" class="w3-container city" style="display:none;background: #f5f7f8;">
    <h2>Chức năng này sẽ sớm được cập nhật!</h2>
  </div>

    </div>
    </div>
  </div>
  </div>
  <?php if(isset(Auth::user()->id)){$user_id = Auth::user()->id;}else{$user_id = 0;} ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
<script>
var map, infoWindow,count;
var markers = [];
var dts = [];
var marker;
var min,index = 0;
var mapDiv = document.getElementById('map');
var chikai_res = document.getElementById('chikai_res');
var arr_res = <?php echo json_encode($restaurant_infos, JSON_FORCE_OBJECT) ?>;
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  count = 0;
  initMap(mapDiv);
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  $(chikai_res).empty();
});
var size = Object.keys(arr_res).length;
var max = 5;
function initMap(mapDiv){
  var pos;
  map = new google.maps.Map(mapDiv, {
    center: {lat: 21.0277644, lng: 105.8341598},
    zoom: 13,
  });

  marker = new google.maps.Marker({
    icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
    map: map,
  });
  //start infowindow
  var contentString = '<div id="container">'+
  '<h5>Vị trí của bạn</h5>'+
  '</div>';
  infoWindow = new google.maps.InfoWindow({
    content: contentString, //chứa nội dung bên trong
  });

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      // infoWindow.open(map);
      marker.setPosition(pos);
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  };
  marker.addListener('click', function(){
    infoWindow.open(map,marker);
  });
  setTimeout(function(){

    for (i = 0; i < size; i++) { 
      if(count == size){
        for (var x=0;x<size;x++)
        {
          for(var y=0;y<size - 1;y++)
          {
            if(dts[y]>dts[y+1])
              {
              t=dts[y];
              dts[y]=dts[y+1];
              dts[y+1]=t;
              var item = arr_res[y];
              arr_res[y]=arr_res[y+1];
              arr_res[y+1]=item;
              var mar = markers[y];
              markers[y]=markers[y+1];
              markers[y+1]=mar;
            }
          }
        }
        for(var m = 0; m<max;m++){
          markers[m].setMap(map);
          getRestaurantInfo(arr_res[m],dts[m]);
          // var content = '<div id="container">'+
          // '<h5>'+arr_res[m].restaurant_name+'</h5>'+'<h5>'+arr_res[m].address+'</h5>'+'<a href="'+arr_res[m].link_website+'" target="_blank"><h5>'+arr_res[m].link_website+'</h5></a>'+'<h5>'+arr_res[m].phone_number+'</h5>'+
          // '</div>';
          // var infowindow = new google.maps.InfoWindow({
          //   content: content, //chứa nội dung bên trong
          //   maxwidth: 70,
          // });
          // markers[m].addListener('click', function(){
          //   infowindow.open(map,markers[m]);
          // });
        }
        break;
      }
      var posi = {
        lat: parseFloat(arr_res[i].lat),
        lng: parseFloat(arr_res[i].lng)
      };  
      var newMarker = new google.maps.Marker({});
      newMarker.setPosition(posi);     
      calculateRoute(newMarker);
      markers.push(newMarker);
      count++;
    }
    // console.log(index);
  }, 1500); 
  
}
function getRestaurantInfo(info,dt)
{ 
  if(index < 5){
    console.log('xxx');
    index++;
  }else{
    $.ajax({
        url: '/umaimono/post/getResFoods/'+info.id_restaurant,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function (response) {
          var id = info.lat + info.lng;
          console.log(id);
          $('<div style="padding: 15px 15px 15px 15px;margin-right:15px;margin-bottom:15px;"><a href="/umaimono/post/view_restaurant/'+info.id_restaurant+'"><span class="font14 bold700 w3-white ">'+info.restaurant_name+': </span></a><span class="font14 txt-red">'+info.address+'</span><br><span class="font14 bold700 w3-white">Quãng đường đến: </span><span class="font14 txt-red">'+dt+'Km</span>&nbsp;&nbsp;<span class="font14 bold700 w3-white">Tiền ship: </span><span class="font14 txt-red">'+dt+' x 5,000đ/km = '+dt*5000+'đ</span></div>').appendTo( chikai_res );
          if(response.length>0){
            $('<div style="width:100%;height:420px;background: #f5f7f8;" id="'+id+'"></div>').appendTo(chikai_res);
            var div = document.getElementById(id);
          for(var i =0; i<response.length;i++){
          $('<div class="w3-col m4" style="margin-top: 15px; height: 340px; margin-bottom: 15px;"><div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px"><div style="height: 200px; overflow: hidden !important;"><img src="../umaimono/post/food_img/'+response[i].avatar+'" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;"></div><div class="w3-white" style="padding-bottom: 15px;"><a href="/umaimono/post/view_food/'+response[i].id+'"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">'+response[i].name+'</p></a><p class="txt-blue font16 bold" style="margin-left: 15px;">'+response[i].price+' đ</p><a href="/umaimono/post/view_restaurant/'+info.id+'""><a href="/umaimono/post/view_restaurant/'+info.id_restaurant+'"><p style="margin-left: 15px; color: #c1e3a1; font-size: 14px;">'+info.restaurant_name+'</p></a><p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;">'+info.address+'</p><a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;"><span>Đã thích</span></a>&nbsp;<span>'+response[i].likes+'</span><a href="/umaimono/post/view_food/'+response[i].id+'" style="margin-left: 15px;">Đã nhận xét</a>&nbsp;<span>'+response[i].comments+'</span><a href="javascript:void(0)" style="margin-left: 15px;">Đã lưu</a>&nbsp;<span>'+response[i].saveds+'</span></div></div></div>').appendTo( div );
          }
          }
        },
        error:function(){

        }
      });
  }
}
function calculateRoute(newMarker){
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
        var res = dt.split(" ");//quãng đường int
        dts.push(parseFloat(res[0]));
        // console.log(dts);
      };
    };
    };
  });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Lỗi: Máy chủ định vị bị lỗi.' :
    'Lỗi: Trình duyệt của bạn không hỗ trợ định vị.');
  infoWindow.open(map);
}

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}

function updateLikePost(id_post,a_tag){
  var a = a_tag.getElementsByTagName("input")[0];
  var data =<?php echo json_encode($user_id, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
    if(a.value == 1){
      $.ajax({
        url: '/umaimono/shopper/dis_like_post/'+id_post,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var likeds = parseInt(spans[1].innerHTML,10);
          spans[1].innerHTML = likeds - 1;
          a_tag.getElementsByTagName("span")[0].innerHTML = "Thích";
          a.value = 0;
        }
      });
    }else{
      $.ajax({
        url: '/umaimono/shopper/like_post/'+id_post,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var likeds = parseInt(spans[1].innerHTML,10);
          spans[1].innerHTML = likeds + 1;
          a_tag.getElementsByTagName("span")[0].innerHTML = "Bỏ thích";
          a.value = 1;
        }
      });
    }
}}

function updateLikeFood(id_food,a_tag){
  var a = a_tag.getElementsByTagName("input")[0];
  var data =<?php echo json_encode($user_id, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
    if(a.value == 1){
      $.ajax({
        url: '/umaimono/shopper/dis_like_food/'+id_food,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var likeds = parseInt(spans[1].innerHTML,10);
          spans[1].innerHTML = likeds - 1;
          a_tag.getElementsByTagName("span")[0].innerHTML = "Thích";
          a.value = 0;
        }
      });
    }else{
      $.ajax({
        url: '/umaimono/shopper/like_food/'+id_food,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var likeds = parseInt(spans[1].innerHTML,10);
          spans[1].innerHTML = likeds + 1;
          a_tag.getElementsByTagName("span")[0].innerHTML = "Bỏ thích";
          a.value = 1;
        }
      });
    }
}}

function update(id_food,a_tag){
  var a = a_tag.getElementsByTagName("input")[0];
  var data =<?php echo json_encode($user_id, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
    if(a.value == 1){
      $.ajax({
        url: '/umaimono/shopper/dis_save_food/'+id_food,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var saveds = parseInt(spans[3].innerHTML,10);
          spans[3].innerHTML = saveds - 1;
          a_tag.style.backgroundColor = "#ddd";
          a_tag.style.color = "#888";
          a_tag.getElementsByTagName("span")[0].innerHTML = "Lưu";
          a.value = 0;
        }
      });
    }else{
      $.ajax({
        url: '/umaimono/shopper/save_food/'+id_food,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var saveds = parseInt(spans[3].innerHTML,10);
          spans[3].innerHTML = saveds + 1;
          a_tag.style.backgroundColor = "#cf2127";
          a_tag.style.color = "#FFF";
          a_tag.getElementsByTagName("span")[0].innerHTML = "Bỏ Lưu";
          a.value = 1;
        }
      });
    }
}}

function updatePost(id_post,a_tag){
  var a = a_tag.getElementsByTagName("input")[0];
  var data =<?php echo json_encode($user_id, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
    if(a.value == 1){
      $.ajax({
        url: '/umaimono/shopper/dis_save_post/'+id_post,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var saveds = parseInt(spans[3].innerHTML,10);
          spans[3].innerHTML = saveds - 1;
          a_tag.style.backgroundColor = "#ddd";
          a_tag.style.color = "#888";
          a_tag.getElementsByTagName("span")[0].innerHTML = "Lưu";
          a.value = 0;
        }
      });
    }else{
      $.ajax({
        url: '/umaimono/shopper/save_post/'+id_post,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var a_par = a_tag.parentNode;
          var spans = a_par.getElementsByTagName("span");
          var saveds = parseInt(spans[3].innerHTML,10);
          spans[3].innerHTML = saveds + 1;
          a_tag.style.backgroundColor = "#cf2127";
          a_tag.style.color = "#FFF";
          a_tag.getElementsByTagName("span")[0].innerHTML = "Bỏ Lưu";
          a.value = 1;
        }
      });
    }
}}
</script>
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@stop
