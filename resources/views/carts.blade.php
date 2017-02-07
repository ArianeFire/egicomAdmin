@extends('master')
@section('content')
<h1 class="text-danger">Carts add form</h1>
<form action="{{url("/carts")}}" method="post">   
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="users_id"> Users id : </label>
			</div>
			<div class="col-md-3">
			<input type ="number" class="form-control" name="users_id"  max = "9999999999" placeholder="Users id"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="products_id"> Products id : </label>
			</div>
			<div class="col-md-3">
			<input type ="number" class="form-control" name="products_id"  max = "9999999999" placeholder="Products id"  required />
			</div>
		</div> <br/>
		  
			<div class="row">
			<div class="col-md-2">
				<label class="text-primary">Users : </label>
			</div>

			<div class="col-md-5">
				<select class="form-control" name="users">
					@forelse(\App\Users::all() as  $users)
					<option value="{{$users->id}}" @if(session('defaultSelect', 'none') == $users->id) {{"selected=\"\"selected\""}} @endif>
						{{$users->name}}
					</option>
					@empty
					<option value="-1">No users</option>
					@endforelse
				</select>
			</div>
		</div><br/>
		  
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