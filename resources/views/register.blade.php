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
        <div id="register" class="animate form">
          <section class="login_content">
            <form action="{{url('register')}}" method="post" role="form">
            {!! csrf_field() !!}
            @if($errors->has('errorRegister'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{$errors->first('errorRegister')}}
                </div>
              @endif
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="name" placeholder="Username*" required="" />
                @if($errors->has('name'))
                  <p style="color:red">{{$errors->first('name')}}</p>
                @endif
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email*" required="" value="{{old('emailR')}}"  />
                @if($errors->has('email'))
                  <p style="color:red">{{$errors->first('email')}}</p>
                @endif
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password*" required="" />
                @if($errors->has('password'))
                  <p style="color:red">{{$errors->first('password')}}</p>
                @endif
              </div>
              <div>
                <input type="password" class="form-control" name="passwordConfirm" placeholder="Password Confirm*" required="" />
                @if($errors->has('passwordConfirm'))
                  <p style="color:red">{{$errors->first('passwordConfirm')}}</p>
                @endif
                @if($errors->has('errorConfirm'))
                  <p style="color:red">{{$errors->first('errorConfirm')}}</p>
                @endif
              </div>
              <div>
                <button type="submit"  class="btn btn-default submit">Register</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{ url('login')}}" class="to_register"> Log in </a>
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