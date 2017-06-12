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
    <div class="w3-col m2" style="margin-top: 20px;">
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
 	<div class="w3-col m10">
 	<div class="margin-left-right-16 w3-white">
 	<div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;">
    	<h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn</h3>
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
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết</h3>
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
  </div>
  </div>
 </div>
 <?php if(isset(Auth::user()->id)){$user_id = Auth::user()->id;}else{$user_id = 0;} ?>
 <script>
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

