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
            <th>status</th>
            <th>order date</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($completed_orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>@foreach (json_decode($order->product_nama) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($order->quantity) as $item)
                    <p>{{$item}}</p>
                @endforeach</td>
                <td>{{$order->status}}</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y')}}</td>
                <td><a href="{{route('historidetil',$order->id)}}" class="btn btn-info">Detil</button></td>
            </tr>
        @endforeach
    </table>
@endsection
