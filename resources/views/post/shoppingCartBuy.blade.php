<?php use App\RestaurantProfile; ?>
<div class="w3-container padding-none text-align-left">
  <div class="row-bill font12">
    <a href="javascript:void(0)" class="cart-stats">
    <span class="float-left bold700" id="number_total">{{$number_total}}&nbsp;</span>
    <span class="float-left">Phần</span>
    </a>
    <a href="javascript:void(0)" class="btn-reset" onclick="reset_menu()">Reset</a>
  </div>
  <?php if($shopping_carts != null){foreach ($shopping_carts as $shopping_cart) {?>
    <div class="row-bill reset_menu" id="{{$shopping_cart->id}}">
      <a href="javascript:void(0)" onclick="add_food({{$shopping_cart->id}})"><span class="fa fa-plus-square txt-green"></span></a>
      <span class="txt-red bold700 font12" style="display: inline-block; min-width: 18px; text-align: center;" >{{$shopping_cart->number}}</span>
      <span class="fa fa-minus-square" onclick="minus_food_buy({{$shopping_cart->id}})"></span>
      <span class="bold700 font13">{{$shopping_cart->food_name}}</span>
      <div class="clearfix" style="margin-top: 2px;">
        <input type="text" width="200" placeholder="Ghi chú" class="pull-left" max="255" maxlength="255">
        <span class="bold700 font12" style="float: right;">{{$shopping_cart->price*$shopping_cart->number}}đ</span>
      </div>
      <a href=""><span style="font-size: 12px;"><?php $restaurant = RestaurantProfile::where('id_restaurant',$shopping_cart->id_restaurant)->get(); echo $restaurant[0]->restaurant_name; ?></span></a>
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
  <a href="javascript:void(0)" class="btn-book-first after-lick" onclick="checkout({{$id}})">
  <i class="fa fa-check-circle"></i>
  Đặt trước</a>
  <div id="position" hidden="">
    <?php foreach ($arr_restau as $res) {?>
    <span><?php echo $res[0]->lat; ?></span>
    <span><?php echo $res[0]->lng; ?></span>
    <span><?php echo $res[0]->restaurant_name; ?></span>
    <span><?php echo $res[0]->address; ?></span>
    <span><?php echo $res[0]->link_website; ?></span>
    <span><?php echo $res[0]->phone_number; ?></span>
    <?php }  ?>
  </div>
</div>