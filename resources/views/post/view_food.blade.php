@extends('layouts.home')
@section('title')
    {{$food->name}} - @parent
@stop
@section('content')
<!-- Page Container -->
<?php use App\RestaurantProfile; ?>
<div class="w3-container w3-content" style="max-width:1400px;margin-top:20px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m2">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Thông tin nhà hàng</h4>
         <p class="w3-center"><img src="../../avatar/{{$user->avatar}}" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <?php 
         if(isset($restaurant_info)){foreach ($restaurant_info as $restaurant_info){}}
        ?>
         <a><h4>{{{ isset($restaurant_info->restaurant_name) ? $restaurant_info->restaurant_name : 'Chưa cập nhật' }}}</h4></a>

        <p><i class="fa fa-map-marker user-profile-icon"></i> {{{ isset($restaurant_info->address) ? $restaurant_info->address : 'Chưa cập nhật' }}}</p>

        <p><i class="fa fa-briefcase user-profile-icon"></i> {{{ isset($restaurant_info->phone_number) ? $restaurant_info->phone_number : 'Chưa cập nhật' }}}</p>

        <p><i class="fa fa-external-link user-profile-icon"></i>
        <a href="{{{ isset($restaurant_info->link_website) ? $restaurant_info->link_website : '#' }}}" target="_blank">{{{ isset($restaurant_info->link_website) ? $restaurant_info->link_website : 'Chưa cập nhật' }}}</a></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card-2 w3-round">
        <div class="w3-accordion w3-white">
          <button onclick="myFunction('Demo3')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Ảnh các món ăn</button>
          <div id="Demo3" class="w3-accordion-content w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/nature.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/forest.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/nature.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>      
      </div>
      <br>
      <div class="w3-card-2 w3-round w3-white">
      @if(isset($posts ))
        <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container" style="padding-top: 15px;">
        <h4>Các bài viết gần đây</h4>
        <hr class="w3-clear">
          @foreach($posts as $post_l)
          <div>
          <img src="../../post/avatar/{{$post_l->avatar}}" style="width: 100%; height: auto;">
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
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
      
      <div class="w3-container w3-card-2 w3-white w3-round margin-left-right-16"><br>
        <img src="../../avatar/{{$user->avatar}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">{{$food->created_at}}</span>
        <h4>{{$user->name}}</h4><br>
        <h3>{{$food->name}}</h3>
        <hr class="w3-clear">
        <div class="w3-row-padding" style="margin:0 -16px; text-align: justify;">
          <div class="w3-half" style="height: 200px; overflow: hidden !important;">
            <img src="../../post/food_img/{{$food->avatar}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
          </div>
          <div class="w3-half">
          <span style="font-size: 16px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;">Nguyên liệu: </span><span style=" color: #a1a1a1; font-size: 14px;">{{$food->material}}</span><br>
          <span style="font-size: 16px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;">Địa chỉ: </span>
          <span style=" color: #a1a1a1; font-size: 14px;"> <?php $restaurants = RestaurantProfile::where('id_restaurant',$food->id_restaurant)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></span><br>
          <span style="font-size: 16px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;">Giá: </span><span style=" color: #a1a1a1; font-size: 14px;">{{$food->price}} đ</span>
          <a href="javascript:void(0)" class="btn-book-first after-lick" onclick="themHang({{$food->id}})" style="width: 120px !important;float: right;margin-right: 121px;     margin-top: 30px;">
          <i class="fa fa-check-circle"></i>
          Thêm hàng</a>
          </div>
        </div>
        <br>
        <div>
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
           &nbsp;
           &nbsp;
           <span>Được đặt <b>{{$food->ordered}}</b> lần</span>
        </div>
           <br> 
      </div>
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <h3>Các món ăn của nhà hàng</h3>
        <hr class="w3-clear">
        @if(isset($foods ))
        @foreach ($foods as $food)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../../post/food_img/{{$food->avatar}}" width="60" height="60" onclick="">
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
        <!-- <a style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a> -->
        <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
          <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="updateFood({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
          <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="updateFood({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
        <?php } ?>
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
                <input type="text" width="200" placeholder="Ghi chú" class="pull-left" max="255" maxlength="255" value="{{$shopping_cart->ghi_chu}}" onblur="blurFunction({{$shopping_cart->id}},this)">
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
            <span class="font14 float-right">5,000đ/km</span>
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

      <div class="w3-card-2 w3-round w3-white w3-center padding-10">
        <div class="text-align-left">
        <h4>Các món ăn liên quan</h4>
        <hr class="w3-clear">
        @if(isset($luu_nhieus ))
        @foreach($luu_nhieus as $food_l)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../../post/food_img/{{$food_l->avatar}}" width="60" height="60" onclick="">
        </div>
        <div class="pull-left" style="margin-left: 10px;line-height: 1.8em; overflow: overflow: hidden;">
        <a class="deli-title-name-food" href="{{url('post/view_food/'.$food_l->id)}}" style="height: 20px;overflow: hidden;">
        <span style="font-size: 14px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;display: inline-block;">
        {{$food_l->name}}
        </span>
        </a>
        <p style="margin: 0; color: #a1a1a1; font-size: 11px;">
        Đã đặt <span style="color: #464646; font-weight: bold;">2</span> lần trong tháng</p>
        <!-- <a style="padding: 3px; color: #888;;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a> -->
        <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food_l->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
          <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="updateFood({{$food_l->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
          <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="updateFood({{$food_l->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
        <?php } ?>
        </div>
        <div class="deli-more-info">
        <div class="adding-food-cart">
        <span class="btn-adding" onclick="themHang({{$food_l->id}});">+</span>
        </div>
        <div class="product-price">
        <p class="current-price">
        <span class="txt-blue bold">
        {{$food_l->price}}</span>
        <span class="unit">đ</span>
        </p>
        </div>
        </div>
        </div>
        @endforeach
        @endif 
        </div>
      </div>

      <div class="w3-card-2 w3-round w3-white w3-center padding-10" style="margin-top: 20px;">
        <div class="text-align-left">
        <h4>Các món được thích nhiều</h4>
        <hr class="w3-clear">
        @if(isset($like_nhieus))
        @foreach ($like_nhieus as $food_l)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../../post/food_img/{{$food_l->avatar}}" width="60" height="60" onclick="">
        </div>
        <div class="pull-left" style="margin-left: 10px;line-height: 1.8em; overflow: overflow: hidden;">
        <a class="deli-title-name-food" href="{{url('post/view_food/'.$food_l->id)}}" style="height: 20px;overflow: hidden;">
        <span style="font-size: 14px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;display: inline-block;">
        {{$food_l->name}}
        </span>
        </a>
        <p style="margin: 0; color: #a1a1a1; font-size: 11px;">
        Đã đặt <span style="color: #464646; font-weight: bold;">2</span> lần trong tháng</p>
        <!-- <a style="padding: 3px; color: #888;;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a> -->
        <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food_l->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
          <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$food_l->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
          <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$food_l->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
        <?php } ?>
        </div>
        <div class="deli-more-info">
        <div class="adding-food-cart">
        <span class="btn-adding" onclick="themHang({{$food_l->id}});">+</span>
        </div>
        <div class="product-price">
        <p class="current-price">
        <span class="txt-blue bold">
        {{$food_l->price}}</span>
        <span class="unit">đ</span>
        </p>
        </div>
        </div>
        </div>
        @endforeach
        @endif 
        </div>
      </div>
    </div>
    <!-- End Right Column -->   
  <!-- End Grid -->
  </div>
  <?php if(isset(Auth::user()->id)){$user_id = Auth::user()->id;}else{$user_id = 0;} ?>
<script>
function updateFood(id_food,a_tag){
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
          a_tag.style.backgroundColor = "#cf2127";
          a_tag.style.color = "#FFF";
          a_tag.getElementsByTagName("span")[0].innerHTML = "Bỏ Lưu";
          a.value = 1;
        }
      });
    }
}}

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
// Accordion
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
    var money_total = document.getElementById("money_total");
    console.log(parseInt(money_total.innerHTML,10));
    if(parseInt(money_total.innerHTML,10) < 50000){
      alertify.alert("Rất xin lỗi! Bạn cần mua nhiều hơn hoặc bằng 50,000đ!");
    }else{
      window.location.href = "http://localhost/umaimono/post/buy";
    }
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
