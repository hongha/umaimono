@extends('layouts.adminTemplate')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
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
            <h2>User Report <small>Activity report</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">   
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Quản lý người dùng</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Quản lý hoạt động</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Thông tin cá nhân</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <!-- start recent activity -->
                    <div class="page-title">
                      <div class="title_left">
                        <h3>Admins</h3>
                      </div>
                      <div class="title_right" style="background: gray;">
                        <div class="col-md-8 col-sm-8 col-xs-12 form-group pull-right top_search">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập vào email hoặc tên đăng nhập...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"!>Tìm kiếm!</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Create at</th>
                          <th>Avatar</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($admins as $admin){
                          ?>
                            <tr>
                              <td><span class="line-height"><?php echo $index++; ?></span></td>
                              <td><span class="line-height">{{$admin->name}}</span></td>
                              <td><span class="line-height">{{$admin->email}}</span></td>
                              <td><span class="line-height">{{$admin->created_at}}</span></td>
                              <td class="vertical-align-mid">
                                <img class="avatar_manage_page" src="../avatar/<?php echo $admin->avatar;?>" alt="{{$admin->name}}">
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    {!! $admins->render() !!}
                    <h3>Managers</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên đăng nhập</th>
                          <th>Email</th>
                          <th class="hidden-phone">Ảnh đại diện</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($managers as $manager){
                          ?>
                            <tr>
                              
                              <td><span class="line-height"><?php echo $index++; ?></span></td>
                              <td><span class="line-height">{{$manager->name}}</span></td>
                              <td><span class="line-height">{{$manager->email}}</span></td>
                              <td><img class="avatar_manage_page" src="../avatar/{{$manager->avatar}}"></td>
                              <td class="vertical-align-mid">
                                <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$manager->id}},this,'/umaimono/admin/delete_user/');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    {!! $managers->render() !!}
                    <h3>Restaurants</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên đăng nhập</th>
                          <th>Email</th>
                          <th class="hidden-phone">Ảnh đại diện</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($restaurants as $restaurant){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$restaurant->name}}</td>
                              <td>{{$restaurant->email}}</td>
                              <td class="hidden-phone"><img class="avatar_manage_page" src="../avatar/{{$restaurant->avatar}}"></td>
                              <td class="vertical-align-mid">
                                <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$restaurant->id}},this,'/umaimono/admin/delete_user/');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                      {!! $restaurants->render() !!}
                    </table>
                    <h3>Shipper</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên đăng nhập</th>
                          <th>Email</th>
                          <th class="hidden-phone">Ảnh đại diện</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($shippers as $shipper){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$shipper->name}}</td>
                              <td>{{$shipper->email}}</td>
                              <td class="hidden-phone">
                                <img class="avatar_manage_page" src="../avatar/{{$shipper->avatar}}">
                              </td>
                              <td class="vertical-align-mid">
                                <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$shipper->id}},this,'/umaimono/admin/delete_user/');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    {!! $shippers->render() !!}
                    <h3>Shopper</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên đăng nhập</th>
                          <th>Email</th>
                          <th class="hidden-phone">Ảnh đại diện</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($shoppers as $shopper){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$shopper->name}}</td>
                              <td>{{$shopper->email}}</td>
                              <td class="hidden-phone">
                              <img class="avatar_manage_page" src="../avatar/{{$shopper->avatar}}">
                              </td>
                              <td class="vertical-align-mid">
                              <!-- <a href="{{url('admin/level_up/'.$shopper->id)}}" class=" btn btn-primary"> -->
                              <a href="javascript:void(0)" class="btn btn-primary" onclick="update_element({{$shopper->id}},this,'/umaimono/admin/level_up/');"><i class="fa fa-level-up" aria-hidden="true"></i></a>
                              <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$shopper->id}},this,'/umaimono/admin/delete_user/');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    {!! $shoppers->render() !!}
                    
                    <!-- end recent activity -->

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <h3>Bài viết giới thiệu món ăn</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tiêu đề</th>
                          <th>Ảnh đại diện</th>
                          <th class="hidden-phone">Lượt xem</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($posts as $index => $post)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td><a href="{{url('post/view/'.$post->id)}}">{{$post->title}}</a></td>
                          <td><img class="avatar_manage_page" src="../post/avatar/{{$post->avatar}}" alt="{{$post->title}}"></td>
                          <td class="hidden-phone">{{$post->seen}}</td>
                          <td class="vertical-align-mid">
                            <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$post->id}},this,'/umaimono/admin/lock_post/');">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {!! $posts->render() !!}

                    <h3>Các món ăn</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tiêu đề</th>
                          <th>Ảnh đại diện</th>
                          <th class="hidden-phone">Lượt đặt</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($foods as $index => $food)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td><a href="{{url('food/view/'.$post->id)}}">{{$food->name}}</a></td>
                          <td><img class="avatar_manage_page" src="../post/food_img/{{$food->avatar}}" alt="{{$post->title}}"></td>
                          <td class="hidden-phone">{{$food->ordered}}</td>
                          <td class="vertical-align-mid">
                            <a href="javascript:void(0)" class=" btn btn-danger" onclick="update_element({{$food->id}},this,'/umaimono/admin/lock_food/');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {!! $foods->render() !!}
                    <!-- end user projects -->

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                      photo booth letterpress, commodo enim craft beer mlkshk </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
function update_element(id,a_tag,url){
      reset();
      console.log(a_tag.parentNode.parentNode);
      alertify.confirm("Bạn chắc chắn muốn cập nhật?", function (e) {
        if (e) {
          $.ajax({
          url: url+id,
          type: 'POST',
          data: {
              "_token": "{{ csrf_token() }}",
              "id": id
              },
          success: function () {
            a_tag.parentNode.parentNode.remove();
            alertify.success("Đã cập nhật thành công!");
            },
          error: function(){
            alertify.error("Lỗi!");
          }
          });
          
        } else {
          alertify.error("Đã hủy cập nhật!");
        }
      });
      return false;
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

</script>
@stop