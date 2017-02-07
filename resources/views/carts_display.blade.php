@extends('master')
@section('content')
<h1 class="text-danger">Display Carts</h1>

<a href="{{url("/carts/$carts->id")}}/edit">Edit</a></br>

   <label class="text-primary">Users_id : </label>
<p>{{$carts->users_id}}</p>
  <label class="text-primary">Products_id : </label>
<p>{{$carts->products_id}}</p>
 
    @if(isset($carts->users))
        @else
        <label class="text-danger">No users related to this carts.</label>
    @endif
@endsection