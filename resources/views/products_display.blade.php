@extends('master')
@section('content')
<h1 class="text-danger">Display Products</h1>

<a href="{{url("/products/$products->id")}}/edit">Edit</a></br>

   <label class="text-primary">Name : </label>
<p>{{$products->name}}</p>
  <label class="text-primary">Availability : </label>
<p>{{$products->availability}}</p>
  <label class="text-primary">Warranty : </label>
<p>{{$products->warranty}}</p>
  <label class="text-primary">Transport : </label>
<p>{{$products->transport}}</p>
  <label class="text-primary">HasTVA : </label>
<p>{{$products->hasTVA}}</p>
  <label class="text-primary">Description : </label>
<p>{{$products->description}}</p>
  <label class="text-primary">NormalPrice : </label>
<p>{{$products->normalPrice}}</p>
  <label class="text-primary">PromoPrice : </label>
<p>{{$products->promoPrice}}</p>
  <label class="text-primary">BigImageUrl : </label>
<p>{{$products->bigImageUrl}}</p>
  <label class="text-primary">SmallImageUrl : </label>
<p>{{$products->smallImageUrl}}</p>
  <label class="text-primary">Category_id : </label>
<p>{{$products->category_id}}</p>
  <label class="text-primary">Manifacturer_id : </label>
<p>{{$products->manifacturer_id}}</p>
 
    @if(isset($products->manifacturers))
        @else
        <label class="text-danger">No manifacturers related to this products.</label>
    @endif
    @if(isset($products->categories))
        @else
        <label class="text-danger">No categories related to this products.</label>
    @endif
@endsection