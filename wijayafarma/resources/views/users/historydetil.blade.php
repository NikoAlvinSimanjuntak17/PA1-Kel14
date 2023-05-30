@extends('users.layouts.userprofile')

@section('profilecontent')
<div class="p-2">
    <div class="card p-2">
        <div class="container text-center">
            <h4>Order Detail</h4>
            <div class="row">
              <div class="col text-start">
                <hr>
                <p>Order Id : {{$pedding->id}}</p>
                <p>Order Date : {{ \Carbon\Carbon::parse($pedding->created_at)->format('d M Y')}}</p>
                <h5 style="border: 1px solid black;color:chartreuse" class="p-2">Order Status Message : {{$pedding->status}}</h5>
            </div>
              <div class="col text-start">
                  <hr>
                  <p>user Id : {{$pedding->user_id}}</p>
                  <p>username : </p>
                  <p>Phone : {{$pedding->shipping_phonenumber}} </p>
                <p>Address : {{$pedding->address}}</p>
                <p>Kota : {{$pedding->shipping_city}}</p>
                <p>Postal code : {{$pedding->shipping_postalcode}}</p>
            </div>
        </div>
    </div>
    <div class="table-responsive container-fluid" >
                <h5>All Product Information</h5>
                <hr>
            <table class="table">
                <tr>
                    <th>Product Id</th>
                    <th>gambar</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total WIll Pay</th>
                </tr>
                {{-- @foreach ($pedding as $pedding) --}}
                <tr>
        <td>@foreach (json_decode($pedding->product_id) as $item)
            <p>{{$item}}</p>
            @endforeach</td>
            <td>@foreach (json_decode($pedding->product_nama) as $item)
            <p>{{$item}}</p>
        @endforeach</td>
        <td>
            @foreach(json_decode($pedding->product_img) as $item)
            <img src="{{asset($item)}}" style="width: 100px" alt="">
            @endforeach</td>
            <td>@foreach (json_decode($pedding->quantity) as $item)
                <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($pedding->totalprice) as $item)
                    <p>{{'Rp '.number_format($item,0,',','.')}}</p>
                    @endforeach</td>
                    <td>
                        @php
            $quantities = json_decode($pedding->quantity);
            $totalprices = json_decode($pedding->totalprice);
            @endphp
            @foreach ($quantities as $key => $item)
            @php
                $subtotal = $item * $totalprices[$key];
                @endphp
                <p>{{'Rp '.number_format($subtotal,0,',', '.') }}</p>
                @endforeach
            </td>
        </tr>
        <tr>
            <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="fw-bold">Total Amount</td>
        <td colspan="4">
            @php
            $quantities = json_decode($pedding->quantity);
            $totalprices = json_decode($pedding->totalprice);
            $total = 0;
            @endphp

    @foreach ($quantities as $key => $quantity)
    @php
                $subtotal = $quantity * $totalprices[$key];
                $total += $subtotal;
                @endphp
            @endforeach

            <p>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</p>
        </td>


    </tr>

    {{-- @endforeach --}}
    </table><br><br><br>
    <div>
        <h4>Bukti Pembayaran</h4>
        @if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
        <hr>
        <div class="row">
            <div class="mb-3">

                <img src="{{asset($pedding->img_bayar)}}" width="750px" alt="">
                              </div>
        </div>
       @if (empty($pedding->ulasan))
       <div class="row">
        <div class="mb-3">
            <h3>Beri komentar</h3>
            <form action="{{ route('komentar', ['id' => $pedding->id]) }}" method="POST">
                @csrf
            <textarea name="ulasan" name="ulasan" id="" cols="100" rows="10">Ayo Beri Komentar.....</textarea>
            <input type="submit" name="" value="Beri Komentar" id="" class="btn btn-success">
            </form>
                          </div>
    </div>
    @elseif(!empty($pedding->ulasan))
    <div class="mb-3">
        <h2>Ulasan Anda :</h2>
        <textarea name=""  id="" cols="95" rows="10" disabled class="p-3">{{$pedding->ulasan}}</textarea>
                      </div>
</div>
       @endif
    </div>
    </div>
</div>
<a href="{{route('peddingorders')}}" class="btn btn-danger float-end mt-3 mb-3">Back</a>
</div>

@endsection
