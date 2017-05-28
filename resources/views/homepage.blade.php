@extends('layouts.home')
@section('title')
    Trang chủ - @parent
@stop
@section('content')
<?php use App\RestaurantProfile; ?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:100px">    
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
    <div class="w3-col m5" style="margin-bottom: 7px;">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#">Mới nhất</a></li>
      <li><a href="#">Top tuần</a></li>
      <li><a href="#">Gần tôi</a></li>
      <li><a href="#">Đã lưu</a></li>
    </ul>
    </div>
    <div class="w3-col m7 float-right">
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
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn mới nhất</h3>
    </div>
    </div>
    @foreach($foods as $food)
      <div class="w3-col m4" style="margin-top: 15px; height: 340px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <img src="../umaimono/post/food_img/{{$food->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;">
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view_food/'.$food->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$food->name}}</p></a>
          <p class="txt-blue font16 bold" style="margin-left: 15px;">{{$food->price}} đ</p>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php $restaurants = RestaurantProfile::where('id_restaurant',$food->id_restaurant)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></p>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;">Like</a>&nbsp;<span>{{$food->likes}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>{{$food->comments}}</span>
          <a href="#" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>40</span>
          <a style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a>
          </div>
        </div>
      </div>
    @endforeach
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết mới nhất</h3>
    </div>
    </div>

    @foreach($posts as $post)
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
          
          <a href="#" style="margin-left: 15px;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>&nbsp;<span>300</span>
          <a href="#" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span>200</span>
          <a href="#" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>40</span>
          <a style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a>
          </div>
        </div>
      </div>
    @endforeach

    </div>
    
    <!-- End Middle Column -->
    </div>
    

    <!-- End Right Column -->   
  <!-- End Grid -->
  </div>
  </div>
</script>
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html> 
@stop
