@extends('master')
@section('content')
<h1 class="text-danger">Edit Products</h1>
<form method="post" action="{{url("products/$products->id")}}">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label class="text-danger">Name : </label>
        <input type ="text" class="form-control" name="name" value = "{{$products->name}}"placeholder="Name"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Availability : </label>
        <input type ="checkbox" class="form-control" name="availability"  checked  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Warranty : </label>
        <input type ="number" class="form-control" name="warranty"  max = "9999999999" value = "{{$products->warranty}}"placeholder="Warranty"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Transport : </label>
        <input type ="text" class="form-control" name="transport" value = "{{$products->transport}}"placeholder="Transport"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">HasTVA : </label>
        <input type ="checkbox" class="form-control" name="hasTVA"  checked  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Description : </label>
        <input type ="text" class="form-control" name="description" value = "{{$products->description}}"placeholder="Description"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">NormalPrice : </label>
        <input type ="number" class="form-control" name="normalPrice"  max = "9999999999" value = "{{$products->normalPrice}}"placeholder="NormalPrice"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">PromoPrice : </label>
        <input type ="number" class="form-control" name="promoPrice"  max = "9999999999" value = "{{$products->promoPrice}}"placeholder="PromoPrice"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">BigImageUrl : </label>
        <input type ="text" class="form-control" name="bigImageUrl" value = "{{$products->bigImageUrl}}"placeholder="BigImageUrl"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">SmallImageUrl : </label>
        <input type ="text" class="form-control" name="smallImageUrl" value = "{{$products->smallImageUrl}}"placeholder="SmallImageUrl"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Category id : </label>
        <input type ="number" class="form-control" name="category_id"  max = "9999999999" value = "{{$products->category_id}}"placeholder="Category id"  required />
    </div>

   <div class="form-group">
        <label class="text-danger">Manifacturer id : </label>
        <input type ="number" class="form-control" name="manifacturer_id"  max = "9999999999" value = "{{$products->manifacturer_id}}"placeholder="Manifacturer id"  required />
    </div>

 
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update" />
    </div>
</form>

    @if(isset($products->manifacturers))
    <h3>Update Manifacturers</h3>
<form action="{{url("/products/updateManifacturers/$products->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="manifacturers">
        @forelse(\App\Manifacturers::all() as  $manifacturers)
        <option value="{{$manifacturers->id}}" @if($manifacturers->id == $products->manifacturers->id) selected = "selected" @endif>
            {{$manifacturers->name}}
        </option>
        @empty
        <option value="-1">No manifacturers</option>
        @endforelse
    </select><br/>

    <input type="submit"  class="btn btn-primary" value="Update"/>
</form>
    @else
                    <h3>Update Manifacturers</h3>
<form action="{{url("/products/updateManifacturers/$products->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" name="manifacturers">
        @forelse(\App\Manifacturers::all() as  $manifacturers)
        <option value="{{$manifacturers->id}}">
            {{$manifacturers->name}}
        </option>
        @empty
        <option value="-1">No manifacturers</option>
        @endforelse
    </select><br/>

    <input type="submit"  class="btn btn-primary" value="Update"/>
</form>            @endif
    @if(isset($products->categories))
    <h3 class="text-danger">Associate Categories</h3>
<form action="{{url("/products/addCategories/$products->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" multiple="multiple" size="10"  name="categories[]">
        @forelse(\App\Categories::all() as  $categories)
        <option value="{{$categories->id}}" @foreach($products->categories as  $categoriestmp) @if($categoriestmp->id == $categories->id) selected = "selected" @endif @endforeach>
                {{$categories->name}}
        </option>
        @empty
        <option value="-1">No categories</option>
        @endforelse
    </select><br/>

    <script>
        var demo1 = $('select[name="categories[]"]').bootstrapDualListbox(
                {
                    nonSelectedListLabel: 'List of Categories',
                    selectedListLabel: 'Selected Categories'
                }
        );
    </script>

    <input type="submit"  class="btn btn-primary" value="Associate"/>
</form>
    @else
                    <h3 class="text-danger">Associate Categories</h3>
<form action="{{url("/products/addCategories/$products->id")}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control" multiple="multiple" size="10"  name="categories[]">
        @forelse(\App\Categories::all() as  $categories)
        <option value="{{$categories->id}}">
            {{$categories->name}}
        </option>
        @empty
        <option value="-1">No categories</option>
        @endforelse
    </select><br/>

    <script>
        var demo1 = $('select[name="categories[]"]').bootstrapDualListbox(
                {
                    nonSelectedListLabel: 'List of Categories',
                    selectedListLabel: 'Selected Categories'
                }
        );
    </script>

    <input type="submit"  class="btn btn-primary" value="Associate"/>
</form>            @endif
@endsection