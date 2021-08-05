@extends('template')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('login.css')}}" crossorigin="anonymous">

@endsection
@section('content')
<form action="{{route('save-user')}}" method="post" onsubmit="return validate(this);" enctype='multipart/form-data'>
	@csrf
	<div class="col-lg-6">
	    <div class="card2 card border-0 px-4 py-5">
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">First Name</h6>
	            </label> 
	            <input class="mb-1 req" type="text"  name="first_name" placeholder="Enter first name" value="{{old('first_name')}}"> 
	            <span class="err text-danger">{{ $errors->first('first_name') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Last Name</h6>
	            </label> 
	            <input class="mb-1 req" type="text"  name="last_name" placeholder="Enter last name" value="{{old('last_name')}}"> 
	           
	            <span class="err text-danger">{{ $errors->first('last_name') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Email Address</h6>
	            </label> 
	            <input class="mb-1 email" type="email"  name="email" placeholder="Enter a valid email address" value="{{old('email')}}"> 
	            <span class="err text-danger">{{ $errors->first('email') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Password</h6>
	            </label> 
	            <input type="password" name="password" placeholder="Enter password"  minlength="6" class="req mb-1"> 
	            <span class="err text-danger">{{ $errors->first('password') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Date of Birth</h6>
	            </label> 
				  <input placeholder="Select date" type="text" id="date_of_birth" name="date_of_birth" class="form-control req"  value="{{old('date_of_birth')}}">
				  <span class="err text-danger">{{ $errors->first('date_of_birth') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Image</h6>
	            </label> 
	        	<input type="file" class="form-control req" name="image" id="image">
	        	<span class="err text-danger">{{ $errors->first('image') }}</span>
	        </div>

	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Role</h6>
	            </label> 
	        	<select class="form-control req" name="role">
	        		@foreach($roles as $role)
	        			<option value="{{$role->id}}">{{$role->role_name}}</option>
	        		@endforeach
	        	</select>
	        	<span class="err text-danger">{{ $errors->first('role') }}</span>
	        </div>
	        <br>
	        <br>
	        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Register</button> </div>
	        <div class="row mb-1 px-3"> <small class="font-weight-bold">Already have an account? <a class="text-danger ">Login</a></small> </div>
	    </div>
	</div>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
	$('#date_of_birth').datepicker({
	    format: "dd-m-yyyy",
	    endDate: "yesterday"
	});
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
		//alert(count);
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
			var fileObj =  $('#image');
			var filePath = fileObj.val();
          
            // Allowing file type
            var allowedExtensions = 
                    /(\.jpg|\.jpeg|\.png)$/i;
              //alert(filePath);
            if (!allowedExtensions.exec(filePath)) {
                $('#image').parent().find('.err').text('Enter valid image file');
                count = count + 1;
            } 
			else
			{
				if(count != 1)
				{
					count = count - 1;
				}
				$('#image').parent().find('.err').text('');
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