@extends('admin.layouts.template')
@section('title','Admin | allcategory')
@section('content')
<div class="container p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages / </span> All Categori</h4>
    <div class="card">
        <h5 class="card-header">Light Table head</h5>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif


        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">

                <tr>
                    <th>ID</th>
                <th>Nama Categori</th>
                <th>SUB Categori</th>
                <th>Slug</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($categories as $categori )
              <tr>
                  <td>{{$categori->id}}</td>
                <td>{{$categori->category_name}}</td>
                <td>{{$categori->subcategory_count}}</td>
                <td>{{$categori->slug}}</td>
                <td>
                    <a href="{{route('editcategory',$categori->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('deletecategory', $categori ->id)}}" class="btn btn-warning" id="delete">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection
