@extends('layouts.userProfile') 
@section('content')
<?php use App\RestaurantProfile; ?>
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
</style>
  <div class="w3-row-padding" style="margin-bottom: 100px;">
  <h3>Các các món đã đặt</h3>
  <table class="w3-table-all">
    <thead>
      <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
        <th>STT</th>
        <th>Tên món ăn</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Ghi chú</th>
        <th>Nhà hàng</th>
      </tr>
    </thead>
    @foreach($orders as $index => $order)
    <tr class="w3-hover-green" style="line-height: 27px;">
      <td>{{$index+1}}</td>
      <td>{{$order->food_name}}</td>
      <td>{{$order->price}}đ</td>
      <td>{{$order->number}}</td>
      <td>{{$order->ghi_chu}}</td>
      <td><?php $res = RestaurantProfile::where('id_restaurant',$order->id_restaurant)->get(); echo $res[0]->restaurant_name;?></td>
    </tr>
    @endforeach
  </table>
  {!! $orders->render() !!}
  <br>
  <table class="my-tbl">
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
      
    </tr>
  </table>
  </div>
  
  <!-- Contact Section -->
  <div class="w3-container w3-padding-large w3-grey">
    <h4 id="contact"><b>Contact Me</b></h4>
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p>email@email.com</p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p>Chicago, US</p>
      </div>
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p>512312311</p>
      </div>
    </div>
    <hr class="w3-opacity">
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Send Message</button>
    </form>
  </div>
@stop