<!DOCTYPE html>
<html>
<title>
@section('title')
  Umaimono
@show
</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ URL::asset('public/css/w3.css') }}">
<!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'> -->
<link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" />
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/alertify.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('public/css/notification/alertify.core.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/notification/alertify.default.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/footer-distributed-with-address-and-phones.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/jquery-ui.css') }}">
<script src="{{ URL::asset('public/js/jquery-ui.js') }}"></script>
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
@yield('content')
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
    <footer class="footer-distributed">

      <div class="footer-left">

        <a href="index.html"><img src="{{ URL::asset('public/img/logo.gif') }}" alt="">
        </a>

        <p class="footer-links">
          <a href="#">Home</a>
          ·
          <a href="#">Blog</a>
          ·
          <a href="#">Pricing</a>
          ·
          <a href="#">About</a>
          ·
          <a href="#">Faq</a>
          ·
          <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Company Name &copy; 2015</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>21 Revolution Street</span> Paris, France</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+1 555 123456</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:support@company.com">support@company.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>About the company</span>
          Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
        </p>

        <div class="footer-icons">

          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-github"></i></a>

        </div>

      </div>

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
</script>

</body>
</html> 

