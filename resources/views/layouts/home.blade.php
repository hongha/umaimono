<!DOCTYPE html>
<html>
<title>
@section('title')
  Umaimono
@show</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ URL::asset('public/css/w3.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/comment.css') }}">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" />
<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
<script src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" />
<script type="text/javascript" src="{{ URL::asset('public/js/alertify.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jssor.slider.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('public/css/notification/alertify.core.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/notification/alertify.default.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/css/footer-distributed-with-address-and-phones.css') }}">
<script src="{{ URL::asset('public/js/docs.min.js') }}"></script>
<script src="{{ URL::asset('public/js/workaround.min.js') }}"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ URL::asset('public/css/jquery-ui.css') }}">
<script src="{{ URL::asset('public/js/jquery-ui.js') }}"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">
<!-- Navbar -->

<?php use App\RestaurantProfile;
use Illuminate\Support\Facades\DB; ?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropdown-thumbnail-preview">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="http://localhost/umaimono/"><img src="{{ URL::asset('public/img/logo.gif') }}" alt="" style="height: 50px;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="dropdown-thumbnail-preview">
      <ul class="nav navbar-nav">
        <li><a href="#">Đặt giao hàng</a></li>
        <li><a href="#">Đặt bàn</a></li>
        <li><a href="#">Du lịch</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Trợ giúp</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" action="{{url('search')}}">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
      </form>
      <ul class="nav navbar-nav" style="top: 0 !important; position: relative; float: right; margin-right: -15px;">
        <li class="dropdown">
        <?php 
          if(isset(Auth::user()->name)){ 
            switch (Auth::user()->role) {
              case 0:?>

                <a class="dropdown-toggle" data-toggle="dropdown" style="float: right;"><span><?php
                echo Auth::user()->name;?> 
                </span><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" class="w3-circle" style="height:25px;width:25px;margin-left: 5px;" alt="Avatar"></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('shopper/index')}}">Cập nhật tài khoản <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('shopper/index')}}">Lịch sử đơn hàng <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('shopper/saved')}}">Lưu trữ <span class="fa fa-bookmark pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('shopper/comment')}}">Nhận xét <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('shopper/like')}}">Đã thích <span class="fa fa-thumbs-up pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('shopper/feedback')}}">Phản hồi <span class="fa fa-envelope pull-right"></span></a></li>
                  <li class="divider"></li>
                  <li><a href="{{url('logout')}}">Thoát <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                </ul>

              <?php  break;
              case 1:?>
                  <a class="dropdown-toggle" data-toggle="dropdown" style="float: right;"><span><?php
                  echo Auth::user()->name?>
                   
                  </span><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" class="w3-circle" style="height:25px;width:25px;margin-left: 5px;" alt="Avatar"></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('shipper/edit_profile')}}">Cập nhật tài khoản <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('shipper/index')}}">Lịch sử đơn hàng <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('shipper/index')}}">Hoạt động <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('logout')}}">Thoát <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                  </ul>

              <?php
                break;
                case 3:?>
                  <a class="dropdown-toggle" data-toggle="dropdown" style="float: right;"><span><?php
                  echo Auth::user()->name;
                  ?> </span><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" class="w3-circle" style="height:25px;width:25px;margin-left: 5px;" alt="Avatar"></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('restaurant/index')}}">Cập nhật tài khoản <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('restaurant/index')}}">Lịch sử đơn hàng <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('logout')}}">Thoát <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                  </ul>
              <?php
                  break;
                  case 5:?>

                    <a class="dropdown-toggle" data-toggle="dropdown" style="float: right;"><span>Admins</span><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" class="w3-circle" style="height:25px;width:25px;margin-left: 5px;" alt="Avatar"></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{url('admin/index')}}">Cập nhật tài khoản <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('shopper/index')}}">Hoạt động <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('logout')}}">Thoát <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>

              <?php
              break;
              ?>
              
              <?php default:?>

                    <a class="dropdown-toggle" data-toggle="dropdown" style="float: right;"><span><?php echo Auth::user()->name; ?></span><img src="{{ URL::asset('avatar/'.Auth::user()->avatar) }}" class="w3-circle" style="height:25px;width:25px;margin-left: 5px;" alt="Avatar"></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{url('shopper/index')}}">Cập nhật tài khoản <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('shopper/index')}}">Lịch sử đơn hàng <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('shopper/index')}}">Lưu trữ <span class="badge pull-right"> 42 </span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('shopper/index')}}">Hoạt động <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                      <li class="divider"></li>
                      <li><a href="{{url('logout')}}">Thoát <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>
               <?php 
                break;
            }
          }else{ ?>
            <a href="{{url('login')}}" style="float: right;">Login/Register</a>
          <?php
          }
        ?>
          
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="w3-container w3-content" style="max-width:1400px; background-color: #000;">
<div class="container" style="margin-bottom: 15px; margin-top: 15px;">
        <!-- Jssor Slider Begin -->
        
        <!-- ================================================== -->
        <div id="slider1_container" style="visibility: hidden; position: relative; margin: 0 auto; width: 1140px; height: 375px; overflow: hidden;">

            <!-- Loading Screen -->
            <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('{{ URL::asset('public/img/loading.gif')}}') no-repeat 50% 50%; background-color: rgba(0, 0, 0, .7);"></div>

            <!-- Slides Container -->
            <div u="slides" style="position: absolute; left: 0px; top: 0px; width: 1140px; height: 375px;
            overflow: hidden;">
                <div>
                    <img u="image" src2="{{ URL::asset('public/img/home/1.jpg')}}" />
                </div>
                <div>
                    <img u="image" src2="{{ URL::asset('public/img/home/2.jpg')}}" />
                </div>
                <div>
                    <img u="image" src2="{{ URL::asset('public/img/home/3.jpg')}}" />
                </div>
                <div>
                    <img u="image" src2="{{ URL::asset('public/img/home/4.jpg')}}" />
                </div>
                <div>
                    <img u="image" src2="{{ URL::asset('public/img/home/5.jpg')}}" />
                </div>
            </div>
            
            <!--#region Bullet Navigator Skin Begin -->
            <!-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html -->
            <style>
                /* jssor slider bullet navigator skin 05 css */
                /*
                .jssorb05 div           (normal)
                .jssorb05 div:hover     (normal mouseover)
                .jssorb05 .av           (active)
                .jssorb05 .av:hover     (active mouseover)
                .jssorb05 .dn           (mousedown)
                */
                .jssorb05 {
                    position: absolute;
                }
                .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                    position: absolute;
                    /* size of bullet elment */
                    width: 16px;
                    height: 16px;
                    background: url('{{ URL::asset('public/img/b05.png')}}') no-repeat;
                    overflow: hidden;
                    cursor: pointer;
                }
                .jssorb05 div { background-position: -7px -7px; }
                .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
                .jssorb05 .av { background-position: -67px -7px; }
                .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
            </style>
            <!-- bullet navigator container -->
            <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
                <!-- bullet navigator item prototype -->
                <div u="prototype"></div>
            </div>
            <style>
                .jssora11l, .jssora11r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 37px;
                    height: 37px;
                    cursor: pointer;
                    background: url('{{ URL::asset('public/img/a11.png')}}') no-repeat;
                    overflow: hidden;
                }
                .jssora11l { background-position: -11px -41px; }
                .jssora11r { background-position: -71px -41px; }
                .jssora11l:hover { background-position: -131px -41px; }
                .jssora11r:hover { background-position: -191px -41px; }
                .jssora11l.jssora11ldn { background-position: -251px -41px; }
                .jssora11r.jssora11rdn { background-position: -311px -41px; }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
            </span>
            <!--#endregion Arrow Navigator Skin End -->
            <a style="display: none" href="https://www.jssor.com">Bootstrap Carousel</a>
        </div>
        <!-- Jssor Slider End -->
</div>
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
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: 1,                                       //[Optional] Auto play or not, to enable 
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation 
                $Idle: 3000,                                        //[Optional] Interval (in milliseconds) to go 
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over 
                $ArrowKeyNavigation: true,                    //[Optional] Allows keyboard (arrow key) navigation 
                $SlideEasing: $Jease$.$OutQuint,                    //[Optional] Specifies easing for right to left animation, default value is $Jease$.$OutQuad
                $SlideDuration: 2000,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0,                           //[Optional] Space between each slide in pixels, default value is 0
                $Cols: 1,                                           //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $Align: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Rows: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth - 30);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

</body>
</html> 

