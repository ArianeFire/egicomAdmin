@extends('master')
@section('content')
@if(isset($products->manifacturers) && "manifacturers" == $table)
    <h3 class="text-danger">Manifacturers : </h3>
     {{$products->manifacturers->name}}
     @else

    @endif
    @if(isset($products->categories) && "categories" == $table)
    <div class="row">
    <div class="col-md-4">
        <h1 class="text-danger">List of Categoriess</h1>
    </div>

    <div class="col-md-5">
        {{ session(['defaultSelect' => $products->id]) }}
        <h4 class="text-danger"><b>Products : {{$products->name}}</b></h4>
    </div>
</div>

<div class="row">

    <div class="col-md-8 col-sm-8">
        <form action="{{url("/products/search")}}" method="get">
            <input type="hidden" name="tab" value="{{$table}}" />
            <div class="col-md-2 col-sm-2">
                <input type="submit" class="btn btn-primary" value="Search"/>
            </div>

            <div class="col-md-10 col-sm-10">
                <input  type="text" class="form-control" name="keyword" placeholder="{{session('keyword', 'Keyword')}}"/>
            </div>


        </form>
    </div>

    <div class="col-md-1 col-sm-1">
        <form action="{{url(Request::url())}}" method="get">
            <input type="hidden" name="cs" />
            <button type="submit" class="btn btn-primary">Clear Search</button>
        </form>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-2 col-sm-2">
        <form action="{{url("/categories/create")}}" method="get">
            <button type="submit" class="btn btn-primary">Add new Categories</button>
        </form>
    </div>
</div>
<br/>


<table class="table table-striped">
    <thead>
    <tr>
                       <th class="c_string">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="name"/>
                    <input type="hidden" name="tab" value="{{$table}}" />
                    <button class="btn btn-link" type="submit"><p @if(session('name', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Name <img src="{{ URL::asset(session('name', 'none').'.png') }}" /></p></button>
                </form>
            </th> 
    </tr>
    </thead>

    <tbody>
    @forelse($products->categories_paginated as  $categories)
    <tr>
                       <td class="c_string">{{$categories->name}}</td>
                 <td class="defaut"><form action="{{url("/categories/$categories->id")}}" method="get">
                <button type="submit" class="btn btn-link">View</button>
            </form>
        </td>
        <td class="defaut"><form action="{{url("/categories/$categories->id")}}/edit" method="get">
                <button type="submit" class="btn btn-link">Edit</button>
            </form>
        </td>
        <td class="defaut">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-link" ng-click="showModal('Delete', 'Do you really want to delete {{ $categories->name}} ?', '{{url("/categories/$categories->id")}}')">Delete</button>
        </td>
             </tr>
    @empty
    <tr>
        <td colspan="2"><label class="text-danger">No categories matching keyword {{session('keyword', 'Keyword')}}.</label></td>
    </tr>
    @endforelse
    </tbody>
</table>
{!!$products->categories_paginated->links()!!}    @else

    @endif
@endsection