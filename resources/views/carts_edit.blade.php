@extends('master')
@section('content')
<h1 class="text-danger">Edit Carts</h1>
<form method="post" action="{{url("carts/$carts->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Users id : </label>
        <input type ="number" class="form-control" name="users_id"  max = "9999999999" value = "{{$carts->users_id}}"placeholder="Users id"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Products id : </label>
        <input type ="number" class="form-control" name="products_id"  max = "9999999999" value = "{{$carts->products_id}}"placeholder="Products id"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

    @if(isset($carts->users))
    <h3>Update Users</h3>
<form action="{{url("/carts/updateUsers/$carts->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="users">
        @forelse(\App\Users::all() as  $users)
        <option value="{{$users->id}}" @if($users->id == $carts->users->id) selected = "selected" @endif>
            {{$users->name}}
        </option>
        @empty
        <option value="-1">No users</option>
        @endforelse
    </select><br/>

    <input type="submit"  class="btn btn-primary" value="Update"/>
</form>
    @else
                    <h3>Update Users</h3>
<form action="{{url("/carts/updateUsers/$carts->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="users">
        @forelse(\App\Users::all() as  $users)
        <option value="{{$users->id}}">
            {{$users->name}}
        </option>
        @empty
        <option value="-1">No users</option>
        @endforelse
    </select><br/>

    <input type="submit"  class="btn btn-primary" value="Update"/>
</form>            @endif
@endsection