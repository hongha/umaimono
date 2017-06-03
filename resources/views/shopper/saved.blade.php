@extends('layouts.userProfile') 
@section('content')
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
.btn span.glyphicon {         
  opacity: 0;       
}
.btn.active span.glyphicon {        
  opacity: 1;       
}
</style>
<?php use App\Post;use App\Food;use App\RestaurantProfile;?>
<div class="w3-row-padding">
    <div style="background: #d02128; margin-right: 8px;margin-left: 7px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn đã lưu</h3>
    </div>
    @foreach($foods as $food_saved)
    <?php $food = Food::find($food_saved->id_food); ?>
      <div class="w3-col m4" style="margin-top: 15px; height: 340px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <img src="../../umaimono/post/food_img/{{$food->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;">
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view_food/'.$food->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$food->name}}</p></a>
          <p class="txt-blue font16 bold" style="margin-left: 15px;">{{$food->price}} đ</p>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php $restaurants = RestaurantProfile::where('id_restaurant',$food->id_restaurant)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></p>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$food->saveds}}</span>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="update({{$food->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span></a> 
          </div>
        </div>
      </div>
    @endforeach

    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết đã lưu</h3>
    </div>
    </div>
    @foreach($posts as $post_saved)
    <?php $post = Post::find($post_saved->id_post); ?>
      <div class="w3-col m4" style="margin-top: 15px; height: 310px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <a href="{{url('post/view/'.$post->id)}}">
          <img src="../../umaimono/post/avatar/{{$post->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;"></a>
          </div>
          <div class="w3-white" style="padding-bottom: 15px;">
          <a href="{{url('post/view/'.$post->id)}}"><p style="font-size: 16px; margin-left: 15px; padding: 0px; line-height: 1.3em; font-weight: bold; margin-top: 5px; color: black;">{{$post->title}}</p></a>
          <p style="margin-left: 15px; color: #a1a1a1; font-size: 14px;"><?php $restaurants = RestaurantProfile::where('id_restaurant',$post->user_id)->get(); foreach ($restaurants as $restaurant) {
             echo $restaurant->address;
          } ?></p>
          <a href="javascript:void(0)" style="margin-left: 15px;"><i class="fa fa-bookmark"></i></a>&nbsp;<span>{{$post->saveds}}</span>
           <a href="javascript:void(0)" style="color: #FFF;background: #cf2127;padding: 2px 10px;margin: -3px 0;border-radius: 2px;float: right;margin-right: 15px;" class="hover-black" onclick="updatePost({{$post->id}},this)"><i class="fa fa-bookmark"></i>&nbsp;<span>Bỏ Lưu</span></a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
<script>
  function update(id_food,a_tag){
    alertify.confirm("Bạn chắc chắn muốn bỏ lưu?", function (e) {
    if (e) {
      $.ajax({
        url: '/umaimono/shopper/dis_save_food/'+id_food,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var div = a_tag.parentNode.parentNode.parentNode;
          div.remove();
        }
      });
    }
  });
}
function updatePost(id_post,a_tag){
    alertify.confirm("Bạn chắc chắn muốn bỏ lưu?", function (e) {
    if (e) {
      $.ajax({
        url: '/umaimono/shopper/dis_save_post/'+id_post,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var div = a_tag.parentNode.parentNode.parentNode;
          div.remove();
        }
      });
    }
  });
}
</script>
@stop