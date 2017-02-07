@extends('master')
@section('content')
<h1 class="text-danger">List of Categories_productss</h1>

<div class="row">

    <div class="col-md-8 col-sm-8">
<form action="{{url("/categories_products/search")}}" method="get">

    <div class="col-md-2 col-sm-2">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </div>

    <div class="col-md-10 col-sm-10">
        <input  type="text" class="form-control" name="keyword" placeholder="{{session('keyword', 'Keyword')}}"/>
    </div>


</form>
    </div>

    <div class="col-md-1 col-sm-1">
        <form action="{{url("/categories_products")}}" method="get">
            <button type="submit" class="btn btn-primary">Clear Search</button>
        </form>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-2 col-sm-2">
        <form action="{{url("/categories_products/create")}}" method="get">
            <button type="submit" class="btn btn-primary">Add new Categories_products</button>
        </form>
    </div>
</div>
<br/>

<table class="table table-striped">
    <thead>
        <tr>
                           <th class="c_numeric">
                <form action="{{url("/categories_products/sort")}}" method="get">
                    <input type="hidden" name="products_id"/>
                <button class="btn btn-link" type="submit"><p @if(session('products_id', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Products<br/>id <img src="{{ URL::asset(session('products_id', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/categories_products/sort")}}" method="get">
                    <input type="hidden" name="categories_id"/>
                <button class="btn btn-link" type="submit"><p @if(session('categories_id', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Categories<br/>id <img src="{{ URL::asset(session('categories_id', 'none').'.png') }}" /></p></button>
                </form>
            </th> 
        </tr>
    </thead>

    <tbody>
        @forelse($categories_productss as $categories_products)
            <tr>
               <td class="c_numeric">{{$categories_products->products_id}}</td>
              <td class="c_numeric">{{$categories_products->categories_id}}</td>
             <td class="defaut"><form action="{{url("/categories_products/$categories_products->id")}}" method="get">
                <button type="submit" class="btn btn-link">View</button>
            </form>
        </td>
        <td class="defaut"><form action="{{url("/categories_products/$categories_products->id")}}/edit" method="get">
                <button type="submit" class="btn btn-link">Edit</button>
            </form>
        </td>
        <td class="defaut">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-link" ng-click="showModal('Delete', 'Do you really want to delete {{ $categories_products->id}} ?', '{{url("/categories_products/$categories_products->id")}}')">Delete</button>
        </td>
                    </tr>
        @empty
            <tr>
                <td colspan="3"><label class="text-danger">No categories_products matching keyword {{session('keyword', 'Keyword')}}.</label></td>
            </tr>
        @endforelse
    </tbody>
</table>
{!!$categories_productss->links()!!}@endsection