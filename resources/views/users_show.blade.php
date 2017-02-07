@extends('master')
@section('content')
<h1 class="text-danger">List of Userss</h1>

<div class="row">

    <div class="col-md-8 col-sm-8">
<form action="{{url("/users/search")}}" method="get">

    <div class="col-md-2 col-sm-2">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </div>

    <div class="col-md-10 col-sm-10">
        <input  type="text" class="form-control" name="keyword" placeholder="{{session('keyword', 'Keyword')}}"/>
    </div>


</form>
    </div>

    <div class="col-md-1 col-sm-1">
        <form action="{{url("/users")}}" method="get">
            <button type="submit" class="btn btn-primary">Clear Search</button>
        </form>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-2 col-sm-2">
        <form action="{{url("/users/create")}}" method="get">
            <button type="submit" class="btn btn-primary">Add new Users</button>
        </form>
    </div>
</div>
<br/>

<table class="table table-striped">
    <thead>
        <tr>
                           <th class="c_string">
                <form action="{{url("/users/sort")}}" method="get">
                    <input type="hidden" name="name"/>
                <button class="btn btn-link" type="submit"><p @if(session('name', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Name <img src="{{ URL::asset(session('name', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_string">
                <form action="{{url("/users/sort")}}" method="get">
                    <input type="hidden" name="email"/>
                <button class="btn btn-link" type="submit"><p @if(session('email', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Email <img src="{{ URL::asset(session('email', 'none').'.png') }}" /></p></button>
                </form>
            </th>              <th class="c_string">
                <form action="{{url("/users/sort")}}" method="get">
                    <input type="hidden" name="password"/>
                <button class="btn btn-link" type="submit"><p @if(session('password', 'keyword') != "keyword") ng-style = "{ 'font-weight': 'bold', 'text-decoration' : 'underline' }" @endif >Password <img src="{{ URL::asset(session('password', 'none').'.png') }}" /></p></button>
                </form>
            </th> 
        </tr>
    </thead>

    <tbody>
        @forelse($userss as $users)
            <tr>
               <td class="c_string">{{$users->name}}</td>
              <td class="c_string">{{$users->email}}</td>
              <td class="c_string">{{$users->password}}</td>
             <td class="defaut"><form action="{{url("/users/$users->id")}}" method="get">
                <button type="submit" class="btn btn-link">View</button>
            </form>
        </td>
        <td class="defaut"><form action="{{url("/users/$users->id")}}/edit" method="get">
                <button type="submit" class="btn btn-link">Edit</button>
            </form>
        </td>
        <td class="defaut">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-link" ng-click="showModal('Delete', 'Do you really want to delete {{ $users->name}} ?', '{{url("/users/$users->id")}}')">Delete</button>
        </td>
                    <td class="defaut">
                <form action="{{url("/users/related/$users->id")}}" method="get">
                    <input type="hidden" name="tab" value="carts" />
                    <button type="submit" class="btn btn-link">Carts</button>
                </form>
            </td>
                    </tr>
        @empty
            <tr>
                <td colspan="4"><label class="text-danger">No users matching keyword {{session('keyword', 'Keyword')}}.</label></td>
            </tr>
        @endforelse
    </tbody>
</table>
{!!$userss->links()!!}@endsection