@extends('master')
@section('content')
<h1 class="text-danger">Display Categories</h1>

<a href="{{url("/categories/$categories->id")}}/edit">Edit</a></br>

   <label class="text-primary">Name : </label>
<p>{{$categories->name}}</p>
 
    @if(isset($categories->products))
        @else
        <label class="text-danger">No products related to this categories.</label>
    @endif
@endsection