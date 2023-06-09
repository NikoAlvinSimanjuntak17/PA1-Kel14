@php
    $all_penyakit = App\Models\deseases::latest()->get();
@endphp
@extends('users.layouts.templete')
@section('css')
<link rel="stylesheet" href="{{asset('users/css/deases.css')}}">
@endsection
@section('main-content')
<div class="container">
    <!-- End Featured Services Section -->

    <section class="section reveal product">
        <div class="container">
            <br>


            <h2 class="h2 title_product">Jenis Penyakit</h2>
{{--
            <div class="search-box p-4 ">
                <button class="btn-search"><i class="bi bi-search"></i></button>
                <input type="text" class="input-search" placeholder="Type to Search...">
            </div> --}}

        </div>
        <div>

            <div class="parent">
                @foreach ($all_penyakit as $penyakit)
          <div class="card">
            <div class="img">
<img src="{{asset($penyakit->Penyakit_img)}}" style="width:100%" alt="">
            </div>
            <span>{{$penyakit->Nama_Penyakit}}</span>
            <p class="info">{{$penyakit->Deskripsi}}</p>
            {{-- <button>Resume</button> --}}
          </div>


          @endforeach



  </div>


</section>
                  <div class="page-btn">
              <span>1</span>
              <span>2</span>
              <span>3</span>
              <span>4</span>
              <span>&#8594;</span>
            </div>
          </div>
        </div>
@endsection
