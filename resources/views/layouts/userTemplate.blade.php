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
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<title>
		@section('title')
            Sugoi-Shiper.com
        @show
	</title>
</head>
	@yield('content')
</html>