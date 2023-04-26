@php
$categories = App\Models\Category::latest()->get();
$product = App\Models\Product::latest()->get();
@endphp
@extends('users.layouts.templete')
@section('title','WijayaFarma | Category')
@section('css')
<link rel="stylesheet" href="{{asset('users/css/category.css')}}">
@endsection
@section('main-content')
<!--  Content -->
<div class="container">
    <!-- End Featured Services Section -->
                <section class="section reveal product">
                  <div class="container">
          <br>


            <h2 class="h2 title_product">All Products</h2>

<div>
            <div class="search-box p-4 ">
              <button class="btn-search"><i class="bi bi-search"></i></button>
              <input type="text" class="input-search" placeholder="Type to Search...">
            </div>

            <div class="container p-3">
                <div id="mySidenav" class="sidenav">
                   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                   <a href="index.html">Home</a>
                   @foreach ($categories as $categori)
                   <a href="{{route('category',[$categori->id, $categori->slug]) }}">{{$categori->category_name}}</a>
                   @endforeach
                </div>
                <span class="toggle_icon" onclick="openNav()"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16" style="color: black;">
                   <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                   <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                 </svg></span>
                <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($categories as $categori)
                    <a class="dropdown-item" href="{{route('category',[$categori->id, $categori->slug]) }}">{{$categori->category_name}}</a>
                    @endforeach

                   </div>
                      <div class="dropdown-menu ">
                         <a href="#" class="dropdown-item">
                         <img src="images/flag-france.png" class="mr-2" alt="flag">
                         French
                         </a>
                      </div>
                   </div>
            </div>
            </div>

          </div>
          <div>
              <ul class="product-list">

                  @foreach ($product as $produc)
              <li class="product-item">
                <div class="product-card" tabindex="0">

                  <figure class="card-banner">
                    <img src="{{asset($produc->product_img)}}" width="312" height="350" loading="lazy"  class="image-contain">

                            <ul class="card-action-list">

                              <li class="card-action-item">
                                <form action="{{route('addproducttocart',$produc->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$produc->id}}" name="product_id">
                                    <input type="hidden" value="{{$produc->price}}" name="price">
                                    <input type="hidden" value="1" name="quantity">
                                    <li class="card-action-item">
                                        <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                                    <ion-icon name="cart-outline"></ion-icon>
                                  </button>
                                  <div class="card-action-tooltip" id="card-label-1">Beli Sekarang</div>
                                </li>
                            </form>



                              <li class="card-action-item">
                                <a href="{{route('singleproduct',[$produc->id,$produc->slug])}}"><button class="card-action-btn" aria-labelledby="card-label-3">
                                  <ion-icon name="eye-outline"></ion-icon>
                                </button>

                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>
                              </a>
                              </li>



                            </ul>
                          </figure>

                          <div class="card-content">

                            <div class="card-cat">
                              <a href="#" class="card-cat-link">{{$produc->product_category_name}}</a>
                            </div>

                            <h3 class="h3 card-title">
                              <a href="#">{{$produc->product_name}}</a>
                            </h3>

                            <data class="card-price" value="180.85">{{$produc->price}}</data>

                          </div>

                        </div>
                      </li>
                      @endforeach




                        </div>
                      </li>
                    </ul>

                  </div>
                  </section>
                  <div class="page-btn container">
              <span>1</span>
              <span>2</span>
              <span>3</span>
              <span>4</span>
              <span>&#8594;</span>
            </div>
          </div>
        </div>

@endsection
@section('js')
@endsection
