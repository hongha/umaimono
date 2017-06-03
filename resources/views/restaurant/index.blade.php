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
<?php use Illuminate\Support\Facades\DB; ?>
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckeditor/ckeditor.js') }}" ></script>
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckfinder/ckfinder.js') }}" ></script>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Restaurant Manage</h3>
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
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Đơn hàng mới</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_contentx1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Đơn đã xác nhận</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_contentx2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Đơn hàng đang ship</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_contentx3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Đơn hàng đã ship</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Bài đăng và món ăn</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <h3>Các đơn hàng mới</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
                          <th>SDT</th>
                          <th>Người nhận</th>
                          <th>Tiền ship</th>
                          <th>Ghi chú</th>
                          <th>Địa chỉ nhận</th>
                          <th>Thời gian nhận</th>
                          <th>Tổng tiền</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      @foreach($receipt_mois as $index => $receipt)
                      <tr class="w3-hover-green" style="line-height: 27px;">
                        <td>{{$receipt->phone_number}}</td>
                        <td>{{$receipt->nguoi_nhan}}</td>
                        <td>{{$receipt->toltal_ship}}đ</td>
                        <td>{{$receipt->ghi_chu}}</td>
                        <td>{{$receipt->receive_address}}</td>
                        <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                        <td>{{$receipt->toltal_money}}đ</td>
                        <td>
                          <a href="{{url('restaurant/xac_nhan_receipt/'.$receipt->id)}}" class="btn btn-success" style="font-size: 10px;"><i class="fa fa-edit m-right-xs" ></i>Xác nhận</a>
                          <a href="{{url('restaurant/delete_receipt/'.$receipt->id)}})" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a>  
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_contentx1" aria-labelledby="profile-tab">
                   <h3>Các đơn hàng đã xác nhận</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
                          <th>SDT</th>
                          <th>Người nhận</th>
                          <th>Tiền ship</th>
                          <th>Ghi chú</th>
                          <th>Địa chỉ nhận</th>
                          <th>Thời gian nhận</th>
                          <th>Tổng tiền</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      @foreach($receipt_xacs as $index => $receipt)
                      <tr class="w3-hover-green" style="line-height: 27px;">
                        <td>{{$receipt->phone_number}}</td>
                        <td>{{$receipt->nguoi_nhan}}</td>
                        <td>{{$receipt->toltal_ship}}đ</td>
                        <td>{{$receipt->ghi_chu}}</td>
                        <td>{{$receipt->receive_address}}</td>
                        <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                        <td>{{$receipt->toltal_money}}đ</td>
                        <td>
                          <a href="{{url('restaurant/view_receipt/'.$receipt->id)}}" class="btn btn-success" style="font-size: 10px;"><i class="fa fa-edit m-right-xs" ></i>Chọn người ship</a>
                         
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_contentx2" aria-labelledby="profile-tab">
                   <h3>Các đơn hàng đang ship</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
                          <th>SDT</th>
                          <th>Người nhận</th>
                          <th>Tiền ship</th>
                          <th>Ghi chú</th>
                          <th>Địa chỉ nhận</th>
                          <th>Thời gian nhận</th>
                          <th>Tổng tiền</th>
                          <th>Người ship</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      @foreach($receipt_ships as $index => $receipt)
                      <tr class="w3-hover-green" style="line-height: 27px;">
                        <td>{{$receipt->phone_number}}</td>
                        <td>{{$receipt->nguoi_nhan}}</td>
                        <td>{{$receipt->toltal_ship}}đ</td>
                        <td>{{$receipt->ghi_chu}}</td>
                        <td>{{$receipt->receive_address}}</td>
                        <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                        <td>{{$receipt->toltal_money}}đ</td>
                        <td><?php $shipper = DB::table('shippers')->where('id',$receipt->id_shipper)->get(); foreach ($shipper as $shipper) {} echo $shipper->name; ?></td>
                        <td>
                          <a href="{{url('restaurant/view_receipt_detail/'.$receipt->id)}}" class="glyphicon glyphicon-eye-open btn btn-info" style="font-size: 10px;"></a>
                          <a href="{{url('restaurant/receipt_da_ship/'.$receipt->id)}}" class="btn btn-success" style="font-size: 10px;"><i class="fa fa-edit m-right-xs" ></i>Đã ship</a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_contentx3" aria-labelledby="profile-tab">
                   <h3>Các đơn hàng đã ship</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
                          <th>SDT</th>
                          <th>Người nhận</th>
                          <th>Tiền ship</th>
                          <th>Ghi chú</th>
                          <th>Địa chỉ nhận</th>
                          <th>Thời gian nhận</th>
                          <th>Tổng tiền</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      @foreach($receipt_toans as $index => $receipt)
                      <tr class="w3-hover-green" style="line-height: 27px;">
                        <td>{{$receipt->phone_number}}</td>
                        <td>{{$receipt->nguoi_nhan}}</td>
                        <td>{{$receipt->toltal_ship}}đ</td>
                        <td>{{$receipt->ghi_chu}}</td>
                        <td>{{$receipt->receive_address}}</td>
                        <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                        <td>{{$receipt->toltal_money}}đ</td>
                        <td>
                          <a href="{{url('restaurant/view_receipt_detail/'.$receipt->id)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;"></a>
      
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <!-- start foods-->
                    <h2>Các món ăn</h2>
                      <table class="data table table-striped no-margin" style="margin-bottom: 0px !important;">
                      <thead>
                        <tr>
                          <th>Số lần đặt</th>
                          <th>Món ăn</th>
                          <th>Avatar</th>
                          <th class="hidden-phone">Giá</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $foodTrId = 100; ?>
                      @foreach ($foods as $index => $food)
                        <tr id="<?php echo $foodTrId; ?>">
                          <td>{{$food->ordered}}</td>
                          <td>{{$food->name}}</td>
                          <td>
                            <img class="avatar_manage_page" src="../post/food_img/<?php echo $food->avatar;?>" alt="{{$food->name}}">
                          </td>
                          <td class="hidden-phone">{{$food->price}} đ</td>
                          <td class="vertical-align-mid">
                            <a class="glyphicon glyphicon-pencil btn-warning btn" onclick="edit_food({{$food->id}});" data-toggle="modal" data-target="#myModal-foods-edit" ></a>
                            <a href="javascript:void(0)" class="glyphicon glyphicon-trash btn btn-danger" onclick="delete_food({{$food->id}},{{$foodTrId}});"></a>
                          </td>
                          <?php $foodTrId++; ?>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {!! $foods->render() !!}
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal-foods" style="float: right;margin-top: 20px;">Thêm món ăn</button>
                    <!-- end foods -->
                    <!-- start posts -->
                    <h2>Các bài đăng</h2>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>Lượt xem</th>
                          <th>Bài đăng</th>
                          <th>Avatar</th>
                          <th class="hidden-phone">Ngày sửa cuối</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach ($posts as $index => $post)
                        <tr id="{{$index+1}}">
                          <td>{{$post->seen}}</td>
                          <td><a href="{{url('post/view/'.$post->id)}}">{{$post->title}}</a></td>
                          <td>
                            <img class="avatar_manage_page" src="../post/avatar/{{$post->avatar}}" alt="{{$post->name}}">
                          </td>
                          <td class="hidden-phone">{{$post->updated_at}}</td>
                          <td class="vertical-align-mid">
                            <a class="glyphicon glyphicon-pencil btn-warning btn" onclick="edit_post({{$post->id}});" data-toggle="modal" data-target="#myModal-posts-edit" ></a>
                            <a href="javascript:void(0)" class="glyphicon glyphicon-trash btn btn-danger" onclick="delete_post({{$post->id}},{{$index+1}});"></a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {!! $posts->render() !!}
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal-posts" style="float: right;margin-top: 20px;">Thêm bài đăng</button>
                    <!-- end posts-->
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab" data-toggle="tab">
                    <?php 
                      foreach ($restaurant_info as $restaurant_info){}
                    ?>
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                        <form enctype="multipart/form-data">
                          <i class="fa fa-camera" aria-hidden="true" style="font-size: 40px;position: absolute;top: 20px;right: 20px;color: white;"></i>
                         <img id="change-avatar-img" onclick="document.getElementById('change-avatar').click();" class="img-responsive avatar-view" src="../avatar/{{Auth::user()->avatar}}" alt="Thay hình đại diện" />
                         <input style="display: none;" type="file" enctype="multipart/form-data"  id="change-avatar" name="change-avatar" accept="image/*" onchange="changeAvatar(this)"/>
                        </form>
                        </div>
                      </div>
                      <h3>{{{ isset($restaurant_info->restaurant_name) ? $restaurant_info->restaurant_name : 'Chưa cập nhật' }}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{{ isset($restaurant_info->address) ? $restaurant_info->address : 'Chưa cập nhật' }}}
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{{ isset($restaurant_info->phone_number) ? $restaurant_info->phone_number : 'Chưa cập nhật' }}}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="{{{ isset($restaurant_info->link_website) ? $restaurant_info->link_website : '#' }}}" target="_blank">{{{ isset($restaurant_info->link_website) ? $restaurant_info->link_website : 'Chưa cập nhật' }}}</a>
                        </li>
                      </ul>

                      <button class="btn btn-success" data-toggle="modal" data-target="#editRestaurant"><i class="fa fa-edit m-right-xs" ></i>Edit Profile</button>
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <p><?php if(isset($restaurant_info->introduction)){echo($restaurant_info->introduction);}else{echo '';} ?></p>
                    <div style="width: 100%; height: 370px;">
                      <div id="curent-position"></div>
                    </div>
                      
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- start Modal foods create-->
<div id="myModal-foods" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thêm món ăn</h4>
      </div>
      <div class="modal-body class="form-group"">
        
        <form id="add-food" action="{{url('restaurant/add_food')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div style="width: 100px;float: left; margin-left: 15px;">
           <img id="logo-img" onclick="document.getElementById('add-new-logo').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
           <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-logo" name="file" accept="image/*" onchange="addNewLogo(this,'#logo-img')"/>
          </div>
          <input type="text" name="food-name" style="width: 70%; margin-left: 130px; border-radius: 5px; " class="form-control" placeholder="Tên món ăn" required="">
          <br>
          <input type="text" name="material" style="width: 70%; margin-left: 130px;border-radius: 5px;" class="form-control" placeholder="Nguyên liệu chế biến" required="">
          </div>
          <div class="row" style="margin-top: 15px;">
            <div class="col-md-6">
              <input type="number" name="price" style="border-radius: 5px; margin-left: 5px;" class="form-control" placeholder="Giá" required="" pattern=".{3,11}" title="Chỉ được điền từ 3 đến 11 kí tự!">
            </div>
            <div class="col-md-6">
              <select class="form-control" id="sel1" style="border-radius: 5px; " name="food-type" required="">
                <option value="" disabled selected>Loại</option>
                <?php foreach ($food_types as $food_type) { ?>
                  <option value="{{$food_type->id}}">{{$food_type->name}}</option>
                <?php              
                }
                ?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
        <!-- <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="submitForm()">Thêm</button> -->
        <button type="submit" class="btn btn-success">Thêm</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- end modal foods create-->
<!-- start Modal posts create -->
<div id="myModal-posts" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thêm bài đăng</h4>
      </div>
      <div class="modal-body class="form-group"">
        
        <form id="add-post" action="{{url('restaurant/add_post')}}" method="post" enctype="multipart/form-data" onsubmit="return isValidForm(condition);">
        {{ csrf_field() }}
        <div class="row">
          <div style="width: 100px;float: left; margin-left: 15px;">
           <img id="post-avatar" onclick="document.getElementById('add-new-avatar').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
           <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-avatar" name="post-avatar" accept="image/*" onchange="addNewLogo(this,'#post-avatar')"/>
          </div>

          <input type="text" class="form-control" id="title" name="title" placeholder="Nhập vào tiêu đề bài viết" onkeyup="ChangeToSlug();" required="" style="width: 70%; margin-left: 130px; border-radius: 5px; ">
          <br>

          <input type="text" class="form-control" id="slug" name="slug" placeholder="Nhập vào đường dẫn hoặc giữ nguyên" onkeyup="CheckSlug('#slug','#thongbao');" style="width: 70%; margin-left: 130px;border-radius: 5px;" required="">

          <p id="thongbao" style="visibility:hidden; color: red;margin-left: 130px;">slug bị trùng bạn hãy nhập vào slug khác</p>
          </div>
          <div class="row">
            <textarea id="content" name="content"></textarea>
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
<!-- end modal posts create -->
<!-- start Modal edit posts -->
<div id="myModal-posts-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa bài đăng</h4>
      </div>
      <div class="modal-body class="form-group"">
        
        <form id="edit-post" action="" method="post" enctype="multipart/form-data" onsubmit="return isValidForm(condition);">
        {{ csrf_field() }}
        <div class="row">
          <div style="width: 100px;float: left; margin-left: 15px;">
           <img id="post-avatar-edit" onclick="document.getElementById('add-new-avatar-edit').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
           <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-avatar-edit" name="post-avatar-edit" accept="image/*" onchange="addNewLogo(this,'#post-avatar-edit')" value="" />
          </div>

          <input type="text" class="form-control" id="title-edit" name="title-edit" placeholder="Nhập vào tiêu đề bài viết" onkeyup="ChangeToSlugEdit();" required="" style="width: 70%; margin-left: 130px; border-radius: 5px; ">
          <br>

          <input type="text" class="form-control" id="slug-edit" name="slug-edit" placeholder="Nhập vào đường dẫn hoặc giữ nguyên" onkeyup="CheckSlug('#slug-edit','#thongbao-edit');" style="width: 70%; margin-left: 130px;border-radius: 5px;" required="">

          <p id="thongbao-edit" style="visibility:hidden; color: red;margin-left: 130px;">slug bị trùng bạn hãy nhập vào slug khác</p>
          </div>
          <div class="row">
            <textarea id="content-edit" name="content-edit"></textarea>
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
<!-- end modal edit posts -->

<!-- start Modal edit foods -->
<div id="myModal-foods-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa món ăn</h4>
      </div>
      <div class="modal-body class="form-group"">
        <form id="edit-food" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div style="width: 100px;float: left; margin-left: 15px;">
           <img id="food-avatar-edit" onclick="document.getElementById('add-new-avatar-food').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
           <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-avatar-food" name="file" accept="image/*" onchange="addNewLogo(this,'#food-avatar-edit')"/>
          </div>
          <input type="text" name="food-name-edit" id="food-name-edit" style="width: 70%; margin-left: 130px; border-radius: 5px; " class="form-control" placeholder="Tên món ăn" required="">
          <br>
          <input type="text" name="material-edit" id="material-edit" style="width: 70%; margin-left: 130px;border-radius: 5px;" class="form-control" placeholder="Nguyên liệu chế biến" required="">
          </div>
          <div class="row" style="margin-top: 15px;">
            <div class="col-md-6">
              <input type="number" name="price-edit" id="price-edit" style="border-radius: 5px; margin-left: 5px;" class="form-control" placeholder="Giá" required="" min="500" pattern=".{3,11}" title="Chỉ được điền từ 3 đến 11 kí tự!">
            </div>
            <div class="col-md-6">
              <select class="form-control" id="food-type-edit" style="border-radius: 5px; " name="food-type-edit" required="">
                <option value="" disabled selected>Loại</option>
                <?php foreach ($food_types as $food_type) { ?>
                  <option value="{{$food_type->id}}">{{$food_type->name}}</option>
                <?php              
                }
                ?>
              </select>
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
<!-- end modal edit foods -->
<!-- Modal -->
<div class="modal fade" id="editRestaurant" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa thông tin nhà hàng</h4>
      </div>
      <form action="{{url('restaurant/update_res_profile/'.$restaurant_info->id)}}" method="post" enctype="multipart/form-data">
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
              <input type="text" class="style-input form-control margin-bottom-15" placeholder="Địa chỉ website" name="link_website" value="{{{ isset($restaurant_info->link_website) ? $restaurant_info->link_website : '' }}}">
              <input type="text" class="style-input form-control margin-bottom-15" placeholder="Tên nhà hàng" name="restaurant_name" value="{{{ isset($restaurant_info->restaurant_name) ? $restaurant_info->restaurant_name : '' }}}">
            </div>
              
              <div id="ckeContainer" class="col-md-12">
              <textarea id="edit-restaurant-profile" class="margin-bottom-15" required="" name="introduction">{{{ isset($restaurant_info->introduction) ? $restaurant_info->introduction : '' }}}</textarea>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
          <input type="text" class="style-input form-control margin-bottom-15" placeholder="Số điện thoại liên hệ" name="phone_number" required="" value="{{{ isset($restaurant_info->phone_number) ? $restaurant_info->phone_number : '' }}}">
          <div style="width: 100%; height: 420px;">
          <input id="pac-input" class="controls" type="text" placeholder="Địa chỉ nhà hàng" name="address" required="" value="{{{ isset($restaurant_info->address) ? $restaurant_info->address : '' }}}">
            <div id="map"></div>
            <div id="infowindow-content">
          <span id="place-name"  class="title"></span>
          <span id="place-address"></span>
          <input type="text" name="lat" id="lat" hidden="" value="{{{ isset($restaurant_info->lat) ? $restaurant_info->lat : '' }}}">
          <input type="text" name="lng" id="lng" hidden="" value="{{{ isset($restaurant_info->lng) ? $restaurant_info->lng : '' }}}">
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
<script>
      var map, infoWindow, infowindow2, curentPositionMap, focusSearchMapInput=0;
      var maker_created = [];
      var marker;
      var curentPosition = document.getElementById('curent-position');
      var mapDiv = document.getElementById('map');
      var resInfo =<?php echo json_encode($restaurant_info, JSON_FORCE_OBJECT) ?>;
      if(resInfo.lat == 0 &&  resInfo.lng == 0){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        Map(curentPosition,21.0277644,105.83415979999995);
        });
      }else{
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        Map(curentPosition,resInfo.lat,resInfo.lng);
        });
      }
      $("#editRestaurant").on("shown.bs.modal", function () {
        if(resInfo.lat == 0 ||resInfo.lng == 0){
          initMap(21.0277644,105.83415979999995);
        }else{
          initMap(resInfo.lat,resInfo.lng);
        }
        finder();
      });

      
      document.getElementById('ckeContainer').style.margin="0px 0px 15px 0px";

function Map(mapDiv,lat,lng){
  var pos = {'lat': lat, 'lng': lng};
  curentPositionMap = new google.maps.Map(mapDiv, {
    center: pos,
    zoom: 18,
  });
  var marker = new google.maps.Marker({
    position: pos,
    map: curentPositionMap,
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
  marker.addListener('click', function(){
    infowindow.open(curentPositionMap,marker);
  });
}
function initMap(lat,lng){
  var pos = {'lat': lat, 'lng': lng};
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
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Lỗi: Máy chủ định vị bị lỗi.' :
    'Lỗi: Trình duyệt của bạn không hỗ trợ định vị.');
  infoWindow.open(map);
}
var condition;

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
function edit_food(id_food){

  $.ajax({
    url: '/umaimono/restaurant/edit_food/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food
        },
    success: function (response) {
      console.log(response.avatar);
      document.getElementById("food-avatar-edit").src = "../post/food_img/" + response.avatar;
      document.getElementById("food-name-edit").value = response.name;
      document.getElementById("material-edit").value = response.material;
      document.getElementById("price-edit").value = response.price;
      document.getElementById("food-type-edit").value = response.type;
      document.getElementById("edit-food").action = "update_food/" + response.id;
    },
    error: function(){
      alertify.error("Có lỗi xảy ra!");
    }
});
}
function delete_food(id_food,id_tr){
      reset();
      console.log(id_tr);
      alertify.confirm("Bạn có chắc chắn muốn xóa không?", function (e) {
        if (e) {
          $.ajax({
          url: '/umaimono/restaurant/delete_food/'+id_food,
          type: 'POST',
          data: {
              "_token": "{{ csrf_token() }}",
              "id": id_food,
              "id_tr": id_tr
              },
          success: function (response,data) {
            document.getElementById(id_tr).remove();
            alertify.success("Đã xóa thành công!");
            }
          });
          
        } else {
          alertify.error("Đã hủy xóa!");
        }
      });
      return false;
}
function isValidForm(condition){
  if(condition == 1){
    return false;
  }else{

    return true;
  }
}

function reset () {
  alertify.set({
    labels : {
      ok     : "OK",
      cancel : "Cancel"
    },
    delay : 5000,
    buttonReverse : false,
    buttonFocus   : "ok"
  });
}

function edit_post(id_post){

  $.ajax({
    url: '/umaimono/restaurant/edit_post/'+id_post,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_post
        },
    success: function (response) {
      console.log(response);
      document.getElementById("post-avatar-edit").src = "../post/avatar/" + response.avatar;
      document.getElementById("title-edit").value = response.title;
      document.getElementById("slug-edit").value = response.slug;
      document.getElementById("edit-post").action = "update_post/" + response.id;
      CKEDITOR.instances['content-edit'].setData(response.content);
    },
    error: function(){
      alertify.error("Có lỗi xảy ra!");
    }
});
}

function delete_post(id_post,id_tr){
      reset();
      console.log(id_tr);
      alertify.confirm("Bạn có chắc chắn muốn xóa không?", function (e) {
        if (e) {
          $.ajax({
          url: '/umaimono/restaurant/delete_post/'+id_post,
          type: 'POST',
          data: {
              "_token": "{{ csrf_token() }}",
              "id": id_post,
              "id_tr": id_tr
              },
          success: function (response,data) {
            document.getElementById(id_tr).remove();
            alertify.success("Đã xóa thành công!");
            }
          });
          
        } else {
          alertify.error("Đã hủy xóa!");
        }
      });
      return false;
}

var data =<?php echo json_encode($slugs, JSON_FORCE_OBJECT) ?>;
var size = Object.keys(data).length;
function ChangeToSlug()
{
    var title, slug, suggestSlug;
    var k = 1;
    //Lấy text từ thẻ input title 
    title = document.getElementById("title").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    for (i = 0; i < size; i++) { 
        if(slug == data[i]){
            document.getElementById("thongbao").style.visibility = 'visible';
            $('#slug').addClass('input-error');
            condition = 1;
            break;
        }else{
            document.getElementById("thongbao").style.visibility = 'hidden';
            $('#slug').removeClass('input-error');
            condition = 0;
        }
        
    }
    //In slug ra textbox có id “slug”
    document.getElementById('slug').value = slug;
}
function ChangeToSlugEdit()
{
    var title, slug, suggestSlug;
    var k = 1;
    //Lấy text từ thẻ input title 
    title = document.getElementById("title-edit").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    for (i = 0; i < size; i++) { 
        if(slug == data[i]){
            document.getElementById("thongbao-edit").style.visibility = 'visible';
            $('#slug-edit').addClass('input-error');
            condition = 1;
            break;
        }else{
            document.getElementById("thongbao-edit").style.visibility = 'hidden';
            $('#slug-edit').removeClass('input-error');
            condition = 0;
        }
        
    }
    //In slug ra textbox có id “slug”
    document.getElementById('slug-edit').value = slug;
}
function CheckSlug(slug, thongbao){
    var suggestSlug;
    slug = document.getElementById(slug).value;
    for (i = 0; i < size; i++) { 
        if(slug == data[i]){
            document.getElementById(thongbao).style.visibility = 'visible';
            $('#slug').addClass('input-error');
            condition = 1;
            break;
        }else{
            document.getElementById(thongbao).style.visibility = 'hidden';
            $('#slug').removeClass('input-error');
            condition = 0;
        }
        
    }
}
function CheckSlugEdit(){
    var suggestSlug;
    slug = document.getElementById("slug-edit").value;
    for (i = 0; i < size; i++) { 
        if(slug == data[i]){
            document.getElementById("thongbao-edit").style.visibility = 'visible';
            $('#slug-edit').addClass('input-error');
            condition = 1;
            break;
        }else{
            document.getElementById("thongbao-edit").style.visibility = 'hidden';
            $('#slug-edit').removeClass('input-error');
            condition = 0;
        }
        
    }
}
CKEDITOR.replace( 'content',{
    filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl      : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});

CKEDITOR.replace( 'content-edit',{
    filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl      : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
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