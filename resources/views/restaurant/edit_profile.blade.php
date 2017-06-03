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
            <form action="{{url('restaurant/update_res_profile/'.$restaurant_i->id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="col-md-12">
              <div class="col-md-6 col-xs-12 col-sm-12">
              <div class="row">
                  <div class="col-md-3 col-xs-12 col-sm-12">
                    <img id="change-avatar-img" onclick="document.getElementById('change-avatar').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="../avatar/{{Auth::user()->avatar}}"/>
                    <input style="" type="file" enctype="multipart/form-data"  id="change-avatar" name="change-avatar" accept="image/*" onchange="addNewLogo(this,'#change-avatar-img')"/>
                  </div>
                  <div class="col-md-9 col-xs-12 col-sm-12">
                    <input type="text" class="style-input form-control margin-bottom-15" placeholder="Địa chỉ website" name="link_website" value="{{{ isset($restaurant_i->link_website) ? $restaurant_i->link_website : '' }}}">
                    <input type="text" class="style-input form-control margin-bottom-15" placeholder="Tên nhà hàng" name="restaurant_name" value="{{{ isset($restaurant_i->restaurant_name) ? $restaurant_i->restaurant_name : '' }}}">
                  </div>
                    
                    <div id="ckeContainer" class="col-md-12">
                    <textarea id="edit-restaurant-profile" class="margin-bottom-15" required="" name="introduction">{{{ isset($restaurant_i->introduction) ? $restaurant_i->introduction : '' }}}</textarea>
                  </div>
              </div>
              </div>
              <div class="col-md-6 col-xs-12 col-sm-12">
                <input type="text" class="style-input form-control margin-bottom-15" placeholder="Số điện thoại liên hệ" name="phone_number" required="" value="{{{ isset($restaurant_i->phone_number) ? $restaurant_i->phone_number : '' }}}">
                <div style="width: 100%; height: 420px;">
                <input id="pac-input" class="controls" type="text" placeholder="Địa chỉ nhà hàng" name="address" required="" value="{{{ isset($restaurant_i->address) ? $restaurant_i->address : '' }}}">
                  <div id="map"></div>
                  <div id="infowindow-content">
                <span id="place-name"  class="title"></span>
                <span id="place-address"></span>
                <input type="text" name="lat" id="lat" hidden="" value="{{{ isset($restaurant_i->lat) ? $restaurant_i->lat : '' }}}">
                <input type="text" name="lng" id="lng" hidden="" value="{{{ isset($restaurant_i->lng) ? $restaurant_i->lng : '' }}}">
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
    </div>
  </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMOaA3Yy3TAZgJwoyjuO7YiVbVa5Ye0Hc&callback=initMap&libraries=places"
    async defer>
</script>
@stop