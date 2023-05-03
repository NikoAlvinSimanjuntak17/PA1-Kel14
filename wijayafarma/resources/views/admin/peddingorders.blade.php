@extends('admin.layouts.template')
@section('title','Admin | peddingorders')
@section('content')
 <div class="container my-5">
    <div class="card p-4">
    <div class="card-title">
        <h2 class="text">Pending Orders</h2>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
    <th>User Id</th>
    <th>Shipping Information</th>
    <th>Product Id</th>
    <th>Quantity</th>
    <th>Total WIll Pay</th>
    <th>Status</th>
    <th>Action</th>
            </tr>
    @foreach ($peding_orders as $order)
    <tr>
        <td>{{$order->user_id}}</td>
        <td>
            <ul>
                <li>Phone Number - {{$order->shipping_phonenumber}}</li>
                <li>City - {{$order->shipping_city}}</li>
                <li>City - {{$order->shipping_postalcode}}</li>
            </ul>
        </td>
        <td>{{$order->product_id}}</td>
        <td>{{$order->quantity}}</td>
        <td>{{$order->total_price}}</td>
        <td><a href="" class="btn btn-success">Approve Now</a></td>
    </tr>
    @endforeach
        </table>
 </div>
    </div>
@endsection
