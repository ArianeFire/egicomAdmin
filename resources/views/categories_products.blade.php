@extends('master')
@section('content')
<h1 class="text-danger">Categories_products add form</h1>
<form action="{{url("/categories_products")}}" method="post">   
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="products_id"> Products id : </label>
			</div>
			<div class="col-md-3">
			<input type ="number" class="form-control" name="products_id"  max = "9999999999" placeholder="Products id"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="categories_id"> Categories id : </label>
			</div>
			<div class="col-md-3">
			<input type ="number" class="form-control" name="categories_id"  max = "9999999999" placeholder="Categories id"  required />
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