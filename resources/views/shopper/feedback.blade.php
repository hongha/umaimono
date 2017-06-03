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
  <!-- Contact Section -->
  <div class="w3-container w3-padding-large" style="background-color: #607d8b;">
    <h4 id="contact" style="color: white;"><b>Gửi phản hồi</b></h4>
    <hr class="w3-opacity">
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label style="color: white;">Họ và tên</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label style="color: white;">Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label style="color: white;">Phản hồi</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Gửi phản hồi</button>
    </form>
  </div>

  
@stop