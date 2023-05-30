@extends('users.layouts.templete')
@section('title','WijayaFarma | Check out')
@section('css')
<style>
    input{
        border-bottom:1px solid black;
        padding:0.5em;
        margin: 0.4em;
    }
    input:focus {
        outline: none;
    }
</style>
@endsection
@section('main-content')
<br><br><br><br><br><br>
<div class="container">
<h2 style="position: ">Final Step TO Place Your Order</h2>
<div class="row">
    <div class="col-8">
        <div class="box-main">
            <h3>Product Will Send At-</h3>
<form action="{{route('placeorder')}}" method="POST">
    @csrf
   <input type="text" placeholder="nama kota"  name="shipping_city" required>
<input type="text" placeholder="Postal Code" name="shipping_postalcode" required>
<input type="text" placeholder="Alamat" name="address" required>
<input type="text" placeholder="phone number" name="shipping_phonenumber" required>
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
                                    <td>Count</td>

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
                                    @php
                                        $count = $item->quantity * $item->price
                                    @endphp
                                    <td>{{'Rp '.number_format($count)}}</td>
                                </tr>
                                @php
                                    $total = $total + $count;
                                @endphp
                                    @endforeach
                                <tr>
                                    <td></td>
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
<br><br><br><br><br><br>
<div class="d-flex">
        <a href="" class="btn btn-danger">Cancel Order</a>
    <input type="submit" value="Place Order" class="btn btn-primary ms-3">
</div>
</form>
</div>

<div class="col-md-8 container">
    <section class=" container col">
        <section class="rowered_1">
            <div class="row ">
             <h1 class="text-left" id="Profile">METODE PEMBAYARAN</h1>
             <p class="teks">Silahkan pilih metode yang anda inginkan</p>
             <div class="col-md-10 shadow my-5 py-2">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-block text-black dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            QRIS Mandiri
                          </button>
                        </h2>
                      </div>
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <center><img src="{{ asset('img/qris.jpg')}}"></center>
                        </div>
                      </div>
                    </div>
                 </div>
             </div>
         </div>
     </section>
    </section>
</div>
</div>
@endsection
