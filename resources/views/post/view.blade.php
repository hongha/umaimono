<!DOCTYPE html>
<html>
<title>User Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" />
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <ul class="w3-navbar w3-theme-d2 w3-left-align w3-large">
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  </li>
  <li><a href="#" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a></li>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="#" class="w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></a>     
    <div class="w3-dropdown-content w3-white w3-card-4">
      <a href="#">One new friend request</a>
      <a href="#">John Doe posted on your wall</a>
      <a href="#">Jane likes your post</a>
    </div>
  </li>
  <li class="w3-hide-small w3-right">
  <?php 
    if(isset(Auth::user()->name)){?>
    <a href="{{url('logout')}}" class="w3-padding-large" title="My Account"><img src="{{ URL::asset('public/img/avatar.png') }}" class="w3-circle" style="height:25px;width:25px" alt="Avatar"><span style="color: white;">
    <?php
      echo Auth::user()->name;
      echo '(Logout)';
      ?>
      </span>
    </a>
    <?php
    }else{ ?>
      <a href="{{url('login')}}">Login</a>&nbsp;<a href="{{url('register')}}">Register</a>
    <?php
    }
  ?>
  </li>
 </ul>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-theme">
    <li><a class="w3-padding-large" href="#" style="color: white;">Link 1</a></li>
    <li><a class="w3-padding-large" href="#" style="color: white !important;">Link 2</a></li>
    <li><a class="w3-padding-large" href="#" style="color: white !important;">Link 3</a></li>
    <li><a class="w3-padding-large" href="#" style="color: white !important;">My Profile</a></li>
  </ul>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m2">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="{{ URL::asset('public/img/avatar.png') }}" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card-2 w3-round">
        <div class="w3-accordion w3-white">
          <button onclick="myFunction('Demo1')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-accordion-content w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-accordion-content w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-btn-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-accordion-content w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/nature.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/forest.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/nature.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Interests</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
          </p>
        </div>
      </div>
      <br>
      
      <!-- Alert Box -->
      <div class="w3-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-hover-text-grey w3-closebtn">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
      
      <div class="w3-container w3-card-2 w3-white w3-round margin-left-right-16"><br>
        <img src="../../avatar/{{$user->avatar}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">1 min</span>
        <h4>{{Auth::user()->name}}</h4><br>
        <div class="w3-row-padding" style="margin:0 -16px">
          <div class="w3-half">
            <img src="../../avatar/{{$post->avatar}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
          </div>
          <?php echo $post->content; ?>
        <a href="{{url('google/buy/'.$post->id)}}"><button onclick="add_food()">dat hang</button></a>
        
        
        </div>
        <button type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <img src="{{ URL::asset('public/img/avatar.png') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">16 min</span>
        <h4>Jane Doe</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>  

      <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <img src="{{ URL::asset('public/img/avatar.png') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">32 min</span>
        <h4>Angie Jane</h4><br>
        <hr class="w3-clear">
        <p>Have you seen this?</p>
        <img src="{{ URL::asset('public/img/lights.jpg') }}" style="width:100%" class="w3-margin-bottom">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-btn w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div> 
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m3">
      <div class="w3-card-2 w3-round w3-white w3-center" id="menu-column">
        <div class="w3-container padding-none text-align-left">
          <div class="row-bill font12">
            <a href="javascript:void(0)" class="cart-stats">
            <span class="float-left bold700" id="number_total">{{$number_total}}&nbsp;</span>
            <span class="float-left">Phần</span>
            </a>
            <a href="javascript:void(0)" class="btn-reset" onclick="reset_menu({{Auth::user()->id}})">Reset</a>
          </div>
          <?php foreach ($shopping_carts as $shopping_cart) {?>
            <div class="row-bill reset_menu" id="{{$shopping_cart->id}}">
              <a href="javascript:void(0)" onclick="add_food({{$shopping_cart->id}})"><span class="fa fa-plus-square txt-green"></span></a>
              <span class="txt-red bold700 font12" style="display: inline-block; min-width: 18px; text-align: center;" >{{$shopping_cart->number}}</span>
              <span class="fa fa-minus-square" onclick="minus_food({{$shopping_cart->id}})"></span>
              <span class="bold700 font13">{{$shopping_cart->food_name}}</span>
              <div class="clearfix" style="margin-top: 2px;">
                <input type="text" width="200" placeholder="Ghi chú" class="pull-left" max="255" maxlength="255">
                <span class="bold700 font12" style="float: right;">{{$shopping_cart->price*$shopping_cart->number}}đ</span>
              </div>
            </div>
          <?php }?>
          
          <div class="row-bill-grey">
            <span class="float-left">Cộng</span>
            <span class="bold700 font13 float-right" id="money_total">{{$price_total}}đ</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left">Phí vận chuyển</span>
            <span class="font14 float-right">7,000đ/km</span>
          </div>
          <div class="row-bill-grey">
            <span class="float-left font16 bold700">Tạm tính</span>
            <span class="font16 float-right bold700 txt-blue" id="money_Temporarily">{{$price_total}}đ</span>
          </div>
          <a href="javascript:void(0)" class="btn-book-first">
          <i class="fa fa-check-circle"></i>
          Đặt trước</a>
        </div>
      </div>
    </div>
    <!-- End Right Column -->   
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

function add_food(id_food){

  $.ajax({
    url: '/umaimono/post/add_food/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food
        },
    success: function (data) {
        var div = document.getElementById(id_food);
        var spans = div.getElementsByTagName("span");
        var number_food = parseInt(spans[1].innerHTML,10);
        var prices = parseInt(spans[4].innerHTML,10);
        var price_one_food = prices/number_food;
        var money_total = document.getElementById("money_total");
        var money_Temporarily = document.getElementById("money_Temporarily");
        var number_total = document.getElementById("number_total");
        number_total.innerHTML = parseInt(number_total.innerHTML,10) + 1 + '&nbsp;';
        money_total.innerHTML = parseInt(money_total.innerHTML,10) + price_one_food + 'đ';
        money_Temporarily.innerHTML = parseInt(money_total.innerHTML,10) + 'đ';
        spans[1].innerHTML = number_food + 1;
        spans[4].innerHTML = prices + price_one_food + 'đ';
    }
});
}
function minus_food(id_food){

  $.ajax({
    url: '/umaimono/post/minus_food/'+id_food,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_food
        },
    success: function (data) {
        var div = document.getElementById(id_food);
        var spans = div.getElementsByTagName("span");
        var number_food = parseInt(spans[1].innerHTML,10);
        var prices = parseInt(spans[4].innerHTML,10);
        var price_one_food = prices/number_food;
        var money_total = document.getElementById("money_total");
        var money_Temporarily = document.getElementById("money_Temporarily");
        var number_total = document.getElementById("number_total");
        number_total.innerHTML = parseInt(number_total.innerHTML,10) - 1 + '&nbsp;';
        money_total.innerHTML = parseInt(money_total.innerHTML,10) - price_one_food;
        money_Temporarily.innerHTML = parseInt(money_total.innerHTML,10);
        spans[1].innerHTML = number_food - 1;
        spans[4].innerHTML = prices - price_one_food;
        if(number_food <= 1){
          document.getElementById(id_food).remove();
        }
    }
});
}
function reset_menu(id_user){

  $.ajax({
    url: '/umaimono/post/reset_menu/'+id_user,
    type: 'POST',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id_user
        },
     success: function (data) {
      $('.reset_menu').remove();
      var money_total = document.getElementById("money_total");
      var money_Temporarily = document.getElementById("money_Temporarily");
      var number_total = document.getElementById("number_total");
      number_total.innerHTML = 0 + '&nbsp;';
      money_total.innerHTML = 0;
      money_Temporarily.innerHTML = 0;
    }
});
}
</script>
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/js/angular.min.js') }}"></script>
</body>
</html> 

