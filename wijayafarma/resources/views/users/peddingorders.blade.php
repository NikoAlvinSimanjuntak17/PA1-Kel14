@extends('users.layouts.userprofile')

@section('profilecontent')
pedding orders
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<table class="table">
    <tr>
        <th>Product Id</th>
        <th>Price</th>
    </tr>
    @foreach ($pending_orders as $order)
        <tr>
            <td>{{$order->product_id}}</td>
            <td>{{$order->totalprice}}</td>
            {{-- <td>{{$order->product_id}}</td> --}}
            {{-- <td>{{$order->product_id}}</td> --}}
        </tr>
    @endforeach
</table>
@endsection
