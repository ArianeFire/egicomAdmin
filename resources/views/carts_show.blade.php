@extends('master')
@section('content')
<h1 class="text-danger">List of Cartss</h1>

<div class="row">

    <div class="col-md-8 col-sm-8">
<form action="{{url("/carts/search")}}" method="get">

    <div class="col-md-2 col-sm-2">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </div>

    <div class="col-md-10 col-sm-10">
        <input  type="text" class="form-control" name="keyword" placeholder="{{session('keyword', 'Keyword')}}"/>
    </div>


</form>
    </div>

    <div class="col-md-1 col-sm-1">
        <form action="{{url("/carts")}}" method="get">
            <button type="submit" class="btn btn-primary">Clear Search</button>
        </form>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-2 col-sm-2">
        <form action="{{url("/carts/create")}}" method="get">
            <button type="submit" class="btn btn-primary">Add new Carts</button>
        </form>
    </div>
</div>
<br/>

<table class="table table-striped">
    <thead>
        <tr>
                           <th class="c_numeric">
                <form action="{{url("/carts/sort")}}" method="get">
                    <input type="hidden" name="users_id"/>
                <button class="btn btn-link" type="submit"><p @if(session('users_id', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Users<br/>id <img src="{{ URL::asset(session('users_id', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_numeric">
                <form action="{{url("/carts/sort")}}" method="get">
                    <input type="hidden" name="products_id"/>
                <button class="btn btn-link" type="submit"><p @if(session('products_id', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Products<br/>id <img src="{{ URL::asset(session('products_id', 'none').'.png') }}" /></p></button>
                </form>
            </th> 
        </tr>
    </thead>

    <tbody>
        @forelse($cartss as $carts)
            <tr>
               <td class="c_numeric">{{$carts->users_id}}</td>
              <td class="c_numeric">{{$carts->products_id}}</td>
             <td class="defaut"><form action="{{url("/carts/$carts->id")}}" method="get">
                <button type="submit" class="btn btn-link">View</button>
            </form>
        </td>
        <td class="defaut"><form action="{{url("/carts/$carts->id")}}/edit" method="get">
                <button type="submit" class="btn btn-link">Edit</button>
            </form>
        </td>
        <td class="defaut">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-link" ng-click="showModal('Delete', 'Do you really want to delete {{ $carts->id}} ?', '{{url("/carts/$carts->id")}}')">Delete</button>
        </td>
                    <td class="defaut">
                <form action="{{url("/carts/related/$carts->id")}}" method="get">
                    <input type="hidden" name="tab" value="users" />
                    <button type="submit" class="btn btn-link">Users</button>
                </form>
            </td>
                    </tr>
        @empty
            <tr>
                <td colspan="3"><label class="text-danger">No carts matching keyword {{session('keyword', 'Keyword')}}.</label></td>
            </tr>
        @endforelse
    </tbody>
</table>
{!!$cartss->links()!!}@endsection