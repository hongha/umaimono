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
<?php use App\Receipt; ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <a href="{{url('restaurant/index')}}"><h3>Restaurant Manage</h3></a>
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
          <h3>Chi tiết đơn hàng</h3>
            <table class="data table table-striped no-margin">
              <thead>
                <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
                  <th>STT</th>
                  <th>Tên món ăn</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Ghi chú</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              @foreach($orders as $index => $order)
              <tr class="w3-hover-green" style="line-height: 27px;" id="{{$index}}">
                <td>{{$index+1}}</td>
                <td>{{$order->food_name}}</td>
                <td>{{$order->price}}đ</td>
                <td>{{$order->number}}</td>
                <td id="{{$order->id}}">{{$order->ghi_chu}}</td>
                <td>
                  <a href="{{url('post/view_food/'.$order->id_food)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;"></a>
                </td>
              </tr>
              @endforeach
            </table>
              <table class="data table table-striped no-margin">
              <tr class="" style="line-height: 27px;">
                <td><b>Địa chỉ nhận</b></td>
                <td style="color: red;">{{$receipt->receive_address}}</td>
                <td><b>Số điện thoại</b></td>
                <td style="color: red;">{{$receipt->phone_number}}</td>
                <td><b>Người nhận</b></td>
                <td style="color: red;">{{$receipt->nguoi_nhan}}</td>
              </tr>
              <tr class="" style="line-height: 27px;">
                <td><b>Tổng tiền(cả ship)</b></td>
                <td style="color: red;">{{$receipt->toltal_money}}đ</td>
                <td><b>Tiền ship</b></td>
                <td style="color: red;">{{$receipt->toltal_ship}}đ</td>
                <td><b>Thanh toán</b></td>
                <td style="color: red;"><?php if($receipt->thanh_toan == 1){echo "Đã thanh toán";}else{echo "Chưa thanh toán";}?></td>
              </tr>
              <tr class="" style="line-height: 27px;">
                <td><b>Thời gian nhận</b></td>
                <td style="color: red;">{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                <td><b>Ghi chú</b></td>
                <td style="color: red;">{{$receipt->ghi_chu}}</td>
                <td><b>Trạng thái</b></td>
                <td style="color: red;"><?php if($receipt->shipping == 0){echo "Chưa ship hàng";}elseif($receipt->shipping == 1){echo "Đang ship hàng";}else{echo "Đã ship hàng";}?></td>
              </tr>
              <tr class="" style="line-height: 27px;">
                <td><b>Cập nhật gần nhất</b></td>
                <td style="color: red;">{{$receipt->updated_at}}</td>
                <td><b>Xác nhận</b></td>
                <td style="color: red;"><?php if($receipt->xac_nhan == 0){echo "Chưa xác nhận";}else{echo "Đã xác nhận";}?></td>
                <td></td>
                <td></td>
              </tr>
            </table>   
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
@stop