@extends('master')
@section('content')
<h1 class="text-danger">Display Manifacturers</h1>

<a href="{{url("/manifacturers/$manifacturers->id")}}/edit">Edit</a></br>

   <label class="text-primary">Name : </label>
<p>{{$manifacturers->name}}</p>
 
    @if(isset($manifacturers->products))
        @else
        <label class="text-danger">No products related to this manifacturers.</label>
    @endif
@endsection