@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{url('post/edit')}}" method="POST" role="form">
            {!! csrf_field() !!}
				<legend>ádadadas</legend>
				<div class="form-group">
					<label for="">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Input title" value="{{$post->title}}">
					<label for="">Content</label>
					<input type="text" class="form-control" id="content" name="content" placeholder="Input content" value="{{$post->content}}">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
        </div>
    </div>
</div>
@stop