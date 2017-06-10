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
            <form action="{{url('register')}}" method="post" role="form" enctype="multipart/form-data">
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
                <input type="email" class="form-control" name="email" placeholder="Email*" required="" value="{{old('emailR')}}"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/>
                @if($errors->has('email'))
                  <p style="color:red">{{$errors->first('email')}}</p>
                @endif
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password*" required pattern=".{8,20}"  title="Password phải chứa từ 8 đến 20 kí tự!" />
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
                <select class=" form-control" data-live-search="true" style="border-radius: 3px; margin-bottom: 20px;" name="role" required>
                  <option value="">Bạn muốn đăng ký loại tài khoản nào?</option>
                  <option value="0">Người dùng</option>
                  <option value="1">Người Ship</option>
                  <option value="3">Nhà Hàng</option>
                  <option value="4">Công ty Ship</option>
                </select>
                @if($errors->has('role'))
                  <p style="color:red">{{$errors->first('role')}}</p>
                @endif
                @if($errors->has('error_role'))
                  <p style="color:red">{{$errors->first('error_role')}}</p>
                @endif
              </div>
              <div style="margin-bottom: 20px;">
                 <img id="logo-img" onclick="document.getElementById('add-new-logo').click();" style="width: 100px; height: 100px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
                 <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-logo" name="file" accept="image/*" onchange="addNewLogo(this)"/>
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
                  <h1><i class="fa fa-paw"></i> Umaimono!</h1>
                </div>
              </div>
            </form>

            
            <script>
              var addNewLogo = function(input){
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                          //Hiển thị ảnh vừa mới upload lên
                          $('#logo-img').attr('src', e.target.result);
                      }
                      reader.readAsDataURL(input.files[0]);     
                  }
              }
              form.addEventListener('submit', function(e){
                e.preventDefault();
                var formdata = new Form
              });
              
        
            </script>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>