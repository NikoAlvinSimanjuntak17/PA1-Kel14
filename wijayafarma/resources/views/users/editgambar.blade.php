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
    <div class="container">
        <div class="p-5">
            <div class="container text-center">
                <div class="row">
                  <div class="col">
                    @if (empty(Auth::user()->user_img))
                    <a href="{{route('editgambar')}}"><img src="{{asset('users/img/profile.png')}}" alt="Foto Profil"></a>
                      @else
                      <img src="{{asset(Auth::user()->user_img)}}" style="width: 300px" alt="Foto Profil">
                      @endif
                  </div>
                  <div class="col">
                    <div class="mb-3">
                        <form action="{{route('updategambar')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="formFileDisabled" class="form-label">Masukkan Foto Baru</label>
                            <input class="form-control" type="file" id="formFileDisabled" name="user_img">
                            <input type="submit" class="btn btn-success mt-5" value="Update">
                        </form>
                        </div>
                  </div>
                </div>
              </div>
        </div>
</div>
@endsection
