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
<div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn mới nhất</h3>
    </div>
    </div>
    @foreach($foods as $food_saved)
    <?php $food = Food::find($food_saved->id_food); ?>
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
<script>
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

</script>
@stop