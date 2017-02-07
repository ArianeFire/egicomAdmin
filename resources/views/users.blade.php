@extends('master')
@section('content')
<h1 class="text-danger">Users add form</h1>
<form action="{{url("/users")}}" method="post">   
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="name"> Name : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="name" placeholder="Name"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="email"> Email : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="email" placeholder="Email"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="password"> Password : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="password" placeholder="Password"  required />
			</div>
		</div> <br/>
		  
	  
		<div class="row">
			<div class="col-md-2">
				<label class="text-danger"> * = Mandatory fields</label>
			</div>
		</div> <br/>

		<div class="row">
			<div class="col-md-2">
			<button type="submit" class="btn btn-primary">Create and return to list</button>
			</div>

			<div class="col-md-1 col-md-offset-4">
			<button type="reset" onclick="goBack();" class="btn btn-danger">Cancel and return to list</button>
			</div>
		</div>
</form>
@endsection