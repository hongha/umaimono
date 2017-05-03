
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Responsive Meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Title-->
        <title>Home Page</title>
        <!--Bootstrap Css-->
		<link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
        <!--Font-awesome-->
		<link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" />
        <!--Fonts Form Google Web Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,400italic,700,900,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
        <!--Responsive Mobile Menu-->
        <link rel="stylesheet" href="{{ URL::asset('public/css/slicknav.css') }}" />
        <!--Revolation Slider-->
        <link rel="stylesheet" href="{{ URL::asset('public/css/settings.css') }}" />
        <!--Carousel Slider-->
        <link rel="stylesheet" href="{{ URL::asset('public/css/owl.carousel.css') }}" />
        <!--Main Style Css-->
        <link rel="stylesheet" href="{{ URL::asset('public/css/style-template.css') }}" />
        <!--Responsive-->
        <link rel="stylesheet" href="{{ URL::asset('public/css/responsive.css') }}" />
		<!-- Style CSS -->
		<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" />

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
       <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--Start Mobile Menu Area-->
        <div id="preloader">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i>
        </div>		
        <div class="mobile_menu_area">
			<nav>
            <ul id="mobile_menu">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="service.html">Service</a></li>
                <li><a href="#">Pages</a>
                    <ul>
                        <li><a href="index2.html"></a>Home Two</li>
                        <li><a href="service-datails.html">Service Datials</a></li>
                        <li><a href="get-a-quate.html">Get a quate</a></li>
                        <li><a href="single-post.html">single posst</a></li>
                        <li><a href="faq.html">faqs</a></li>
                        <li><a href="404.html">not found</a></li>
                    </ul>
                </li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="storage-location.html">Team</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
            </ul>
			</nav>
        </div>
        <!--End Mobile Menu Area-->
        
        <!--Start Header area  -->
        <div class="header_area">
             <div class="header_top_area">
                <div class="container">
                    <div class="row">  
                        <div class="col-md-4 col-lg-4">
                            <div class="header_top_menu">
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Service</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>  
                        <div class="col-md-2 col-lg-2 col-md-offset-6 col-lg-offset-6">
                            <div class="header_social_bookmark">
                                <ul>
                                    <li>
                                    	<?php
                                    	  if(isset(Auth::user()->name)){?>
										    <a href="{{url('logout')}}"  title="<?php echo Auth::user()->name; ?>"><img src="avatar/<?php echo Auth::user()->avatar;?>" class="w3-circle" style="height:25px;width:25px;" alt="Avatar" title="logout">
										    </a>
										    <?php
										    }else{ ?>
										      <a href="{{url('login')}}">Login</a>
										    <?php
										    }
										?>
                                    </li>
                                    <li>
                                        <div class="dropdown" >
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php echo Auth::user()->name; ?>
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu hp_dropdown">
                                                <?php 
                                                    if(Auth::user()->role == 0){
                                                        ?>
                                                            <li ><a href="#">Trang cá nhân</a></li>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <li ><a href="#">Quản lí</a></li>
                                                        <?php
                                                    }
                                                ?>
                                                  <li ><a href="#">Đăng xuất</a></li>
                                                </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <div class="logo">
                                <a href="index.html"><img src="{{ URL::asset('public/img/logo.gif') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-md-offset-1 col-lg-offset-1">
                            <div class="opening_time s_header">
                                <div><i class="fa fa-clock-o"></i></div>
                                <p class="contact_title">Opening Hours</p>
                                <p class="uppercase">Mon to fri - 9:00 am to 9:00 pm</p>
                                <p class="uppercase">sat 9:00 am to 5:00 pm</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <div class="call_us s_header">
                                <div><i class="fa fa-phone"></i></div>
                                <p class="contact_title">Call Us</p>
                                <p>+123 456 789</p>
                                <p>+123 456 789</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="email_us s_header">
                                <div><i class="fa fa-envelope-o"></i></div>
                                <p class="contact_title">Email Us</p>
                                <p class="uppercase">INFO@YOUR.COM</p>
                                <p class="uppercase">INFO@YOURCOMPANY.COM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Area-->

		@yield('content')

        <!-- Footer Area  -->
        <footer class="footer_area">
            <div class="footer_top_area  section_dark">
                <div class="container">
                    <div class="row footer_padding_top">
                        <div class="col-md-4 col-lg-4">
                            <div class="footer_adddress s_footer">
                                <div><i class="fa fa-home"></i></div>
                                <p class="uppercase">address</p>
                                <p>09 Movers and Packers,Design Street,Victoria,Australia</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="footer_call_us s_footer">
                                <div><i class="fa fa-phone"></i></div>
                                <p class="uppercase">quick contact</p>
                                <p>+123 456 789 <br>+123 456 789</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="footer_email_us s_footer">
                                <div><i class="fa fa-envelope-o"></i></div>
                                <p class="uppercase">Email address</p>
                                <p>INFO@YOUR.COM <br>Help@company.Com</p>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="footer_border"></div>
                        </div>
                    </div>
                    <div class="row footer_padding_bottom">
                        <div class="col-md-3 col-lg-3">
                            <div class="footer_discription">
                                <h3>About Us</h3>
                                <p>In a freak mishap Ranger 3 and its pilot Captain William Buck Rogers are blown out of their trajectory into an orbit which freezes his life support systems and returns Buck Rogers to Earth five-hundred years later. </p>
                                <div class="footer_social_bookmark">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="footer_list">
                                <h3>our service</h3>
                                <div class="col-md-6 col-lg-6">
                                    <ul>
                                        <li><a href="#">Moving locally or Interstate</a></li>
                                        <li><a href="#">Moving Oversead</a></li>
                                        <li><a href="#">Commercial Relocation</a></li>
                                        <li><a href="#">Corporate Relocation</a></li>
                                        <li><a href="#">Packing</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <ul>
                                        <li><a href="#">Storage</a></li>
                                        <li><a href="#">Insurance</a></li>
                                        <li><a href="#">Additional Service</a></li>
                                        <li><a href="#">Contuct Us</a></li>
                                        <li><a href="#">Quality Policy Statement</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="footer_opening_time">
                                <h3>buseness hour</h3>
                                <p>Monday To Friday:<br>9:00 am to 9:00 pm </p>
                                <p>Saturday:<br> 9:00 am to 5:00 pm</p>
                                <p>Vacations:<br>All Sundays <br> All Official Holydays</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="footer_copyright">
                                <p>Copyright 2016 &copy; <a href ="http://freecssthemes.com/">FreeCssThemes</a> | All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                           <div class="footer_menu">
								<nav>
									<ul>
										<li><a href="#">Home</a></li>
										<li>I</li>
										<li><a href="#">About Us</a></li>
										<li>I</li>
										<li><a href="#">Service</a></li>
										<li>I</li>
										<li><a href="#">Contact Us</a></li>
									</ul>								
								</nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer Area-->
        
        <!--jQuery-->
        <script type="text/javascript" src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
        <!--Bootstrap-->
        <script type="text/javascript" src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!--Revolation Slider-->
        <script type="text/javascript" src="{{ URL::asset('public/js/jquery.themepunch.plugins.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('public/js/jquery.themepunch.revolution.min.js') }}"></script>
        <!--Carousel Slider-->
        <script type="text/javascript" src="{{ URL::asset('public/js/owl.carousel.min.js') }}"></script>
        <!--Mobile Menu Js-->
        <script type="text/javascript" src="{{ URL::asset('public/js/jquery.slicknav.min.js') }}"></script>
        <!--Active jQuery-->
        <script type="text/javascript" src="{{ URL::asset('public/js/main.js') }}"></script>

    </body>
</html>