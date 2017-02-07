@extends('master')
@section('content')
<h1 class="text-danger">List of Productss</h1>

<div class="row">

    <div class="col-md-8 col-sm-8">
<form action="{{url("/products/search")}}" method="get">

    <div class="col-md-2 col-sm-2">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </div>

    <div class="col-md-10 col-sm-10">
        <input  type="text" class="form-control" name="keyword" placeholder="{{session('keyword', 'Keyword')}}"/>
    </div>


</form>
    </div>

    <div class="col-md-1 col-sm-1">
        <form action="{{url("/products")}}" method="get">
            <button type="submit" class="btn btn-primary">Clear Search</button>
        </form>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-2 col-sm-2">
        <form action="{{url("/products/create")}}" method="get">
            <button type="submit" class="btn btn-primary">Add new Products</button>
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
                <button class="btn btn-link" type="submit"><p @if(session('name', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Name <img src="{{ URL::asset(session('name', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="availability"/>
                <button class="btn btn-link" type="submit"><p @if(session('availability', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Availability <img src="{{ URL::asset(session('availability', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="warranty"/>
                <button class="btn btn-link" type="submit"><p @if(session('warranty', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Warranty <img src="{{ URL::asset(session('warranty', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_string">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="transport"/>
                <button class="btn btn-link" type="submit"><p @if(session('transport', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Transport <img src="{{ URL::asset(session('transport', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="hasTVA"/>
                <button class="btn btn-link" type="submit"><p @if(session('hasTVA', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >HasTVA <img src="{{ URL::asset(session('hasTVA', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_string">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="description"/>
                <button class="btn btn-link" type="submit"><p @if(session('description', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Description <img src="{{ URL::asset(session('description', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="normalPrice"/>
                <button class="btn btn-link" type="submit"><p @if(session('normalPrice', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >NormalPrice <img src="{{ URL::asset(session('normalPrice', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/products/sort")}}" method="get">
                    <input type="hidden" name="promoPrice"/>
                <button class="btn btn-link" type="submit"><p @if(session('promoPrice', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >PromoPrice <img src="{{ URL::asset(session('promoPrice', 'none').'.png') }}" /></p></button>
                </form>
            </th>
        </tr>
    </thead>

    <tbody>
        @forelse($productss as $products)
            <tr>
               <td class="c_string">{{$products->name}}</td>
              <td class="c_numeric">@if($products->availability == 0) Oui @else non @endif</td>
              <td class="c_numeric">{{$products->warranty}}</td>
              <td class="c_string">{{$products->transport}}</td>
              <td class="c_numeric">@if($products->hasTVA == 0) Oui @else non @endif</td>
              <td class="c_string">{{$products->description}}</td>
              <td class="c_numeric">{{$products->normalPrice}}</td>
              <td class="c_numeric">{{$products->promoPrice}}</td>
             <td class="defaut"><form action="{{url("/products/$products->id")}}" method="get">
                <button type="submit" class="btn btn-link">View</button>
            </form>
        </td>
        <td class="defaut"><form action="{{url("/products/$products->id")}}/edit" method="get">
                <button type="submit" class="btn btn-link">Edit</button>
            </form>
        </td>
        <td class="defaut">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-link" ng-click="showModal('Delete', 'Do you really want to delete {{ $products->name}} ?', '{{url("/products/$products->id")}}')">Delete</button>
        </td>
                    <td class="defaut">
                <form action="{{url("/products/related/$products->id")}}" method="get">
                    <input type="hidden" name="tab" value="manifacturers" />
                    <button type="submit" class="btn btn-link">Manifacturers</button>
                </form>
            </td>
                    <td class="defaut">
                <form action="{{url("/products/related/$products->id")}}" method="get">
                    <input type="hidden" name="tab" value="categories" />
                    <button type="submit" class="btn btn-link">Categories</button>
                </form>
            </td>
                    </tr>
        @empty
            <tr>
                <td colspan="13"><label class="text-danger">No products matching keyword {{session('keyword', 'Keyword')}}.</label></td>
            </tr>
        @endforelse
    </tbody>
</table>
{!!$productss->links()!!}@endsection