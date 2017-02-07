@extends('master')
@section('content')
<h1 class="text-danger">Edit Manifacturers</h1>
<form method="post" action="{{url("manifacturers/$manifacturers->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Name : </label>
        <input type ="text" class="form-control" name="name" value = "{{$manifacturers->name}}"placeholder="Name"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

    @if(isset($manifacturers->products))
    <h3>Add Products</h3>
<form action="{{url("/manifacturers/addProducts/$manifacturers->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="products">
        @forelse(\App\Products::all() as  $products)
        <option value="{{$products->id}}">
            {{$products->name}}
        </option>
        @empty
        <option value="-1">No products</option>
        @endforelse
    </select>

    <input type="submit"  class="btn btn-primary" value="Add"/>
</form>
    @else
            @endif
@endsection