@extends('template')

@section('head')
<link rel="stylesheet" href="{{asset('login.css')}}" crossorigin="anonymous">

@endsection
@section('content')
<form action="{{route('authenticate')}}" method="post" onsubmit="return validate(this);">
	@csrf
	@if(Session::has('message'))
		<h3 class="text-danger">{{Session::get('message')}}</h3>
		{{Session::forget('message')}}
	@endif
	<div class="col-lg-6">
	    <div class="card2 card border-0 px-4 py-5">
	        <div class="row px-3">
	         <label class="mb-1">
	                <h6 class="mb-0 text-sm">Email Address</h6>
	            </label>
	             <input class="mb-4 req" type="email" id="email" name="email" placeholder="Enter a valid email address"> 
	             <span class="err text-danger">{{ $errors->first('email') }}</span>
	         </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Password</h6>
	            </label>
	            <input type="password" name="password" placeholder="Enter password" class="req" minlength="6"> 
	            <span class="err text-danger">{{ $errors->first('password') }}</span>
	        </div>
	        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>
	        <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger " href="{{route('register')}}">Register</a></small> </div>
	    </div>
	</div>
</form>
@endsection

@section('scripts')

<script type="text/javascript">
	function validate(elem)
	{
		var count = 1;
		var flag = false;
		$('.req').each(function (){
			if($(this).val() == '')
			{
				$(this).parent().find('.err').text('This Field is required.');
				count = count + 1;
			}
			else
			{
				$(this).parent().find('.err').text('');
			}
		});
		if(count == 1)
		{
			//flag = true;
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#email').val()))
			{
			   	$('#email').parent().find('.err').text('');
			   	if(count != 1)
				{
					count = count - 1;
				}
			}
			else
			{
				count = count + 1;
				$('#email').parent().find('.err').text('Please eneter valid email');
			}

			if(count == 1)
			{
				flag = true;
			}
		}
		return flag;
	}
</script>
@endsection