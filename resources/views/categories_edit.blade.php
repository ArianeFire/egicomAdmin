@extends('master')
@section('content')
<h1 class="text-danger">Edit Categories</h1>
<form method="post" action="{{url("categories/$categories->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Name : </label>
        <input type ="text" class="form-control" name="name" value = "{{$categories->name}}"placeholder="Name"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

    @if(isset($categories->products))
    <h3 class="text-danger">Associate Products</h3>
<form action="{{url("/categories/addProducts/$categories->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" multiple="multiple" size="10"  name="products[]">
        @forelse(\App\Products::all() as  $products)
        <option value="{{$products->id}}" @foreach($categories->products as  $productstmp) @if($productstmp->id == $products->id) selected = "selected" @endif @endforeach>
                {{$products->name}}
        </option>
        @empty
        <option value="-1">No products</option>
        @endforelse
    </select><br/>

    <script>
        var demo1 = $('select[name="products[]"]').bootstrapDualListbox(
                {
                    nonSelectedListLabel: 'List of Products',
                    selectedListLabel: 'Selected Products'
                }
        );
    </script>

    <input type="submit"  class="btn btn-primary" value="Associate"/>
</form>
    @else
                    <h3 class="text-danger">Associate Products</h3>
<form action="{{url("/categories/addProducts/$categories->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" multiple="multiple" size="10"  name="products[]">
        @forelse(\App\Products::all() as  $products)
        <option value="{{$products->id}}">
            {{$products->name}}
        </option>
        @empty
        <option value="-1">No products</option>
        @endforelse
    </select><br/>

    <script>
        var demo1 = $('select[name="products[]"]').bootstrapDualListbox(
                {
                    nonSelectedListLabel: 'List of Products',
                    selectedListLabel: 'Selected Products'
                }
        );
    </script>

    <input type="submit"  class="btn btn-primary" value="Associate"/>
</form>            @endif
@endsection