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
  <div class="w3-row-padding">
  <h3>Các đơn hàng đã đặt</h3>
  <table class="w3-table-all">
    <thead>
      <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
        <th>STT</th>
        <th>Địa chỉ nhận</th>
        <th>Thời gian nhận</th>
        <th>Trạng thái</th>
        <th>Tổng tiền</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    @foreach($receipts as $index => $receipt)
    <tr class="w3-hover-green" style="line-height: 27px;">
      <td>{{$index+1}}</td>
      <td>{{$receipt->receive_address}}</td>
      <td>{{$receipt->receive_hour}} {{$receipt->receive_day}}</td>
      <td><?php if($receipt->shipping == 0){echo "Chưa giao hàng";}else{ echo "Đang giao hàng";}?></td>
      <td>{{$receipt->toltal_money}}đ</td>
      <td>
        <a href="{{url('shopper/view_receipt/'.$receipt->id)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;"></a>
        @if($receipt->shipping == 0)
        <a href="javascript:void(0)" onclick="edit_order({{$receipt->id}})" class="glyphicon glyphicon-pencil btn-warning btn" style="font-size: 10px;" data-toggle="modal" data-target="#modal-edit-receipt" ></a>
        <a href="javascript:void(0)" onclick="delete_receipt({{$receipt->id}},this)" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a> 
        @endif    
      </td>
    </tr>
    @endforeach
  </table>
  {!! $receipts->render() !!}
  <h3>Các đơn hàng đã thanh toán</h3>
  <table class="w3-table-all">
    <thead>
      <tr class="w3-light-grey w3-hover-red" style="line-height: 27px;">
        <th>STT</th>
        <th>Địa chỉ nhận</th>
        <th>Thời gian nhận</th>
        <th>Trạng thái</th>
        <th>Tổng tiền</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    @foreach($old_receipts as $index => $old_receipt)
    <tr class="w3-hover-green" style="line-height: 27px;">
      <td>{{$index+1}}</td>
      <td>{{$old_receipt->receive_address}}</td>
      <td>{{$old_receipt->receive_hour}} {{$old_receipt->receive_day}}</td>
      <td>Đã giao hàng</td>
      <td>{{$old_receipt->toltal_money}}đ</td>
      <td>
        <a href="{{url('shopper/view_receipt/'.$old_receipt->id)}}" class="glyphicon glyphicon-eye-open btn btn-success" style="font-size: 10px;"></a>
        <a href="javascript:void(0)" onclick="delete_receipt({{$old_receipt->id}},this)" class="glyphicon glyphicon-trash btn btn-danger" style="font-size: 10px;"></a>  
      </td>
    </tr>
    @endforeach
  </table>
  {!! $old_receipts->render() !!}
  </div>
  <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>

  <div id="modal-edit-receipt" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bạn muốn?</h4>
      </div>
      <div class="modal-body class="form-group"">
        <form action="{{url('shopper/edit_order')}}" method="post">
        {{ csrf_field() }}
        <center>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-info active">
              <input type="radio" autocomplete="off" name="options" id="option1" checked value="0">
              <span class="glyphicon glyphicon-ok"></span>
              Thay đổi thông tin sản phẩm
            </label>
            <label class="btn btn-info">
              <input type="radio" autocomplete="off" name="options" id="option2" value="1">
              <span class="glyphicon glyphicon-ok"></span>
              Thay đổi thông tin đặt hàng
            </label> 
          </div>
          <input type="number" name="id_receipt" id="id_receipt" hidden="" value="">
        </center>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-success">Đồng ý</button>
      </div>
      </form>
    </div>

  </div>
</div>
  <script>
    function edit_order(id_receipt) {
      document.getElementById("id_receipt").value = id_receipt;  
    }
    function delete_receipt(id_receipt,a_tag) {
      alertify.confirm("Bạn chắc chắn muốn xóa?", function (e) {
      if (e) {
      $.ajax({
        url: '/umaimono/shopper/delete_receipt/'+id_receipt,
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
  </script>
@stop