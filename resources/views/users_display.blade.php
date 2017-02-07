@extends('master')
@section('content')
<h1 class="text-danger">Display Users</h1>

<a href="{{url("/users/$users->id")}}/edit">Edit</a></br>

   <label class="text-primary">Name : </label>
<p>{{$users->name}}</p>
  <label class="text-primary">Email : </label>
<p>{{$users->email}}</p>
  <label class="text-primary">Password : </label>
<p>{{$users->password}}</p>
 
    @if(isset($users->carts))
        @else
        <label class="text-danger">No carts related to this users.</label>
    @endif
@endsection