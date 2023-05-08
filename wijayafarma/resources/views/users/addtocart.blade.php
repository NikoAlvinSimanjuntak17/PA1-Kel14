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
                        <td><input type="checkbox" name="" id="select_all_ids"></td>
                        <td>Product id</td>
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
                    <tr id="cart{{$item->id}}">
                        @php
$product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
$img = App\Models\Product::where('id',$item->product_id)->value('product_img');
@endphp
<td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{$item->id}}"></td>
<td>{{$item->id}}</td>
                        <td><img src="{{asset($img)}}" style="width: 50px; height:50px;"  alt=""></td>
                        <td>{{$product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td class="item_price">{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                        <td><a href="{{route('removeitem',$item->id)}}" class="btn btn-warning">Remove</a></td>
                    </tr>
                    @php
                        $total = $total + $item->price;
                    @endphp
                        @endforeach
                        @if ($total >0)
                    <tr>
                        <td>
                            <td></td>
                        </td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td id="total_price">{{'Rp '.number_format(0)}}</td>
                            <td><a href="{{route('shippingaddress')}}" class="btn btn-primary" id="checkout_button">Checkout Now</a></td>


                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function calculateTotal() {
    var total = 0;
    $('.checkbox_ids:checked').each(function(){
        var price = parseFloat($(this).closest('tr').find('.item_price').text().replace(/[^0-9.-]+/g,""));
        total += price;
    });
    if (total > 0) {
        $('#total_price').text(' Rp ' + total.toFixed(3).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
    } else {
        $('#total_price').text(' Rp 0');
    }
}

$(function() {
    // Checkbox all
    $('#select_all_ids').click(function(){
        $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        calculateTotal();
    });

    // Checkbox individual
    $('.checkbox_ids').click(function(){
        calculateTotal();
    });
});
</script>
@endsection-
