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
.input-group-addon.primary {
    color: rgb(255, 255, 255);
    background-color: rgb(50, 118, 177);
    border-color: rgb(40, 94, 142);
}
</style>
<table class="w3-table-all">
    <thead>
      <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
        <th>STT</th>
        <th>Tên món ăn</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Ghi chú</th>
        <th>Nhà hàng</th>
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
      <td><?php $res = RestaurantProfile::where('id_restaurant',$order->id_restaurant)->get();?><a href="{{$res[0]->link_website}}"><?php echo $res[0]->restaurant_name;?></a></td>
      <td>
        <a href="{{url('post/view_food/'.$order->id_food)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;"></a>
        <a href="javascript:void(0)" onclick="edit_order({{$order->id}},{{$index}},{{$order->id_receipt}});" class="glyphicon glyphicon-pencil btn-warning btn" style="font-size: 10px;" data-toggle="modal" data-target="#modal-edit-food" ></a>
        <a href="javascript:void(0)" onclick="delete_order({{$order->id}},this)" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a>
      </td>
    </tr>
    @endforeach
  </table>
  <br>
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
function delete_order(id_order,a_tag) {
      alertify.confirm("Bạn chắc chắn muốn xóa?", function (e) {
      if (e) {
      $.ajax({
        url: '/umaimono/shopper/delete_order/'+id_order,
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            },
         success: function (response) {
          var tr = a_tag.parentNode.parentNode;
          tr.remove();
          alertify.success("Đã xóa thành công!");
        },
        error: function(){
          alertify.error("Có lỗi xảy ra!");
        }
      });
    }
  });
}  

function edit_order(id_order,tr_id,id_receipt) {
  document.getElementById("id_order").value = id_order;
  document.getElementById("id_receipt").value = id_receipt;
  var tr = document.getElementById(tr_id);
  var tds = tr.getElementsByTagName("td");
  document.getElementById("number").value = tds[3].innerHTML;
  // var ghi_chu = document.getElementById(id_order).innerHTML;
  document.getElementById("ghi_chu").value = tds[4].innerHTML;    
}

function submitForm(){
	var form = $("#edit_order_food").serialize();
	$('#modal-edit-food').modal('hide');
	$.ajax({
  	url: 'http://localhost/umaimono/shopper/edit_order_food',
  	type: 'POST',
  	data: form,
  	success: function (response) {
  		var tdGhiChu = document.getElementById(response.id);
  		var tr = tdGhiChu.parentNode;
  		var tds = tr.getElementsByTagName("td");
  		console.log(tdGhiChu);
  		console.log(tds[3]);
  		tds[3].innerHTML = response.number;
  		tdGhiChu.innerHTML = response.ghi_chu;
    	alertify.success("Đã cập nhật thành công!");
    },
  	error: function(){
	    alertify.error("Lỗi!");
	  	}
  	});
  // });
} 
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alertify.error("Xin lỗi! Bạn phải chọn số lớn hơn 0!");
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alertify.error("Xin lỗi! Bạn phải chọn số nhỏ hơn 101!");
        $(this).val($(this).data('oldValue'));
    }  
});
   
</script>
@stop
