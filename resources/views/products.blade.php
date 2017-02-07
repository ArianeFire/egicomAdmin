@extends('master')
@section('content')
<h1 class="text-danger">Products add form</h1>
<form action="{{url("/products")}}" method="post">   
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="name">Name * : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="name" placeholder="Name"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="availability">Availability * : </label>
			</div>
			<div class="col-md-3">
			<input type ="checkbox" class="form-control" name="availability"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="warranty">Warranty * : </label>
			</div>
			<div class="col-md-3">
			<input type ="number" class="form-control" name="warranty"  max = "9999999999" placeholder="Warranty"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="transport">Transport * : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="transport" placeholder="Transport"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="hasTVA">HasTVA * : </label>
			</div>
			<div class="col-md-3">
			<input type ="checkbox" class="form-control" name="hasTVA"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="description">Description * : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="description" placeholder="Description"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="normalPrice">NormalPrice * : </label>
			</div>
			<div class="c_numeric">
			<input type ="number" class="form-control" name="normalPrice"  max = "9999999999" placeholder="NormalPrice"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="promoPrice">PromoPrice * : </label>
			</div>
			<div class="c_numeric">
			<input type ="number" class="form-control" name="promoPrice"  max = "9999999999" placeholder="PromoPrice"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="bigImageUrl"> BigImageUrl : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="bigImageUrl" placeholder="BigImageUrl"  required />
			</div>
		</div> <br/>
		  
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2">
			<label class="text-primary" id="smallImageUrl"> SmallImageUrl : </label>
			</div>
			<div class="col-md-7">
			<input type ="text" class="form-control" name="smallImageUrl" placeholder="SmallImageUrl"  required />
			</div>
		</div> <br/>
		  
			<div class="row">
			<div class="col-md-2">
				<label class="text-primary">Manifacturers : </label>
			</div>

			<div class="col-md-5">
				<select class="form-control" name="manifacturers">
					@forelse(\App\Manifacturers::all() as  $manifacturers)
					<option value="{{$manifacturers->id}}" @if(session('defaultSelect', 'none') == $manifacturers->id) {{"selected=\"\"selected\""}} @endif>
						{{$manifacturers->name}}
					</option>
					@empty
					<option value="-1">No manifacturers</option>
					@endforelse
				</select>
			</div>
		</div><br/>
		 		<div class="row">
			<div class="col-md-2">
				<label class="text-primary">Categoriess : </label>
			</div>

			<div class="col-md-7">
				<select class="form-control" multiple="multiple" size="10"  name="categories[]">
					@forelse(\App\Categories::all() as  $categories)
					<option value="{{$categories->id}}" @if(session('defaultSelect', 'none') == $categories->id) {{"selected=\"\"selected\""}} @endif>
					{{$categories->name}}
					</option>
					@empty
					<option value="-1">No categories</option>
					@endforelse
				</select>
			</div>

			<script>
				var demo1 = $('select[name="categories[]"]').bootstrapDualListbox(
						{
							nonSelectedListLabel: 'List of Categories',
							selectedListLabel: 'Selected Categories'
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