@extends('template')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('login.css')}}" crossorigin="anonymous">

@endsection
@section('content')
<form action="{{route('save-blog')}}" method="post" onsubmit="return validate(this);" enctype='multipart/form-data'>
	@csrf
	<input type="hidden" name="id" value="{{(isset($blog) && !empty($blog)) ? $blog->id : ''}}">
	<div class="col-lg-6">
	    <div class="card2 card border-0 px-4 py-5">
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Title</h6>
	            </label> 
	            <input class="mb-1 req" type="text"  name="title" placeholder="Enter title" value="{{(isset($blog) && !empty($blog)) ? $blog->title : old('title')}}"> 
	            <span class="err text-danger">{{ $errors->first('title') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Description</h6>
	            </label> 
	            <textarea class="form-control req" name="description" id="description">{{(isset($blog) && !empty($blog)) ? $blog->description : old('description')}}</textarea> 
	           
	            <span class="err text-danger">{{ $errors->first('description') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Start Date</h6>
	            </label> 
				  <input placeholder="Select date" type="text" id="start_date" name="start_date" class="form-control req"  value="{{(isset($blog) && !empty($blog)) ? date('d-m-Y',strtotime($blog->start_date)) : old('start_date')}}">
				  <span class="err text-danger">{{ $errors->first('start_date') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">End Date</h6>
	            </label> 
				  <input placeholder="Select date" type="text" id="end_date" name="end_date" class="form-control req"  value="{{(isset($blog) && !empty($blog)) ? date('d-m-Y',strtotime($blog->end_date)) : old('end_date')}}">
				  <span class="err text-danger">{{ $errors->first('end_date') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Image</h6>
	            </label>
	         @if(isset($blog) && !empty($blog) && !empty($blog->image))
	         <img src="{{asset('blog/'.$blog->image)}}" width="100px" height="100px">
	         @endif 
	         <input type="hidden" name="img_name" id="img_name" value="{{(isset($blog) && !empty($blog)) ? $blog->image : ''}}">
	        	<input type="file" class="form-control {{(isset($blog) && !empty($blog)) ? '' : 'req'}}" name="image" id="image">
	        	<span class="err text-danger">{{ $errors->first('image') }}</span>
	        </div>
	        <div class="row px-3"> 
	        	<label class="mb-1">
	                <h6 class="mb-0 text-sm">Status</h6>
	            </label> 
	        	<select class="form-control req" name="status">
	        			<option value="1" @if(isset($blog) && !empty($blog) && $blog->status == 1) selected @endif>Active</option>
	        			<option value="0" @if(isset($blog) && !empty($blog) && $blog->status == 0) selected @endif>Inactive</option>
	        		
	        	</select>
	        	<span class="err text-danger">{{ $errors->first('status') }}</span>
	        </div>
	        <br>
	        <br>
	        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Save</button> </div>
	    </div>
	</div>
</form>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$('#start_date').datepicker({
	    format: "dd-m-yyyy"
	});
	$('#end_date').datepicker({
	    format: "dd-m-yyyy"
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
			if($('#img_name').val() == '')
			{
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
