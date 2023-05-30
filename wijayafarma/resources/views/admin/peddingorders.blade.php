@extends('admin.layouts.template')
@section('title','Admin | peddingorders')
@push('css')
    <link href="{{asset('css/tables.css')}}" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dtbl').DataTable();
        });
    </script>
@endpush
@section('content')
<div class="container-fluid p-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages / </span> All Product</h4>
    <div class="card">
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header">All Product Information</h5>
        <table class="table" >
            <tr>
    <th>User Id</th>
    <th>Status</th>
    <th>OrderDate</th>
    <th>Action</th>
            </tr>
    @foreach ($peding_orders as $order)
    <tr>
        <td>{{$order->user_id}}</td>
        <td>{{$order->status}}</td>
        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y')}}</td>
        <td><a href="{{route('pendingorderdetail',$order->id)}}" class="btn btn-primary">view</a></td>
    </tr>
    @endforeach
        </table>
 </div>
    </div>
    </div>
@endsection
