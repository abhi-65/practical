@extends('template')

@section('head')
<link rel="stylesheet" href="{{asset('blog.css')}}" crossorigin="anonymous">

@endsection
@section('content')
 <div class="row">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
    	@foreach($blog as $bl)
      	<div class="card">
	        <img class="card-img" src="{{asset('blog/'.$bl->image)}}" alt="{{$bl->title}}">
	        <div class="card-body">
	          <h4 class="card-title">{{$bl->title}}</h4>
	          <p class="card-text">{{$bl->description}}</p>
	          @if(!empty(Auth::user()))
	          <a href="{{route('edit-blog',[$bl->id])}}" class="btn btn-info">edit</a>
	          <a href="{{route('delete-blog',[$bl->id])}}" class="btn btn-info">delete</a>
	          @endif
	        </div>
	        <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
	          <div class="views">{{date('Y-m-d',strtotime($bl->start_date))}} - {{date('Y-m-d',strtotime($bl->end_date))}}
	          </div>
	        </div>
      	</div>
      	@endforeach
    </div>
  </div>
@endsection
