@extends('users.layouts.userprofile')
@section('title','WijayaFarma | Profile')
@section('profilecontent')
<head>
<style>
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
    </style>
</head>
<body>
    <br><br>
<div class="col-lg-20">
    <div class="card">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-sm-3">
                    <h6 class="mb-0">User Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{Auth::user()->email}}" disabled>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-3">
                    <h6 class="mb-0">Birthday Date</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="date" class="form-control" value="" disabled>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-3">
                    <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <textarea class="form-control" cols="33"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <input type="button" class="btn btn-primary px-4" value="Save">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
