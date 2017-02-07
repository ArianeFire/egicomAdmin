@extends('master')
@section('content')
<h1 class="text-danger">Edit Users</h1>
<form method="post" action="{{url("users/$users->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Name : </label>
        <input type ="text" class="form-control" name="name" value = "{{$users->name}}"placeholder="Name"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Email : </label>
        <input type ="text" class="form-control" name="email" value = "{{$users->email}}"placeholder="Email"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Password : </label>
        <input type ="text" class="form-control" name="password" value = "{{$users->password}}"placeholder="Password"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

    @if(isset($users->carts))
    <h3>Add Carts</h3>
<form action="{{url("/users/addCarts/$users->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="carts">
        @forelse(\App\Carts::all() as  $carts)
        <option value="{{$carts->id}}">
            {{$carts->id}}
        </option>
        @empty
        <option value="-1">No carts</option>
        @endforelse
    </select>

    <input type="submit"  class="btn btn-primary" value="Add"/>
</form>
    @else
            @endif
@endsection