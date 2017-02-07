@extends('master')
@section('content')
<h1 class="text-danger">Edit Categories_products</h1>
<form method="post" action="{{url("categories_products/$categories_products->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Products id : </label>
        <input type ="number" class="form-control" name="products_id"  max = "9999999999" value = "{{$categories_products->products_id}}"placeholder="Products id"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Categories id : </label>
        <input type ="number" class="form-control" name="categories_id"  max = "9999999999" value = "{{$categories_products->categories_id}}"placeholder="Categories id"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

@endsection