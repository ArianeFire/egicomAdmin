@extends('master')
@section('content')
<h1 class="text-danger">Categories add form</h1>
<form action="{{url("/categories")}}" method="post">   
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="name"> Name : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="name" placeholder="Name"  required />
			</div>
		</div> <br/>
		  
			<div class="row">
			<div class="col-md-2">
				<label class="text-primary">Productss : </label>
			</div>

			<div class="col-md-7">
				<select class="form-control" multiple="multiple" size="10"  name="products[]">
					@forelse(\App\Products::all() as  $products)
					<option value="{{$products->id}}" @if(session('defaultSelect', 'none') == $products->id) {{"selected=\"\"selected\""}} @endif>
					{{$products->name}}
					</option>
					@empty
					<option value="-1">No products</option>
					@endforelse
				</select>
			</div>

			<script>
				var demo1 = $('select[name="products[]"]').bootstrapDualListbox(
						{
							nonSelectedListLabel: 'List of Products',
							selectedListLabel: 'Selected Products'
						}
				);
			</script>

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