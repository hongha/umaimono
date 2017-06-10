@extends('layouts.home')
@section('title')
    {{$post->title}} - @parent
@stop
@section('content')
<!-- Page Container -->
<?php use App\User; ?>
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
        <span class="w3-right w3-opacity">{{$post->created_at}}</span>
        <h4>{{$user->name}}</h4><br>
        <h3>{{$post->title}}</h3>
        <hr class="w3-clear">
        <div class="w3-row-padding" style="margin:0 -16px; text-align: justify;">
          <div class="w3-half">
            <img src="../../post/avatar/{{$post->avatar}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
          </div>
          <?php echo $post->content; ?>
        </div>
        <br>
        <div>
        <?php $j = 0; if(isset(Auth::user()->id)){foreach ($liked_posts as $liked_post) {
            if($post->id == $liked_post){$j = 1;break;}}} ?>
          <?php if($j == 1){?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Bỏ thích</span><input type="text" name="" value="1" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php }else{?>
          <a href="javascript:void(0)" class="danh-muc" style="margin-left: 15px;" onclick="updateLikePost({{$post->id}},this)"><span>Thích</span><input type="text" name="" value="0" hidden=""></a>&nbsp;<span>{{$post->likes}}</span>
          <?php } ?>
          <a href="{{url('post/view/'.$post->id)}}" style="margin-left: 15px;"><i class="fa fa-comments" aria-hidden="true"></i></a>&nbsp;<span id="comment_post_number">{{$post->comments}}</span>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$post->saveds}}</span>
          <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_posts as $saved_post) {
            if($post->id == $saved_post){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
           </div>
           <br> 
      </div>
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <h3>Các món ăn của nhà hàng</h3>
        <hr class="w3-clear">
        @if(isset($foods ))
        @foreach ($foods as $foodh)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../../post/food_img/{{$foodh->avatar}}" width="60" height="60" onclick="">
        </div>
        <div class="deli-name-food-detail pull-left">
        <a class="deli-title-name-food" href="{{url('post/view_food/'.$foodh->id)}}">
        <h3 style="font-size: 16px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;">
        {{$foodh->name}}</h3>
        </a>
        <span class="deli-desc"></span>
        <div class="deli-rating-food">
        </div>
        <p style="margin: 0; color: #a1a1a1; font-size: 11px;">
        Đã được đặt <span style="color: #464646; font-weight: bold;">2</span> lần trong tháng</p>
        <!-- <a style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a> -->
        <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($foodh->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$foodh->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
            <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$foodh->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
           <?php } ?>
        </div>
        <div class="deli-more-info">
        <div class="adding-food-cart">
        <span class="btn-adding" onclick="themHang({{$foodh->id}});">+</span>
        </div>
        <div class="product-price">
        <p class="current-price">
        <span class="txt-blue font16 bold">
        {{$foodh->price}}</span>
        <span class="unit">đ</span>
        </p>
        </div>
        </div>
        </div>
        @endforeach
        @endif 
      </div> 
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <h3>Bình luận</h3>
        <hr class="w3-clear">
        <div class="">
          <div class="">
          <!-- Contenedor Principal -->
            <div class="comments-container">
            <ul id="comments-list" class="comments-list">
            @foreach($comment_posts as $comment_post)
              <li>
                <div class="comment-main-level">
                  <!-- Avatar -->
                  <div class="comment-avatar">
                  <?php $comment_user = User::where('id',$comment_post->id_user)->get(); 
                  foreach ($comment_user as $comment_user) {} ?>
                  <img src="{{ URL::asset('avatar/'.$comment_user->avatar) }}" alt="">
                  </div>
                  <!-- Contenedor del Comentario -->
                  <div class="comment-box">
                    <div class="comment-head">
                    <?php if($comment_post->id_user == $post->user_id){?>
                      <h6 class="comment-name by-author"><a href="{{url('user/view/'.$comment_post->id_user)}}">{{$comment_user->name}}</a></h6>
                    <?php }elseif($comment_user->role == 5 || $comment_user->role == 4){ ?>
                      <h6 class="comment-name admin"><a href="{{url('user/view/'.$comment_post->id_user)}}">{{$comment_user->name}}</a></h6>
                    <?php }else{?>
                      <h6 class="comment-name"><a href="{{url('user/view/'.$comment_post->id_user)}}">{{$comment_user->name}}</a></h6>
                    <?php }?>
                      <span>{{$comment_post->created_at}}</span>
                      <?php if(isset(Auth::user()->id)){
                      if(Auth::user()->id == $comment_post->id_user){ ?>
                      <a href="javascript:void(0)" onclick="deleteComment({{$comment_post->id}},this)"><i class="fa fa-trash-o"></i></a>
                      <a href="javascript:void(0)" onclick="loadEditComment({{$comment_post->id}},this)"><i class="fa fa-pencil"></i></a>                     
                      <?php }}?>
                    </div>
                    <div class="comment-content">
                      <span>{{$comment_post->content}}</span><br><br>
                      <a href="" style="font-size: 14px;"><span>Thích</span></a>&nbsp;<span style="font-size: 14px;">20</span>&nbsp;&nbsp;<a href="" style="font-size: 14px;"><span>Trả lời</span></a>&nbsp;<span style="font-size: 14px;">20</span>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
            </ul>
            <ul class="comments-list">
              <li>
              <?php if(isset(Auth::user()->id)){?>
                <div class="comment-main-level">
                  <!-- Avatar -->
                  <div class="comment-avatar"><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" alt=""></div>
                  <!-- Contenedor del Comentario -->
                  <div class="comment-box">
                    <div class="comment-head">
                      <h6 class="comment-name"><a href="">{{Auth::user()->name}}</a></h6>
                      <i class="fa fa-reply"></i>
                      <i class="fa fa-heart"></i>
                    </div>
                    <div class="comment-content">
                    <form id="form" action="{{url('post/create_comment_post/'.$post->id)}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="text" name="id_user" value="{{Auth::user()->id}}" hidden="">
                    <textarea style="height: 80px; margin-bottom: 15px; margin-top: 15px;" class="form-control" name="content" id="content" required=""></textarea>
                    </form>
                    <button class="btn btn-success" onclick="commentAjax();">Bình luận</button>
                    </div>
                  </div>
                </div>
                <?php }else{?>
                <a class="btn btn-success" href="{{url('login')}}">Bình luận</a>
                <?php  } ?>
              </li>
            </ul>
          </div>
          </div>
        </div>
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
            <a href="javascript:void(0)" class="btn-reset" onclick="reset_menu({{$post->user_id
              }})">Reset</a>
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
          <a href="javascript:void(0)" class="btn-book-first after-lick" onclick="checkout({{$post->user_id}})">
          <i class="fa fa-check-circle"></i>
          Đặt trước</a>
        </div>
      </div>

      <div class="w3-card-2 w3-round w3-white w3-center padding-10">
        <div class="text-align-left">
        <h4>Các món được đặt nhiều</h4>
        <hr class="w3-clear">
        @if(isset($luu_nhieus))
        @foreach ($luu_nhieus as $food_l)
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

      <div class="w3-card-2 w3-round w3-white w3-center padding-10" style="margin-top: 20px;">
        <div class="text-align-left">
        <h4>Các món được thích nhiều</h4>
        <hr class="w3-clear">
        @if(isset($like_nhieus))
        @foreach ($like_nhieus as $food_k)
        <div class="deli-box-menu-detail clearfix">
        <div class="img-food-detail pull-left">
        <img src="../../post/food_img/{{$food_k->avatar}}" width="60" height="60" onclick="">
        </div>
        <div class="pull-left" style="margin-left: 10px;line-height: 1.8em; overflow: overflow: hidden;">
        <a class="deli-title-name-food" href="{{url('post/view_food/'.$food_k->id)}}" style="height: 20px;overflow: hidden;">
        <span style="font-size: 14px; margin: 0px; padding: 0px; line-height: 1.3em; font-weight: bold;display: inline-block;">
        {{$food_k->name}}
        </span>
        </a>
        <p style="margin: 0; color: #a1a1a1; font-size: 11px;">
        Đã đặt <span style="color: #464646; font-weight: bold;">2</span> lần trong tháng</p>
        <!-- <a style="padding: 3px; color: #888;;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span></a> -->
        <?php $i = 0; if(isset(Auth::user()->id)){foreach ($saved_foods as $save_food) {
            if($food_k->id == $save_food){$i = 1;break;}}} ?>
          <?php if($i == 1){?>
          <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$food_k->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span><input type="text" name="" value="1" hidden=""></a> 
           <?php }else{?>
          <a href="javascript:void(0)" style="color: #888;background: #ddd;padding: 2px 10px;margin: -3px 0;border-radius: 2px;" class="hover-black" onclick="update({{$food_k->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Lưu</span><input type="text" name="" value="0" hidden=""></a>
        <?php } ?>
        </div>
        <div class="deli-more-info">
        <div class="adding-food-cart">
        <span class="btn-adding" onclick="themHang({{$food_k->id}});">+</span>
        </div>
        <div class="product-price">
        <p class="current-price">
        <span class="txt-blue bold">
        {{$food_k->price}}</span>
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
    <?php if(isset(Auth::user()->id)){$user_id = Auth::user()->id;}else{$user_id = 0;} ?>
  </div>
<script>

function editComment(id_comment, button) {
  var div = button.parentNode;
  var form = div.getElementsByTagName("form");
  var data = $(form[0]).serialize();
  var textarea = form[0].getElementsByTagName("textarea");
  var textareaValue = $("textarea").val();
  if(textareaValue == ''){
    alertify.error("Hãy nhập vào nhận xét!");
  }else{
    $.ajax({
    url: '/umaimono/post/edit_comment_post/'+id_comment,
    type: 'POST',
    data: data,
    success: function (response) {
    var parentDiv = div.parentNode.parentNode;
    var li = parentDiv.parentNode;
    $(parentDiv).empty();
    $(response).appendTo(li);
    }
  });
  }
}
function loadEditComment(id_comment,a_tag){
  var div1 = a_tag.parentNode.parentNode.parentNode;
  var div2 = div1.parentNode;
  var div3 = a_tag.parentNode.parentNode;
  var divs = div3.getElementsByTagName("div");
  var span = divs[1].getElementsByTagName("span");
  var content = span[0].innerHTML;
  $(div1).empty();
  $('<?php if(isset(Auth::user()->id)){?><li><div class="comment-main-level"><div class="comment-avatar"><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" alt=""></div><div class="comment-box"><div class="comment-head"><h6 class="comment-name"><a href="http://creaticode.com/blog">{{Auth::user()->name}}</a></h6><i class="fa fa-reply"></i><i class="fa fa-heart"></i></div><div class="comment-content"><form method="POST">{!! csrf_field() !!}<input type="text" name="id_user" value="{{Auth::user()->id}}" hidden=""><textarea style="height: 80px; margin-bottom: 15px; margin-top: 15px;" class="form-control" name="editContent">'+content+'</textarea></form><button class="btn btn-success" onclick="editComment('+id_comment+',this);">Chỉnh sửa</button></div></div></div></li><?php }?>').appendTo(div2);

}
function deleteComment(id_comment,a_tag){
    alertify.confirm("Bạn chắc chắn muốn xóa?", function (e) {
    if (e) {
      $.ajax({
        url: '/umaimono/post/delete_comment_post/'+id_comment,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var li = a_tag.parentNode.parentNode.parentNode.parentNode;
          li.remove();
        }
      });
    }
  });
}
function commentAjax(){
  var form = document.getElementById("form");
  var url = $(form).attr('action');
  var data = $(form).serialize();
  var textarea = form.getElementsByTagName("textarea");
  var textareaValue = $("textarea").val();
  if(textareaValue == ''){
    alertify.error("Hãy nhập vào nhận xét!");
  }else{
  $.ajax({
    url: url,
    type: 'POST',
    data: data,
     success: function (response) {
      var ul = document.getElementById("comments-list");
      $('<?php if(isset(Auth::user()->id)){?><li><div class="comment-main-level"><div class="comment-avatar"><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}"></div><div class="comment-box"><div class="comment-head"><h6 class="comment-name"><a href="http://creaticode.com/blog">{{Auth::user()->name}}</a></h6><span>'+response.created_at+'</span><a href="javascript:void(0)" onclick="deleteComment('+response.id+',this)"><i class="fa fa-trash-o"></i></a><a href="javascript:void(0)" onclick="loadEditComment('+response.id+',this)"><i class="fa fa-pencil"></i></a> </div><div class="comment-content"><span>'+response.content+'</span><br><br><a href="" style="font-size: 14px;"><span>Thích</span></a>&nbsp;<span style="font-size: 14px;">20</span>&nbsp;&nbsp;<a href="" style="font-size: 14px;"><span>Trả lời</span></a>&nbsp;<span style="font-size: 14px;">20</span></div></div></div></li><?php }?>').appendTo(ul);
      var comment_post_number = document.getElementById("comment_post_number");
      comment_post_number.innerHTML = parseInt(comment_post_number.innerHTML,10) + 1;
      $("textarea").val('');
    }
  });
  }
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
function reset_menu(id){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){window.location.href = "http://localhost/umaimono/login";
  }else{
  $.ajax({
    url: '/umaimono/post/reset_menu/'+id,
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
function checkout(id){
  var data =<?php echo json_encode($shopping_carts, JSON_FORCE_OBJECT) ?>;
  if(!data){
    window.location.href = "http://localhost/umaimono/login";
  }else{
    window.location.href = 'http://localhost/umaimono/post/buy/'+id;
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
