@extends('master')
@section('content')
@if(isset($carts->users) && "users" == $table)
    <h3 class="text-danger">Users : </h3>
     {{$carts->users->name}}
     {{$carts->users->email}}
     {{$carts->users->password}}
     @else

    @endif
@endsection