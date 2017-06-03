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
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <a href="{{url('shipper/index')}}"><h3>Shipper Manage</h3></a>
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
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Đơn hàng được giao</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Đơn hàng đã ship</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <h3>Các đơn được giao</h3>
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
                  @foreach($receipt_dangs as $index => $receipt)
                  <tr class="w3-hover-green" style="line-height: 27px;">
                    <td>{{$receipt->phone_number}}</td>
                    <td>{{$receipt->nguoi_nhan}}</td>
                    <td>{{$receipt->toltal_ship}}đ</td>
                    <td>{{$receipt->ghi_chu}}</td>
                    <td>{{$receipt->receive_address}}</td>
                    <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                    <td>{{$receipt->toltal_money}}đ</td>
                    <td>
                      <a href="{{url('shipper/view_receipt_detail/'.$receipt->id)}}" class="btn btn-info" style="font-size: 10px;"><i class="fa fa-edit m-right-xs" ></i>Xem chi tiết</a> 
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
              <h3>Đơn hàng đã ship</h3>
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
                  @foreach($receipt_das as $index => $receipt)
                  <tr class="w3-hover-green" style="line-height: 27px;">
                    <td>{{$receipt->phone_number}}</td>
                    <td>{{$receipt->nguoi_nhan}}</td>
                    <td>{{$receipt->toltal_ship}}đ</td>
                    <td>{{$receipt->ghi_chu}}</td>
                    <td>{{$receipt->receive_address}}</td>
                    <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
                    <td>{{$receipt->toltal_money}}đ</td>
                    <td>
                      <a href="{{url('shipper/view_receipt_detail/'.$receipt->id)}}" class="btn btn-info" style="font-size: 10px;"><i class="fa fa-edit m-right-xs" ></i>Xem chi tiết</a> 
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
@stop