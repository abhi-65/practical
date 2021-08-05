<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog Practical</title>
	<link rel="stylesheet" href="{{asset('bootstrap.min.css')}}" crossorigin="anonymous">
	<script src="{{asset('bootstrap.min.js')}}" crossorigin="anonymous"></script>
	<script src="{{asset('jquery.min.js')}}" crossorigin="anonymous"></script>
	@yield('head')
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav">
					<li class="nav-item">
					    <a class="nav-link" href="{{route('index')}}">Blog</a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" href="{{route('add-blog')}}">Add Blog</a>
					</li>
					@if(!empty(Auth::user()))
					 <li class="nav-item">
					    <a class="nav-link active">Hello {{Auth::user()->first_name}}</a>
					 </li>
					 <li class="nav-item">
					    <a class="nav-link active" href="{{route('logout')}}">logout</a>
					 </li>
				  	@else
				  	<li class="nav-item">
					    <a class="nav-link active" href="{{route('login')}}">Login</a>
					 </li>
				  	<li class="nav-item">
				    	<a class="nav-link" href="{{route('register')}}">Register</a>
				  	</li>
				  	@endif
					
				</ul>
			</div>
		</div>
		@yield('content')
	</div>

	@yield('scripts')
</body>
</html>