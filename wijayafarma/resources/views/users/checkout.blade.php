@extends('users.layouts.templete')
@section('title','WijayaFarma | Check out')
@section('main-content')
<br><br><br><br><br><br>
<div class="container">
<h2 style="position: ">Final Step TO Place Your Order</h2>
<div class="row">
    <div class="col-8">
        <div class="box-main">
            <h3>Product Will Send At-</h3>
            <p>City/Village- {{$shipping_address->city_name}}</p>
            <p>City/Village- {{$shipping_address->postal_code}}</p>
            <p>City/Village- {{$shipping_address->phone_number}}</p>

        </div>
    </div>

    <div class="col-4">
        <div class="box-main">
            <h3>Your Final Products Are-</h3>
            <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Quantity</td>
                                    <td>Price</td>

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
            @endphp
                                    <td>{{$product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                                </tr>
                                @php
                                    $total = $total + $item->price;
                                @endphp
                                    @endforeach
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{ 'Rp '.number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                                                </tbody>
                            </table>
                        </div>
        </div>
    </div>
</div>
</div>
<div class="d-flex">
    <form action="">
        @csrf
        <input type="submit" value="Cancel Order" class="btn btn-danger">
    </form>
<form action="{{route('placeorder')}}" method="POST">
    @csrf
    <input type="submit" value="Place Order" class="btn btn-primary ms-3">
</form>

</div>
</div>
@endsection
