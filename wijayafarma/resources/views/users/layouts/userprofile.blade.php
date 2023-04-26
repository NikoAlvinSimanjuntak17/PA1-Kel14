@extends('users.layouts.templete')
@section('title','WijayaFarma | Profile')
@section('css')
<style>
    .header{
        background-color: black;
        opacity: 0.8s;
    }
    .user-profile {
  display: flex;
  align-items: center;
  font-family: sans-serif;
  color: #333;
  padding: 1rem;
  border-radius: 10px;
}

.profile-image {
  width: 100px;
  height: 100px;
  margin-right: 1rem;
  overflow: hidden;
  border-radius: 50%;
  border: 5px solid #fff;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}

.profile-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.profile-info {
  flex-grow: 1;
}

.profile-name {
  margin: 0;
  font-size: 1.5rem;
}

.profile-details {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.profile-details p {
  margin: 0;
  margin-right: 1.5rem;
  font-size: 0.8rem;
  display: flex;
  align-items: center;
}

.profile-details p i {
  margin-right: 0.5rem;
  font-size: 1.2rem;
}

.profile-details p:last-of-type {
  margin-right: 0;
}
.profile-body{
    background-color: #f5f5f5;
}
    </style>
@endsection
@section('main-content')
<br><br><br><br><br>
<div class="profile-body">

    <div class="user-profile container">
        <div class="profile-image">
            <img src="{{asset('admindasboard/assets/img/avatars/5.png')}}" alt="Foto Profil">
        </div>
        <div class="profile-info">
          <h2 class="profile-name">{{Auth::user()->name}}</h2>
          <div class="profile-details">
            <p class="profile-email"><i class="far fa-envelope"></i>{{Auth::user()->email}}</p>
            <p class="profile-birthday"><i class="fas fa-birthday-cake"></i> 01 Januari 1990</p>
        </div>
        </div>
    </div>
</div>

    <div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box-main">
                <ul>
                    <li><a href="{{route('userprofile')}}">Dasboard</a></li>
                    <li><a href="{{route('peddingorders')}}">Pedding Orders</a></li>
                    <li><a href="{{route('history')}}">History</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box-main">
               @yield('profilecontent')
            </div>
        </div>
    </div>
</div>
@endsection