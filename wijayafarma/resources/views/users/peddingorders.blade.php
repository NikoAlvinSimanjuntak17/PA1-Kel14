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
            <th>Product</th>
            <th>quantity</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($pending_orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>@foreach (json_decode($order->product_nama) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($order->quantity) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td><a href="{{route('peddingordersdetil',$order->id)}}" class="btn btn-info">Detil</button></td>
                <td><a href="" class="btn btn-danger">batal</a></td>
            </tr>
        @endforeach
    </table>
@endsection
