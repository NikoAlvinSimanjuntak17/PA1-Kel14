@extends('users.layouts.templete')
@section('title','WijayaFarma | Add To Cart')
@section('main-content')
<h1 style="position: ">add TO cart</h1>
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
@endsection
