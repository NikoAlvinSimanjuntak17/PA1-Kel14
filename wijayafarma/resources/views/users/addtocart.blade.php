@extends('users.layouts.templete')
@section('title','WijayaFarma | Add To Cart')
@section('css')
<style>
    .header{
        background-color:black;
        opacity: 0.8;
    }
</style>
@endsection
@section('main-content')
<div class="container">
<br><br><br><br><br><br><br><br>
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Product Image</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart_items as $item)
                    <tbody>
                    <tr>
                        @php
$product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
$img = App\Models\Product::where('id',$item->product_id)->value('product_img');
@endphp
                        <td><img src="{{asset($img)}}" style="width: 50px; height:50px;"  alt=""></td>
                        <td>{{$product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                        <td><a href="{{route('removeitem',$item->id)}}" class="btn btn-warning">Remove</a></td>
                    </tr>
                    @php
                        $total = $total + $item->price;
                    @endphp
                        @endforeach
                        @if ($total >0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{ 'Rp '.number_format($total, 0, ',', '.') }}</td>
                            <td><a href="{{route('shippingaddress')}}" class="btn btn-primary">Checkout Now</a></td>


                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
