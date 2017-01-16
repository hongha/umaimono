<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ URL::asset('public/bootstrap/dist/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('public/font-awesome/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('public/nprogress/nprogress.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('public/animate.css/animate.min.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('public/css/custom.min.css') }}" />
	<script type="text/javascript" src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/js/jquery.validate.min.js') }}"></script>
	<title>

	</title>
</head>
		<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{url('login')}}" method="post" role="form">
            	@if($errors->has('errorlogin'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									{{$errors->first('errorlogin')}}
								</div>
            	@endif
              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email*" value="{{old('email')}}" required="" />
                @if($errors->has('email'))
									<p style="color:red">{{$errors->first('email')}}</p>
								@endif
              </div>
              <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required="" pattern=".{8,}"   required title="Vui lòng nhập từ 8 kí tự trở lên!" />
                @if($errors->has('password'))
									<p style="color:red">{{$errors->first('password')}}</p>
								@endif
              </div>
              <div>
              <div class="form group" style="height: 40px;">
              	<input type="checkbox" name="remember">Remember me!
              </div>
              	{!! csrf_field() !!}
              	<!-- id="dang-nhap" -->
                <button type="submit"  class="btn btn-default submit">log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{url('register')}}" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>