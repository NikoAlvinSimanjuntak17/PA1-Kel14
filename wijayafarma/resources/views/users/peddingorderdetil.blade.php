@extends('users.layouts.userprofile')

@section('profilecontent')
    <h3>Pending Orders</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif

    <table class="table">
        <tr>
            <th>Order id</th>
            <th>id Product</th>
            <th>Product</th>
            <th>quantity</th>
            <th>Price</th>
            <th>Gambar produk</th>
            <th>nomor telepon</th>
            <th>kota</th>
            <th>postal code</th>
            <th></th>

        </tr>

            <tr>
                <td>{{$pedding->id}}</td>
                <td>@foreach (json_decode($pedding->product_id) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($pedding->product_nama) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($pedding->quantity) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($pedding->totalprice) as $item)
                    <p>{{'Rp'.number_format($item,0,',', '.')}}</p>
                @endforeach</td>
                @php

                @endphp
                <td>
                    @foreach(json_decode($pedding->product_img) as $item)
                    <img src="{{asset($item)}}" style="width: 100px" alt="">
                @endforeach</td>
                <td>{{$pedding->shipping_phonenumber}}</td>
                <td>{{$pedding->shipping_city}}</td>
                <td>{{$pedding->shipping_postalcode}}</td>
                <td></td>
            </tr>
            @php


            @endphp
            <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="5">
                    @php
                        $total = 0; // Variabel untuk menyimpan total jumlah
                    @endphp

                    @foreach (json_decode($pedding->totalprice) as $jumlah)
                        @php
                            $total += $jumlah; // Menambahkan nilai $jumlah ke total
                        @endphp
                    @endforeach
                    <p>{{'Rp '.number_format($total,0,',', '.') }}</p>
                </td>
                <td><a href="{{route('peddingorders')}}" class="btn btn-danger">back</a></td>

            </tr>

    </table>
@endsection
