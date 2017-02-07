@extends('master')
@section('content')
<h1 class="text-danger">Display Categories_products</h1>

<a href="{{url("/categories_products/$categories_products->id")}}/edit">Edit</a></br>

   <label class="text-primary">Products_id : </label>
<p>{{$categories_products->products_id}}</p>
  <label class="text-primary">Categories_id : </label>
<p>{{$categories_products->categories_id}}</p>
 
@endsection