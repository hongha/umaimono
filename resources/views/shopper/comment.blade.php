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
.scrollbar
{
  float: left;
  height: 360px;
  overflow-y: scroll;
  margin-top: 15px;
}

.force-overflow
{
  min-height: 360px;
}

#style-7::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
  border-radius: 10px;
}

#style-7::-webkit-scrollbar
{
  width: 10px;
  background-color: #F5F5F5;
}

#style-7::-webkit-scrollbar-thumb
{
  border-radius: 10px;
  background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0.44, rgb(122,153,217)),
  color-stop(0.72, rgb(73,125,189)),
  color-stop(0.86, rgb(28,58,148)));
}
</style>
<?php use App\Post;
use App\Food;
use App\RestaurantProfile; 
use App\CommentPost;
use App\CommentFood;?>
<div class="w3-row-padding">

    <div style="background: #d02128; margin-right: 8px;margin-left: 7px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Món ăn đã bình luận</h3>
    </div>
    @foreach($food_ids as $index => $id_food)
    <?php 
      $food = Food::find($id_food); $comment_foods = CommentFood::where('id_food',$id_food)->where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->get();?>
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
      <div class="w3-col m8 scrollbar" id="style-7">
      <div class="force-overflow">
        <table class="w3-table-all">
        <thead>
          <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
            <th>STT</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        @foreach($comment_foods as $index => $comment_food)
        <tr class="w3-hover-green" style="line-height: 27px;">
          <td>{{$index+1}}</td>
          <td>{{$comment_food->content}}</td>
          <td>{{$comment_food->updated_at}}</td>
          <td>
            <a href="{{url('post/view_food/'.$food->id)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;" target="_blank"></a>
            <a href="javascript:void(0)" onclick="edit_comment_food({{$comment_food->id}},{{$food->id}},this)" class="glyphicon glyphicon-pencil btn-warning btn" style="font-size: 10px;" data-toggle="modal" data-target="#modal-edit-receipt" ></a>
            <a href="javascript:void(0)" onclick="delete_receipt(this)" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a>    
          </td>
        </tr>
        @endforeach
        </table>
      </div>
    </div>
    @endforeach
    <div  class="w3-col m12">
    <div style="background: #d02128; margin-right: 15px; height: 40px; line-height: 40px;"><h3 style="line-height: 40px; margin-left: 15px; color: white;">Bài viết đã bình luận</h3>
    </div>
    </div>
    @foreach($post_ids as $index => $id_food)
    <?php 
      $food = Post::find($id_food); $comment_foods = CommentPost::where('id_post',$id_food)->where('id_user',Auth::user()->id)->where('delete_flg','!=',1)->get();?>
      <div class="w3-col m4" style="margin-top: 15px; height: 340px; margin-bottom: 15px;">
        <div class="margin-right-15 " style="padding-bottom: 15px; border-radius: 2px">
          <div style="height: 200px; overflow: hidden !important;">
          <img src="../../umaimono/post/avatar/{{$food->avatar}}" alt="" style="height: auto; width: 100%; border-radius: 2px 2px 0 0;">
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
      <div class="w3-col m8 scrollbar" id="style-7">
      <div class="force-overflow">
        <table class="w3-table-all">
        <thead>
          <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
            <th>STT</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        @foreach($comment_foods as $index => $comment_food)
        <tr class="w3-hover-green" style="line-height: 27px;">
          <td>{{$index+1}}</td>
          <td>{{$comment_food->content}}</td>
          <td>{{$comment_food->updated_at}}</td>
          <td>
            <a href="{{url('post/view/'.$food->id)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;" target="_blank"></a>
            <a href="javascript:void(0)" onclick="edit_comment({{}})" class="glyphicon glyphicon-pencil btn-warning btn" style="font-size: 10px;" data-toggle="modal" data-target="#modal-edit-receipt" ></a>
            <a href="javascript:void(0)" onclick="delete_receipt(this)" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a>    
          </td>
        </tr>
        @endforeach
        </table>
      </div>
    </div>
    @endforeach
  </div>
  <div id="modal-edit-food" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa thông tin đơn hàng</h4>
      </div>
      <div class="modal-body class="form-group"">
        <form action="{{url('shopper/edit_order_food')}}" method="post" id="edit_order_food">
        {{ csrf_field() }}
        <center>
         <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="number" name="quant" class="form-control input-number" id="number" value="" min="1" max="100">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
        </div>
        <br>
        <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon primary"><span class="glyphicon glyphicon-star"></span></span>
            <input type="text" class="form-control" id="ghi_chu" placeholder="Ghi chú" name="ghi_chu">
      </div>
      </div>
          <input type="number" name="id_receipt" id="id_receipt" hidden="" value="">
          <input type="number" name="id_order" id="id_order" hidden="" value="">
        </center> 
        </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-success" onclick="submitForm();">Đồng ý</button>
      </div>
      
    </div>
  </div>
</div>
<script>
function edit_comment_food(id_comment,tr_food,tr_comment) {
  document.getElementById("id_order").value = id_order;
  document.getElementById("id_receipt").value = id_receipt;
  var tr = document.getElementById(tr_id);
  var tds = tr.getElementsByTagName("td");
  document.getElementById("number").value = tds[3].innerHTML;
  // var ghi_chu = document.getElementById(id_order).innerHTML;
  document.getElementById("ghi_chu").value = tds[4].innerHTML;    
}
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